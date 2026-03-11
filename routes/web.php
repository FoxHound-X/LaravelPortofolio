<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\center_control;
use App\Http\Controllers\UserControl;

Route::get('/', [center_control::class, 'index']);

Route::post('/admin', [UserControl::class, 'login'])->name('login.sys');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [center_control::class, 'admin']);
    Route::delete('/kamar/{id}', [center_control::class, 'delete']);
    Route::get('/logout', [UserControl::class, 'logout'])->name('logout.sys');
    
});
    