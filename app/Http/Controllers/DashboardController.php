<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookDonation;
use App\Models\Staff;
use App\Models\Stock;
use App\Models\Borrow;
use App\Models\Member;
use App\Models\Major;
use App\Models\Donation;
use Illuminate\Http\Request;
use App\Models\StaffRegistration;
use App\Models\MemberRegistration;
use App\Models\BorrowItem;
use Carbon\Carbon;
use Termwind\Components\Raw;
use DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $random1        = Stock::inRandomOrder()->where('stok_akhir','>','0')->get();
        $borrow_su      = Borrow::where('member_id', auth()->user()->member_id)->value('id');

        if ($request->filterTahun) {
            $tahun = $request->filterTahun;
        } else {
            $tahun = date('Y');
        }
        

        // chart peminjaman perbulan
        $data           = Borrow::select('id', 'tanggal_pinjam')->whereYear('tanggal_pinjam', $tahun)->orderBy('tanggal_pinjam', 'asc')->get()->groupBy(function($data)
        {
            return Carbon::parse($data->tanggal_pinjam)->format('M');
        });
        
        $months = [];
        $monthsCount = [];

        foreach ($data as $month => $values) {
            $months[]       = $month;
            $monthsCount[]  = count($values);
        }
        
        //chart Buku by kategori
        $kategoris = Book::select(DB::raw('kategori, count(id) as total'))->groupby('kategori')->get();
    
        $kategoriName   = [];
        $kategoriCount  = [];

        foreach ($kategoris as $kat) {
            $kategoriName[]     = $kat->kategori;
            $kategoriCount[]    = $kat->total ;
        }
            
        // chart peminjaman by kelas
        $kelas  = Borrow::join('tb_members', 'tb_members.id', '=', 'trx_borrows.member_id')->whereYear('tanggal_pinjam', $tahun)->select(DB::raw('kelas, count(kelas) as total'))->groupby('kelas')->get();
        $className = [10,11,12,13];
        $borrowCount = [0,0,0,0];
        
        foreach ($kelas as $class) {
            if ($class->kelas == 10) {
                $key = 0;
            }elseif($class->kelas == 11){
                $key = 1;
            }elseif($class->kelas == 12){
                $key = 2;
            }else{
                $key = 3;
            }
            $borrowCount[$key]    = $class->total ;
        }

        return view('dashboard.index',[

            // Tampilan Anggota
            'stockBooks'    => $random1,

            'stock'         => Stock::where('stok_akhir' ,'>', 0 )->count(),
            'borrowed'      => Borrow::where('member_id', auth()->user()->member_id)->where('status','Disetujui')->count(),
            'borrowReq'     => Borrow::where('member_id', auth()->user()->member_id)->where('status','Menunggu persetujuan')->count(),
            'donation'      => Donation::where('member_id',auth()->user()->member_id)->count(),
            'borrowes'      => Borrow::where('member_id', auth()->user()->member_id)->where('status','!=','Ditolak')->where('status','!=','Selesai')->count(),
            'borrow'        => Borrow::where('member_id', auth()->user()->member_id)->where('status','!=','Ditolak')->where('status','!=','Selesai')->latest()->get(),
            'borrow_count'  => BorrowItem::where('borrow_id', $borrow_su)->where('finished','!=',2)->count(),

            // Tampilan Staff
            'books'             => Book::whereYear('created_at', $tahun)->count(),
            'members'           => Member::whereYear('created_at', $tahun)->count(),
            'borrowRequest'     => Borrow::whereYear('created_at', $tahun)->where('status','Menunggu persetujuan')->count(),
            'memberall'         => Member::whereYear('created_at', $tahun)->count(),
            'borrows'           => Borrow::whereYear('tanggal_pinjam', $tahun)->where('status', 'Menunggu persetujuan')->latest()->get(),
            'member'            => Member::all(),
            'stocksAll'         => Stock::all(),
            'topRankBook'       => BorrowItem::whereYear('created_at', $tahun)->select(DB::raw('book_id, count(book_id) as count'))->groupby('book_id')->orderBy('count', 'desc')->get(),
            'memberse'          => Member::all(),
            'majors'            => Major::all(),
            'years'             => range(2000, strftime("%Y", time())),
            'tahun'             => $tahun,

            //chart peminjaman
            'data'      => $data,
            'months'     => $months,
            'monthsCount'=> $monthsCount,

            //chart Buku by kategori
            'kategoriName'  => $kategoriName,
            'kategoriCount' => $kategoriCount,

            //chart by kelas
            'kelas'         => $kelas,
            'className' => $className,
            'borrowCount' => $borrowCount
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