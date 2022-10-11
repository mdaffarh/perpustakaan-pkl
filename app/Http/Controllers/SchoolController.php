<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('table.schools.index', [
            'schools' => School::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('table.schools.create', [
            'schools' => School::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //name,address,city,post_code,email,website,fax,phone_number
        //slug ??

        $validatedData = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'kode_pos' => 'required',
            'email' => 'required',
            'website' => 'required',
            'fax' => 'required',
            'nomor_telepon' => 'required'
        ]);

        School::create($validatedData);

        toast('Data Sekolah telah ditambahkan!','success');
        return redirect('/table/schools');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        return view('table.schools.show',[
            'school' => $school
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        return view('table.schools.edit',[
            'school' => $school
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
     
        $validatedData = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'kode_pos' => 'required',
            'email' => 'required',
            'website' => 'required',
            'fax' => 'required',
            'nomor_telepon' => 'required'
        ]);

        School::where('id',$school->id)->update($validatedData);

        toast('Data Sekolah telah diedit!','success');
        return redirect('/table/schools');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        School::destroy($school->id);
        toast('Data sekolah telah dihapus!','success');
        return redirect('/table/schools');

    }
}