<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Returns;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function borrow()
    {
        return view('information.borrows.index',[
            'borrows' => Borrow::latest()->get()
        ]);
    }

    public function return()
    {
        return view('information.returns.index',[
            'returns' => Returns::latest()->get()
        ]);
    }
}