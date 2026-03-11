<?php

namespace App\Http\Controllers;
use App\Models\DataKamar;
use App\Models\user_data;
use Illuminate\Http\Request;

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

    public function tambah_kamar(Request $request){

        DataKamar::create([
            'no_kamar' => $request->no_kamar,
            'tipe_kamar' => $request->tipe_kamar,
            'lantai' => $request->lantai,
            'kapasitas' => $request->kapasitas,
            'status' => $request->status,
            'harga' => $request->harga,
        ]);
        return redirect('/admin');
    }
    
}
