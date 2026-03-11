<?php

namespace App\Http\Controllers;
use App\Models\DataKamar;
use App\Models\user_data;

class center_control extends Controller
{
    public function index(){
        return view('login');
    }

    public function admin(){
        $datakamar = DataKamar::all();
        $jmlhkamar = DataKamar::count();
        $KamarAktif = DataKamar::where('status', 1)->count();
        return view('admin', compact('datakamar', 'jmlhkamar', 'KamarAktif'));
    }

    public function delete($id){
        $kamar = DataKamar::find($id);
        $kamar->delete();

        return redirect()->back();
    }

    
}
