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
            'borrows'   => Borrow::where('status','!=','Dibatalkan')->latest()->get(),
            

            'borrowedMenungguPersetujuan'   => Borrow::where('member_id', auth()->user()->member_id)->where('status',"Menunggu persetujuan")->latest()->get(),
            'borrowedDisetujui'             => Borrow::where('member_id', auth()->user()->member_id)->where('status',"Disetujui")->where('dikembalikan','Belum')->latest()->get(),
            'borrowedDitolak'               => Borrow::where('member_id', auth()->user()->member_id)->where('status',"Ditolak")->latest()->get(),
            'borrowedSelesai'               => Borrow::where('member_id', auth()->user()->member_id)->where('dikembalikan',"Sudah")->latest()->get(),
            'borrow_count'      => BorrowItem::where('borrow_id', $borrow_su)->count(),

            'members'   => Member::where('status',true)->get(),
            'stocks' => Stock::where('stok_akhir','>',0)->get(),
            'stocksAll' => Stock::all()
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

    // < Method dihalaman admin
    public function directBorrow(Request $request)
    {
        $borrow =  Borrow::create([
            'kode_peminjaman'   => date('dmyis'),
            'member_id'         => $request->member_id,
            'staff_id'          => auth()->user()->staff_id,
            'tanggal_pinjam'    => Carbon::now(),
            'tanggal_tempo'     => Carbon::now()->addDay(3),
            'status'            => "Menunggu persetujuan",
            'pengambilan_buku'  => "belum",
            'dikembalikan'      => "Belum"
        ]);

        foreach ($request->book_id as $key => $book) {

            // Buat di borrow_item
            BorrowItem::create([
                'borrow_id' => $borrow->id,
                'book_id'   => $book
            ]);

            // Ngurangin stock buku
            $stock = Stock::where('book_id', $book)->first();
            $stok_keluar    = $stock->stok_keluar + 1;
            $stok_akhir     = $stock->stok_akhir - 1;
    
            $stock->update([
                'stok_akhir'    => $stok_akhir,
                'stok_keluar'   => $stok_keluar
            ]);
        }

        toast('Peminjaman telah ditambahkan!','success');
        return redirect('/transaction/borrows');
    }

    public function updateBorrow(Request $request)
    {
        // Update anggota kalau digatni
        $borrow = Borrow::where('id',$request->borrow_id )->first();
        $borrow ->update([
            'member_id'         => $request->member_id
        ]);

        // Ambil buku yang dipinjam
        $borrowItem = BorrowItem::where('borrow_id', $request->borrow_id)->get();

        // Nambahin kembali stock buku yang tidak jadi dipinjam
        foreach ($borrowItem as $book) {
            $stock = Stock::where('book_id', $book->book_id)->first();
            $stok_keluar    = $stock->stok_keluar - 1;
            $stok_akhir     = $stock->stok_akhir + 1;
    
            $stock->update([
                'stok_akhir'    => $stok_akhir,
                'stok_keluar'   => $stok_keluar
            ]);
        }

        // Delete buku yang lama
        BorrowItem::where('borrow_id',$request->borrow_id)->delete();

        // Buat buku yang dipinjam dan mengurangi stock
        foreach ($request->book_id as $key => $book) {

            // Buat di borrow_item
            BorrowItem::create([
                'borrow_id' => $borrow->id,
                'book_id'   => $book
            ]);

            // Ngurangin stock buku
            $stock = Stock::where('book_id', $book)->first();
            $stok_keluar    = $stock->stok_keluar + 1;
            $stok_akhir     = $stock->stok_akhir - 1;
    
            $stock->update([
                'stok_akhir'    => $stok_akhir,
                'stok_keluar'   => $stok_keluar
            ]);
        }

        toast('Peminjaman telah diedit!','success');
        return redirect('/transaction/borrows');
    }

    public function deleteBorrow(Request $request)
    {
        // Update status peminjaman
        $borrow = Borrow::where('id',$request->borrow_id )->first();
        $borrow ->update([
            'status'         => "Dibatalkan"
        ]);

        // Ambil buku yang dipinjam
        $borrowItem = BorrowItem::where('borrow_id', $request->borrow_id)->get();

        // Nambahin kembali stock buku yang tidak jadi dipinjam
        foreach ($borrowItem as $book) {
            $stock = Stock::where('book_id', $book->book_id)->first();
            $stok_keluar    = $stock->stok_keluar - 1;
            $stok_akhir     = $stock->stok_akhir + 1;
    
            $stock->update([
                'stok_akhir'    => $stok_akhir,
                'stok_keluar'   => $stok_keluar
            ]);
        }

        // Delete buku yang lama
        BorrowItem::where('borrow_id',$request->borrow_id)->delete();

        toast('Peminjaman telah dibatalkan!','success');
        return redirect('/transaction/borrows');
    }

    
    // Method dihalaman admin >

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tanggal_tempo = date('Y-m-d', strtotime('+3 days', strtotime( $request->tanggal_pinjam )));

        // Buat di trx_borrow
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

            // Buat di borrow_item
            BorrowItem::create([
                'borrow_id' => $borrow->id,
                'book_id'   => $book
            ]);

            // Ngurangin stock buku
            $stock = Stock::where('book_id', $book)->first();
            $stok_keluar    = $stock->stok_keluar + 1;
            $stok_akhir     = $stock->stok_akhir - 1;
    
            $stock->update([
                'stok_akhir'    => $stok_akhir,
                'stok_keluar'   => $stok_keluar
            ]);
        }


        // Notification ke penjaga
        $message = [
            'message'   => "Peminjaman No. ".$borrow->kode_peminjaman." diajukan ",
            'borrow_id' => $borrow->id
        ];
        Notification::create($message);     
        // 

        // Hapus wishlist
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

        Notification::where('borrow_id', $request->id)->update(['viewed' => true]);

        // Notification ke anggota
            $message = [
                'member_id'   => $request->member_id,
                'borrow_id' => $request->id,
                'message'   => "Peminjaman No. ".$request->kode_peminjaman." telah disetujui, Silakan cetak Kartu dan ambil Buku di perpustakaan." ,
            ];

        Notification::create($message);
        // 

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

        Notification::where('borrow_id',$request->id)->update(['viewed' => true]);
        
        // Notification ke anggota
            if ($request->reason){
                $msg = "Peminjaman dengan Kode. ".$request->kode_peminjaman." telah ditolak karena ".$request->reason;
            }
            else {
                $msg = "Peminjaman dengan Kode. ".$request->kode_peminjaman." telah ditolak";
            }

        $message = [
            'borrow_id' => $request->id,
            'member_id' => $request->member_id,
            'message'   => $msg
        ];

        Notification::create($message);  
        //  

        // Pengembalian stock ketika ditolak
        $items = BorrowItem::where('borrow_id',$request->id)->get();

        foreach ($items as $item) {
            $stock = Stock::where('book_id', $item->book_id)->first();

            $stok_keluar    = $stock->stok_keluar - 1;
            $stok_akhir     = $stock->stok_akhir + 1;

            $stock->update([
                'stok_akhir'    => $stok_akhir,
                'stok_keluar'   => $stok_keluar
            ]);
        }

        toast('Peminjaman telah ditolak!','success');
        return redirect('/transaction/borrows');
    }

    public function getBook(Request $request, $id)
    {
        $rules = [
            'pengambilan_buku'  => "Sudah"
        ];

        Borrow::where('id', $request->id)->update($rules);
        Notification::whereNotNull('member_id')->where('borrow_id',request()->id)->update(['viewed' => true]);

        alert()->success('Buku telah Di ambil!','Success');
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

        $q = $date->diffInDays($now,false);
        $denda = 0;
        if ($q > 0) {
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

        $q = $date->diffInDays($now,false);

        // apakah dia punya denda kits?
        if ($q > 0) {
            $kali = 500*$q;

            Fine::create([
                'borrow_id'     => $request->borrow_id,
                'member_id'     => $request->member_id,
                'waktu_tenggat' => $q,
                'total'         => $kali
            ]);  
        }

        // Pengembalian stock
        $items = BorrowItem::where('borrow_id',$request->borrow_id)->get();
        
        foreach ($items as $item) {
            $stock = Stock::where('book_id', $item->book_id)->first();

            $stok = 1;
            $stok_keluar    = $stock->stok_keluar - $stok;
            $stok_akhir     = $stock->stok_akhir + $stok;

            $stock->update([
                'stok_akhir'    => $stok_akhir,
                'stok_keluar'   => $stok_keluar
            ]);
        }


        alert()->success('Buku Sudah Di Kembalikan!','Success');
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