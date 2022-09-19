<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Stock;
use App\Models\Member;
use App\Models\BookDonation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookDonationController extends Controller
{
    public function index(){
        return view('transaction.book-donations.index',[
            'bookDonations' => BookDonation::all(),
            'members' => Member::all(),
            'bookDonated'   => BookDonation::where('member_id',auth()->user()->member_id)->get()
        ]);
    }

    public function create(){
        return view('transaction.book-donations.create',[
            'bookDonations' => BookDonation::all()
        ]);
    }

    public function store(Request $request)
    {
    
        $validatedData = $request->validate([
            'member_id'     => 'required',
            'isbn'          => 'required',
            'judul'         => 'required',
            'penulis'       => 'required',
            'penerbit'      => 'required',
            'kategori'      => 'required',
            'jumlah'        => 'required',
            'tglTerbit'     => 'required',
            'tglMasuk'      => 'required',
            'image'         => 'image|file',
        ]);
        
        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('images');
        }

        $book = Book::where('isbn',$request->isbn)->first();
        if($book){
            $stock = Stock::where('book_id',$book['id'])->first();
            Stock::where('book_id',$book['id'])->update([
                'stok_akhir' => $stock['stok_akhir']+= $request->jumlah,
                'stok_semua' => $stock['stok_semua']+= $request->jumlah
            ]);
        }else{
            $book = Book::create($validatedData);
            Stock::create([
                'book_id'    => $book->id,
                'stok_akhir' => $request->jumlah,
                'stok_semua' => $request->jumlah
            ]);
        }

        BookDonation::create($validatedData);

        toast('Sumbangan buku telah ditambahkan!','success');
        return redirect('/transaction/book-donations');


    }
    public function show(BookDonation $bookDonation)
    {
        return view('transaction.book-donations.show',[
            'bookDonation' => $bookDonation
        ]);
    }

    public function edit(BookDonation $bookDonation)
    {
        return view('transaction.book-donations.edit',[
            'bookdonation' => $bookDonation
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookDonation $bookDonation)
    {
        //isbn,judul,penulis,penerbit,image,kategori,subject
        //slug ??
        $rules = [
            'isbn'          => 'required',
            'judul'         => 'required',
            'penulis'       => 'required',//
            'penerbit'      => 'required',//
            'image'         => 'image|file',
            'kategori'      => 'required',
            'stock_awal'    => 'required',
            'keterangan'    => 'required',
            'tglTerbit'     => 'required',
            'tglMasuk'      => 'required'
        ];

        if($request->isbn != $bookDonation->isbn){
            $rules['isbn'] = 'required|unique:trx_book-donations';
        }

        $validatedData = $request->validate($rules);

        if($request->file('image')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('images');
        }

        BookDonation::where('id',$bookDonation->id)
            ->update($validatedData);
        
        toast('Data buku telah diedit!','success');
        return redirect('/transaction/book-donations');
    }

    public function destroy(BookDonation $bookDonation)
    {
        BookDonation::destroy($bookDonation->id);

        //untuk men delete gambar
        if ($bookDonation->photobook) {
            Storage::delete($bookDonation->photobook);
        }

        toast('Data sumbangan buku telah dihapus!','success');
        return redirect("/transaction/book-donations");
    }
}