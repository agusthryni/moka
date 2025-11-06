<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Investasi;
use App\Models\KapasitasProduksi;
use App\Models\Kbli;
use App\Models\PelakuUsaha;
use App\Models\TenagaKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class DataController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->input('filter');
        $keyword = $request->input('keyword');
        $enumValue = $request->input('enum_value');

        $query = PelakuUsaha::query();

        if ($filter && ($keyword || $enumValue)) {
            if ($filter === 'nama') {
                $query->where('nama', 'like', '%' . $keyword . '%');
            } elseif ($filter === 'nib') {
                $query->where('NIB', 'like', '%' . $keyword . '%');
            } elseif ($filter === 'id_kbli') {
                $query->whereHas('kbli', function ($query) use ($keyword) {
                    $query->where('jenis_kbli', 'like', '%' . $keyword . '%');
                });
            } elseif (in_array($filter, ['jenis_badan_usaha', 'skala_usaha', 'risiko', 'jenis_proyek'])) {
                $query->where($filter, $enumValue);
            } elseif ($filter === 'kecamatan') {
                $query->whereHas('alamat', function ($query) use ($enumValue) {
                    $query->where('kecamatan', $enumValue);
                });
            } elseif ($filter === 'kelurahan') {
                $query->whereHas('alamat', function ($query) use ($enumValue) {
                    $query->where('kelurahan', $enumValue);
                });
            }
        }

        $pelakuUsaha = $query->with(['kbli', 'alamat'])->get();

        return view('data-industri', compact('pelakuUsaha'));
    }

    public function inputindustri()
    {
        $kbli = Kbli::all();
        return view('input-industri', compact('kbli'));
    }

    public function storeindustri(Request $request)
    {
        $validated = $request->validate([
            'NIB' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'jenis_badan_usaha' => 'required|string',
            'skala_usaha' => 'required|string',
            'risiko' => 'required|string',
            'jenis_proyek' => 'required|string',
            'tanggal_permohonan' => 'required|date',
            'email' => 'nullable', 'regex:/^[-a-zA-Z0-9_.+@]+$/',
            'no_telp' => 'nullable', 'regex:/^[-0-9+\s()]+$/',
            'id_kbli' => 'required|string|max:5',
            'alamat_usaha' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'jumlah_tki_laki_laki' => 'required|integer',
            'jumlah_tki_perempuan' => 'required|integer',
            'jumlah_tenaga_kerja_asing' => 'required|integer',
            'modal_usaha' => 'required|numeric',
            'investasi_mesin' => 'required|numeric',
            'investasi_lainnya' => 'required|numeric',
            'nama_produk.*' => 'required|string|max:255',
            'id_kbli_produk.*' => 'required|string|max:255',
            'kapasitas.*' => 'required|string|max:255',
            'satuan.*' => 'required|string|max:255',
            'status_siinas.*' => 'required|string|max:255',
            'tanggal_registrasi_siinas.*' => 'required|date',
        ]);

        $email = ($validated['email'] === '-' || $validated['email'] === null) ? null : $validated['email'];
        $no_telp = ($validated['no_telp'] === '-' || $validated['no_telp'] === null) ? null : $validated['no_telp'];

        DB::beginTransaction();
        try {
            // Mengecek apakah NIB sudah ada
            // if (PelakuUsaha::where('NIB', $validated['NIB'])->exists()) {
            //     return response()->json(['status' => 'error', 'message' => 'NIB ' . $validated['NIB'] . ' sudah ada sebelumnya.'], 400);
            // }
            
            // Mengecek nib dan kbli sudah ada ato belom secara manual
            if (PelakuUsaha::where('NIB', $validated['NIB'])->where('id_kbli', $validated['id_kbli'])->exists()) {
                return response()->json(['status' => 'error', 'message' => 'NIB dan KBLI yang sama sudah ada.'], 400);
            }
            
            // Simpan Data Pelaku Usaha
            $pelaku_usaha = PelakuUsaha::create([
                'nama' => $validated['nama'],
                'NIB' => $validated['NIB'],
                'jenis_badan_usaha' => $validated['jenis_badan_usaha'],
                'skala_usaha' => $validated['skala_usaha'],
                'risiko' => $validated['risiko'],
                'jenis_proyek' => $validated['jenis_proyek'],
                'tanggal_permohonan' => $validated['tanggal_permohonan'],
                'email' => $email,
                'no_telp' => $no_telp,
                'id_kbli' => $validated['id_kbli'],
            ]);

            // Simpan Alamat
            Alamat::create([
                'id_usaha' => $pelaku_usaha->id_usaha,
                'alamat_usaha' => $validated['alamat_usaha'],
                'kecamatan' => $validated['kecamatan'],
                'kelurahan' => $validated['kelurahan'],
            ]);

            // Simpan Tenaga Kerja
            TenagaKerja::create([
                'id_usaha' => $pelaku_usaha->id_usaha,
                'jumlah_tki_laki_laki' => $validated['jumlah_tki_laki_laki'],
                'jumlah_tki_perempuan' => $validated['jumlah_tki_perempuan'],
                'jumlah_tenaga_kerja_asing' => $validated['jumlah_tenaga_kerja_asing'],
            ]);

            // Simpan Investasi
            Investasi::create([
                'id_usaha' => $pelaku_usaha->id_usaha,
                'modal_usaha' => $validated['modal_usaha'],
                'investasi_mesin' => $validated['investasi_mesin'],
                'investasi_lainnya' => $validated['investasi_lainnya'],
            ]);

            // Simpan Data Produk
            foreach ($validated['nama_produk'] as $index => $nama_produk) {
                KapasitasProduksi::create([
                    'id_usaha' => $pelaku_usaha->id_usaha,
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
            return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()], 500);
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