<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\center_control;

Route::get('/', [center_control::class, 'index']);