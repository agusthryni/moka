<?php

namespace App\Http\Controllers;

use App\Models\Kbli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KbliController extends Controller
{
    public function showkbli()
    {
        $kbli_industri = Kbli::all();
        return view('kbli', compact('kbli_industri'));
    }

    public function inputkbli()
    {
        return view('input-kbli');
    }

    public function storekbli(Request $request)
    {
        $validated = $request->validate([
            'id_kbli.*' => 'required|string|size:5|distinct',
            'jenis_kbli.*' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            foreach ($validated['id_kbli'] as $index => $id_kbli) {
                if (Kbli::where('id_kbli', $id_kbli)->exists()) {
                    return response()->json([
                        'error' => 'KBLI ' . $id_kbli . ' sudah ada sebelumnya.'
                    ], 422);
                }
                Kbli::create([
                    'id_kbli' => $id_kbli,
                    'jenis_kbli' => $validated['jenis_kbli'][$index],
                ]);
            }
            DB::commit();
            return response()->json([
                'success' => 'Data berhasil disimpan.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function editkbli ($id_kbli)
    {
        $kbli = Kbli::findOrFail($id_kbli);
        return view('edit-kbli', compact('kbli'));
    }

    public function updatekbli(Request $request, $id_kbli)
    {
        $validated = $request->validate([
            'id_kbli' => 'required|string|size:5',
            'jenis_kbli' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            // Check for duplicate id_kbli
            $duplicateCheck = Kbli::where('id_kbli', $validated['id_kbli'])
                                    ->where('id_kbli', '!=', $id_kbli)
                                    ->exists();

            if ($duplicateCheck) {
                return response()->json([
                    'error' => ' KBLI yang anda masukkan sudah ada sebelumnya.'
                ], 422);
            }

            $kbli = Kbli::findOrFail($id_kbli);
            $kbli->update([
                'id_kbli' => $validated['id_kbli'],
                'jenis_kbli' => $validated['jenis_kbli'],
            ]);

            DB::commit();
            return response()->json([
                'success' => 'Data berhasil diperbarui.'
            ]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'error' => 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage()
                ], 500);
            }
        }

    public function deletekbli($id_kbli)
    {
        DB::beginTransaction();
        try {
            $kbli = Kbli::findOrFail($id_kbli);
            $kbli->delete();

            DB::commit();
            return redirect()->route('data-kbli')->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('data-kbli')->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
}
