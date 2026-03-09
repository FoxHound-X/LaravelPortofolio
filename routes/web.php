<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controller\center_controller;

Route::get('/', [center_controller::class, 'index']);