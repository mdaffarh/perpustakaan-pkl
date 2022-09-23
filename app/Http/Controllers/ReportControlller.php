<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fine;

class ReportControlller extends Controller
{
    public function fine()
    {
        return view('report.fines.index',[
            'fines' => Fine::all()
        ]);
    }
}
