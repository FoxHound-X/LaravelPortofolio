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
        $datakamar          = DataKamar::paginate(10);
        $datapegawai        = DataPegawai::paginate(10);
        $jmlhkamar          = DataKamar::count();
        $notif              = Notification::latest()->limit(10)->get();
        $totalnotif         = Notification::where('status', 1)->count();
        $KamarAktif         = DataKamar::where('status', 1)->count();
        $KamarMaintenance   = DataKamar::where('status', 2)->count();
        $jumlahpegawai      = DataPegawai::count();
        return view('admin', compact(
            'datakamar',
            'jmlhkamar',
            'KamarAktif',
            'datapegawai',
            'jumlahpegawai',
            'KamarMaintenance',
            'notif',
            'totalnotif'));
    }


    //Controller Kamar
    public function findkamar(Request $request){
        $search = $request->search;

        $data = DataKamar::where('no_kamar', 'like', "%$search%")
        ->orWhere('tipe_kamar', 'like', "%$search%")
        ->get();
        $datakamar          = DataKamar::all();
        $datapegawai        = DataPegawai::all();
        $jmlhkamar          = DataKamar::count();
        $notif              = Notification::latest()->get();
        $totalnotif         = Notification::where('status', 1)->count();
        $KamarAktif         = DataKamar::where('status', 1)->count();
        $KamarMaintenance   = DataKamar::where('status', 2)->count();
        $jumlahpegawai      = DataPegawai::count();

        return view('admin', [
            'datakamar'         => $data,
            'tab'               => 'daftar-kamar',
            'datapegawai'       => $datapegawai,
            'jmlhkamar'         => $jmlhkamar,
            'notif'             => $notif,
            'totalnotif'        => $totalnotif,
            'KamarAktif'        => $KamarAktif,
            'KamarMaintenance'  => $KamarMaintenance,
            'jumlahpegawai'     => $jumlahpegawai
        ]);
    }


    public function delete($id){
        $kamar = DataKamar::find($id);
        $kamar->delete();

        return redirect()->back();
    }


    public function tambah_kamar(Request $request){
        $request->validate([
            'no_kamar'      => 'required|string|unique:data_kamar,no_kamar',
            'tipe_kamar'    => 'required|string',
            'lantai'        => 'required|string',
            'kapasitas'     => 'required|string',
            'harga'         => 'required|numeric|min:0',
            'status'        => 'required|integer|in:0,1,2',
        ], [
            'no_kamar.unique'   => 'Nomor kamar sudah ada!',
            'no_kamar.required' => 'Nomor kamar harus diisi!',
            'status.in'         => 'Status tidak valid!',
        ]);

        DataKamar::create([
            'no_kamar'      => $request->no_kamar,
            'tipe_kamar'    => $request->tipe_kamar,
            'lantai'        => $request->lantai,
            'kapasitas'     => $request->kapasitas,
            'status'        => $request->status,
            'harga'         => $request->harga,
        ]);

        Notification::create([
            'title'         => 'Tambah Kamar',
            'deskripsi'     => ' Kamar Dengan Nomor '.$request->no_kamar.' Telah Berhasil Di Tambahkan',
            'type'          => 'create',
            'status'        => 1,
        ]);

            return redirect('/adminutama');
    }

    public function import(Request $request){
        Excel::import(new KamarImport, $request->file('file'));
        return redirect('/adminutama')->with('success', 'Data berhasil diimport');
    }


    // //Controller Pegawai
    // public function tambah_karyawan(Request $request){
    //     $request->validate([
    //         'nama_pegawai'  =>'required|string',
    //         'posisi'        =>'required|string',
    //         'shift'         =>'required|string',
    //         'nomer_hp'      =>'required|string',
    //         'status'        =>'required|string',
    //     ]);

    //     DataPegawai::create([
    //         'nama_pegawai'  => $request->nama_pegawai,
    //         'posisi'        => $request->posisi,
    //         'shift'         => $request->shift,
    //         'nomer_hp'      => $request->nomer_hp,
    //         'status'        => $request->status,
    //     ]);

    // }

    public function edit_karyawan($id){
        $data = DataPegawai::findOrFail($id);
        return view('editkaryawan', compact('data'));
    }

    public function update_karyawan(Request $request, $id){
        $data = DataPegawai::findOrFail($id);

        $request->validate([
            'nama_pegawai'  => 'required',
            'posisi'        => 'required',
            'shift'         => 'required',
            'nomer_hp'      => 'required',
            'status'        => 'required',
        ]);

        $data->update([
            'nama_pegawai'  => $request->nama_pegawai,
            'posisi'        => $request->posisi,
            'shift'         => $request->shift,
            'nomer_hp'      => $request->nomer_hp,
            'status'        => $request->status,
        ]);

        return redirect()->route('adminpage')->with('success', 'Berhasil update');
    }


    public function delete_datapegawai(Request $request, $id){
        $pegawai = DataPegawai::findOrFail($id);
        Notification::create([
            'title'         =>'Hapus Data Pegawai',
            'deskripsi'     =>'Data pegawai dengan nama ' .$pegawai->nama_pegawai. ' telah di hapus',
            'type'          =>'Deleted',
            'status'        => 1,
        ]);
        $pegawai->delete();


        return redirect()->back();
    }


    public function pegawai(){
        $datapegawai = DataPegawai::all();
        return view('admin', compact('datapegawai'));
    }

    public function importpegawai(Request $request){
        Excel::import(new PegawaiImport, $request->file('file'));
        return redirect('/adminutama')->with('success', 'data berhasil diimport');
    }


    //Controller User Login
    public function tambah_user(Request $request){
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:user_datas,email',
            'password'  => 'required|string|min:8',
            'role'      => 'required|string',
        ]);

        user_data::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'role'          => $request->role,
        ]);

        return redirect('/adminutama');
    }

}
