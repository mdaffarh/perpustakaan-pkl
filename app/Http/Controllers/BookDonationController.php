<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookDonation;
use Illuminate\Http\Request;

class BookDonationController extends Controller
{
    public function index()
    {
        return view('transaction.book-donations.index',[
            'books' => Book::all()
        ]);
    }

    public function create()
    {
        return view('transaction.book-donations.index',[
            'books' => Book::all()
        ]);
    }

    public function store(Request $request)
    {
        //isbn,judul,penulis,penerbit,image,kategori,subject
        //slug ??

        $validatedData = $request->validate([
            'isbn'          => 'required|unique:tb_books',
            'judul'         => 'required',
            'penulis'       => 'required',
            'penerbit'      => 'required',
            'kategori'      => 'required',
            'tglTerbit'     => 'required',
            'tglMasuk'      => 'required',
            'image'         => 'image|file|required',
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('images');
        }


        Book::create($validatedData);

        toast('Buku sumbangan telah ditambahkan!','success');
        return redirect('/transaction/book-donations');


    }
}
