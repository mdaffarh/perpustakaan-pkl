<?php

namespace App\Http\Controllers;

use App\Models\MemberRegistration;
use Illuminate\Http\Request;

class MemberRegistrationController extends Controller
{
    public function index()
    {
        return view('transaction.member-registration.index',[
            'memberRegistration' => MemberRegistration::all()
            // 'members' => Member::all()
        ]);
    }
}
