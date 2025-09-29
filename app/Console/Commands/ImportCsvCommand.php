<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\PelakuUsaha;
use App\Models\Alamat;
use App\Models\Investasi;
use App\Models\KapasitasProduksi;
use App\Models\TenagaKerja;
use App\Models\Kbli;

class ImportCsvCommand extends Command
{
    protected $signature = 'import:csv {path}';

    public function handle()
    {
        $path = $this->argument('path');

        if (!file_exists($path)) {
            $this->error("File tidak ditemukan di path: $path");
            return;
        }

        $this->info("Membaca file CSV: $path");
        $data = array_map('str_getcsv', file($path));
        $header = array_map('trim', array_shift($data));

        $successCount = 0;
        $duplicateCount = 0;

        DB::beginTransaction();

        try {
            foreach ($data as $index => $row) {
                $rowData = array_combine($header, $row);

                $this->line("Memproses baris " . ($index + 2));

                // Clean skala usaha dari "Usaha " prefix
                $skalaUsaha = trim(str_replace("Usaha ", "", $rowData['Skala Usaha']));

                // KBLI Utama
                $kbli = Kbli::firstOrCreate(
                    ['id_kbli' => $rowData['KBLI']],
                    ['jenis_kbli' => $rowData['Jenis KBLI']]
                );

                // KBLI Produk (jika ada)
                $kbliProduk = Kbli::firstOrCreate(
                    ['id_kbli' => $rowData['KBLI']],
                    ['jenis_kbli' => $rowData['Jenis KBLI']]
                );

                // Cek duplikat berdasarkan NIB dan Alamat
                $existing = PelakuUsaha::where('NIB', $rowData['NIB'])
                    ->where('id_kbli', $kbli->id_kbli)
                    ->first();

                if ($existing) {
                    $duplicateCount++;
                    $this->warn("⚠️ Duplikat ditemukan di baris " . ($index + 2));
                    continue;
                }

                // Insert pelaku_usaha
                $pelakuUsaha = PelakuUsaha::create([
                    'NIB' => $rowData['NIB'],
                    'nama' => $rowData['Nama'],
                    'jenis_badan_usaha' => $rowData['Jenis Badan Usaha'],
                    'skala_usaha' => $skalaUsaha,
                    'risiko' => $rowData['Risiko Usaha'],
                    'jenis_proyek' => $rowData['Jenis Proyek'],
                    'tanggal_permohonan' => $rowData['Tanggal Permohonan'],
                    'email' => $rowData['Email'],
                    'no_telp' => $rowData['No Telepon'],
                    'id_kbli' => $kbli->id_kbli
                ]);

                // Insert alamat
                Alamat::create([
                    'alamat_usaha' => $rowData['Alamat Usaha'],
                    'kelurahan' => $rowData['Kelurahan'],
                    'kecamatan' => $rowData['Kecamatan'],
                    'id_usaha' => $pelakuUsaha->id_usaha
                ]);

                // Insert investasi
                Investasi::create([
                    'modal_usaha' => (float) str_replace('.', '', $rowData['Modal Usaha']),
                    'investasi_mesin' => (float) str_replace('.', '', $rowData['Investasi Mesin']),
                    'investasi_lainnya' => (float) str_replace('.', '', $rowData['Investasi Lainnya']),
                    'id_usaha' => $pelakuUsaha->id_usaha
                ]);

                // Insert kapasitas_produksi
                KapasitasProduksi::create([
                    'nama_produk' => $rowData['Produk'],
                    'kapasitas' => (int) str_replace('.', '', $rowData['Kapasitas']),
                    'satuan' => $rowData['Satuan'],
                    'id_kbli' => $kbliProduk->id_kbli,
                    'id_usaha' => $pelakuUsaha->id_usaha
                ]);

                // Insert tenaga_kerja
                TenagaKerja::create([
                    'jumlah_tki_laki_laki' => (int) $rowData['Jumlah TKI Laki-laki'],
                    'jumlah_tki_perempuan' => (int) $rowData['Jumlah TKI Perempuan'],
                    'jumlah_tenaga_kerja_asing' => (int) $rowData['Jumlah Tenaga Kerja Asing'],
                    'id_usaha' => $pelakuUsaha->id_usaha
                ]);

                $successCount++;
            }

            DB::commit();

            $this->info("✅ Import selesai!");
            $this->info("✔️ Berhasil: $successCount");
            $this->info("⚠️ Duplikat di-skip: $duplicateCount");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error("❌ Error saat import: " . $e->getMessage());
        }
    }
}
