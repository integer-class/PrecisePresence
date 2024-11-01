<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HRD_dashboardController;
use App\Http\Controllers\HRD_karyawanController;
use App\Http\Controllers\FaceController;
use App\Http\Controllers\FileCheckController;
use App\Http\Controllers\HRD_AbsensiController;

use App\Http\Controllers\PengaturanController;


Route::middleware('auth')->group(function () {
    Route::get('/', [HRD_dashboardController::class, 'index'])->name('index');
    Route::resource('hrd_karyawan', \App\Http\Controllers\HRD_karyawanController::class);

    Route::get('/upload', [FaceController::class, 'showUploadForm'])->name('upload.form');
Route::post('/upload', [FaceController::class, 'uploadFiles'])->name('upload.files');
Route::post('/cek-extensi', [FileCheckController::class, 'checkExtensi'])->name('cek.extensi');
Route::resource('hrd_absensi', \App\Http\Controllers\HRD_AbsensiController::class);

Route::resource('pengaturan', \App\Http\Controllers\PengaturanController::class);


Route::post('/settings', [PengaturanController::class, 'store']);


});


Route::post('/check-in', [HRD_AbsensiController::class, 'checkIn']);
Route::post('/check-out', [HRD_AbsensiController::class, 'checkOut']);



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
