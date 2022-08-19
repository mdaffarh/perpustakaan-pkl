<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\Staff;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index(){
        return view ('table.shifts.index',[
            'shifts' => Shift::all(),
            'staffs' => Staff::all()
        ]);
    }

    public function create(){
        return view ('table.shifts.create', [
            'shifts' => Shift::all()
        ]);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'staff_id' => 'required|unique:tb_shifts',
            'kategori_shift' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required'
        ]);
        Shift::create($validatedData);

        toast('Data Shift telah ditambahkan!','success');
        return redirect('/table/shifts');
    }

    public function show(Shift $shift){
        return view('table.shifts.show',[
            'shift' => $shift
    ]);
    }

    public function edit(Shift $shift){
        return view('table.shifts.edit',[
            'shift' => $shift
        ]);
    }
    
    // public function update(Request $request, Shift $shift){
    //     $rules = [
    //         'staff_id' => 'required',
    //         'kategori_shift' => 'required',
    //         'waktu_mulai' => 'required',
    //         'waktu_selesai' => 'required'
    //     ];
    
    //     // if($request->staff_id != $shift->staff_id){
    //     //     $rules['staff_id'] = 'required|unique:tb_shifts';
    //     // }

    //     $validatedData = $request->validate($rules);

    //     Shift::where('id',$shift->id)->update($validatedData);

    //     toast('Data Shift telah diedit!','success');
    //     return redirect('/table/shifts');
    // }
    public function update(Request $request, Shift $shift)
    {
     
        $validatedData = $request->validate([
            'staff_id' => 'required',
            'kategori_shift' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required'
        ]);

        Shift::where('id',$shift->id)->update($validatedData);

        toast('Data Shift telah diedit!','success');
        return redirect('/table/shifts');

    }

    public function destroy(Shift $shift){
        Shift::destroy($shift->id);

        toast('Data shift telah dihapus!','success');
        return redirect('/table/shifts');
    }
}