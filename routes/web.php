<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PeriksaController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\DetailPeriksaController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route setelah login
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Rute dashboard dokter & pasien
Route::get('/dokter', [HomeController::class, 'dokter'])->middleware(['auth', 'role:dokter'])->name('dokter');
Route::get('/pasien', [HomeController::class, 'pasien'])->middleware(['auth', 'role:pasien'])->name('pasien');

// Group dokter
Route::prefix('dokter')->middleware('auth', 'role:dokter')->group(function () {
    Route::resource('periksa', PeriksaController::class)->names([
        'index' => 'dokter.periksa.index',
        'create' => 'dokter.periksa.create',
        'store' => 'dokter.periksa.store',
        'show' => 'dokter.periksa.show',
        'edit' => 'dokter.periksa.edit',
        'update' => 'dokter.periksa.update',
        'destroy' => 'dokter.periksa.destroy',
    ]);
    Route::resource('obat', ObatController::class);
});

// Group pasien
Route::prefix('pasien')->middleware('auth', 'role:pasien')->group(function () {
    Route::resource('periksa', PeriksaController::class)->names([
        'index' => 'pasien.periksa.index',
        'create' => 'pasien.periksa.create',
        'store' => 'pasien.periksa.store',
        'show' => 'pasien.periksa.show',
        'edit' => 'pasien.periksa.edit',
        'update' => 'pasien.periksa.update',
        'destroy' => 'pasien.periksa.destroy',
    ]);
    Route::get('/riwayat', [PeriksaController::class, 'riwayat'])->name('pasien.riwayat');
    Route::get('/periksa/create', [PeriksaController::class, 'create'])->name('pasien.periksa.create');
});
