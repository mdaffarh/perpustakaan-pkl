<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Fine;
use App\Models\Borrow;
use App\Models\Returns;
use App\Models\Donation;
use App\Models\BookDonation;
use Illuminate\Http\Request;
use App\Models\StaffRegistration;
use App\Models\MemberRegistration;
use Illuminate\Support\Facades\DB;

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
            'donations' => Donation::latest()->get()
        ]);
    }

    public function fine()
    {
        return view('information.fines.index',[
            'fines' => Fine::latest()->get()
        ]);
    }

    public function memberRegistration(){
        return view('information.member-registrations.index',[
            'memberRegistrations' => MemberRegistration::latest()->get()
        ]);
    }
    public function staffRegistration(){
        return view('information.staff-registrations.index',[
            'staffRegistrations' => StaffRegistration::latest()->get()
        ]);
    }

    public function book(){
        return view('information.books.index',[
            'books' => Book::join('tb_stocks', 'tb_books.id', '=', 'tb_stocks.book_id')->get()
        ]);
    }
}