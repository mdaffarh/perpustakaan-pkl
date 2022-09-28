<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\BookDonation;
use App\Models\Book;
use App\Models\Stock;
use App\Models\Member;
use Illuminate\Database\Console\Migrations\StatusCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookDonationController extends Controller
{
    public function index(){
        return view('transaction.book-donations.index',[
            'bookDonations'         => BookDonation::where('member_id', auth()->user()->member_id)->get(),
            'bookDonationsWaiting'  => BookDonation::where('status', "menunggu persetujuan")->get(),
            'bookDonationsGet'      => BookDonation::where('diambil', "belum")->get(),
            'anggota'               => Member::all()
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
            'isbn'          => 'required',
            'judul'         => 'required',
            'penulis'       => 'required',
            'penerbit'      => 'required',
            'kategori'      => 'required',
            'tglTerbit'     => 'required',
            'tglMasuk'      => 'required',
            'stock_masuk'    => 'required',
            'image'         => 'image|file'
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('images');
        }

        $validatedData['member_id'] = auth()->user()->member_id;
        $validatedData['status'] = "menunggu persetujuan";
   
        $bookDonations = BookDonation::create($validatedData);

        if (auth()->user()->member) {
            $message = [
                'message'           => auth()->user()->member->nama." Mengajukan Penyumbangan buku ",
                'bookDonation_id'   => $bookDonations->id
            ];

            Notification::create($message);
        }
            

        toast('Data sumbangan buku telah ditambahkan!','success');
        return redirect('/transaction/book-donations');


    }
    public function approved(Request $request){
        $bukusumbangan = [
            'staff_approved' => auth()->user()->staff_id,
            'status' => "disetujui",
            'diambil' => "belum"
            
        ];
        BookDonation::where('id', $request->id)->update($bukusumbangan);

        // Notification
        Notification::where('bookDonation_id', $request->id)->update(['viewed' => true]);
            $message = [
                'staff_approved'   => auth()->user()->staff_id,
                'message'   => "Sumbangan Buku telah disetujui, Terimakasih atas Donasi anda" ,
            ];

        Notification::create($message);

        return redirect('/transaction/book-donations');
    }

    public function status(Request $request, BookDonation $bookDonation){
        $bukusumbangan = [
            'diambil' => "sudah",
            'staffygngambil' => auth()->user()->staff_id
        ];
        $buku = [
            'isbn'          => 'required',
            'judul'         => 'required',
            'penulis'       => 'required',
            'penerbit'      => 'required',
            'stock_awal'    => 'required'
        ];
        $validatedData = $request->validate($bukusumbangan);
        $validatedDataBook = $request->validate($buku);

        $validatedData['created_by'] = auth()->user()->staff_id;

        BookDonation::where('id', $request->id)->update($bukusumbangan);
        Book::create($validatedDataBook);
        
        toast('Buku sumbangan ditambahkan !','success');
        return redirect('/table/books/create');
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
            'isbn'          => 'required|unique:tb_books',
            'judul'         => 'required',
            'penulis'       => 'required',
            'penerbit'      => 'required',
            'kategori'      => 'required',
            'tglTerbit'     => 'required',
            'tglMasuk'      => 'required',
            'stock_awal'    => 'required',
            'image'         => 'image|file'
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

    public function creates(){
        return view('transaction.book-donations.create',[
            'bookdonations' => BookDonation::all()
        ]);
    }

    public function stores(Request $request){
        $validatedData = $request->validate([
            'isbn' => 'required|unique:tb_books',
            'judul' => 'required',
            'penerbit' => 'required',
            'kategori' => 'required',
            'tglTerbit' => 'required',
            'tglMasuk' => 'required',
            'stock_awal' => 'required',
            'image' => 'image|file'
            
        ]);
        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('images');
        }
        $buku = Book::create($validatedData);
        $stok = [
            'book_id'       => $buku->id,
            'stok_awal'     => $request->stok_awal,
            'stok_semua'    => $request->stok_awal,
            'stok_akhir'    => $request->stok_awal
        ];

        Stock::create($stok);
        // BookDonation::where('id', $request->id)->get($bookDonation);

        toast('Buku sumbangan telah ditambahkan','success');
        return redirect('/table/books');
    }
}