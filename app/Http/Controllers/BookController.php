<?php

namespace App\Http\Controllers;

use App\Models\Book;
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
        return view('books.index',[
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
        return view('dashboard.books.create',[
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
            'isbn'          => 'required',
            'judul'         => 'required',
            'penulis'       => 'required',
            'penerbit'      => 'required',
            'kategori'      => 'required',
            'tglTerbit'     => 'required',
            'tglMasuk'      => 'required',
            'image'         => 'image|file',
            'tglTerbit'     => 'required'
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('images');
        }


        $this->book->save($request, $id);

        return redirect('/books')->with('success','Data Buku telah ditambahkan!');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('dashboard.books.show',[
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
        return view('dashboard.books.edit',[
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
            'isbn' => 'required|unique:tb_books',
            'judul' => 'required',
            'penulis' => 'required',//
            'penerbit' => 'required',//
            'image' => 'image|file',
            'kategori' => 'required'

        ];

        $validatedData = $request->validate($rules);

        if($request->files('image')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('images');
        }
        
        Book::where('id',$book->id)->update($validatedData);
        
        return redirect('/books')->with('success','Data Buku telah diedit!');
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
        if ($book->image) {
            Storage::delete($book->image);
        }

        return redirect("/books")->with('success', "book data has been deleted");
    }
}