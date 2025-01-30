<?php

use App\Http\Controllers as Ctrl;
use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [Ctrl\DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('profil', [Ctrl\ProfileController::class, 'index'])->name('profil.index');
    Route::put('profil/{profil}', [Ctrl\ProfileController::class, 'update'])->name('profil.update');

    Route::resource('pasien', Ctrl\PasienController::class);
    Route::resource('pendaftaran', Ctrl\PendaftaranController::class);

    Route::middleware(IsAdminMiddleware::class)->group(function() {
        Route::resource('agama', Ctrl\AgamaController::class);
        Route::resource('user', Ctrl\UserController::class);
        Route::resource('pendidikan', Ctrl\PendidikanController::class);
        Route::resource('pekerjaan', Ctrl\PekerjaanController::class);
        Route::resource('jaminan', Ctrl\JaminanController::class);
        Route::resource('instalasi', Ctrl\InstalasiController::class);
        Route::resource('layanan', Ctrl\LayananController::class);
        Route::resource('tindakan', Ctrl\TindakanController::class);
    });
});

require __DIR__.'/auth.php';
