<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\center_control;
use App\Http\Controllers\UserControl;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', [center_control::class, 'index']);

Route::post('/admin', [UserControl::class, 'login'])->name('login.sys');
Route::post('/tambah', [center_control::class, 'tambah_kamar'])->name('tambah.kamar');
Route::post('/import', [center_control::class, 'import'])->name('import.datakamar');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [center_control::class, 'admin']);
    Route::delete('/kamar/{id}', [center_control::class, 'delete']);
    Route::delete('/pegawai/{id}', [center_control::class, 'delete_datapegawai']);
    Route::get('/logout', [UserControl::class, 'logout'])->name('logout.sys');
});
    