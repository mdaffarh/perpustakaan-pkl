<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Fine;
use App\Models\Borrow;
use App\Models\MemberRegistration;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function fine()
    {
        return view('report.fines.index',[
            'fines' => Fine::all()
        ]);
    }

    public function borrow()
    {
        return view('report.borrows.index',[
            'borrows' => Borrow::all()
        ]);
    }

    public function borrowSet()
    {
        if (request()->tanggal_awal == request()->tanggal_akhir) {
            return redirect('/report/borrows');
        }

        return redirect('/report/borrows');
    }

    public function memberRegistrations()
    {
        if (request()->tanggal_awal == request()->tanggal_akhir) {
            return redirect('/report/borrows');
        }

        return view('report.member-registrations.index',[
            'members' => MemberRegistration::all()
        ]);
    }
}