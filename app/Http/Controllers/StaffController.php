<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index(){
        return view ('table.staffs.index',[
            'staffs' => Staff::all()
        ]);
    }

    public function create(){
        return view ('table.staffs.create',[
            'staffs' => Staff::all()
        ]);
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'nip' => 'required|unique:tb_staffs',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'nomor_telepon' => 'required',
            'alamat' => 'required',
            'email' => 'required|unique:tb_staffs'
        ]);

        $validatedData['created_by'] = auth()->user()->staff_id;
        
        Staff::create($validatedData);

        toast('Data staff telah ditambahkan!','success');
        return redirect('/table/staffs');
    }

    public function show(Staff $staff){
        return view('table.staffs.show',[
            'staff' => $staff
    ]);
    }

    public function edit(Staff $staff){
        return view('table.staffs.edit',[
            'staff' => $staff
        ]);
    }
    
    public function update(Request $request, Staff $staff){
        $rules = [
            'nip' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required',
            'nomor_telepon' => 'required',
            'alamat' => 'required',
            'email' => 'required'
        ];
    
        if($request->nip != $staff->nip){
            $rules['nip'] = 'required|unique:tb_staffs';
        }
        if($request->email != $staff->email){
            $rules['email'] = 'required|unique:tb_staffs';
        }



        $validatedData = $request->validate($rules);

        $validatedData['updated_by'] = auth()->user()->staff_id;

        Staff::where('id',$staff->id)->update($validatedData);

        toast('Data staff telah diedit!','success');
        return redirect('/table/staffs');
    }

    public function destroy(Staff $staff){
        Staff::destroy($staff->id);

        toast('Data staff telah dihapus!','success');
        return redirect('/table/staffs');
    }
}