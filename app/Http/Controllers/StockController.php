<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Book;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('table.stock.index', [
            'stocks'    => Stock::all(),
            'books'     => Book::all()
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
    public function update(Request $request, Stock $stock)
    {

        $stokAkhir      = $stock->stok_akhir + $request->stok_tambahan;
        $stokTambahan   = $stock->stok_tambahan  + $request->stok_tambahan;
        $stokSemua      = $stock->stok_awal + $stokTambahan;
        
        $stok = [
            'stok_akhir'     => $stokAkhir,
            'stok_tambahan'  => $stokTambahan,
            'stok_semua'     => $stokSemua
        ];

        $stock->update($stok);

        toast('Stok Buku telah ditambahkan!','success');
        return redirect('/table/stocks');
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
