<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('table.books.index',[
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
        return view('table.books.create',[
            'books' => Book::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            'image'         => 'image|file'
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

        toast('Data buku telah ditambahkan!','success');
        return redirect('/table/books');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('table.books.show',[
            'book' => $book
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('table.books.edit',[
            'book' => $book
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //isbn,judul,penulis,penerbit,image,kategori,subject
        //slug ??
        $rules = [
            'isbn'      => 'required',
            'judul'     => 'required',
            'penulis'   => 'required',
            'penerbit'  => 'required',
            'kategori'  => 'required',
            'tglTerbit' => 'required',
            'tglMasuk'  => 'required',
            'image'     => 'image|file'
        ];

        if($request->isbn != $book->isbn){
            $rules['isbn'] = 'required|unique:tb_books';
        }

        $validatedData = $request->validate($rules);

        if($request->file('image')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('images');
        }

        Book::where('id',$book->id)
            ->update($validatedData);
        
        toast('Data buku telah diedit!','success');
        return redirect('/table/books');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        Book::destroy($book->id);

        //untuk men delete gambar
        if ($book->photobook) {
            Storage::delete($book->photobook);
        }

        Stock::where('book_id', $book->id)->delete();

        toast('Data buku telah dihapus!','success');
        return redirect("/table/books");
    }
    public function status(){
        // jika ada stock buku, maka statusnya avaible
        
    }
}