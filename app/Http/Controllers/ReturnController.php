<?php

namespace App\Http\Controllers;

use App\Models\Fine;
use App\Models\Borrow;
use App\Models\Member;
use App\Models\Returns;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReturnController extends Controller
{
    Public function index()
    {
        return view('transaction.return.index',[
            'returns' => Returns::all(),
            'borrows' => Borrow::all()->where('dikembalikan', 'Belum')
        ]);
    }
    
    public function store(Request $request)
    {
        $dt = [
            'dikembalikan'  => "Sudah"
        ];
        Borrow::where('id', $request->borrow_id)->update($dt);
        
        $data = Borrow::where('id', $request->borrow_id)->value('updated_at');

        $validatedData = [
            'borrow_id' => $request->borrow_id,
            'staff_id'  =>  auth()->user()->staff_id
        ];

        Returns::create($validatedData);

        $q = $data->diffInDays(now(), false); // now() = 2020-10-15 16:40:49
        
        if ($q > 3) {
            $kali = 500*$q;

            Fine::create([
                'borrow_id' => $request->borrow_id,
                'member_id' => $request->member_id,
                'tenggat_waktu' => $q,
                'total'     => $kali
            ]);
        }


        toast('Data anggota telah ditambahkan!','success');
        return redirect('/transaction/return');


    }
    
    public function update(Request $request, Member $member){
        $rules = [
            
        ];
        
        $q = $i->diffInDays(now(), false); // now() = 2020-10-15 16:40:49

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