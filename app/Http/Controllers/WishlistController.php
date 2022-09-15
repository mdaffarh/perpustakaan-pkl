<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Book;
use App\Models\Wishlist;
use Illuminate\Database\Events\TransactionBeginning;
use Illuminate\Support\Facades\Cache;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wishlist_count = Wishlist::where('member_id', auth()->user()->member_id)->count();

        return view('transaction.wishlist.index', [
            'wishlists' => Wishlist::where('member_id', auth()->user()->member_id)->get(),
            'books'     => Book::all(),
            'wishlist_count'    => $wishlist_count
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

        $wishlist = [
            'member_id' => auth()->user()->member_id,
            'book_id'   => $request->book_id
        ];

        Wishlist::create($wishlist);
        toast('Buku telah ditambahkan kedalam wishlist!','success');
        return redirect()->intended('/dashboard');
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
    public function delete($id)
    {
        Wishlist::destroy($id);

        toast('Data draff telah dihapus!','success');
        return redirect('/transaction/wishlist');
    }

    public function checkout(Request $request)
    {
        foreach ($request->id as $key => $dt) {
            $data['id'] = Wishlist::where("id", $dt)->get();
        }

        return redirect('/transaction/wishlist/checkout')->with($data['id']);
    }
}