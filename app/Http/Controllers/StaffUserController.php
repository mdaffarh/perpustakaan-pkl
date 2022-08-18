<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\StaffUser;
use Illuminate\Http\Request;

class StaffUserController extends Controller
{
    public function index(){
        return view('table.staff-users.index', [
            'staffUsers' => StaffUser::all(),
            'staffs' => Staff::all()
        ]);
    }

    public function create(){
        return view('table.staff-users.index',[
            'staffusers' => StaffUser::all()
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'staff_id' => 'required|unique:tb_staff_users',
            'username' => 'required|unique:tb_staff_users',
            'email' => 'required|unique:tb_staff_users',
            'password' => 'required',
            'role' => 'required'
        ]);
        StaffUser::create($validatedData);

        toast('User staff telah ditambahkan!','success');
        return redirect('/table/staff-users');
    }

    public function show(StaffUser $staffUser){
        return view('table.staff-users.show',[
            'staffusers' => $staffUser
    ]);
    }

    public function edit(StaffUser $staffUser){
        return view('table.staff-users.edit',[
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
    
        if($request->username != $staffUser->username){
            $rules['username'] = 'required|unique:tb_staff_users';
        }
        if($request->email != $staffUser->email){
            $rules['email'] = 'required|unique:tb_staff_users';
        }

        $validatedData = $request->validate($rules);

        StaffUser::where('id',$staffUser->id)->update($validatedData);

        toast('User staff telah diedit!','success');
        return redirect('/table/staff-users');
    }

    public function destroy(StaffUser $staffUser){
        StaffUser::destroy($staffUser->id);

        toast('User staff telah dihapus!','success');
        return redirect('/table/staff-users');
    }
}