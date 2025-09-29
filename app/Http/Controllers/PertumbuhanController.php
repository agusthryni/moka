<?php

namespace App\Http\Controllers;

use App\Models\Pertumbuhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PertumbuhanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pertumbuhan::query();
        $pertumbuhan = $query->get();

        return view('pertumbuhan', compact('pertumbuhan'));
    }

    public function inputpertumbuhan()
    {
        return view('input-pertumbuhan');
    }

    public function storepertumbuhan(Request $request)
    {
        $validated = $request->validate([
            // 'periode'    => 'required|array',
            // 'periode.*'  => 'required|digits:4',
            // 'jenis_data' => 'required|array',
            // 'jenis_data.*' => 'required|string',
            // 'total'      => 'required|array',
            // 'total.*'    => 'required|integer|min:0',
            'periode'    => 'required|array',
            'periode.*'  => 'required|digits:4',
            'verifikasi' => 'required|array',
            'pengawasan' => 'required|array',
            'energi' => 'required|array',
            'bahan_baku' => 'required|array',
            'tenaga_kerja' => 'required|array',
            'investasi' => 'required|array',
            'produksi' => 'required|array',
        ]);

        DB::beginTransaction();

        try {
            foreach ($request->periode as $i => $periode) {
                Pertumbuhan::create([
                    'periode'    => $periode,
                    'verifikasi' => $request->jenis_data[$i],
                    'pengawasan' => $request->total[$i],
                    'energi' => $request->total[$i],
                    'bahan_baku' => $request->total[$i],
                    'tenaga_kerja' => $request->total[$i],
                    'investasi' => $request->total[$i],
                    'produksi' => $request->total[$i],
                ]);
            }

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Data pertumbuhan berhasil disimpan.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function editpertumbuhan($id)
    {
        $pertumbuhan = Pertumbuhan::findOrFail($id);
        return view('edit-pertumbuhan', compact('pertumbuhan'));
    }

    public function updatepertumbuhan(Request $request, $id)
    {
        $validated = $request->validate([
            'periode'       => 'required|digits:4',
            'verifikasi'    => 'required|integer',
            'pengawasan'    => 'required|integer',
            'energi'        => 'required|integer',
            'bahan_baku'    => 'required|integer',
            'tenaga_kerja'  => 'required|integer',
            'investasi'     => 'required|integer',
            'produksi'      => 'required|integer',
        ]);

        DB::beginTransaction();
        try {
            $pertumbuhan = Pertumbuhan::findOrFail($id);
            $pertumbuhan->update($validated);

            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Data berhasil diperbarui.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Gagal update: '.$e->getMessage()], 500);
        }
    }

    public function hapusPertumbuhan($id)
    {
        DB::beginTransaction();

        try {
            $pertumbuhan = Pertumbuhan::findOrFail($id);
            $pertumbuhan->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Data pertumbuhan berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus: '.$e->getMessage());
        }
    }
}