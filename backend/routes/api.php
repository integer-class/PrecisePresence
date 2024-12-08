<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\CekPresensi;
use App\Http\Controllers\HRD_AbsensiController;
use App\Http\Controllers\PerizinanController;
use App\Http\Controllers\AbsensiController;


use App\Http\Controllers\history;


Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('user')->group(function () {

        Route::post('/perizinan', [PerizinanController::class, 'store']);

        Route::post('/check-in', [HRD_AbsensiController::class, 'checkIn']);
        Route::post('/check-out', [HRD_AbsensiController::class, 'checkOut']);

        Route::get('/history', [history::class, 'index']);

        Route::get('/cek_presensi', [history::class, 'cek']);

        Route::post('/cek_perhari', [history::class, 'cek_perhari']);
        Route::get('/cek_jadwal', [history::class, 'cek_jadwal']);



        Route::post('/absensi', [AbsensiController::class, 'store']);
        Route::get('/perizinan', [PerizinanController::class, 'getperizinan']);




    });


});



Route::post('/login', [AuthController::class, 'login']);

Route::post('/validate-face', [FaceRecognitionController::class, 'validateFace']);
