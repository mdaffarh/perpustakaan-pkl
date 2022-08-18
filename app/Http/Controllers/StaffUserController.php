<?php

namespace App\Http\Controllers;

use App\Models\StaffUser;
use Illuminate\Http\Request;

class StaffUserController extends Controller
{
    public function index(){
        return view('table.staffUsers.index', [
            'staffUsers' => StaffUser::all()
        ]);
    }

    public function create(){
        return view('table.staffUsers.index',[
            'staffusers' => StaffUser::all()
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'staff_id' => 'required|unique:tb_staff_users',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);
        StaffUser::create($validatedData);
        return redirect('/table/staffUsers')->with('success','Data Staff User telah ditambahkan !');
    }

    public function show(StaffUser $staffUser){
        return view('table.staffUsers.show',[
            'staffusers' => $staffUser
    ]);
    }

    public function edit(StaffUser $staffUser){
        return view('table.staffUsers.edit',[
            'staffusers' => $staffUser
        ]);
    }
    
    public function update(Request $request, StaffUser $staffUser){
        $rules = [
            'staff_id' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'
        ];
    
        if($request->staff_id != $staffUser->staff_id){
            $rules['staff_id'] = 'required|unique:tb_staff_users';
        }

        $validatedData = $request->validate($rules);

        StaffUser::where('id',$staffUser->id)->update($validatedData);

        return redirect('/table/staffUsers')->with('success','Data Staff User telah diedit!');
    }

    public function destroy(StaffUser $staffUser){
        StaffUser::destroy($staffUser->id);
        return redirect('/table/staffUsers')->with('deleted','Data Staff User telah dihapus!');
    }
}
