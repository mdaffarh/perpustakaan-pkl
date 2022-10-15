<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Fine;
use App\Models\Stock;
use App\Models\Borrow;
use App\Models\MemberRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function fine()
    {
        return view('report.fines.index',[
            'fines' => Fine::all()
        ]);
    }

    public function borrow()
    {
        // Filter
        $query = Borrow::when(request()->tanggal_awal && request()->tanggal_akhir, function($q){
            return $q->whereBetween('tanggal_pinjam',[request()->tanggal_awal,request()->tanggal_akhir]);
        })
        ->when(request()->tanggal_akhir, function($q){
            return $q->whereBetween('tanggal_pinjam',[0000-00-00,request()->tanggal_akhir]);
        })
        ->when(request()->tanggal_awal, function($q){
            return $q->whereBetween('tanggal_pinjam',[request()->tanggal_awal,'2099-10-17']);
        })
        ->when(request()->member_id,function($q){
            return $q->where('member_id',request()->member_id);
        })
        ->when(request()->status, function($q){
            return $q->where('status',request()->status);
        })
        ->when(true, function($q){
            return $q->where('id','!=',NULL);
        })
        ->get();

        // Kirim data ke report
        if(request()->member_id){
            $member_id = request()->member_id;
        }else{
            $member_id = NULL;
        }
        if(request()->status){
            $status = request()->status;
        }else{
            $status = NULL;
        }
        if(request()->tanggal_awal){
            $tanggal_awal = request()->tanggal_awal;
        }else{
            $tanggal_awal = NULL;
        }
        if(request()->tanggal_akhir){
            $tanggal_akhir = request()->tanggal_akhir;
        }else{
            $tanggal_akhir = NULL;
        }

        return view('report.borrows.index',[
            'borrows' => $query,
            'member_id' => $member_id,
            'status' => $status,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir
        ]);
    }

    public function borrowSet()
    {
        return view('report.borrows.set',[
            'borrows' => Borrow::all(),
            'members' => Borrow::select(DB::raw('DISTINCT member_id'))->get(),
            'status' => Borrow::select(DB::raw('DISTINCT status'))->get()
        ]);
    }

    public function stock(){
        return view('report.stock.index',[
            'stocks' => Stock::all()
        ]);
    }

    public function memberRegistrations()
    {
        if (request()->tanggal_awal == request()->tanggal_akhir) {
            return redirect('/report/borrows');
        }

        return view('report.member-registrations.index',[
            'members' => MemberRegistration::all()
        ]);
    }
}