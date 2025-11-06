<?php

namespace App\Http\Controllers;

use App\Models\DataPegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = DataPegawai::orderBy('nama_pegawai')->get();
        return view('data-pegawai', compact('pegawai'));
    }

    public function create()
    {
        return view('input-pegawai');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pegawai.*' => 'required|string|max:255',
            'nip.*' => 'required|string|max:20',
            'jabatan.*' => 'required|string|max:255',
            'bidang.*' => 'required|in:Sekretariat,TSDI,IKM,Koperasi,UPT',
        ]);

        // Check for duplicate NIPs in the same request
        $nips = $validated['nip'];
        if (count($nips) !== count(array_unique($nips))) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terdapat NIP duplikat dalam data yang dimasukkan.'
            ], 400);
        }

        DB::beginTransaction();
        try {
            foreach ($validated['nama_pegawai'] as $index => $nama_pegawai) {
                // Check if NIP already exists
                if (DataPegawai::where('nip', $validated['nip'][$index])->exists()) {
                    DB::rollBack();
                    return response()->json([
                        'status' => 'error',
                        'message' => 'NIP ' . $validated['nip'][$index] . ' sudah ada sebelumnya.'
                    ], 400);
                }

                DataPegawai::create([
                    'nama_pegawai' => $nama_pegawai,
                    'nip' => $validated['nip'][$index],
                    'jabatan' => $validated['jabatan'][$index],
                    'bidang' => $validated['bidang'][$index],
                ]);
            }

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Data pegawai berhasil disimpan.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        $pegawai = DataPegawai::findOrFail($id);
        return view('edit-pegawai', compact('pegawai'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_pegawai' => 'required|string|max:255',
            'nip' => 'required|string|max:20',
            'jabatan' => 'required|string|max:255',
            'bidang' => 'required|in:Sekretariat,TSDI,IKM,Koperasi,UPT',
        ]);

        DB::beginTransaction();
        try {
            // Check for duplicate NIP
            $duplicateCheck = DataPegawai::where('nip', $validated['nip'])
                ->where('id_pegawai', '!=', $id)
                ->exists();

            if ($duplicateCheck) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'NIP yang anda masukkan sudah ada sebelumnya.'
                ], 400);
            }

            $pegawai = DataPegawai::findOrFail($id);
            $pegawai->update([
                'nama_pegawai' => $validated['nama_pegawai'],
                'nip' => $validated['nip'],
                'jabatan' => $validated['jabatan'],
                'bidang' => $validated['bidang'],
            ]);

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Data pegawai berhasil diperbarui.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $pegawai = DataPegawai::findOrFail($id);
            $pegawai->delete();

            DB::commit();
            return redirect()->route('data-pegawai')->with('success', 'Data pegawai berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('data-pegawai')->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
}
