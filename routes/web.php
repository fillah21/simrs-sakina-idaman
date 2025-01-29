<?php

use App\Http\Controllers as Ctrl;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [Ctrl\DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('user', Ctrl\UserController::class);
});

require __DIR__.'/auth.php';
