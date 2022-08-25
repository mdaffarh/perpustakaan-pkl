<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MemberUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('table.member-users.index',[
            'memberUsers' => User::whereNotNull('member_id')->get(),
            'members' => Member::whereNull('signed')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'member_id' => 'required|unique:users',
            'username' => ['required','min:3','max:255','unique:users'],
            'password' => 'required'
        ]);

        // $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['password'] = Hash::make($validatedData['password']);

        Member::where('id',$validatedData['member_id'])->update(['signed' => true]);

        User::create($validatedData);

        // $request->session()->flash('success', 'Registration successfull! Please login');
        

        toast('User anggota telah dibuat!','success');
        return redirect('/table/member-users');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MemberUser  $memberUser
     * @return \Illuminate\Http\Response
     */
    public function show(User $memberUser){
        return view('table.members.show',[
            'memberUser' => $memberUser
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MemberUser  $memberUser
     * @return \Illuminate\Http\Response
     */
    public function edit(User $memberUser){
        return view('table.member-users.edit',[
            'memberUser' => $memberUser
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MemberUser  $memberUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $memberUser)
    {
        $rules = [
            'member_id' => 'required',
            'username' => 'required',
            'password' => 'required'
        ];
    
        if($request->username != $memberUser->username){
            $rules['username'] = 'required|unique:users';
        }

        $validatedData = $request->validate($rules);
        if($validatedData['password'] != $memberUser->password){
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        User::where('id',$memberUser->id)->update($validatedData);

        toast('User anggota telah diedit!','success');
        return redirect('/table/member-users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MemberUser  $memberUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $memberUser)
    {
        Member::where('id',$memberUser->member_id)->update(['signed' => null]);
        User::destroy($memberUser->id);
        toast('User anggota telah dihapus!','success');
        return redirect('/table/member-users');
    }
}