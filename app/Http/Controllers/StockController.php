<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use Alert;
use App\Models\Book;
use App\Models\Stock;

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
            'stocks' => Stock::all(),
            'books' => Book::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Stock::create([
            'book_id'       => $request->book_id,
            'stok_awal'     => $request->stokAwal,
            'stok_akhir'    => $request->stokAwal
        ]);

        toast('Your Post as been submited!','success');
        return redirect('/table/stocks');
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
        $rules = [
            'book_id'       => $request->book_id
        ];

        if ($request->stock_tambahan) {
            $stokAkhir = $id->stok_akhir;
            $jumlah = $request->stock + $stokAkhir;
            $stokAkhir = intval($jumlah);
            $stokAkhir->save();
        }

        Stock::where('id', $id)->update($rules);

        toast('Your Post as been submited!','success');
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