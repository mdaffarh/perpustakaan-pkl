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

    public function approved(Request $request){
        $bukusumbangan = [
            'staff_approved' => auth()->user()->staff_id,
            'status' => "disetujui",
            'diambil' => "belum"
            
        ];
        BookDonation::where('id', $request->id)->update($bukusumbangan);

        return redirect('/transaction/book-donations');
    }

    public function reject(Request $request, BookDonation $bookDonation){
        $bukusumbangan = [
            'staff_approved' => auth()->user()->staff_id,
            'status' => "ditolak"
        ];

        BookDonation::where('id', $request->id)->update($bukusumbangan);


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
            'isbn'          => 'required',
            'judul'         => 'required',
            'penulis'       => 'required',
            'penerbit'      => 'required',
            'kategori'      => 'required',
            'tglTerbit'     => 'required',
            'tglMasuk'      => 'required',
            'stock_masuk'    => 'required',
            'image'         => 'image|file'
        ];

        $validatedData = $request->validate($rules);

        if($request->file('image')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('images');
        }

        BookDonation::where('id',$bookDonation->id)->update($validatedData);
        
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

    public function addBook(Request $request){
        $buku_donasion = BookDonation::where('id', $request->id)->first();
        $books = Book::where('isbn', $request->isbn)->first();

        if ($books) {
            $stokz = Stock::where('id', $books->id)->first();
            // Variabel
            $angka  = $buku_donasion->stock_masuk;
            $stok_awal = $stokz->stok_awal + $angka;
            $stok_tambahan = $stokz->stok_tambahan + $angka;
            $stok_semua = $stokz->stok_semua + $angka;
            $stok_akhir = $stokz->stok_akhir + $angka;
            $stok = [
                'stok_awal' => $stok_awal,
                'stok_tambahan' => $stok_tambahan,
                'stok_semua'    => $stok_semua,
                'stok_akhir'    => $stok_akhir
            ];

            $stokz->update($stok);
        } else {
            $validatedData = [
                'isbn'          => $buku_donasion->isbn,
                'judul'         => $buku_donasion->judul,
                'penerbit'      => $buku_donasion->penerbit,
                'penulis'       => $buku_donasion->penulis,
                'kategori'      => $buku_donasion->kategori,
                'tglTerbit'     => $buku_donasion->tglTerbit,
                'tglMasuk'      => $buku_donasion->tglMasuk,
                'image'         => $buku_donasion->image
            ];
            
            $buku = Book::create($validatedData);

            $stok = [
                'book_id'       => $buku->id,
                'stok_tambahan' => $buku_donasion->stock_masuk,
                'stok_semua'    => $buku_donasion->stock_masuk,
                'stok_akhir'    => $buku_donasion->stock_masuk
            ];

            Stock::create($stok);
        }

        $bukudonasi = [
            'diambil'   => "Sudah"
        ];

        BookDonation::where('id', $request->id)->update($bukudonasi);
        
        toast('Buku sumbangan telah ditambahkan','success');
        return redirect("/transaction/book-donations");
    }

    public function cancel(Request $request)
    {
        $bukudonasi = [
            'diambil'   => "Dicancel"
        ];

        BookDonation::where('id', $request->id)->update($bukudonasi);
        
        alert()->error('Dicancel','Transaksi telah di cancel');
        return redirect("/transaction/book-donations");
    }

    public function search(Request $request)
    {
        $data = [];
        if($request->has('q')){
            $search = $request->q;
            $data = Member::where('status', "1")->select("id","nis", "nama", "kelas", "jurusan")->where('nama', 'LIKE', "%$search%")->get();
        }
        return response()->json($data);
    }
}