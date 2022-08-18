<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        if($user = Auth::user()){
            if($user->role == 'staff'){
                return redirect()->intended('dashboard');
            }elseif($user->role =='member'){
                return redirect()->intended('member');
            }
        }

        toast('Login berhasil!','success');
        return view('login.index');
    }

    public function proses(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ],
        [
            'username.required' => 'username tidak boleh kosong',
            'password.required' => 'password tidak boleh kosong'
        ]
    );

    $credential =  $request->only('username', 'password');

    if(Auth::attempt($credential)){
        $request->session()->regenerate();
        if($user = Auth::user()){
            if($user->role == 'staff'){
                return redirect()->intended('dashboard');
            }elseif($user->role =='member'){
                return redirect()->intended('dashboard');
            }
        }
        return redirect()->intended('/dashboard');
    }

        return back()->withErrors([
            'username' => 'Maaf username atau password anda salah',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }
}