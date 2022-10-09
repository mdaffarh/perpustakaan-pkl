<?php

namespace App\Http\Controllers;

use App\Models\Fine;
use App\Models\Stock;
use App\Models\Borrow;
use App\Models\Member;
use App\Models\Returns;
use App\Models\BorrowItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReturnController extends Controller
{
    public function index()
    {

        return view('transaction.returns.index',[
            'returns'   => Returns::where('dikembalikan','Belum')->latest()->get(),
            'members'   => Member::where('status',true)->get(),
            'stocks' => Stock::where('stok_akhir','>',0)->get(),
            'stocksAll' => Stock::all()
        ]);
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
            'status'            => "Selesai",
        ];
        Borrow::where('id', $request->borrow_id)->update($dt);
        $return = Returns::where('borrow_id', request()->borrow_id)->first();
        $return->update([
            'updated_by' => auth()->user()->staff_id,
            'dikembalikan' => 'Sudah',
            'updated_by'     => auth()->user()->staff_id,
            'tanggal_kembali'   => Carbon::now()->toDateString()
        ]);

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
        return redirect('/transaction/returns');
    }
}