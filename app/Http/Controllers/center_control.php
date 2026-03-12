<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\DataKamar;
use App\Models\user_data;
use App\Models\DataPegawai;
use Illuminate\Http\Request;
use App\Imports\KamarImport;

class center_control extends Controller
{
    public function index(){
        return view('login');
    }

    public function admin(){
        $datakamar = DataKamar::all();
        $datapegawai = DataPegawai::all();
        $jmlhkamar = DataKamar::count();
        $KamarAktif = DataKamar::where('status', 1)->count();
        return view('admin', compact('datakamar', 'jmlhkamar', 'KamarAktif', 'datapegawai'));
    }

    public function delete($id){
        $kamar = DataKamar::find($id);
        $kamar->delete();

        return redirect()->back();
    }

    public function delete_datapegawai($id){
        $pegawai = DataPegawai::find($id);
        $pegawai->delete();

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

    public function import(Request $request){
        Excel::import(new KamarImport, $request->file('file'));
        return redirect('/admin')->with('success', 'Data berhasil diimport');
    }

    public function pegawai(){
        $datapegawai = DataPegawai::all();
        return view('admin', compact('datapegawai'));
    }
    
}
