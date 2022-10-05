<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookDonation;
use App\Models\Staff;
use App\Models\Stock;
use App\Models\Borrow;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\StaffRegistration;
use App\Models\MemberRegistration;
use App\Models\BorrowItem;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $random1        = Stock::inRandomOrder()->where('stok_akhir','>','0')->get();
        $borrow_su = Borrow::where('member_id', auth()->user()->member_id)->value('id');

        return view('dashboard.index',[
            // Tampilan Anggota
            'stockBooks'    => $random1,

            'stock'     => Stock::where('stok_akhir' ,'>', 0 )->count(),
            'borrowed'  => Borrow::where('member_id', auth()->user()->member_id)->where('status','Disetujui')->count(),
            'borrowReq' => Borrow::where('member_id', auth()->user()->member_id)->where('status','Menunggu persetujuan')->count(),
            'donation'  => BookDonation::where('member_id',auth()->user()->member_id)->count(),
            'borrowes'  => Borrow::where('member_id', auth()->user()->member_id)->where('status','!=','Ditolak')->where('status','!=','Selesai')->count(),
            'borrow'    => Borrow::where('member_id', auth()->user()->member_id)->where('status','!=','Ditolak')->where('status','!=','Selesai')->latest()->get(),
            'borrow_count'  => BorrowItem::where('borrow_id', $borrow_su)->count(),

            // Tampilan Staff
            'books'     => Book::all()->count(),
            'members'   => Member::all()->count(),
            'borrowRequest'     => Borrow::where('status','Menunggu persetujuan')->count(),
            'memberRegist'      => MemberRegistration::all()->count()
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}