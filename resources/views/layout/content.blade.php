
@extends('layout.main')
@section('title', "Dashboard")
    
@section('content')
@include('sweetalert::alert')
@can('member')
    <style>
        .card-img-top {
            height: 50%;
        }

        .card-title .judul{
            color: black;
            text-decoration:none;
            margin-top: 0em;
            text-align: center;
            display:inline-block; /* important */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .card-title, .judul{
            -webkit-transition: 3.3s;
            -moz-transition: 3.3s;
            transition: 3.3s;     
            
            -webkit-transition-timing-function: linear;
            -moz-transition-timing-function: linear;
            transition-timing-function: linear;
        }

        .card-title{
            height: 64px;
            font: normal normal 700 1em/4em Arial,sans-serif;
            color: black;
            overflow: hidden;
            width: 100%;
        }

        .card-title:hover{
        }

        .card-title .judul:hover{
            text-decoration: none;
        }

        .judul{
            margin-left: 0em;
        }

        .card-title:hover .judul{
            margin-left: -300px;
        }

        td {
            text-align: left;
        }
    </style>

    <main>
        <div>
            <div><h2>Rak Buku</h2></div>
            <div style="text-align: right;">Kategori :
                <select name="" id="">
                    <option value="">Komik</option>
                </select>
            </div>
        </div>
        <div class="card-deck row">
            @foreach($books1 as $book)
            <div class="col-2" style="padding-top: 20px;">
                <div class="card card-secondary" style="height: 300px;">
                    @if ($book->image)
                    <img src="{{ asset('storage/' . $book->image) }}" class="card-img-top">
                    @else
                    <img src="{{ asset("storage/images/book_cover_default.png") }}" class="card-img-top">
                    @endif
                    <div class="card-body">
                        <div class="card-title">
                            <div class="judul">{{ $book->judul }}</div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <a href="#show{{ $book->id }}" class="btn btn-sm btn-link btn-icon-right" data-toggle="modal">
                            <span>LEARN MORE</span>
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="show{{ $book->id }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Detail Buku <strong>{{ $book->judul }}</strong></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <span>
                                                    @if ($book->image)
                                                <img src="{{ asset('storage/' . $book->image) }}" width="100%">
                                                    @else
                                                <img src="{{ asset("storage/images/book_cover_default.png") }}" width="100%">
                                                    @endif
                                            </span>
                                        </div>
                                        <div class="col-6">
                                            <div class="table-responsive">
                                                <table class="table align-middle">
                                                    <thead>
                                                        <tr></tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>ISBN</td>
                                                            <td>{{ $book->isbn }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Judul Buku</td>
                                                            <td>{{ $book->judul }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Penulis</td>
                                                            <td>{{ $book->penulis }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Penerbit</td>
                                                            <td>{{ $book->penerbit }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tanggal Terbit</td>
                                                            <td>{{ $book->tglTerbit }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Kategori</td>
                                                            <td>{{ $book->kategori }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>deskripsi</td>
                                                            <td>{{ $book->deskripsi }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="" style="font-weight: bolder;font-size: 14px;">Tanggal Masuk : {{ $book->tglMasuk }}</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <form action="/transaction/wishlist" method="POST">
                                    @csrf
                                        <input type="text" name="book_id" value="{{ $book->id }}" style="display: none;">
                                        <button type="submit" class="btn btn-primary">Wishlist</button>
                                    </form>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal -->

                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </main>

@endcan

@can('admin')
    <div class="row">

                      <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                  <h3>{{ $books }}</h3>
                    <p>Buku</p>
                </div>
                <div class="icon">
                                                  <i class="ion ion-ios-bookmarks"></i>
                </div>
                                              <a href="/table/books" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                          </div>
        </div>

                      <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $members }}</h3>
                    <p>Anggota</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person"></i>
                </div>
                <a href="/table/members" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

                      <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $staffs }}</h3>
                    <p>Staff</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person"></i>
                </div>
                <a href="/table/staffs" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $registrations }}</h3>
                    <p>Registrations</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        
    </div>

@endcan
@endsection
