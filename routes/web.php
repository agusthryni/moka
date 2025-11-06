<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\KbliController;
use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return redirect('/moka/data-laporan');
});

// Home
// Route::get('/siiba/dashboard', [DashboardController::class, 'index'])->name('dashboard-industri');

// Dashboard
Route::get('/moka/data-laporan', [DataController::class, 'index'])->name('data-industri');
Route::get('/moka/data-laporan/input-industri', [DataController::class, 'inputindustri'])->name('data-industri.input');
Route::post('/moka/data-laporan', [DataController::class, 'storeindustri'])->name('data-industri.store');
Route::delete('/moka/data-laporan/{id}', [DataController::class, 'destroyindustri'])->name('data-industri.delete');
Route::get('/moka/data-laporan/edit-industri/{id}', [DataController::class, 'editindustri'])->name('data-industri.edit');
Route::put('/moka/data-laporan/{id}', [DataController::class, 'updateindustri'])->name('data-industri.update');

// Data Pegawai
Route::get('/moka/data-pegawai', [PegawaiController::class, 'index'])->name('data-pegawai');
Route::get('/moka/data-pegawai/input-kbli', [PegawaiController::class, 'create'])->name('data-pegawai.input');
Route::post('/moka/data-pegawai', [PegawaiController::class, 'store'])->name('data-pegawai.store');
Route::get('/moka/data-pegawai/edit-kbli/{id}', [PegawaiController::class, 'edit'])->name('data-pegawai.edit');
Route::put('/moka/data-pegawai/update-kbli/{id}', [PegawaiController::class, 'update'])->name('data-pegawai.update');
Route::delete('/moka/data-pegawai/delete-kbli/{id}', [PegawaiController::class, 'destroy'])->name('data-pegawai.delete');

// API Data Industri kelurahan
Route::get('/api/industri-kelurahan', function () {
    $data = DB::table('pelaku_usaha')
        ->join('alamat', 'pelaku_usaha.id_usaha', '=', 'alamat.id_usaha')
        ->leftJoin('tenaga_kerja', 'pelaku_usaha.id_usaha', '=', 'tenaga_kerja.id_usaha')
        ->select(
            'alamat.kelurahan',
            DB::raw('COUNT(DISTINCT pelaku_usaha.id_usaha) as total_usaha'),
            DB::raw('SUM(CASE WHEN pelaku_usaha.skala_usaha = "Mikro" THEN 1 ELSE 0 END) as mikro'),
            DB::raw('SUM(CASE WHEN pelaku_usaha.skala_usaha = "Kecil" THEN 1 ELSE 0 END) as kecil'),
            DB::raw('SUM(CASE WHEN pelaku_usaha.skala_usaha = "Menengah" THEN 1 ELSE 0 END) as menengah'),
            DB::raw('SUM(CASE WHEN pelaku_usaha.skala_usaha = "Besar" THEN 1 ELSE 0 END) as besar'),
            DB::raw('SUM(CASE WHEN pelaku_usaha.risiko = "Rendah" THEN 1 ELSE 0 END) as risiko_rendah'),
            DB::raw('SUM(CASE WHEN pelaku_usaha.risiko = "Menengah Rendah" THEN 1 ELSE 0 END) as risiko_menengah_rendah'),
            DB::raw('SUM(CASE WHEN pelaku_usaha.risiko = "Menengah Tinggi" THEN 1 ELSE 0 END) as risiko_menengah_tinggi'),
            DB::raw('SUM(CASE WHEN pelaku_usaha.risiko = "Tinggi" THEN 1 ELSE 0 END) as risiko_tinggi'),
            DB::raw('SUM(tenaga_kerja.jumlah_tki_laki_laki) as tenaga_laki'),
            DB::raw('SUM(tenaga_kerja.jumlah_tki_perempuan) as tenaga_perempuan'),
            DB::raw('SUM(tenaga_kerja.jumlah_tenaga_kerja_asing) as tenaga_asing')
        )
        ->groupBy('alamat.kelurahan')
        ->get();

    return response()->json($data);
});