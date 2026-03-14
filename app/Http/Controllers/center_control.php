<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Notification;
use App\Models\DataKamar;
use App\Models\user_data;
use App\Models\DataPegawai;
use Illuminate\Http\Request;
use App\Imports\KamarImport;
use App\Imports\PegawaiImport;
use Carbon\Carbon;

class center_control extends Controller
{
    public function index(){
        return view('login');
    }

    public function admin(){
        $datakamar = DataKamar::all();
        $datapegawai = DataPegawai::all();
        $jmlhkamar = DataKamar::count();
        $notif = Notification::latest()->limit(10)->get();
        $totalnotif = Notification::count();
        $KamarAktif = DataKamar::where('status', 1)->count();
        $KamarMaintenance = DataKamar::where('status', 2)->count();
        $jumlahpegawai = DataPegawai::count();
        return view('admin', compact('datakamar', 'jmlhkamar', 'KamarAktif', 'datapegawai', 'jumlahpegawai', 'KamarMaintenance', 'notif', 'totalnotif'));
    }

    public function time(){
        return Carbon::now()->format('H:i:s');
    }

    public function delete($id){
        $kamar = DataKamar::find($id);
        $kamar->delete();

        return redirect()->back();
    }

    public function delete_datapegawai(Request $request, $id){
        $pegawai = DataPegawai::findOrFail($id);
        Notification::create([
            'title'=>'Hapus Data Pegawai',
            'deskripsi'=>'Data pegawai dengan nama ' .$pegawai->nama_pegawai. ' telah di hapus',
            'type'=>'Deleted'
        ]);
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
        
        Notification::create([
            'title' => 'Tambah Kamar',
            'deskripsi' => ' Kamar Dengan Nomor '.$request->no_kamar.' Telah Berhasil Di Tambahkan',
            'type' => 'create'
        ]);
            
            return redirect('/admin');
    }

    public function tambah_user(Request $request){
        user_data::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect('/admin');
    }

    public function import(Request $request){
        Excel::import(new KamarImport, $request->file('file'));
        return redirect('/admin')->with('success', 'Data berhasil diimport');
    }

    public function importpegawai(Request $request){
        Excel::import(new PegawaiImport, $request->file('file'));
        return redirect('/admin')->with('success', 'data berhasil diimport');
    }

    public function pegawai(){
        $datapegawai = DataPegawai::all();
        return view('admin', compact('datapegawai'));
    }
    
}
