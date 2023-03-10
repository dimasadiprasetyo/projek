<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //login
    public function postlogin(Request $request){
        if (Auth::attempt($request->only('username', 'password'))) {
            return redirect('/dasboard')->with('success','Selamat! Anda telah berhasil Login');
        }
            return redirect('/')->with('message','Username atau Password salah');
    }
    //logout
    
    public function logout(Request $request){
        Auth::logout();
        return redirect('/');
    }
}
