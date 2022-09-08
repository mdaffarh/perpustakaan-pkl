<?php

namespace App\Http\Controllers;

use App\Models\StaffRegistration;
use App\Models\Staff;
use Illuminate\Http\Request;
use Auth;

class StaffRegistrationController extends Controller
{
    public function index(){

    	return view('transaction.staff-registrations.index',[
            'staffRegistration' => StaffRegistration::all()->where('status', '0')
        ]);
    }

    public function create(){
        
    }

    public function store(Request $request){
        
        $validatedData = $request->validate([
            'nip'           => 'required',
            'nama'          => 'required',
            'email'         => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'nomor_telepon' => 'required',
            'alamat'        => 'required'
        ]);

        
        StaffRegistration::create($validatedData);
        alert()->success('success','waiting for approved by admin');

        return redirect('/register');
    }

    public function approved(Request $request, StaffRegistration $staffRegistration){
        $rules = [
            'status'            => $request->status,
            'user_verifikasi'   => Auth::user()->id
        ];

        $staff = [
            'nip'           => 'required', //Jangan unique klo update
            'nama'          => 'required',
            'email'         => 'required',
            'jenis_kelamin' => 'required',//
            'tanggal_lahir' => 'required',
            'nomor_telepon' => 'required',
            'alamat'        => 'required'
        ];

        $validatedDataStaff     = $request->validate($staff);

        StaffRegistration::where('id', $request->id)->update($rules);
        Staff::create($validatedDataStaff);

        toast('Data anggota Ditambahkan!','success');
        return redirect('/table/staffs');
    }

    public function tolak(Request $request, StaffRegistration $staffRegistration){
        $registrasi = [
            'status'            => $request->status,
            'user_verifikasi'   => Auth::user()->id
        ];

        StaffRegistration::where('id', $request->id)->update($registrasi);

        toast('Data sudah Ditolak!','success');
        return redirect('/transaction/staff-registrations/index');
    }
}