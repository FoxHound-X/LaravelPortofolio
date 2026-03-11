<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\DataKamar;


class UserControl extends Controller
{
    public function login(Request $request){
        $data = $request->only('email', 'password');

        if(Auth::attempt($data)){

            if(Auth::user()->role == 'admin'){
                $datakamar = DataKamar::all();
                $jmlhkamar = DataKamar::count();
                $KamarAktif = DataKamar::where('status', 1)->count();
                return view('admin', compact('datakamar', 'jmlhkamar', 'KamarAktif'));
                return view('admin');
            } else {
                return redirect('login');
            }
        }
        return back()->with('error','email atau password salah');
    }

    public function logout(){
        Auth::logout();
        return view('login');
    }
}
