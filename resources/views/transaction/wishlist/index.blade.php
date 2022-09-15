@extends('layout.main')
@section('title', "Wishlist Buku")

@section('content')
@include('sweetalert::alert')

    <form action="/checkout" method="post">
        @csrf
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="mt-2">@yield('title')</h3>
                                    <p>Total Wishlist : {{ $wishlist_count }}</p>
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right" style="background-color: rgba(255,0,0,0);">
                                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                                        <li class="breadcrumb-item active">@yield('title')</li>
                                    </ol>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                        <div style="text-align: right;">
                            <div id="anjing"></div>
                        </div>
                    </div>
		
                    <div class="card-body">
                        
                        {{-- Tabel --}}
                        <table id="example1" class="table">
                            <tbody>
                                @foreach($wishlists as $key => $wishlist)
                                <tr>
                                    <td style="border :none;">{{ $loop->iteration }}</td>
                                    <td style="border: none;">
                                        <div class="row">
                                            <div class="col-6">
                                                @if ($wishlist->book->image)
                                                    <img src="{{ asset('storage/' . $wishlist->book->image) }}" class="" width="50%">
                                                @else
                                                    <img src="{{ asset("storage/images/book_cover_default.png") }}" class="" width="50%">
                                                @endif
                                            </div>
                                            <div class="col-6">
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td style="border: none;">ISBN</td>
                                                            <td style="border: none;">: {{ $wishlist->book->isbn }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="border: none;">Judul</td>
                                                            <td style="border: none;">: {{ $wishlist->book->judul }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center" style="border: none; font-size:20px;">
                                        <input style="font-size:20px;" name='id[]' type="checkbox" id="checkItem" value="<?php echo $wishlists[$key]->id; ?>">
                                    </td>
                                    <td  style="border: none;">
                                        <a href="/transaction/wishlist/destroy/{{ $wishlist->id }}" style="font-size :12px;" class="btn btn-danger" onclick="return confirm('sure?')">Hapus dari draff</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>
	<script>

    $('input[type=checkbox]').on('change', function(evt) {
        if($('input[id=checkItem]:checked').length >= 4) {
            this.checked = false;
            alert('Hanya boleh memilih maksimal 3 kategori !');
        }
        var n = $('input[id=checkItem]:checked').length;
        $("#anjing").html("<button type='submit' class='btn btn-outline-success'>Pinjam " + n + " Buku</button>");
    });


	</script>
@endsection