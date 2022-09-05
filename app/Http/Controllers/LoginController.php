<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

     public function register()
    {
        return view('login.register');
    }

    public function authenticate()
    {
        $credentials = request()->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            request()->session()->regenerate();

            toast('Login berhasil!','success');
            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError','Login failed!');
    }


    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }
}