<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //
    public function index()
    {
        return view('table.members.index',[
            'members' => Member::all()
        ]);
    }

    public function create(){
        return view('table.members.create',[
            'members' => Member::all() 
        ]);
    }
    
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nis' => 'required|unique:tb_members',
            'nama' => 'required',
            'jenis_kelamin' => 'required',//
            'kelas' => 'required',//
            'jurusan' => 'required',
            'tanggal_lahir' => 'required',
            'nomor_telepon'=> 'required',
            'alamat'=> 'required'
        ]);

        
        Member::create($validatedData);

        return redirect('/table/members')->with('success','Data Member telah ditambahkan!');


    }

    public function show(Member $member){
        return view('table.members.show',[
            'member' => $member
        ]);
    }

    public function edit(Member $member){
        return view('table.members.edit',[
            'member' => $member
        ]);
    }
    
    public function update(Request $request, Member $member){
        $rules = [
            'nis' => 'required', //Jangan unique klo update
            'nama' => 'required',
            'jenis_kelamin' => 'required',//
            'kelas' => 'required',//
            'jurusan' => 'required',
            'tanggal_lahir' => 'required',
            'nomor_telepon'=> 'required',
            'alamat'=> 'required'
        ];
    
        if($request->nis != $member->nis){
            $rules['nis'] = 'required|unique:tb_members';
        }

        $validatedData = $request->validate($rules);

        Member::where('id',$member->id)->update($validatedData);

        return redirect('/table/members')->with('success','Data Member telah diedit!');
    }

    public function destroy(Member $member){
        Member::destroy($member->id);
        return redirect('/table/members')->with('deleted','Data Member telah dihapus!');
    }
}