<?php

namespace App\Http\Controllers;
use App\Models\database_kamar;
use Illuminate\Http\Request;

class center_control extends Controller
{
    public function index(){
        $datakamar = data_kamar::all();
        return view('admin', compact('datakamar'));
    }
}
