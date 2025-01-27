<?php

use App\Http\Controllers as Ctrl;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [Ctrl\DashboardController::class, 'index'])->name('dashboard');
    // Route::get('/profile', [Ctrl\ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [Ctrl\ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [Ctrl\ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
