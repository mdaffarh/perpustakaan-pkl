<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Stock;
use App\Models\Borrow;
use App\Models\Notification;
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
            'borrowsWaiting' => Borrow::where('status',"Menunggu persetujuan")->latest()->get(),
            'borrowsApproved' => Borrow::where('status',"Disetujui")->latest()->get(),
            'borrowsRejected' => Borrow::where('status',"Ditolak")->latest()->get(),
            'borrowed' => Borrow::where('member_id', auth()->user()->member_id)
            ->latest()
            ->get(),
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
            'book_id' => 'required'
        ]);

        $validatedData['tanggal_pinjam'] = Carbon::now();
        $validatedData['tanggal_tempo'] = Carbon::now()->addDay(3);
        $validatedData['member_id'] = auth()->user()->member_id;
        $validatedData['status'] = "Menunggu persetujuan"; //
        $stok_akhir = $request->stok_akhir -= 1;
        $stok_keluar = $request->stok_keluar += 1;

        Stock::where('book_id',$validatedData['book_id'])
        ->update([
            'stok_akhir' => $stok_akhir,
            'stok_keluar' => $stok_keluar
        ]); //
        $borrow =  Borrow::create($validatedData);

        // Notification
        $message = [
            'message'   => "Peminjaman Buku No. ".$request->book_id." diajukan ",
            'borrow_id' => $borrow->id
        ];

        Notification::create($message);       

        toast('Peminjaman telah diajukan!','success');
        return redirect('/transaction/borrows');
    }

    public function approve(Request $request, Borrow $borrow){
        $rules = [
            'id'        => 'required'
        ];

        $validatedData = $request->validate($rules);
        $validatedData['status'] = "Disetujui";
        $validatedData['dikembalikan'] = "Belum";
        $validatedData['staff_id'] = auth()->user()->staff_id;

        Borrow::where('id', $request->id)->update($validatedData);

        // Notification
        Notification::where('borrow_id',$request->id)->update(['viewed' => true]);
        $message = [
            'user_id' => $request->user_id,
            'message'   => "Peminjaman No. ".$request->id." telah disetujui",
        ];

        Notification::create($message);

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
        $stok_keluar = $request->stok_keluar -= 1;

        Borrow::where('id', $request->id)->update($validatedData);
        Stock::where('book_id',$validatedData['book_id'])
        ->update([
            'stok_akhir' => $stok_akhir,
            'stok_keluar' => $stok_keluar
        ]); //

        
        // Notification
        Notification::where('borrow_id',$request->id)->update(['viewed' => true]);
        if($request->reason){
            $msg = "Peminjaman No. ".$request->id." telah ditolak karena ".$request->reason;
        }else{
            $msg = "Peminjaman No. ".$request->id." telah ditolak";
        }
        $message = [
            'user_id' => $request->user_id,
            'message'   => $msg
        ];

        Notification::create($message);       

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
        
    }
}