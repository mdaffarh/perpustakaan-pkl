<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('table.majors.index', [
            'majors' => Major::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('table.majors.create', [
            'majors' => Major::all()
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
            'short' => 'required',
            'full' => 'required',
        ]);

        Major::create($validatedData);

        toast('Data Jurusan telah ditambahkan!','success');
        return redirect('/table/majors');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\major  $major
     * @return \Illuminate\Http\Response
     */
    public function show(major $major)
    {
        return view('table.majors.show',[
            'major' => $major
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\major  $major
     * @return \Illuminate\Http\Response
     */
    public function edit(major $major)
    {
        return view('table.majors.edit',[
            'major' => $major
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\major  $major
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, major $major)
    {
     
        $validatedData = $request->validate([
            'short' => 'required',
            'full' => 'required',
        ]);

        Major::where('id',$major->id)->update($validatedData);

        toast('Data Jurusan telah diedit!','success');
        return redirect('/table/majors');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\major  $major
     * @return \Illuminate\Http\Response
     */
    public function destroy(major $major)
    {
        Major::destroy($major->id);
        toast('Data Jurusan telah dihapus!','success');
        return redirect('/table/majors');

    }
}