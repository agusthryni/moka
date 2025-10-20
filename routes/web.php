<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\InvestasiController;
use App\Http\Controllers\KapasitasController;
use App\Http\Controllers\KbliController;
use App\Http\Controllers\TenagaKerjaController;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return redirect('/siiba/dashboard');
});

// Home
Route::get('/siiba/dashboard', [DashboardController::class, 'index'])->name('dashboard-industri');

// Dashboard
Route::get('/siiba/data-industri', [DataController::class, 'index'])->name('data-industri');
Route::get('/siiba/data-industri/input-industri', [DataController::class, 'inputindustri'])->name('data-industri.input');
Route::post('/siiba/data-industri', [DataController::class, 'storeindustri'])->name('data-industri.store');
Route::delete('/siiba/data-industri/{id}', [DataController::class, 'destroyindustri'])->name('data-industri.delete');
Route::get('/siiba/data-industri/edit-industri/{id}', [DataController::class, 'editindustri'])->name('data-industri.edit');
Route::put('/siiba/data-industri/{id}', [DataController::class, 'updateindustri'])->name('data-industri.update');

// Data Pegawai
Route::get('/siiba/data-kbli', [KbliController::class, 'showkbli'])->name('data-kbli');
Route::get('/siiba/data-kbli/input-kbli', [KbliController::class, 'inputkbli'])->name('data-kbli.input');
Route::post('/siiba/data-kbli', [KbliController::class, 'storekbli'])->name('data-kbli.store');
Route::get('/siiba/data-kbli/edit-kbli/{id}', [KbliController::class, 'editkbli'])->name('data-kbli.edit');
Route::put('/siiba/data-kbli/update-kbli/{id}', [KbliController::class, 'updatekbli'])->name('data-kbli.update');
Route::delete('/siiba/data-kbli/delete-kbli/{id}', [KbliController::class, 'deletekbli'])->name('data-kbli.delete');

// Tenaga Kerja
Route::get('/siiba/data-tenaga-kerja', [TenagaKerjaController::class, 'index'])->name('data-tenaker');
Route::get('/siiba/data-investasi', [InvestasiController::class, 'index'])->name('data-investasi');
Route::get('/siiba/data-kapasitas-produksi', [KapasitasController::class, 'index'])->name('data-kapasitas-produksi');

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