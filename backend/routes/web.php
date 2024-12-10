<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HRD_dashboardController;
use App\Http\Controllers\HRD_karyawanController;
use App\Http\Controllers\FaceController;
use App\Http\Controllers\FileCheckController;
use App\Http\Controllers\HRD_AbsensiController;
use App\Http\Controllers\PerizinanController;
use App\Http\Controllers\PengaturanController;


Route::middleware('auth')->group(function () {
    Route::get('/', [HRD_dashboardController::class, 'index'])->name('index');
    Route::resource('hrd_karyawan', \App\Http\Controllers\HRD_karyawanController::class);

    Route::get('/upload', [FaceController::class, 'showUploadForm'])->name('upload.form');
Route::post('/upload', [FaceController::class, 'uploadFiles'])->name('upload.files');
Route::post('/cek-extensi', [FileCheckController::class, 'checkExtensi'])->name('cek.extensi');
Route::resource('hrd_absensi', \App\Http\Controllers\HRD_AbsensiController::class);

Route::resource('pengaturan', \App\Http\Controllers\PengaturanController::class);

Route::resource('perizinan', \App\Http\Controllers\PerizinanController::class);

Route::resource('dashboard', \App\Http\Controllers\HRD_dashboardController::class);

Route::post('/settings', [PengaturanController::class, 'store']);

Route::get('/cabang', [PengaturanController::class, 'cabang'])->name('hrd.pengaturan.cabang');
Route::get('/cabang/{id}', [PengaturanController::class, 'detailCabang'])->name('hrd.pengaturan.cabang.detail');
Route::get('/pengaturan/cabang/tambah', [PengaturanController::class, 'buatCabang'])->name('hrd.pengaturan.cabang.tambah');
Route::post('/save_cabang', [PengaturanController::class, 'saveCabang']);


Route::get('/general', [PengaturanController::class, 'general'])->name('hrd.pengaturan.general');
Route::get('/jenis_absensi', [PengaturanController::class, 'jenis_absensi'])->name('hrd.pengaturan.jenis_absensi');

Route::get('/pengaturan/divisi/tambah', [PengaturanController::class, 'buatDivisi'])->name('hrd.pengaturan.divisi.tambah');
Route::post('/divisi/simpan', [PengaturanController::class, 'simpanDivisi'])->name('divisi.simpan');


Route::post('/pengaturan/jenis_absensi/tambahjenis', [PengaturanController::class, 'tambahjenis'])->name('hrd.pengaturan.jenis_absensi.tambahjenis');

Route::get('/divisi/{id}/edit', [PengaturanController::class, 'editdivisi'])->name('divisi.edit');

Route::get('/detailkaryawan/{id}', [HRD_karyawanController::class, 'detail'])->name('detailkaryawan');

Route::get('/diterima', [PerizinanController::class, 'diterima'])->name('diterima');

Route::get('/pending', [PerizinanController::class, 'pending'])->name('pending');
Route::get('/ditolak', [PerizinanController::class, 'ditolak'])->name('ditolak');
Route::get('/perizinan/{id}', [PerizinanController::class, 'show'])->name('show');

Route::post('perizinan/approve/{id}', [PerizinanController::class, 'approve'])->name('perizinan.approve');
Route::post('perizinan/reject/{id}', [PerizinanController::class, 'reject'])->name('perizinan.reject');











});








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
