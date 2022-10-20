<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffUserController extends Controller
{
    public function index(){
        return view('users.staff-users.index', [
            'staffUsers' => User::whereNotNull('staff_id')->get(),
            'staffUnsigned' => Staff::where('signed','!=','2')->get(),
            'staffs' => Staff::all()
        ]);
    }

    public function create(){
        return view('users.staff-users.index',[
            'staffusers' => User::all()
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'staff_id' => 'required|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        Staff::where('id',$validatedData['staff_id'])->update(['signed' => 2]);

        User::create($validatedData);

        toast('User staff telah ditambahkan!','success');
        return redirect('/users/staff-users');
    }

    public function show(User $staffUser){
        return view('users.staff-users.show',[
            'staffusers' => $staffUser
    ]);
    }

    public function edit(User $staffUser){
        return view('users.staff-users.edit',[
            'staffusers' => $staffUser
        ]);
    }
    
    public function update(Request $request, User $staffUser){
        $rules = [
            'staff_id' => 'required',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required'
        ];
    
        if($request->username != $staffUser->username){
            $rules['username'] = 'required|unique:users';
        }

        $validatedData = $request->validate($rules);
        if($validatedData['password'] != $staffUser->password){
            $validatedData['password'] = Hash::make($validatedData['password']);
        }
        User::where('id',$staffUser->id)->update($validatedData);

        toast('User staff telah diedit!','success');
        return redirect('/users/staff-users');
    }

    public function destroy(User $staffUser){
        Staff::where('id',$staffUser->staff_id)->update(['signed' => 1]);
        User::destroy($staffUser->id);

        toast('User staff telah dihapus!','success');
        return redirect('/users/staff-users');
    }
}