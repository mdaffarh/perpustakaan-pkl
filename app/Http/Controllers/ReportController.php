<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fine;

class ReportController extends Controller
{
    public function fine()
    {
        return view('report.fines.index',[
            'fines' => Fine::all()
        ]);
    }
}