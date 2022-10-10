<?php

namespace App\Http\Controllers;

use App\Models\BookDonation;
use App\Models\Borrow;
use App\Models\Returns;
use Illuminate\Http\Request;
use App\Models\Fine;

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

    public function bookDonation()
    {
        return view('information.book-donations.index',[
            'bookDonations' => BookDonation::latest()->get()
        ]);
    }

    public function fine()
    {
        return view('information.fines.index',[
            'fines' => Fine::latest()->get()
        ]);
    }
}