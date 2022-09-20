<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Stock;
use App\Models\Borrow;
use App\Models\BorrowItem;
use App\Models\Member;
use App\Models\Returns;
use App\Models\Fine;
use App\Models\Notification;
use App\Models\Wishlist;
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
        $borrow_su = Borrow::where('member_id', auth()->user()->member_id)->value('id');

        return view('transaction.borrows.index',[
            'borrowsWaiting'    => Borrow::where('status',"Menunggu persetujuan")->latest()->get(), // disetujui Staff
            'borrowsApproved'   => Borrow::where('status',"Disetujui")->where('pengambilan_buku', "Belum")->latest()->get(),  //Pengambilan Buku Staff
            'borrows'           => Borrow::where('pengambilan_buku',"Sudah")->where('dikembalikan',"Belum")->latest()->get(), //Return Buku Staff
            'borrowedMenungguPersetujuan'   => Borrow::where('member_id', auth()->user()->member_id)->where('status',"Menungggu persetujuan")->latest()->get(),
            'borrowedDisetujui'             => Borrow::where('member_id', auth()->user()->member_id)->where('status',"Disetujui")->where('pengambilan_buku', "Belum")->latest()->get(),
            'borrowedDitolak'               => Borrow::where('member_id', auth()->user()->member_id)->where('status',"Ditolak")->latest()->get(),
            'borrow_count'      => BorrowItem::where('borrow_id', $borrow_su)->count()
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
        $tanggal_tempo = date('Y-m-d', strtotime('+3 days', strtotime( $request->tanggal_pinjam )));
        $borrow =  Borrow::create([
            'kode_peminjaman'   => date('dmyis'),
            'member_id'         => auth()->user()->member_id,
            'tanggal_pinjam'    => $request->tanggal_pinjam,
            'tanggal_tempo'     => $tanggal_tempo,
            'status'            => "Menunggu persetujuan",
            'pengambilan_buku'  => "Belum",
            'dikembalikan'      => "Belum"
        ]);

        foreach ($request->book_id as $key => $book) {

            BorrowItem::create([
                'borrow_id' => $borrow->id,
                'book_id'   => $book
            ]);
        }

        foreach ($request->book_id as $key => $book) {
            
            // Notification
            $message = [
                'message'   => "Peminjaman Buku No. ".$book." diajukan ",
                'borrow_id' => $borrow->id
            ];

            Notification::create($message);     
        }

        foreach ($request->wishlist_id as $key => $wishlist) {
            Wishlist::where('id', $wishlist)->delete();
        }

        toast('Peminjaman telah diajukan!','success');
        return redirect('/dashboard');
    }

    public function approve(Request $request, Borrow $borrow){
        $rules = [
            'id'        => 'required'
        ];

        $validatedData = $request->validate($rules);
        $validatedData['status'] = "Disetujui";
        $validatedData['dikembalikan'] = "Belum";
        $validatedData['pengambilan_buku'] = "Belum";
        $validatedData['staff_id'] = auth()->user()->staff_id;

        Borrow::where('id', $request->id)->update($validatedData);


        // Notification
        Notification::where('borrow_id', $request->id)->update(['viewed' => true]);
            $message = [
                'user_id'   => $request->user_id,
                'message'   => "Peminjaman No. ".$request->kode_peminjaman." telah disetujui, Silakan cetak Kartu dan ambil Buku di perpustakaan." ,
            ];

        Notification::create($message);

        // Stok Buku
        foreach ($request->book_id as $key => $book) {
            $stock = Stock::where('book_id', $book)->first();

            $stok = 1;
            $stok_keluar    = $stock->stok_keluar + $stok;
            $stok_akhir     = $stock->stok_akhir - $stok;

            $stock->update([
                'stok_akhir'    => $stok_akhir,
                'stok_keluar'   => $stok_keluar
            ]);
        }
        

        toast('Peminjaman telah disetujui!','success');
        return redirect('/transaction/borrows');
    }

    public function reject(Request $request, Borrow $borrow){
        $rules = [
            'id'        => 'required'
        ];

        $validatedData = $request->validate($rules);
        $validatedData['status'] = "Ditolak";
        $validatedData['staff_id'] = auth()->user()->staff_id;

        Borrow::where('id', $request->id)->update($validatedData);

        // Notification
        Notification::where('borrow_id',$request->id)->update(['viewed' => true]);

            if ($request->reason){
                $msg = "Peminjaman dengan Kode. ".$request->kode_peminjaman." telah ditolak karena ".$request->reason;
            }
            else {
                $msg = "Peminjaman dengan Kode. ".$request->kode_peminjaman." telah ditolak";
            }

        $message = [
            'user_id' => $request->user_id,
            'message'   => $msg
        ];

        Notification::create($message);       

        toast('Peminjaman telah ditolak!','success');
        return redirect('/transaction/borrows');
    }

    public function getBook(Request $request, $id)
    {
        $rules = [
            'pengambilan_buku'  => "Sudah"
        ];

        Borrow::where('id', $request->id)->update($rules);

        alert()->success('Buku telah Di ambil!','success');
        return redirect('/transaction/borrows');
    }

    public function DetailPengembalian(Request $request)
    {
        $borrowed   = Borrow::where('id', $request->borrow_id)->get();
        $nama_borrow = Member::where('id', $request->member_id)->value('nama');
        $borrow     = Borrow::where('id', $request->borrow_id)->value('tanggal_tempo');
        $date       = Carbon::parse($borrow);
        $now        = Carbon::now();
        $asu        = Borrow::where('id', $request->borrow_id)->value('tanggal_pinjam');
        $tanggal_pinjam = Carbon::parse($asu)->toFormattedDateString();

        $q = $date->diffInDays($now);
        if ($q > 3) {
            $kali = 500*$q;
            $denda = $kali;
        }

        return view('transaction.borrows.detail',[
            'borrow'    => $borrow,
            'denda'     => $denda,
            'borrowed'  => $borrowed,
            'nama_borrow' => $nama_borrow,
            'selisih'   => $q,
            'now'       => $now,
            'tanggal_tempo'       => $date,
            'tanggal_pinjam'    => $tanggal_pinjam
        ]);

    }

    public function returnBook(Request $request)
    {
        $dt = [
            'dikembalikan'      => "Sudah",
            'staff_kembali'     => auth()->user()->staff_id,
            'tanggal_kembali'   => Carbon::now()->toDateString(),
        ];
        Borrow::where('id', $request->borrow_id)->update($dt);

        $tanggal_tempo  = Borrow::where('id', $request->borrow_id)->value('tanggal_tempo');
        $date   = Carbon::parse($tanggal_tempo);
        $now    = Carbon::now();

        $q = $date->diffInDays($now);
        
        // apakah dia punya denda kits?
        if ($q > 3) {
            $kali = 500*$q;

            Fine::create([
                'borrow_id'     => $request->borrow_id,
                'member_id'     => $request->member_id,
                'waktu_tenggat' => $q,
                'total'         => $kali
            ]);
        }


        alert()->success('Buku Sudah Di Kembalikan!','success');
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