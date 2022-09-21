<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index',[
            'member'    => Member::where('id', auth()->user()->member_id)->first()
        ]);
    }
    public function edit()
    {
        return view('profile.edit',[
            'member'    => Member::where('id', auth()->user()->member_id)->first()
        ]);
    }

    public function update()
    {
        $validatedData = request()->validate([
            'id'          => 'required',
            'profile'     => 'image|file|dimensions:ratio=1/1',
        ]);

        $validatedData['nama'] = request()->nama;
        $validatedData['kelas'] = request()->kelas;
        $validatedData['jurusan'] = request()->jurusan;
        $validatedData['nomor_telepon'] = request()->nomor_telepon;
        $validatedData['alamat'] = request()->alamat;

        if(request()->file('profile')){
            if(request()->oldImage){
                Storage::delete(request()->oldImage);
            }
            $validatedData['profile'] = request()->file('profile')->store('profile');
        }

        Member::where('id', request()->id)
            ->update($validatedData);
        
        toast('Profil telah diedit!','success');
        return redirect('/profile');
    }

    public function delete()
    {
        Storage::delete(request()->profile);
        Member::where('id', auth()->user()->member_id)->update(['profile' => null]);
        toast('Foto profil telah dihapus!','success');
        return redirect('/profile');
    }
}