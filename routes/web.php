<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PeriksaController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\JadwalPraktikController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// =================== LANDING & AUTH ===================

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


// =================== ADMIN ===================

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [HomeController::class, 'admin'])->name('admin');

    Route::resource('dokter', DokterController::class);
    Route::resource('pasien', PasienController::class);
    Route::resource('poli', PoliController::class);
    Route::resource('obat', ObatController::class);

    Route::get('/pasien/{id}', [PasienController::class, 'show'])->name('pasien.show');
});


// =================== DOKTER ===================

Route::prefix('dokter')->middleware(['auth', 'role:dokter'])->name('dokter.')->group(function () {
    // Dashboard Dokter
    Route::get('/', [HomeController::class, 'dokter'])->name('dashboard');

    // Pemeriksaan Pasien
    Route::resource('periksa', PeriksaController::class)->names('periksa');
    Route::patch('periksa/{id}/selesai', [PeriksaController::class, 'selesai'])->name('periksa.selesai');

    // Riwayat Pemeriksaan
    Route::get('/riwayat', [PeriksaController::class, 'riwayatDokter'])->name('riwayat.index');

    // Jadwal Praktik
    Route::prefix('jadwal')->name('jadwal.')->group(function () {
        Route::get('/', [JadwalPraktikController::class, 'index'])->name('index');
        Route::get('/create', [JadwalPraktikController::class, 'create'])->name('create');
        Route::post('/', [JadwalPraktikController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [JadwalPraktikController::class, 'edit'])->name('edit');
        Route::put('/{id}', [JadwalPraktikController::class, 'update'])->name('update');
        Route::delete('/{id}', [JadwalPraktikController::class, 'destroy'])->name('destroy');
    });

    // Profil Dokter
    Route::get('/profile', [DokterController::class, 'profile'])->name('profile');
    Route::put('/profile', [DokterController::class, 'updateProfile'])->name('profile.update');
});



// =================== PASIEN ===================

Route::prefix('pasien')->middleware(['auth', 'role:pasien'])->group(function () {
    Route::get('/', [HomeController::class, 'pasien'])->name('pasien');

    // Pemeriksaan oleh pasien
    Route::resource('periksa', PeriksaController::class)->names([
        'index'   => 'pasien.periksa.index',
        'create'  => 'pasien.periksa.create',
        'store'   => 'pasien.periksa.store',
        'show'    => 'pasien.periksa.show',
        'edit'    => 'pasien.periksa.edit',
        'update'  => 'pasien.periksa.update',
        'destroy' => 'pasien.periksa.destroy',
    ]);

    // Riwayat pasien
    Route::get('/riwayat', [PeriksaController::class, 'riwayat'])->name('pasien.riwayat');
    Route::get('/pasien/riwayat/{id}', [\App\Http\Controllers\PeriksaController::class, 'showRiwayat'])->name('pasien.riwayat.show');
    Route::get('/profile', [App\Http\Controllers\PasienController::class, 'profile'])->name('pasien.profile');
    Route::put('/pasien/profile', [PasienController::class, 'updateProfile'])->name('pasien.profile.update');
});
