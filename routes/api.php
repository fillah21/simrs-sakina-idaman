<?php

use App\Http\Controllers\Api as Ctrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::middleware('web')->group(function () {
    // Wilayah Indonesia
    Route::post('provinsi', Ctrl\GetAllProvinsiController::class);
    Route::post('kabupaten', Ctrl\GetAllKabupatenController::class);
    Route::post('kecamatan', Ctrl\GetAllKecamatanController::class);
    Route::post('kelurahan', Ctrl\GetAllKelurahanController::class);

    Route::post('agama', Ctrl\GetAllAgamaController::class);
    Route::post('pendidikan', Ctrl\GetAllPendidikanController::class);
    Route::post('pekerjaan', Ctrl\GetAllPekerjaanController::class);

    Route::post('pasien', Ctrl\GetAllPasienController::class);
    Route::post('instalasi', Ctrl\GetAllInstalasiController::class);
    Route::post('layanan', Ctrl\GetAllLayananController::class);
    Route::post('dokter', Ctrl\GetAllDokterController::class);
    Route::post('jaminan', Ctrl\GetAllJaminanController::class);
    Route::post('tindakan', Ctrl\GetAllTindakanController::class);
});