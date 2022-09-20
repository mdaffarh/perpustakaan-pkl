<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MemberRegistration;
use Illuminate\Http\Request;

class MemberRegistrationController extends Controller
{
    public function index()
    {
        return view('transaction.member-registrations.index',[
            'memberRegistration' => MemberRegistration::all()->where('status', '0')
        ]);
    }

    public function create(){
        
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

        
        MemberRegistration::create($validatedData);
        alert()->success('success','Data akan didaftarkan setelah disetujui staff');

        return redirect('/register');

    }

    public function directStore(Request $request)
    {

        $validatedData = $request->validate([
            'nis' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',//
            'kelas' => 'required',//
            'jurusan' => 'required',
            'tanggal_lahir' => 'required',
            'nomor_telepon'=> 'required',
            'alamat'=> 'required'
        ]);

        
        Member::create($validatedData);
        toast('Data anggota telah ditambahkan!','success');

        return redirect('/transaction/member-registrations/index');

    }
    
    public function approved(Request $request, MemberRegistration $memberRegistration){
        $rules = [
            'status'        => 'required'
        ];

        $member = [
            'nis' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',//
            'kelas' => 'required',//
            'jurusan' => 'required',
            'tanggal_lahir' => 'required',
            'nomor_telepon'=> 'required',
            'alamat'=> 'required'
        ];

        $validatedData = $request->validate($rules);
        $validatedDataMember = $request->validate($member);

        MemberRegistration::where('id', $request->id)->update($validatedData);
        Member::create($validatedDataMember);

        toast('Data anggota Ditambahkan!','success');
        return redirect('/table/members');
    }

    public function tolak(Request $request, MemberRegistration $memberRegistration){
        $registrasi = [
            'status' => $request->status
        ];

        MemberRegistration::where('id', $request->id)->update($registrasi);

        toast('Data Ditolak!','success');
        return redirect('/transaction/member-registrations/index');
    }
}