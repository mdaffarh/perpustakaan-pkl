<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Member;
use App\Models\MemberRegistration;
use App\Models\Staff;
use App\Models\StaffRegistration;

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
        $random1        = Book::inRandomOrder()->get();
        $count_book     = Book::all()->count();
        $count_member   = Member::all()->count();
        $count_staff    = Staff::all()->count();

        // Count register
        $count_member_registration  = MemberRegistration::all()->count();
        $count_staff_registration   = StaffRegistration::all()->count();
        $count_registration         = $count_member_registration + $count_staff_registration;

        return view('/dashboard/index',[
            'books1'    => $random1,
            'books'     => $count_book,
            'members'   => $count_member,
            'staffs'    => $count_staff,
            'registrations' => $count_registration
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