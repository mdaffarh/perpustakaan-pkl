@extends('layout.main')
@section('title', "Dashboard")

@section('content')
    @include('sweetalert::alert')
    {{-- Statistik --}}
    <div class="row">
      <!-- ./col -->
        @can('member')
          {{-- Stok Buku --}}
          <div class="col-lg-3 col-md-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $stock }}</h3>
      
                <p>Judul Buku Tersedia</p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
              <a href="/transaction/borrows" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <!-- small box -->
            <div class="small-box bg-gradient-danger">
              <div class="inner">
                <h3>{{ $donation }}</h3>
      
                <p>Buku Telah Kamu Sumbangkan</p>
              </div>
              <div class="icon">
                <i class="fas fa-hands-helping"></i>
              </div>
              <a href="/transaction/book-donations" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          {{-- Peminjaman Anggota --}}
          <div class="col-lg-3 col-md-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $borrowReq }}</h3>
      
                <p>Peminjaman Diajukan</p>
              </div>
              <div class="icon">
                <i class="fas fa-book-open"></i>
              </div>
              <a href="/transaction/borrows" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $borrowed }}</h3>
      
                <p>Peminjaman Berjalan</p>
              </div>
              <div class="icon">
                <i class="fas fa-book-reader"></i>
              </div>
              <a href="/transaction/borrows" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        @endcan

        @can('staff')
          {{-- Total semua buku --}}
          <div class="col-lg-3 col-md-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $books }}</h3>
      
                <p>Judul Buku</p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
              <a href="/table/books" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

           <!-- ./col -->
           <div class="col-lg-3 col-md-6">
            <!-- small box -->
            <div class="small-box bg-gradient-red">
              <div class="inner">
                <h3>{{ $members }}</h3>
      
                <p>Jumlah Anggota</p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <a href="/table/members" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $borrowRequest }}</h3>
      
                <p>Permintaan Peminjaman</p>
              </div>
              <div class="icon">
                <i class="fas fa-book-reader"></i>
              </div>
              <a href="/transaction/borrows" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
         
          <!-- ./col -->
          <div class="col-lg-3 col-md-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $memberRegist }}</h3>
      
                <p>Pendaftar Anggota</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="/transaction/member-registrations/index" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        @endcan
    </div>
    {{-- Statistik end --}}

    {{-- Buku --}}
    <div class="row m-2">
      @can('member')
            @section('style')
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
            @endsection
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
                  <div class="col-md-3" style="padding-top: 20px;">
                      <div class="card card-secondary">
                          <div class="card-body">
                              @if ($book->image)
                                <img src="{{ asset('storage/' . $book->image) }}" class="card-img-top img-fluid img-cover">
                              @else
                                <img src="{{ asset("storage/images/book_cover_default.png") }}" class="card-img-top img-fluid img-cover">
                              @endif
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
                                                                  <td>Deskripsi</td>
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
      @endcan
    </div>
    {{-- Buku end --}}

@endsection