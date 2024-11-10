<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\HRD_AbsensiController;
use App\Http\Controllers\PerizinanController;
use App\Http\Controllers\history;


Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('user')->group(function () {

        Route::post('/perizinan', [PerizinanController::class, 'store']);

        Route::post('/check-in', [HRD_AbsensiController::class, 'checkIn']);
        Route::post('/check-out', [HRD_AbsensiController::class, 'checkOut']);

        Route::get('/history', [history::class, 'index']);

    });


});


Route::post('/login', [AuthController::class, 'login']);

Route::post('/validate-face', [FaceRecognitionController::class, 'validateFace']);
