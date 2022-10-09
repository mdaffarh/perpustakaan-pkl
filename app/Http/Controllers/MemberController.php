<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //
    public function index()
    {
        return view('table.members.index',[
            'members' => Member::all(),
            'majors'  => Major::all()
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
            'alamat'=> 'required',
        ]);

        $validatedData['status'] = 1;
        $validatedData['created_by'] = auth()->user()->staff_id;
        
        Member::create($validatedData);

        toast('Data anggota telah ditambahkan!','success');
        return redirect('/table/members');


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
            'alamat'=> 'required',
            'status'=> 'required'
        ];
    
        if($request->nis != $member->nis){
            $rules['nis'] = 'required|unique:tb_members';
        }

        $validatedData = $request->validate($rules);

        $validatedData['updated_by'] = auth()->user()->staff_id;

        Member::where('id',$member->id)->update($validatedData);

        toast('Data anggota telah diedit!','success');
        return redirect('/table/members');
    }

    public function destroy(Member $member){
        Member::destroy($member->id);
        toast('Data anggota telah dihapus!','success');
        return redirect('/table/members');
    }
}