<?php

namespace App\Http\Controllers;
use App\Models\DataKamar;
use Illuminate\Http\Request;

class center_control extends Controller
{
    public function index(){
        $datakamar = DataKamar::all();
        $jumlahkamar = DataKamar::count();
        $KamarAktif = DataKamar::where('status', 1)->count();
        return view('admin', compact('datakamar', 'jumlahkamar', 'KamarAktif'));

    }
}
