<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class tb_schoolController extends Controller
{
    public function index()
    {
        $tb_school = DB::table('tb_school')->get();
 
        return view('table.tb_school', ['tb_school' => $tb_school]);
    }

    // public function show($id){
    
    //     return view('table.tb_school', [
    //         'tb_school' => tb_school::findOrFail($id)
    //     ]);
    // }


}