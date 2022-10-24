<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\BookDonation;
use App\Models\Donation;
use App\Models\Book;
use App\Models\Stock;
use App\Models\Member;
use App\Models\CategoryBook;
use Carbon\Carbon;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Database\Console\Migrations\StatusCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonationController extends Controller
{
    public function index(){        

        return view('transaction.book-donations.index',[
            'donationsWaiting'      => Donation::where('status', 'menunggu persetujuan')->get(),
            'donationsGet'          => Donation::where('diambil', 'belum')->get(),
            'donationsMember'       => Donation::where('member_id', auth()->user()->member_id)->latest()->get()
        ]);
    }

    public function create(){

        return view('transaction.book-donations.create',[
            'bookDonations'         => Donation::all(),
            'members'               => Member::all(),
            'categorys'             => CategoryBook::all()
        ]);
    }

    public function store(Request $request)
    {

        $validatedData = [
            'kode_sumbangan'    => date('ymdis'),
            'status'            => "menunggu persetujuan"
        ];
        
        if (auth()->user()->member) 
        {
            $validatedData['member_id'] = auth()->user()->member_id;
        } else 
        {
            $validatedData['member_id'] = $request->member_id;
        }
   
        $donasi = Donation::create($validatedData);

        foreach ($request->isbn as $key => $isbn) {

            $bukuDonasi = [
                'donation_id'   => $donasi->id,
                'isbn'          => $isbn,
                'judul'         => $request->judul[$key],
                'penulis'       => $request->penulis[$key],
                'penerbit'      => $request->penerbit[$key],
                'kategori'      => $request->kategori[$key],
                'tglTerbit'     => $request->tanggal_terbit[$key],
                'tglMasuk'      => $request->tanggal_masuk[$key],
                'stok_masuk'    => $request->kuatitas[$key]
            ];

            if ($request->image[$key] == "NULL") {
            }
            else {
                $bukuDonasi['image'] = $request->image[$key]->store('images');
            }

            BookDonation::create($bukuDonasi);
        }

        toast('Data sumbangan buku telah ditambahkan!','success');
        return redirect('/transaction/book-donations');

    }

    public function edit($id)
    {
    	return view('transaction.book-donations.edit', [
    		'donation'  => Donation::where('id', $id)->first(),
    		'members'	=> Member::all(),
            'categorys'             => CategoryBook::all()
    	]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = [
            'status'    => "menunggu persetujuan"
        ];
        
        if (auth()->user()->member) 
        {
            $validatedData['member_id'] = auth()->user()->member_id;
        } else 
        {
            $validatedData['member_id'] = $request->member_id;
        }
   
        $donasi = Donation::where('id', $id)->update($validatedData);
    	BookDonation::where('donation_id', $id)->delete();

        foreach ($request->isbn as $key => $isbn) {

            $bukuDonasi = [
                'donation_id'   => $id,
                'isbn'          => $isbn,
                'judul'         => $request->judul[$key],
                'penulis'       => $request->penulis[$key],
                'penerbit'      => $request->penerbit[$key],
                'kategori'      => $request->kategori[$key],
                'tglTerbit'     => $request->tanggal_terbit[$key],
                'tglMasuk'      => $request->tanggal_masuk[$key],
                'stok_masuk'   => $request->kuatitas[$key]
            ];
            
            if ($request->image[$key] == "NULL") {
                # code...
            }
            else{

                if ($request->oldImage[$key]){
                    Storage::delete($request->oldImage);
                }
                $bukuDonasi['image'] = $request->image[$key]->store('images');
            }

            BookDonation::create($bukuDonasi);
        }
        
        toast('Data buku telah diedit!','success');
        return redirect('/transaction/book-donations');
    }

    public function setuju($id){
        $bukusumbangan = [
            'staff_approved'    => auth()->user()->staff_id,
            'status'            => "disetujui",
            'diambil'           => "belum"
            
        ];
        Donation::where('id', $id)->update($bukusumbangan);

        toast('Data Sumbangan Buku telah di setujui!','success');
        return redirect('/transaction/book-donations');
    }

    public function tolak($id){

        $sumbangan = [
            'staff_approved'    => auth()->user()->staff_id,
            'status'            => "ditolak"
        ];

        Donation::where('id', $id)->update($sumbangan);

        toast('Data Sumbangan Buku telah di tolak!','success');
        return redirect('/transaction/book-donations');
    }

    public function serahTerima($id){
        $donation       = Donation::where('id', $id)->first();
        $book_donation  = BookDonation::where('donation_id', $donation->id)->get();
        
        foreach ($book_donation as $donasiItem) {
            $book   = Book::where('isbn', $donasiItem->isbn)->first(); 
        
            if ($book) {
                $stoks = Stock::where('book_id', $book->id)->first();
                // Variabel
                $angka          = $donasiItem->stok_masuk;
                $stok_awal      = $stoks->stok_awal + $angka;
                $stok_tambahan  = $stoks->stok_tambahan + $angka;
                $stok_semua     = $stoks->stok_semua + $angka;
                $stok_akhir     = $stoks->stok_akhir + $angka;
                $stok = [
                    'stok_awal'     => $stok_awal,
                    'stok_tambahan' => $stok_tambahan,
                    'stok_akhir'    => $stok_akhir,
                    'stok_semua'    => $stok_semua
                ];

                $stoks->update($stok);
            } 
            else {
                $validatedData = [
                    'isbn'          => $donasiItem->isbn,
                    'judul'         => $donasiItem->judul,
                    'penerbit'      => $donasiItem->penerbit,
                    'penulis'       => $donasiItem->penulis,
                    'kategori'      => $donasiItem->kategori,
                    'tglTerbit'     => $donasiItem->tglTerbit,
                    'tglMasuk'      => $donasiItem->tglMasuk,
                    'image'         => $donasiItem->image
                ];
                
                $buku = Book::create($validatedData);

                $stok = [
                    'book_id'       => $buku->id,
                    'stok_tambahan' => $donasiItem->stok_masuk,
                    'stok_akhir'    => $donasiItem->stok_masuk,
                    'stok_semua'    => $donasiItem->stok_masuk
                ];

                Stock::create($stok);
            }
        }

        $bukudonasi = [
            'diambil'               => "Sudah",
            'tanggal_serah_terima'  => Carbon::now()
        ];

        Donation::where('id', $id)->update($bukudonasi);
        
        toast('Buku sumbangan telah ditambahkan','success');
        return redirect("/transaction/book-donations");
    }

    public function batalkan($id)
    {
        $bukudonasi = [
            'diambil'   => "Dicancel"
        ];

        Donation::where('id', $id)->update($bukudonasi);
        
        alert()->error('Dicancel','Transaksi telah di cancel');
        return redirect("/transaction/book-donations");
    }

    public function hapus($id)
    {
        $bukudonasi = [
            'status'   => "Dicancel"
        ];

        Donation::where('id', $id)->update($bukudonasi);
        
        alert()->error('Dicancel','Transaksi telah di cancel');
        return redirect("/transaction/book-donations");
    }
}