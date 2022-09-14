<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;

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

            $data = Book::inRandomOrder()->get();

            toast('Login berhasil!','success');
            return redirect()->intended('/dashboard')->with([$data]);
        }

        return back()->with('loginError','Login failed!');
    }

    public function dashboard()
    {
        $random1 = Book::inRandomOrder()->get();
        $random2 = Book::inRandomOrder()->limit(5)->get();
        $random2 = Book::inRandomOrder()->limit(5)->get();
        return view('/dashboard/index',[
            'books1' => $random1,
            'books2' => $random2
        ]);
    }


    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }

}