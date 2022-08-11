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
        return view('dashboard.schools.index', [
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
        return view('dashboard.schools.create', [
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
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'post_code' => 'required',
            'email' => 'required',
            'website' => 'required',
            'fax' => 'required',
            'phone_number' => 'required'
        ]);

        School::create($validatedData);

        return redirect('/dashboard/schools')->with('success','Data School telah ditambahkan!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        return view('dashboard.schools.show',[
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
        return view('dashboard.schools.edit',[
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
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'post_code' => 'required',
            'email' => 'required',
            'website' => 'required',
            'fax' => 'required',
            'phone_number' => 'required'
        ]);

        School::where('id',$school->id)->update($validatedData);

        return redirect('/dashboard/schools')->with('success','Data Sekolah telah diedit!');

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
        return redirect('/dashboard/schools')->with('deleted','Data Sekolah telah dihapus!');

    }
}