<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Investasi;
use App\Models\KapasitasProduksi;
use App\Models\Kbli;
use App\Models\PelakuUsaha;
use App\Models\TenagaKerja;
use App\Models\Laporan;
use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\SubKegiatan;
use App\Models\PenilaianPimpinan;
use App\Models\ArahanPimpinan;
use App\Models\Melaporkan;
use App\Models\DataPegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class DataController extends Controller
{
    public function index(Request $request)
    {
        // Get filter parameter
        $triwulan = $request->input('triwulan');
        $tahun = $request->input('tahun');
        $bidang = $request->input('bidang');

        // Build query with filters
        $query = Laporan::with([
            'programs.pegawaiPelapor',
            'programs.pimpinanMonev'
        ]);

        // Apply filters
        if ($triwulan) {
            $query->where('triwulan', $triwulan);
        }
        if ($tahun) {
            $query->where('tahun', $tahun);
        }
        if ($bidang) {
            $query->where('bidang', $bidang);
        }

        $laporans = $query->get();

        // Get unique values for filter dropdowns
        $triwulanList = Laporan::distinct()->pluck('triwulan')->filter()->sort()->values();
        $tahunList = Laporan::distinct()->pluck('tahun')->filter()->sort()->values();
        $bidangList = Laporan::distinct()->pluck('bidang')->filter()->sort()->values();

        return view('data-laporan', compact('laporans', 'triwulanList', 'tahunList', 'bidangList', 'triwulan', 'tahun', 'bidang'));
    }

    public function inputindustri()
    {
        $pegawai = DataPegawai::all();
        return view('input-industri', compact('pegawai'));
    }

    public function storeindustri(Request $request)
    {
        // Validate required fields first
        $validated = $request->validate([
            'bidang' => 'required|string',
            'tahun' => 'required|integer|min:2000|max:2100',
            'triwulan' => 'required|string',
        ]);

        // Map bidang values to database enum values
        $mapBidang = function($bidang) {
            $mapping = [
                'Sekretariat' => 'Sekretariat',
                'Teknologi Sumber Daya Industri' => 'TSDI',
                'TSDI' => 'TSDI',
                'UMKM' => 'IKM',
                'IKM' => 'IKM',
                'Koperasi' => 'Koperasi',
                'UPT Sumber' => 'UPT',
                'UPT' => 'UPT',
            ];
            return $mapping[$bidang] ?? $bidang;
        };

        // Map triwulan values (handle both formats)
        $mapTriwulan = function($triwulan) {
            // If already in correct format, return as is
            if (strpos($triwulan, 'Triwulan') !== false) {
                return $triwulan;
            }
            // Otherwise map from short format
            $mapping = [
                'I' => 'Triwulan I',
                'II' => 'Triwulan II',
                'III' => 'Triwulan III',
                'IV' => 'Triwulan IV',
            ];
            return $mapping[$triwulan] ?? $triwulan;
        };

        // Start transaction - all or nothing
        DB::beginTransaction();
        try {
            // Step 1: Create Laporan
            $bidang = $mapBidang($request->bidang);
            $triwulan = $mapTriwulan($request->triwulan);
            
            $laporan = Laporan::create([
                'bidang' => $bidang,
                'tahun' => $request->tahun,
                'triwulan' => $triwulan,
            ]);

            // Step 2: Handle Programs
            if ($request->has('program') && is_array($request->program)) {
                foreach ($request->program as $index => $program) {
                    // Use pegawai ID directly from dropdown
                    $idPelapor = $request->id_pegawai_pelapor ?? null;
                    $idMonev = $request->id_pimpinan_monev ?? null;
                    
                    // Validate pegawai IDs exist
                    if ($idPelapor && !DataPegawai::find($idPelapor)) {
                        throw new \Exception("Pegawai pelapor dengan ID {$idPelapor} tidak ditemukan.");
                    }
                    if ($idMonev && !DataPegawai::find($idMonev)) {
                        throw new \Exception("Pimpinan monev dengan ID {$idMonev} tidak ditemukan.");
                    }

                    // Calculate percentage for kinerja
                    $target = $request->input("target.{$index}", 0);
                    $realisasiKinerja = $request->input("program_realisasi_kinerja.{$index}", 0);
                    $persenKinerja = $target > 0 ? ($realisasiKinerja / $target) * 100 : 0;

                    // Calculate percentage for keuangan
                    $pagu = $request->input("pagu.{$index}", 0);
                    $realisasiKeuangan = $request->input("program_realisasi_keuangan.{$index}", 0);
                    $persenKeuangan = $pagu > 0 ? ($realisasiKeuangan / $pagu) * 100 : 0;

                    Program::create([
                        'id_laporan' => $laporan->id_laporan,
                        'urutan' => $index + 1,
                        'level' => 'Program',
                        'id_pegawai_pelapor' => $idPelapor,
                        'id_pimpinan_monev' => $idMonev,
                        'program' => $program,
                        'indikator_program' => $request->input("indikator_program.{$index}", ''),
                        'satuan_program' => $request->input("satuan.{$index}", ''),
                        'target_program' => $target,
                        'realisasi_kinerja_program' => $realisasiKinerja,
                        'persen_kinerja_program' => $persenKinerja,
                        'pagu_program' => $pagu,
                        'realisasi_keuangan_program' => $realisasiKeuangan,
                        'persen_keuangan_program' => $persenKeuangan,
                        'keterangan_program' => $request->input("keterangan.{$index}", ''),
                        'faktor_pendorong_program' => $request->input("faktor_pendorong.{$index}", ''),
                        'faktor_penghambat_program' => $request->input("faktor_penghambat.{$index}", ''),
                        'rekomendasi_program' => $request->input("rekomendasi.{$index}", ''),
                    ]);
                }
            }

            // Step 3: Handle Kegiatan
            if ($request->has('kegiatan') && is_array($request->kegiatan)) {
                foreach ($request->kegiatan as $index => $kegiatan) {
                    // Use pegawai ID directly from dropdown
                    $idPelapor = $request->id_pegawai_pelapor ?? null;
                    $idMonev = $request->id_pegawai_monev ?? null;
                    
                    // Validate pegawai IDs exist
                    if ($idPelapor && !DataPegawai::find($idPelapor)) {
                        throw new \Exception("Pegawai pelapor dengan ID {$idPelapor} tidak ditemukan.");
                    }
                    if ($idMonev && !DataPegawai::find($idMonev)) {
                        throw new \Exception("Pegawai monev dengan ID {$idMonev} tidak ditemukan.");
                    }

                    $target = $request->input("target.{$index}", 0);
                    $realisasiKinerja = $request->input("kegiatan_realisasi_kinerja.{$index}", 0);
                    $persenKinerja = $target > 0 ? ($realisasiKinerja / $target) * 100 : 0;

                    $pagu = $request->input("pagu.{$index}", 0);
                    // Note: kegiatan form uses program_realisasi_keuangan name, but we need to handle it
                    $realisasiKeuangan = $request->input("program_realisasi_keuangan.{$index}", 0);
                    $persenKeuangan = $pagu > 0 ? ($realisasiKeuangan / $pagu) * 100 : 0;

                    Kegiatan::create([
                        'id_laporan' => $laporan->id_laporan,
                        'urutan' => $index + 1,
                        'level' => 'Kegiatan',
                        'id_pegawai_pelapor' => $idPelapor,
                        'id_pegawai_monev' => $idMonev,
                        'kegiatan' => $kegiatan,
                        'indikator_kegiatan' => $request->input("indikator_kegiatan.{$index}", ''),
                        'satuan_kegiatan' => $request->input("satuan.{$index}", ''),
                        'target_kegiatan' => $target,
                        'realisasi_kinerja_kegiatan' => $realisasiKinerja,
                        'persen_kinerja_kegiatan' => $persenKinerja,
                        'pagu_kegiatan' => $pagu,
                        'realisasi_keuangan_kegiatan' => $realisasiKeuangan,
                        'persen_keuangan_kegiatan' => $persenKeuangan,
                        'keterangan_kegiatan' => $request->input("keterangan.{$index}", ''),
                        'faktor_pendorong_kegiatan' => $request->input("faktor_pendorong.{$index}", ''),
                        'faktor_penghambat_kegiatan' => $request->input("faktor_penghambat.{$index}", ''),
                        'rekomendasi_kegiatan' => $request->input("rekomendasi.{$index}", ''),
                    ]);
                }
            }

            // Step 4: Handle Sub Kegiatan
            if ($request->has('sub_kegiatan') && is_array($request->sub_kegiatan)) {
                foreach ($request->sub_kegiatan as $index => $subKegiatan) {
                    // Use pegawai ID directly from dropdown
                    $idPelapor = $request->id_pegawai_pelapor ?? null;
                    $idMonev = $request->id_pimpinan_monev ?? null;
                    
                    // Validate pegawai IDs exist
                    if ($idPelapor && !DataPegawai::find($idPelapor)) {
                        throw new \Exception("Pegawai pelapor dengan ID {$idPelapor} tidak ditemukan.");
                    }
                    if ($idMonev && !DataPegawai::find($idMonev)) {
                        throw new \Exception("Pimpinan monev dengan ID {$idMonev} tidak ditemukan.");
                    }

                    $target = $request->input("target.{$index}", 0);
                    $realisasiKinerja = $request->input("subkegiatan_realisasi_kinerja.{$index}", 0);
                    $persenKinerja = $target > 0 ? ($realisasiKinerja / $target) * 100 : 0;

                    $pagu = $request->input("pagu.{$index}", 0);
                    $realisasiKeuangan = $request->input("subkegiatan_realisasi_keuangan.{$index}", 0);
                    $persenKeuangan = $pagu > 0 ? ($realisasiKeuangan / $pagu) * 100 : 0;

                    SubKegiatan::create([
                        'id_laporan' => $laporan->id_laporan,
                        'urutan' => $index + 1,
                        'level' => 'Sub Kegiatan',
                        'id_pegawai_pelapor' => $idPelapor,
                        'id_pimpinan_monev' => $idMonev,
                        'sub_kegiatan' => $subKegiatan,
                        'indikator_sub_kegiatan' => $request->input("indikator_sub_kegiatan.{$index}", ''),
                        'satuan_sub_kegiatan' => strtolower($request->input("satuan.{$index}", '')),
                        'target_sub_kegiatan' => $target,
                        'realisasi_kinerja_sub_kegiatan' => $realisasiKinerja,
                        'persen_kinerja_sub_kegiatan' => $persenKinerja,
                        'pagu_sub_kegiatan' => $pagu,
                        'realisasi_keuangan_sub_kegiatan' => $realisasiKeuangan,
                        'persen_keuangan_sub_kegiatan' => $persenKeuangan,
                        'keterangan_sub_kegiatan' => $request->input("keterangan.{$index}", ''),
                        'faktor_pendukung_sub_kegiatan' => $request->input("faktor_pendorong.{$index}", ''),
                        'faktor_penghambat_sub_kegiatan' => $request->input("faktor_penghambat.{$index}", ''),
                        'rekomendasi_sub_kegiatan' => $request->input("rekomendasi.{$index}", ''),
                    ]);
                }
            }

            // Step 5: Handle Penilaian Pimpinan
            if ($request->has('penilaian') && is_array($request->penilaian)) {
                foreach ($request->penilaian as $index => $penilaian) {
                    PenilaianPimpinan::create([
                        'id_laporan' => $laporan->id_laporan,
                        'pimpinan' => $request->input("pimpinan.{$index}", ''),
                        'penilaian' => $penilaian,
                    ]);
                }
            }

            // Step 6: Handle Arahan Pimpinan
            if ($request->has('arahan') && is_array($request->arahan)) {
                foreach ($request->arahan as $index => $arahan) {
                    ArahanPimpinan::create([
                        'id_laporan' => $laporan->id_laporan,
                        'pimpinan' => $request->input("pimpinan.{$index}", ''),
                        'arahan' => $arahan,
                    ]);
                }
            }

            // Step 7: Handle Melaporkan
            if ($request->has('id_pegawai') && is_array($request->id_pegawai)) {
                foreach ($request->id_pegawai as $index => $idPegawai) {
                    if ($idPegawai) {
                        // Validate pegawai ID exists
                        $pegawai = DataPegawai::find($idPegawai);
                        if (!$pegawai) {
                            throw new \Exception("Pegawai dengan ID {$idPegawai} tidak ditemukan.");
                        }
                        
                        Melaporkan::create([
                            'id_laporan' => $laporan->id_laporan,
                            'id_pegawai' => $idPegawai,
                            'jabatan' => $request->input("jabatan.{$index}", $pegawai->jabatan),
                        ]);
                    }
                }
            }

            // If we reach here, all operations succeeded
            DB::commit();
            
            return response()->json([
                'status' => 'success', 
                'message' => 'Data laporan berhasil disimpan.'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Rollback on validation errors
            DB::rollBack();
            $errorMessages = [];
            foreach ($e->errors() as $field => $messages) {
                $errorMessages = array_merge($errorMessages, $messages);
            }
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal: ' . implode(', ', $errorMessages),
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            // Rollback on any other error
            DB::rollBack();
            
            // Log the error for debugging
            \Log::error('Error saving laporan: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            
            return response()->json([
                'status' => 'error', 
                'message' => 'Terjadi kesalahan saat menyimpan data. Semua perubahan telah dibatalkan. Silakan coba lagi atau hubungi administrator jika masalah berlanjut.'
            ], 500);
        }
    }

    public function destroyindustri($id)
    {
        DB::beginTransaction();
        try {
            // Menghapus data terkait
            $pelakuUsaha = PelakuUsaha::findOrFail($id);
            Alamat::where('id_usaha', $id)->delete();
            TenagaKerja::where('id_usaha', $id)->delete();
            Investasi::where('id_usaha', $id)->delete();
            KapasitasProduksi::where('id_usaha', $id)->delete();
            $pelakuUsaha->delete();

            DB::commit();

            return back()->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function editindustri($id)
    {
        $kbli = Kbli::all();
        $pelakuUsaha = PelakuUsaha::with(['kbli', 'alamat', 'investasi', 'tenagaKerja', 'kapasitasProduksi'])->findOrFail($id);
        $produk = KapasitasProduksi::where('id_usaha', $id)->get();
        $kecamatan = ['Balikpapan Selatan', 'Balikpapan Kota', 'Balikpapan Timur', 'Balikpapan Utara', 'Balikpapan Tengah', 'Balikpapan Barat']; 
        return view('edit-industri', compact('kbli', 'pelakuUsaha', 'produk', 'kecamatan'));
    }

    public function updateindustri(Request $request, $id)
    {
        $validated = $request->validate([
            'NIB' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'jenis_badan_usaha' => 'required|string',
            'skala_usaha' => 'required|string',
            'risiko' => 'required|string',
            'jenis_proyek' => 'required|string',
            'tanggal_permohonan' => 'required|date',
            'email' => ['nullable', 'regex:/^[-a-zA-Z0-9_.+@]+$/'],
            'no_telp' => ['nullable', 'regex:/^[-0-9+\s()]+$/'],
            'id_kbli' => 'required|string|max:255',
            'alamat_usaha' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'jumlah_tki_laki_laki' => 'required|integer',
            'jumlah_tki_perempuan' => 'required|integer',
            'jumlah_tenaga_kerja_asing' => 'required|integer',
            'modal_usaha' => 'required|numeric|min:0|max:1000000000000',
            'investasi_mesin' => 'required|numeric|min:0|max:1000000000000',
            'investasi_lainnya' => 'required|numeric|min:0|max:1000000000000',
            'id_kbli_produk.*' => 'required|string|max:255',
            'nama_produk.*' => 'required|string|max:255',
            'kapasitas.*' => 'required|string|max:255',
            'satuan.*' => 'required|string|max:255',
            'status_siinas.*' => 'required|string|max:255',
            'tanggal_registrasi_siinas.*' => 'required|date',
        ]);

        // Bersihkan input email dan no_telp jika diisi "-"
        $email = ($validated['email'] === '-' || $validated['email'] === null) ? null : $validated['email'];
        $no_telp = ($validated['no_telp'] === '-' || $validated['no_telp'] === null) ? null : $validated['no_telp'];

        DB::beginTransaction();
        try {
            // Check for duplicate id_kbli
            $duplicateCheck = PelakuUsaha::where('NIB', $validated['NIB'])
                                    ->where('id_usaha', '!=', $id)
                                    ->exists();

            if ($duplicateCheck) {
                return response()->json([
                    'error' => ' KBLI yang anda masukkan sudah ada sebelumnya.'
                ], 422);
            }

            $pelakuUsaha = PelakuUsaha::findOrFail($id);

            // Update Data Pelaku Usaha
            $pelakuUsaha->update([
                'NIB' => $validated['NIB'],
                'nama' => $validated['nama'],
                'jenis_badan_usaha' => $validated['jenis_badan_usaha'],
                'skala_usaha' => $validated['skala_usaha'],
                'risiko' => $validated['risiko'],
                'jenis_proyek' => $validated['jenis_proyek'],
                'tanggal_permohonan' => $validated['tanggal_permohonan'],
                'email' => $email,
                'no_telp' => $no_telp,
                'id_kbli' => $validated['id_kbli'],
            ]);

            // Update Alamat
            $pelakuUsaha->alamat->update([
            'alamat_usaha' => $validated['alamat_usaha'],
                'kecamatan' => $validated['kecamatan'],
                'kelurahan' => $validated['kelurahan'],
            ]);

            // Update Tenaga Kerja
            $pelakuUsaha->tenagaKerja->update([
                'jumlah_tki_laki_laki' => $validated['jumlah_tki_laki_laki'],
                'jumlah_tki_perempuan' => $validated['jumlah_tki_perempuan'],
                'jumlah_tenaga_kerja_asing' => $validated['jumlah_tenaga_kerja_asing'],
            ]);

            // Update Investasi
            $pelakuUsaha->investasi->update([
                'modal_usaha' => $validated['modal_usaha'],
                'investasi_mesin' => $validated['investasi_mesin'],
                'investasi_lainnya' => $validated['investasi_lainnya'],
            ]);

            // Update Data Produk
            KapasitasProduksi::where('id_usaha', $pelakuUsaha->id_usaha)->delete();
            foreach ($validated['nama_produk'] as $index => $nama_produk) {
                KapasitasProduksi::create([
                    'id_usaha' => $pelakuUsaha->id_usaha,
                    'id_kbli' => $validated['id_kbli_produk'][$index],
                    'nama_produk' => $nama_produk,
                    'kapasitas' => $validated['kapasitas'][$index],
                    'satuan' => $validated['satuan'][$index],
                    'status_siinas' => $validated['status_siinas'][$index],
                    'tanggal_registrasi_siinas' => $validated['tanggal_registrasi_siinas'][$index],
                ]);
            }

            DB::commit();

            return response()->json(['status' => 'success', 'message' => 'Data berhasil disimpan.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan saat menyimpan data ' . $e->getMessage()], 500);
        }
    }

    public function hapusKapasitasProduksi(Request $request, $id_usaha, $id_kapasitas_produksi)
    {
        DB::beginTransaction();

        try {
            $kapasitasProduksi = KapasitasProduksi::where('id_usaha', $id_usaha)
                ->findOrFail($id_kapasitas_produksi);

            // Lakukan penghapusan
            $kapasitasProduksi->delete();

            DB::commit();

            return redirect()->back()->with('success', 'Kapasitas produksi berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus kapasitas produksi. ' . $e->getMessage());
        }
    }
}