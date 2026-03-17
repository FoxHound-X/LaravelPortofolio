<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\center_control;
use App\Http\Controllers\UserControl;
use App\Http\Controllers\notificationsys;
use Maatwebsite\Excel\Facades\Excel;


Route::get('/', [center_control::class, 'index']);
Route::get('/login', [center_control::class, 'index'])->name('login');

Route::post('/admin', [UserControl::class, 'login'])->name('login.sys');
Route::post('/time', [UserControl::class, 'time'])->name('time.sys');
Route::post('/import', [center_control::class, 'import'])->name('import.datakamar');
Route::post('/importpegawai', [center_control::class, 'importpegawai'])->name('import.datapegawai');
Route::post('/readall', [notificationsys::class, 'ReadAll'])->name('notifi.readall');
Route::get('/datakamar', [center_control::class, 'findkamar'])->name('finddatakamar');
Route::post('/tambahuser', [center_control::class, 'tambah_user'])->name('user.tambah');
// Route::get('/alldata', [center_control::class, 'findpegawai'])->name('alldatas');

Route::middleware(['auth', 'nocache'])->group(function () {
    Route::get('/logout', [UserControl::class, 'logout'])->name('logout.sys');
    Route::post('/tambah', [center_control::class, 'tambah_kamar'])->name('tambah.kamar');
    Route::get('/adminutama', [center_control::class, 'admin'])->name('adminpage');
    Route::delete('/kamar/{id}', [center_control::class, 'delete']);
    Route::delete('/pegawai/{id}', [center_control::class, 'delete_datapegawai']);
});
    