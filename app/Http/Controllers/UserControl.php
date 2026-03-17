<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class UserControl extends Controller
{
    public function login(Request $request){
        $data = $request->only( 'email', 'password');

        if(Auth::attempt($data)){
            $request->session()->regenerate();

            if(in_array(Auth::user()->role, ['admin', 'front'])){
                return redirect()->intended('/adminutama');
                // return view('admin');
            } else {
                return redirect('/');
            }
        }
        return back()->with('error','email atau password salah');
    }

    public function logout(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerate();
        return redirect()->route('login');
    }

}
