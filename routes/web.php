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
Route::get('/dokter', [HomeController::class, 'dokter'])->name('dokter');
Route::get('/pasien', [HomeController::class, 'pasien'])->name('pasien');

// Group dokter
Route::prefix('dokter')->middleware('auth')->group(function () {
    Route::resource('periksa', PeriksaController::class);
    Route::resource('obat', ObatController::class);
});

// Group pasien
Route::prefix('pasien')->middleware('auth')->group(function () {
    Route::resource('periksa', PeriksaController::class);
    Route::resource('riwayat', DetailPeriksaController::class);
});
