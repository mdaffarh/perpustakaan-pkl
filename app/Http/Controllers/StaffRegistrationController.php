<?php

namespace App\Http\Controllers;

use App\Models\StaffRegistration;
use Illuminate\Http\Request;

class StaffRegistrationController extends Controller
{
    public function index(){

    	return view('transaction.staff-registrations.index',[
            'staffRegistration' => StaffRegistration::all()
        ]);
    }

    public function create(){
        
    }

    public function store(Request $request){
        
        $validatedData = $request->validate([
            'nip' 	=> 'required',
            'nama' 	=> 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'nomor_telepon'=> 'required',
            'alamat'=> 'required'
        ]);

        
        StaffRegistration::create($validatedData);
        alert()->success('success','waiting for approved by admin');

        return redirect('/register');
    }

    public function show(User $staffUser){
        
    }

    public function edit(User $staffUser){
        
    }
    
    public function update(Request $request, User $staffUser){
        
    }

    public function destroy(User $staffUser){
        
    }
}