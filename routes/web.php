<?php

use App\Http\Controllers as Ctrl;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [Ctrl\DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('user', Ctrl\UserController::class);
    Route::get('profil', [Ctrl\ProfileController::class, 'index'])->name('profil.index');
    Route::put('profil/{profil}', [Ctrl\ProfileController::class, 'update'])->name('profil.update');

    Route::resource('pasien', Ctrl\PasienController::class);
    Route::resource('pendaftaran', Ctrl\PendaftaranController::class);
});

require __DIR__.'/auth.php';
