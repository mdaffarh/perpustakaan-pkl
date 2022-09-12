<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Stock;
use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transaction.borrows.index',[
            'borrows' => Borrow::latest()->get(),
            'borrowed' => Borrow::where('member_id', auth()->user()->member_id)->latest()->get(),
            'stocks' => Stock::where('stok_akhir' ,'>', 0 )->get()
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
        // member_id,book_id,staff_id,tanggal_pinjam,tanggal_tempo,school_id,deskrisi
        $validatedData = $request->validate([
            'book_id' => 'required',
            'stok_akhir' => 'required'
        ]);

        $validatedData['tanggal_pinjam'] = Carbon::now();
        $validatedData['tanggal_tempo'] = Carbon::now()->addDay(3);
        $validatedData['member_id'] = auth()->user()->member_id;
        $validatedData['status'] = "Menunggu persetujuan"; //
        $stok_akhir = $validatedData['stok_akhir'] -= 1;

        Stock::where('book_id',$validatedData['book_id'])->update(['stok_akhir' => $stok_akhir]); //
        Borrow::create($validatedData);

        toast('Peminjaman telah diajukan!','success');
        return redirect('/transaction/borrows');
    }

    public function approve(Request $request, Borrow $borrow){
        $rules = [
            'id'        => 'required'
        ];

        $validatedData = $request->validate($rules);
        $validatedData['status'] = "Disetujui";
        $validatedData['staff_id'] = auth()->user()->staff_id;

        Borrow::where('id', $request->id)->update($validatedData);

        toast('Peminjaman telah disetujui!','success');
        return redirect('/transaction/borrows');
    }

    public function reject(Request $request, Borrow $borrow){
        $rules = [
            'id'        => 'required',
            'book_id'   => 'required',
        ];

        $validatedData = $request->validate($rules);
        $validatedData['status'] = "Ditolak";
        $validatedData['staff_id'] = auth()->user()->staff_id;

        $stok_akhir = $request->stok_akhir += 1;

        Borrow::where('id', $request->id)->update($validatedData);
        Stock::where('book_id',$validatedData['book_id'])->update(['stok_akhir' => $stok_akhir]); //


        toast('Peminjaman telah ditolak!','success');
        return redirect('/transaction/borrows');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function show(Borrow $borrow)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function edit(Borrow $borrow)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Borrow $borrow)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Borrow  $borrow
     * @return \Illuminate\Http\Response
     */
    public function destroy(Borrow $borrow)
    {
        //
    }
}