<?php

namespace App\Http\Controllers\table;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\School;

class tb_schoolController extends Controller
{
    public function index()
    {
        return view('schools.index', [
            'schools' => School::all()
        ]);
    }

    // public function show($id){
    
    //     return view('table.tb_school', [
    //         'tb_school' => tb_school::findOrFail($id)
    //     ]);
    // }


}