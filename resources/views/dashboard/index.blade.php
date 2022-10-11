@extends('layout.main')
@section('title', "Dashboard")

@section('content')
    @include('sweetalert::alert')
        {{-- Statistik --}}
            <div class="row">
                <!-- ./col -->
                @can('member')
                    {{-- Stok Buku --}}
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $stock }}</h3>
                                <p>Judul Buku Tersedia</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-book"></i>
                            </div>
                            <a href="/transaction/wishlist" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
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
                    <div class="col-lg-3 col-6">
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
                    <div class="col-lg-3 col-6">
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
                    <div class="col-lg-3 col-6" class="nav-link active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home"role="tab" aria-controls="nav-home" aria-selected="true">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>3</h3>
                                <p>Chart Statika</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-chart-line"></i>
                            </div>
                            <a href="/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6 nav-link" id="nav-borrow-tab" data-toggle="tab" data-target="#nav-borrow" role="tab" aria-controls="nav-borrow" aria-selected="false">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $borrowRequest }}</h3>
                    
                                <p>Permintaan Peminjaman</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-book-reader"></i>
                            </div>
                            <a href="/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <!-- ./col -->
                    <div class="col-lg-3 col-6 nav-link" id="nav-topRankBook-tab" data-toggle="tab" data-target="#nav-topRankBook" role="tab" aria-controls="nav-topRankBook" aria-selected="false">
                        <!-- small box -->
                        <div class="small-box bg-gradient-red">
                            <div class="inner">
                                <h3>{{ $books }}</h3>
                                <p>Top Rank Book</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <a href="/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    
                    <!-- ./col -->
                    <div class="col-lg-3 col-6 nav-link" id="nav-member-tab" data-toggle="tab" data-target="#nav-member" role="tab" aria-controls="nav-member" aria-selected="false">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $memberall }}</h3>
                    
                                <p>Semua Anggota</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                
                <main>
                    <div>
                        <div style="text-align: center;"><h2 class="font-weight-bold" style="font-size: 25px;">Rak Buku</h2></div>
                    </div>
                    <div class="offset-8">
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Kategori</span>
                            </div>
                            <select class="form-control" id="">
                                <option value="">Novel</option>
                                <option value="">Komik</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="">
                        <div class="card-deck row">  
                                @if($borrowes != 0)
                                    <div style="padding-top: 20px;" class="col-lg-6">
                                        <div style="max-height:300px; overflow-y: scroll;" class="card">
                                            <div class="card-header"><strong>Status Peminjaman</strong></div>
                                                <div class="card-body">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Kode</th>
                                                                <th>Nama Peminjam</th>
                                                                <th>Status</th>
                                                                <th>Info</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($borrow as $b)
                                                            @if($b->status !="Ditolak")
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $b->kode_peminjaman }}</td>
                                                                <td>{{ $b->member->nama }}</td>
                                                                <td>
                                                                    @if($b->status == "Menunggu persetujuan")
                                                                        <div class="badge badge-primary">{{ $b->status }}</div>
                                                                    @elseif($b->status == "Disetujui")
                                                                        <div class="badge badge-warning">{{ $b->status }}</div>
                                                                      
                                                                    @elseif($b->status == "Dalam peminjaman")
                                                                        @if(Carbon\Carbon::parse( $b->tanggal_tempo)->diffInDays(Carbon\Carbon::now(),false) > 0)
                                                                            <div class="badge badge-danger">Telat ({{ Carbon\Carbon::parse( $b->tanggal_tempo)->diffInDays(Carbon\Carbon::now(),false) }} Hari)</div>
                                                                        @else
                                                                            <div class="badge badge-info">{{ $b->status }}</div>
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if($b->status == "Menunggu persetujuan" || "Dalam peminjaman")
                                                                        <button style="background: transparent;border:none;" data-toggle="modal" data-target="#menunggu{{ $b->id }}">
                                                                            <i class="fas fa-info-circle"></i>
                                                                        </button>
                                                                    @elseif($b->status == "Disetujui")
                                                                        <button style="background: transparent;border:none;" data-toggle="modal" data-target="#disetujui{{ $b->id }}">
                                                                            <i class="fas fa-info-circle"></i>
                                                                        </button>        
                                                                    @endif

                                                                    <!-- Modal -->
                                                                    <div class="modal fade" id="menunggu{{ $b->id }}">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header" style="border: none;">
                                                                                    <h5 class="modal-title mt-3 px-4">Kode Peminjaman <p class="font-weight-bolder">{{ $b->kode_peminjaman }}</p></h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="row mx-md-n3">
                                                                                        <div class="col px-md-5"><div class="p-2">NIS</div></div>
                                                                                        <div class="col px-md-5"><div class="p-2">: {{ $b->member->nis }}</div></div>
                                                                                    </div>
                                                                                    <div class="row mx-md-n3">
                                                                                        <div class="col px-md-5"><div class="p-2">Nama</div></div>
                                                                                        <div class="col px-md-5"><div class="p-2">: {{ $b->member->nama }}</div></div>
                                                                                    </div>
                                                                                    <div class="row mx-md-n3">
                                                                                        <div class="col px-md-5"><div class="p-2">Kelas / Jurusan</div></div>
                                                                                        <div class="col px-md-5"><div class="p-2">: {{ $b->member->kelas }} {{ $b->member->jurusan }}</div></div>
                                                                                    </div>
                                                                                    <div class="row mx-md-n3">
                                                                                        <div class="col px-md-5"><div class="p-2">Tanggal Pinjam</div></div>
                                                                                        <div class="col px-md-5"><div class="p-2">: {{ $b->tanggal_pinjam }}</div></div>
                                                                                    </div>
                                                                                    <div class="row mx-md-n3">
                                                                                        <div class="col px-md-5"><div class="p-2">Tanggal Kembali</div></div>
                                                                                        <div class="col px-md-5"><div class="p-2">: {{ $b->tanggal_tempo }}</div></div>
                                                                                    </div>
                                                                                  
                                                                                    @if(Carbon\Carbon::parse( $b->tanggal_tempo)->diffInDays(Carbon\Carbon::now(),false) > 0)
                                                                                        <div class="row mx-md-n3">
                                                                                            <div class="col px-md-5"><div class="p-2">Status</div></div>
                                                                                            <div class="col px-md-5"><div class="p-2">: Telat ({{ Carbon\Carbon::parse( $b->tanggal_tempo)->diffInDays(Carbon\Carbon::now(),false) }} Hari)</div></div>
                                                                                        </div>
                                                                                        <div class="row mx-md-n3">
                                                                                            <div class="col px-md-5"><div class="p-2">Denda</div></div>
                                                                                            <div class="col px-md-5"><div class="p-2">: {{ Carbon\Carbon::parse( $b->tanggal_tempo)->diffInDays(Carbon\Carbon::now(),false) * 500 }}</div></div>
                                                                                        </div>
                                                                                    @else
                                                                                        <div class="row mx-md-n3">
                                                                                            <div class="col px-md-5"><div class="p-2">Status</div></div>
                                                                                            <div class="col px-md-5"><div class="p-2">: {{ $b->status }}</div></div>
                                                                                        </div>
                                                                                    @endif
                                                                                            <hr>
                                                                                    <p class="px-4"><strong>Buku Yang Dipinjam :</strong></p>
                                                                                    <ol>
                                                                                        @foreach($b->borrowItem as $bi)
                                                                                        <li>
                                                                                            <div class="row mx-md-n3">
                                                                                                <div class="col px-md-5"><div class="p-2">{{ $bi->book->judul }}</div></div>
                                                                                                <div class="col px-md-5"><div class="p-2">1</div></div>
                                                                                                @if ($b->status == "Menunggu persetujuan")
                                                                                                    <div class="col px-md-5"><div class="p-2">( Stok : {{ $bi->book->stock->stok_akhir + 1 }} )</div></div>    
                                                                                                @endif

                                                                                            </div>
                                                                                        </li>
                                                                                        @endforeach
                                                                                    </ol>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    <!-- Modal -->
                                                                    <div class="modal fade" id="disetujui{{ $b->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header" style="border: none;">
                                                                                    <div class="media flex-sm-row flex-column-reverse justify-content-between  ">
                                                                                        <div class="col my-auto">
                                                                                            <h4 class="mb-0">Kartu Pinjaman Buku,
                                                                                                <span class="change-color" style="color: blue;">{{ auth()->user()->member->nama }}</span> !
                                                                                            </h4> 
                                                                                        </div>
                                                                                    </div>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="row justify-content-between mb-3">
                                                                                        <div class="col-auto"> <h6 class="color-1 mb-0 change-color"></h6> </div>
                                                                                        <div class="col-auto font-weight-bolder">No Peminjaman : {{ $b->kode_peminjaman }}</div>
                                                                                    </div>
                                                                                    @foreach($b->borrowItem as $borrowItem)
                                                                                    <div class="row py-3">
                                                                                        <div class="col">
                                                                                            <div class="card card-2">
                                                                                                <div class="card-body">
                                                                                                    <div class="media">
                                                                                                        <div class="align-self-center">
                                                                                                            @if ($borrowItem->book->image)
                                                                                                                <img src="{{ asset('storage/' . $borrowItem->book->image) }}" class="img-fluid  my-auto align-self-center mr-2 mr-md-4 pl-0 p-0 m-0" width="135" height="135">
                                                                                                            @else
                                                                                                                <img src="{{ asset("assets/img/book_cover_default.png") }}" class="img-fluid  my-auto align-self-center mr-2 mr-md-4 pl-0 p-0 m-0" width="135" height="135">
                                                                                                            @endif
                                                                                                        </div>
                                                                                                        <div class="media-body my-auto text-right">
                                                                                                            <div class="row  my-auto flex-column flex-md-row">
                                                                                                                <div class="col my-auto" style="text-align: left;"> <h6 class="mb-0">{{ $borrowItem->book->judul }}</h6>  </div>
                                                                                                                <div class="col-auto my-auto"> <small>Penulis : {{ $borrowItem->book->penulis }}</small></div>
                                                                                                                <div class="col my-auto"> <small>Qty : 1</small></div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    @endforeach
                                                                                    <div class="row mt-4">
                                                                                        <div class="col">
                                                                                            <div class="row justify-content-between">
                                                                                                <div class="col-auto"><h6 class="mb-1 text-dark"><b>Borrowed Details</b></h6></div>
                                                                                                <div class="flex-sm-col text-right col"> <h6 class="mb-1"><b>{{ $borrow_count }} Buku akan di pinjam</b></h6> </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <hr>
                                                                                    <div class="">
                                                                                        <div class="d-flex justify-content-end">
                                                                                            <div class="mr-auto  p-2">NIS</div>
                                                                                            <div class="p-2">{{ $b->member->nis }}</div>
                                                                                        </div>
                                                                                        <div class="d-flex justify-content-end">
                                                                                            <div class="mr-auto  p-2">Nama</div>
                                                                                            <div class=" p-2">{{ $b->member->nama }}</div>
                                                                                        </div>
                                                                                        <div class="d-flex justify-content-end">
                                                                                            <div class="mr-auto  p-2">Kelas</div>
                                                                                            <div class=" p-2">{{ $b->member->kelas }}</div>
                                                                                        </div>
                                                                                        <div class="d-flex justify-content-end">
                                                                                            <div class="mr-auto  p-2">Jurusan</small></div>
                                                                                            <div class=" p-2">{{ $b->member->jurusan }}</div>
                                                                                        </div>
                                                                                        <div class="d-flex justify-content-end">
                                                                                            <div class="mr-auto  p-2">Tanggal Pinjam</div>
                                                                                            <div class=" p-2">{{ $b->tanggal_pinjam }}</div>
                                                                                        </div>
                                                                                        <div class="d-flex justify-content-end">
                                                                                            <div class="mr-auto  p-2">Tanggal Kembali</div>
                                                                                            <div class=" p-2">{{ $b->tanggal_tempo }}</div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer justify-content-between">
                                                                                    <div class="offset-5 py-3">
                                                                                        <span><small>*Cetak Kartu untuk mengambil buku di perpustakaan</small></span>
                                                                                        <br>
                                                                                        <span><small>*Pastikan anda mengambil buku dan mengembalikannya di waktu yang tepat</small></span>
                                                                                    </div>
                                                                                    <div>
                                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                        <button class="btn btn-success">Cetak</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            @endif
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                
                                @foreach($stockBooks as $stock)
                                    <div class="col-6 col-md-3" style="padding-top: 20px;">
                                        <div class="card card-secondary">
                                            <div class="card-body px-2 pt-3 pb-0">
                                                @if ($stock->book->image)
                                                    <img src="{{ asset('storage/' . $stock->book->image) }}" class="card-img-top img-fluid">
                                                @else
                                                <img src="{{ asset("assets/img/book_cover_default.png") }}" class="card-img-top img-fluid">
                                                @endif
                                                <div class="card-title">
                                                    <div class="judul">{{ $stock->book->judul }}</div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-right px-0 py-1 ">
                                                <a href="#show{{ $stock->book->id }}" class="btn btn-sm btn-link btn-icon-right" data-toggle="modal">
                                                    <span>LEARN MORE</span>
                                                </a>

                                                <!-- Modal -->
                                                <div class="modal fade" id="show{{ $stock->book->id }}">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Detail Buku <strong>{{ $stock->book->judul }}</strong></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <span>
                                                                            @if ($stock->book->image)
                                                                        <img src="{{ asset('storage/' . $stock->image) }}" width="100%">
                                                                            @else
                                                                        <img src="{{ asset("assets/img/book_cover_default.png") }}" width="100%">
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
                                                                                    <td>{{ $stock->book->isbn }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Judul Buku</td>
                                                                                    <td>{{ $stock->book->judul }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Penulis</td>
                                                                                    <td>{{ $stock->book->penulis }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Penerbit</td>
                                                                                    <td>{{ $stock->book->penerbit }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Tanggal Terbit</td>
                                                                                    <td>{{ $stock->book->tglTerbit }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Kategori</td>
                                                                                    <td>{{ $stock->book->kategori }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Status</td>
                                                                                    <td>{{ $stock->book->status }}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>Deskripsi</td>
                                                                                    <td>{{ $stock->book->deskripsi }}</td>
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
                                                            <div class="" style="font-weight: bolder;font-size: 14px;">Tanggal Masuk : {{ $stock->book->tglMasuk }}</div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <form action="/transaction/wishlist" method="POST">
                                                            @csrf
                                                                <input type="text" name="book_id" value="{{ $stock->book->id }}" style="display: none;">
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
                        </div>
                </main>
            @endcan
        </div>
        {{-- Buku end --}}

        {{-- Line Chart --}}
            @can('staff')
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Borrow</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <canvas id="myChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card card-danger">
                                    <div class="card-header">
                                        <h3 class="card-title">Book By Category</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card card-success">
                                    <div class="card-header">
                                        <h3 class="card-title">Bar Chart</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart">
                                            <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-borrow" role="tabpanel" aria-labelledby="nav-borrow-tab">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="font-weight-bold">Permintaan Peminjaman</h3>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Pinjam</th>
                                            <th>NIS</th>
                                            <th>Nama Peminjam</th>
                                            <th>Tanggal Pinjam</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($borrows as $borrow)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    {{ $borrow->created_at->format('md') }}/PB/{{ $borrow->created_at->format('yis') }}
                                                </td>
                                                <td>{{ $borrow->member->nis }}</td>
                                                <td>{{ $borrow->member->nama }}</td>
                                                <td>{{ $borrow->tanggal_pinjam }}</td>
                                                <td>
                                                    @if ($borrow->status == "Menunggu persetujuan")
                                                        <span class="badge bg-warning">Menunggu persetujuan</span>
                                                    @endif

                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                        @if ($borrow->status == "Menunggu persetujuan")
                                                            {{-- Detail --}}
                                                            <button class="btn btn-success btn-sm btn-detail" type="button" data-toggle="modal" data-target="#show{{ $borrow->id }}"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail Peminjaman">
                                                                <i class="fas fa-info-circle "></i>
                                                            </button>
                                                            <div class="modal fade" id="show{{ $borrow->id }}">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Pengajuan Peminjaman</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row mx-md-n3">
                                                                                <div class="col px-md-5"><div class="p-2">Kode Pinjam</div></div>
                                                                                <div class="col px-md-5"><div class="p-2"><strong>: {{ $borrow->kode_peminjaman }}</strong></div></div>
                                                                            </div>
                                                                            <div class="row mx-md-n3">
                                                                                <div class="col px-md-5"><div class="p-2">NIS</div></div>
                                                                                <div class="col px-md-5"><div class="p-2">: {{ $borrow->member->nis }}</div></div>
                                                                            </div>
                                                                            <div class="row mx-md-n3">
                                                                                <div class="col px-md-5"><div class="p-2">Nama</div></div>
                                                                                <div class="col px-md-5"><div class="p-2">: {{ $borrow->member->nama }}</div></div>
                                                                            </div>
                                                                            <div class="row mx-md-n3">
                                                                                <div class="col px-md-5"><div class="p-2">Kelas / Jurusan</div></div>
                                                                                <div class="col px-md-5"><div class="p-2">: {{ $borrow->member->kelas }} {{ $borrow->member->jurusan }}</div></div>
                                                                            </div>
                                                                            <div class="row mx-md-n3">
                                                                                <div class="col px-md-5"><div class="p-2">Tanggal Pinjam</div></div>
                                                                                <div class="col px-md-5"><div class="p-2">: {{ $borrow->tanggal_pinjam }}</div></div>
                                                                            </div>
                                                                            <div class="row mx-md-n3">
                                                                                <div class="col px-md-5"><div class="p-2">Tanggal Kembali</div></div>
                                                                                <div class="col px-md-5"><div class="p-2">: {{ $borrow->tanggal_tempo }}</div></div>
                                                                            </div>
                                                                            <div class="row mx-md-n3">
                                                                                <div class="col px-md-5"><div class="p-2">Status</div></div>
                                                                                <div class="col px-md-5"><div class="p-2"><strong>: {{ $borrow->status }}</strong></div></div>
                                                                            </div>
                                                                            <hr>
                                                                            <p class="px-4"><strong>Buku Yang Dipinjam :</strong></p>
                                                                            <ol>
                                                                                <p style="display: none">{{ $outOfStock = 0}}</p>
                                                                                @foreach($borrow->borrowItem as $bi)
                                                                                    @if ($bi->book->stock->stok_akhir < 0)
                                                                                        <p style="display: none">{{ $outOfStock = true }}</p> 
                                                                                    @endif
                                                                                    <li>
                                                                                        <div class="row mx-md-n3">
                                                                                            <div class="col px-md-5"><div class="p-2">{{ $bi->book->judul }}</div></div>
                                                                                            <div class="col px-md-5"><div class="p-2">1</div></div>
                                                                                        </div>
                                                                                    </li>
                                                                                @endforeach
                
                                                                            </ol>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            @if ($outOfStock == true)
                                                                                <p class="text-danger flex-fill fw-bold">Stok salah satu buku habis!</p>
                                                                            @endif
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                            @if ($outOfStock != true)     
                                                                                <form action="/transaction/borrows/approve/{borrow->id}" method="post" enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    <div style="display: none;">
                                                                                        <input name="id" value="{{ $borrow->id }}">
                                                                                        <input name="kode_peminjaman" value="{{ $borrow->kode_peminjaman }}">
                                                                                        <input name="member_id" value="{{ $borrow->member->id }}">
                                                                                        @foreach($borrow->borrowItem as $borrowItem)
                                                                                            <input type="text" name="book_id[]" id="" value="{{ $borrowItem->book_id }}">
                                                                                        @endforeach
                                                                                    </div>
                                                                                    <button class="btn btn-success rounded me-1" type="submit">Terima Peminjaman</button>
                                                                                </form>
                                                                            @endif
                                                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#reject{{ $borrow->id }}">Tolak Peminjaman</button>
                                                                            <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="reject{{ $borrow->id }}" data-backdrop="false">
                                                                                <div class="modal-dialog modal-sm">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <p class="modal-title">Tolak Peminjaman</p>
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <span aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <form action="/transaction/borrows/reject/{id}" method="post" enctype="multipart/form-data">
                                                                                                @csrf
                                                                                                <div class="form-floating mb-3">
                                                                                                    <label for="">Alasan <small>Opsional</small> </label>
                                                                                                    <input type="text" name="reason" id="" class="form-control">
                                                                                                </div>
                                                                                                <div style="display: none;">
                                                                                                    <input required name="kode_peminjaman" type="number" maxlength="11" required class="form-control" id="floatingInput3" value="{{ $borrow->kode_peminjaman }}">
                                                                                                    <input required name="id" type="number" maxlength="11" required class="form-control" id="floatingInput3" value="{{ $borrow->id }}">
                                                                                                    <input name="member_id" value="{{ $borrow->member->id }}">
                                                                                                </div>
                                                                                                
                                                                                            </div>
                                                                                        <div class="modal-footer">
                                                                                                <button class="btn btn-danger rounded me-1" type="submit">Tolak Peminjaman</button>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>    
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @elseif ($borrow->status != "Menunggu persetujuan" && $borrow->pengambilan_buku != "Sudah")
                                                                {{-- Pengambilan Buku --}}
                                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#show{{ $borrow->id }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Pengambilan Buku"> 
                                                                <i class="fas fa-check"></i>
                                                            </button>
                                                            <div class="modal fade" id="show{{ $borrow->id }}">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header" style="border: none;">
                                                                            <h5 class="modal-title mt-3 px-4">Kode Peminjaman <p class="font-weight-bolder">{{ $borrow->kode_peminjaman }}</p></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row mx-md-n3">
                                                                                <div class="col px-md-5"><div class="p-2">NIS</div></div>
                                                                                <div class="col px-md-5"><div class="p-2">: {{ $borrow->member->nis }}</div></div>
                                                                            </div>
                                                                            <div class="row mx-md-n3">
                                                                                <div class="col px-md-5"><div class="p-2">Nama</div></div>
                                                                                <div class="col px-md-5"><div class="p-2">: {{ $borrow->member->nama }}</div></div>
                                                                            </div>
                                                                            <div class="row mx-md-n3">
                                                                                <div class="col px-md-5"><div class="p-2">Kelas / Jurusan</div></div>
                                                                                <div class="col px-md-5"><div class="p-2">: {{ $borrow->member->kelas }} {{ $borrow->member->jurusan }}</div></div>
                                                                            </div>
                                                                            <div class="row mx-md-n3">
                                                                                <div class="col px-md-5"><div class="p-2">Tanggal Pinjam</div></div>
                                                                                <div class="col px-md-5"><div class="p-2">: {{ $borrow->tanggal_pinjam }}</div></div>
                                                                            </div>
                                                                            <div class="row mx-md-n3">
                                                                                <div class="col px-md-5"><div class="p-2">Tanggal Kembali</div></div>
                                                                                <div class="col px-md-5"><div class="p-2">: {{ $borrow->tanggal_tempo }}</div></div>
                                                                            </div>
                                                                            <hr>
                                                                            <p class="px-4"><strong>Buku Yang Dipinjam :</strong></p>
                                                                            <ol>
                                                                                @foreach($borrow->borrowItem as $bi)
                                                                                <li>
                                                                                    <div class="row mx-md-n3">
                                                                                        <div class="col px-md-5"><div class="p-2">{{ $bi->book->judul }}</div></div>
                                                                                        <div class="col px-md-5"><div class="p-2">1</div></div>
                                                                                    </div>
                                                                                </li>
                                                                                @endforeach
                                                                            </ol>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                            <form action="/transaction/pengambilan_buku/{{ $borrow->id }}" method="post">
                                                                                @csrf
                                                                                <input type="text" name="id" hidden value="{{ $borrow->id }}">
                                                                                <button type="submit" class="btn btn-success">Diambil</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                        @elseif($borrow->pengambilan_buku == "Sudah")
                                                            <form action="/transaction/return/detail/{{ $borrow->id }}" method="post" class="{{ Request::is('/transaction/return/detail/*') ? 'active' : '' }}">
                                                                @csrf
                                                                <div style="display: none;">
                                                                    <input name="borrow_id" value="{{ $borrow->id }}">
                                                                    <input name="member_id" value="{{ $borrow->member->id }}">
                                                                </div>
                                                                <button class="btn btn-success btn-sm" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Pengembalian Buku"><i class="fas fa-arrow-down"></i></button>
                                                            </form> 
                                                        @endif
                                                            
                                                        {{-- Show --}}
                                                        <button class="btn btn-warning   btn-sm btn-detail" type="button" data-toggle="modal" data-target="#showw{{ $borrow->id }}"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail Peminjaman">
                                                            <i class="fas fa-eye "></i>
                                                        </button>
                                                        <div class="modal fade" id="showw{{ $borrow->id }}">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Peminjaman</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row mx-md-n3">
                                                                            <div class="col px-md-5"><div class="p-2">Kode Pinjam</div></div>
                                                                            <div class="col px-md-5"><div class="p-2"><strong>: {{ $borrow->kode_peminjaman }}</strong></div></div>
                                                                        </div>
                                                                        <div class="row mx-md-n3">
                                                                            <div class="col px-md-5"><div class="p-2">NIS</div></div>
                                                                            <div class="col px-md-5"><div class="p-2">: {{ $borrow->member->nis }}</div></div>
                                                                        </div>
                                                                        <div class="row mx-md-n3">
                                                                            <div class="col px-md-5"><div class="p-2">Nama</div></div>
                                                                            <div class="col px-md-5"><div class="p-2">: {{ $borrow->member->nama }}</div></div>
                                                                        </div>
                                                                        <div class="row mx-md-n3">
                                                                            <div class="col px-md-5"><div class="p-2">Kelas / Jurusan</div></div>
                                                                            <div class="col px-md-5"><div class="p-2">: {{ $borrow->member->kelas }} {{ $borrow->member->jurusan }}</div></div>
                                                                        </div>
                                                                        <div class="row mx-md-n3">
                                                                            <div class="col px-md-5"><div class="p-2">Tanggal Pinjam</div></div>
                                                                            <div class="col px-md-5"><div class="p-2">: {{ $borrow->tanggal_pinjam }}</div></div>
                                                                        </div>
                                                                        <div class="row mx-md-n3">
                                                                            <div class="col px-md-5"><div class="p-2">Tanggal Kembali</div></div>
                                                                            <div class="col px-md-5"><div class="p-2">: {{ $borrow->tanggal_tempo }}</div></div>
                                                                        </div>
                                                                        <div class="row mx-md-n3">
                                                                            <div class="col px-md-5"><div class="p-2">Status</div></div>
                                                                            <div class="col px-md-5"><div class="p-2"><strong>: {{ $borrow->status }}</strong></div></div>
                                                                        </div>
                                                                        <hr>
                                                                        <p class="px-4"><strong>Buku Yang Dipinjam :</strong></p>
                                                                        <ol>
                                                                            <p style="display: none">{{ $outOfStock = 0}}</p>
                                                                            @foreach($borrow->borrowItem as $bi)
                                                                                @if ($bi->book->stock->stok_akhir < 0)
                                                                                    <p style="display: none">{{ $outOfStock = true }}</p> 
                                                                                @endif
                                                                                <li>
                                                                                    <div class="row mx-md-n3">
                                                                                        <div class="col px-md-5"><div class="p-2">{{ $bi->book->judul }}</div></div>
                                                                                        <div class="col px-md-5"><div class="p-2">1</div></div>
                                                                                    </div>
                                                                                </li>
                                                                            @endforeach
            
                                                                        </ol>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- Edit data --}}
                                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default{{ $borrow->id }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Peminjaman"> <i class="fas fa-pencil-alt"></i> </button>
                                                        <div class="modal fade" id="modal-default{{ $borrow->id }}">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Edit Peminjaman</h4>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="/transaction/borrows/updateBorrow/{{ $borrow->id }}" method="post" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <input type="hidden" name="borrow_id" value="{{ $borrow->id }}">
                                                                            <div class="form-floating mb-3">
                                                                                <label for="floatingInput3">Nama Anggota</label>
                                                                                <select class="form-select form-control select2" aria-label="Default select example" name="member_id" required>
                                                                                    @foreach ($member as $m)
                                                                                        @if ($m->id == $borrow->member_id)
                                                                                            <option value="{{ $m->id }}" selected>{{ $m->nama }}</option>                                   
                                                                                        @else
                                                                                            <option value="{{ $m->id }}">{{ $m->nama }}</option> 
                                                                                        @endif
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            
                                                                            
                                                                            @section('style')
                                                                                <style>
                                                                                    .select2-container {
                                                                                        width: 92% !important;
                                                                                        padding: 0;
                                                                                    }
                                                                                </style>
                                                                            @endsection
                                                                            <div class="form-floating mb-3 book-container">
                                                                                <label for="floatingInput3">Judul Buku</label>
                                                                                <button class="float-right btn btn-sm btn-success btn-add-book" type="button">Tambah Buku</button>

                                                                                @foreach ($borrow->borrowItem as $key => $borrowItem)

                                                                                    <div class="input-group mt-1 book">
                                                                                        
                                                                                        <select class="form-select form-control select2" aria-label="Default select example" name="book_id[]" required>
                                                                                            @foreach ($stocksAll as $stock)
                                                                                                @if ($stock->book->id == $borrowItem->book_id)
                                                                                                    <option selected value="{{ $stock->book->id }}">{{ $stock->book->judul }} - {{ $stock->book->penulis }} ( Stok : {{ $stock->stok_akhir + 1 }} )</option>
                                                                                                @elseif ($stock->stok_akhir > 0)
                                                                                                    <option value="{{ $stock->book->id }}">{{ $stock->book->judul }} - {{ $stock->book->penulis }} ( Stok : {{ $stock->stok_akhir }} )</option>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </select>
                                                                                        @if ($key > 0)
                                                                                            <button type="button" class="btn btn-sm btn-danger btn-delete-book">Hapus</button>
                                                                                        @endif
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                            <div class="input-group">
                                                                                <button class="btn btn-success rounded me-1" type="submit">Update Peminjaman</button>
                                                                            </div>
                                                                        </form>   
                                                                    </div>
                                                                    <div class="modal-footer justify-content-between">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>               
                                        
                                                        

                                                        {{-- Delete --}}
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $borrow->id }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Batalkan Peminjaman"> 
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                        <div class="modal fade" id="delete{{ $borrow->id }}">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header" style="border: none;">
                                                                        <h5 class="modal-title mt-3 px-4">Kode Peminjaman <p class="font-weight-bolder">{{ $borrow->kode_peminjaman }}</p></h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="row mx-md-n3">
                                                                            <div class="col px-md-5"><div class="p-2">NIS</div></div>
                                                                            <div class="col px-md-5"><div class="p-2">: {{ $borrow->member->nis }}</div></div>
                                                                        </div>
                                                                        <div class="row mx-md-n3">
                                                                            <div class="col px-md-5"><div class="p-2">Nama</div></div>
                                                                            <div class="col px-md-5"><div class="p-2">: {{ $borrow->member->nama }}</div></div>
                                                                        </div>
                                                                        <div class="row mx-md-n3">
                                                                            <div class="col px-md-5"><div class="p-2">Kelas / Jurusan</div></div>
                                                                            <div class="col px-md-5"><div class="p-2">: {{ $borrow->member->kelas }} {{ $borrow->member->jurusan }}</div></div>
                                                                        </div>
                                                                        <div class="row mx-md-n3">
                                                                            <div class="col px-md-5"><div class="p-2">Tanggal Pinjam</div></div>
                                                                            <div class="col px-md-5"><div class="p-2">: {{ $borrow->tanggal_pinjam }}</div></div>
                                                                        </div>
                                                                        <div class="row mx-md-n3">
                                                                            <div class="col px-md-5"><div class="p-2">Tanggal Kembali</div></div>
                                                                            <div class="col px-md-5"><div class="p-2">: {{ $borrow->tanggal_tempo }}</div></div>
                                                                        </div>
                                                                        <hr>
                                                                        <p class="px-4"><strong>Buku Yang Dipinjam :</strong></p>
                                                                        <ol>
                                                                            @foreach($borrow->borrowItem as $bi)
                                                                            <li>
                                                                                <div class="row mx-md-n3">
                                                                                    <div class="col px-md-5"><div class="p-2">{{ $bi->book->judul }}</div></div>
                                                                                    <div class="col px-md-5"><div class="p-2">1</div></div>
                                                                                </div>
                                                                            </li>
                                                                            @endforeach
                                                                        </ol>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                        <form action="/transaction/borrows/deleteBorrow/{{ $borrow->id }}" method="post">
                                                                            @csrf
                                                                            <input type="text" name="borrow_id" hidden value="{{ $borrow->id }}">
                                                                            <button type="submit" class="btn btn-danger">Batalkan</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                         
                    </div>
                    <div class="tab-pane fade" id="nav-topRankBook" role="tabpanel" aria-labelledby="nav-topRankBook-tab">
                        <div class="card">
                            <div class="card-body">
                        
                                {{-- Tabel --}}
                                <table id="example1" class="table">
                                    <tbody>
                                        @foreach($topRankBook as $wishlist)
                                            <tr>
                                                <td style="border :none;">{{ $loop->iteration }}</td>
                                                <td style="border: none;">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            @if ($wishlist->book->image)
                                                                <img src="{{ asset('storage/' . $wishlist->book->image) }}" class="" width="50%">
                                                            @else
                                                                <img src="{{ asset("assets/img/book_cover_default.png") }}" class="" width="50%">
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
                                                                    <tr>
                                                                        <td style="border: none;">Penulis</td>
                                                                        <td style="border: none;">: {{ $wishlist->book->penulis }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="border: none;">Penerbit</td>
                                                                        <td style="border: none;">: {{ $wishlist->book->penerbit }}</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-member" role="tabpanel" aria-labelledby="nav-member-tab">
                        <div class="card">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Jurusan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($memberse as $member)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $member->nama }}</td>
                                        <td>{{ $member->kelas }}</td>
                                        <td>{{ $member->jurusan }}</td>
                                        <td class="text-center">
                                            @if ($member->status == 1)
                                                <span class="badge bg-success">Aktif</span> 
                                            @else
                                                <span class="badge bg-danger">Nonaktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- Edit --}}
                                            <a href="#modalEditData{{ $member->id }}" data-toggle="modal" class="btn btn-outline-info btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583v4.43zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585 1.594-1.58zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006v-1.589z"></path><path d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2z"></path></svg>
                                            </a>
                                            
                                            <div class="modal fade" id="modalEditData{{ $member->id }}">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Data</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="modal-body">
                                                                <form action="/table/members/{{ $member->id }}" method="post" enctype="multipart/form-data">
                                                                    @method('put')
                                                                    @csrf
                                                                    
                                                                    <div class="form-floating mb-3">
                                                                        <label for="floatingInput3">NIS</label>
                                                                        <input required name="nis" type="number" maxlength="11" required class="form-control" id="floatingInput3" value="{{ $member->nis }}">
                                                                    </div>
                                                                    <div class="form-floating mb-3">
                                                                        <label for="floatingInput3">Nama</label>
                                                                        <input required name="nama" type="text" required class="form-control" id="floatingInput3" value="{{ $member->nama }}">
                                                                    </div>
                                                                    <div class="form-floating mb-3">
                                                                        <label for="floatingInput3">Jenis Kelamin</label>
                                                                        <select class="form-select form-control select2" aria-label="Default select example" name="jenis_kelamin" required>
                                                                            <option value="" selected disabled></option>
                                                                            <option value="Laki-laki" {{ $member->jenis_kelamin == "Laki-laki" ? 'selected' : ''  }}>Laki-laki</option>
                                                                            <option value="Perempuan" {{ $member->jenis_kelamin == "Perempuan" ? 'selected' : ''  }}>Perempuan</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-floating mb-3">
                                                                        <label for="floatingInput3">Kelas</label>
                                                                        <select class="form-select form-control select2" aria-label="Default select example" name="kelas" required>
                                                                            <option value="" selected disabled></option>
                                                                            <option value="10" {{ $member->kelas == "10" ? 'selected' : ''  }}>10</option>
                                                                            <option value="11" {{ $member->kelas == "11" ? 'selected' : ''  }}>11</option>
                                                                            <option value="12" {{ $member->kelas == "12" ? 'selected' : ''  }}>12</option>
                                                                            <option value="13" {{ $member->kelas == "13" ? 'selected' : ''  }}>13</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-floating mb-3">
                                                                        <label for="floatingInput3">Jurusan</label>
                                                                        <select class="form-select form-control select2" aria-label="Default select example" name="jurusan" required>
                                                                            <option value="" selected disabled></option>
                                                                            @foreach ($majors as $major)	
                                                                                @if ($member->jurusan == $major->short)
                                                                                    <option selected value="{{ $major->short }}">{{ $major->full }}</option>
                                                                                @else
                                                                                    <option value="{{ $major->short }}">{{ $major->full }}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-floating mb-3">
                                                                        <label for="floatingInput3">Tanggal Lahir</label>
                                                                        <input required name="tanggal_lahir" type="date" required class="form-control" id="floatingInput3" value="{{ $member->tanggal_lahir }}">
                                                                    </div>
                                                                    <div class="form-floating mb-3">
                                                                        <label for="floatingInput3">Nomor Telepon</label>
                                                                        <input required name="nomor_telepon" type="text" required class="form-control" id="floatingInput3" value="{{ $member->nomor_telepon }}">
                                                                    </div>
                                                                    <div class="form-floating mb-3">
                                                                        <label for="floatingInput3">Alamat</label>
                                                                        <input required name="alamat" type="text" required class="form-control" id="floatingInput3" value="{{ $member->alamat }}">
                                                                    </div>
                                                                    <div class="form-floating mb-3">
                                                                        <label for="floatingInput3">Status</label>
                                                                        <select class="form-select form-control" aria-label="Default select example" name="status" required>
                                                                            <option value="" selected disabled></option>
                                                                            <option value="1" {{ $member->status == "1" ? 'selected' : ''  }}>Aktif</option>
                                                                            <option value="0" {{ $member->status == "0" ? 'selected' : ''  }}>Nonaktif</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="input-group">
                                                                        <button class="btn btn-success rounded me-1" type="submit">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                    
                    
                                            {{-- Show --}}
                                            <a href="#show{{ $member->id }}" data-toggle="modal" class="btn btn-outline-success btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                                </svg>
                                            </a>
                                            
                                            <div class="modal fade" id="show{{ $member->id }}">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Tampil Data</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="modal-body">
                                                                <form action="/table/members/{{ $member->id }}" method="post" enctype="multipart/form-data">
                                                                    @method('put')
                                                                    @csrf
                                                                    
                                                                    <div class="form-floating mb-3">
                                                                        <label for="floatingInput3">NIS</label>
                                                                        <input required name="nis" type="number" maxlength="11" required class="form-control" id="floatingInput3" value="{{ $member->nis }}" disabled>
                                                                    </div>
                                                                    <div class="form-floating mb-3">
                                                                        <label for="floatingInput3">Nama</label>
                                                                        <input required name="nama" type="text" required class="form-control" id="floatingInput3" value="{{ $member->nama }}" disabled>
                                                                    </div>
                                                                    <div class="form-floating mb-3">
                                                                        <label for="floatingInput3">Jenis Kelamin</label>
                                                                        <input required name="kelas" type="text" required class="form-control" id="floatingInput3" value="{{ $member->jenis_kelamin }}" disabled>
                                                                    </div>
                                                                    <div class="form-floating mb-3">
                                                                        <label for="floatingInput3">Kelas</label>
                                                                        <input required name="kelas" type="text" required class="form-control" id="floatingInput3" value="{{ $member->kelas }}" disabled>
                                                                    </div>
                                                                    <div class="form-floating mb-3">
                                                                        <label for="floatingInput3">Jurusan</label>
                                                                        <input required name="jurusan" type="text" required class="form-control" id="floatingInput3" value="{{ $member->jurusan }}" disabled>
                                                                    </div>
                                                                    <div class="form-floating mb-3">
                                                                        <label for="floatingInput3">Tanggal Lahir</label>
                                                                        <input required name="tanggal_lahir" type="date" required class="form-control" id="floatingInput3" value="{{ $member->tanggal_lahir }}" disabled>
                                                                    </div>
                                                                    <div class="form-floating mb-3">
                                                                        <label for="floatingInput3">Nomor Telepon</label>
                                                                        <input required name="nomor_telepon" type="text" required class="form-control" id="floatingInput3" value="{{ $member->nomor_telepon }}" disabled>
                                                                    </div>
                                                                    <div class="form-floating mb-3">
                                                                        <label for="floatingInput3">Alamat</label>
                                                                        <input required name="alamat" type="text" required class="form-control" id="floatingInput3" value="{{ $member->alamat }}" disabled>
                                                                    </div>
                                                                    <div class="form-floating mb-3">
                                                                        <label for="">Status</label>
                                                                        @if ($member->status == 1)
                                                                            <input required name="" type="text" required class="form-control" id="floatingInput3" value="Aktif" disabled>
                                                                        @else
                                                                        <input required name="" type="text" required class="form-control" id="floatingInput3" value="Nonaktif" disabled>
                                                                        @endif
                                                                    </div>
                                                                    <div class="form-floating mb-3">
                                                                        @if ($member->created_by)
                                                                            <label for="floatingInput3">Didaftarkan pada {{ $member->created_at }} oleh {{ $member->creator->nama }}</label>
                                                                        @endif
                                                                        @if ($member->updated_by)
                                                                            <label for="floatingInput3">Dieditkan pada {{ $member->updated_at }} oleh {{ $member->editor->nama }}</label>
                                                                        @endif
                                                                    </div>
                                                                    
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                    
                                            {{-- Delete --}}
                                            <form action="/table/members/{{ $member->id }}" method="POST" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                        <button type="submit" onclick="return confirm('Sure?')" class="btn btn-outline-danger btn-sm">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm4 12H8v-9h2v9zm6 0h-2v-9h2v9zm.618-15L15 2H9L7.382 4H3v2h18V4z"></path></svg>
                                                    </button>
                                            </form>
                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <script>
                    $(function () {
                        $("#example1").DataTable({
                        "responsive": true, "lengthChange": false, "autoWidth": false,
                        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
                    });
                </script>
                
                <script src="{{ asset('plugins/chart.js/Chart.min.js')}}"></script>
                <script>
                    const labels = JSON.parse('{!! json_encode($months) !!}');
                    
                    const data = {
                        labels: labels,
                        datasets: [{
                            label: 'Data Peminjaman Bulanan',
                            backgroundColor: 'rgb(102, 178, 255)',
                            borderColor: 'rgb(0, 128, 255)',
                            data: JSON.parse('{!! json_encode($monthsCount) !!}'),
                        }]
                    };

                    const config = {
                        type: 'line',
                        data: data,
                        options: {}
                    };
                    
                    const myChart = new Chart(
                        document.getElementById('myChart'),
                        config
                    );
                </script>
                <script>
                    //-------------
                    //- DONUT CHART -
                    //-------------
                    // Get context with jQuery - using jQuery's .get() method.
                    var donutChartCanvas = $('#pieChart').get(0).getContext('2d')
                    var donutData        = {
                    labels: JSON.parse('{!! json_encode($kategoriName) !!}'),
                    datasets: [
                        {
                        data: JSON.parse('{!! json_encode($kategoriCount) !!}'),
                        backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                        }
                    ]
                    }
                    var donutOptions     = {
                    maintainAspectRatio : false,
                    responsive : true,
                    }
                    //Create pie or douhnut chart
                    // You can switch between pie and douhnut using the method below.
                    new Chart(donutChartCanvas, {
                    type: 'pie',
                    data: donutData,
                    options: donutOptions
                    })
                </script>
                <script>
                    //-------------
                    //- BAR CHART -
                    //-------------
                    var areaChartData = {
                        labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                        datasets: [
                            {
                                label               : 'Digital Goods',
                                backgroundColor     : 'rgba(60,141,188,0.9)',
                                borderColor         : 'rgba(60,141,188,0.8)',
                                pointRadius          : false,
                                pointColor          : '#3b8bba',
                                pointStrokeColor    : 'rgba(60,141,188,1)',
                                pointHighlightFill  : '#fff',
                                pointHighlightStroke: 'rgba(60,141,188,1)',
                                data                : [28, 48, 40, 19, 86, 27, 90]
                            },
                            {
                                label               : 'Electronics',
                                backgroundColor     : 'rgba(210, 214, 222, 1)',
                                borderColor         : 'rgba(210, 214, 222, 1)',
                                pointRadius         : false,
                                pointColor          : 'rgba(210, 214, 222, 1)',
                                pointStrokeColor    : '#c1c7d1',
                                pointHighlightFill  : '#fff',
                                pointHighlightStroke: 'rgba(220,220,220,1)',
                                data                : [65, 59, 80, 81, 56, 55, 40]
                            },
                            {
                                label               : 'Electronics',
                                backgroundColor     : 'rgba(210, 214, 222, 1)',
                                borderColor         : 'rgba(210, 214, 222, 1)',
                                pointRadius         : false,
                                pointColor          : 'rgba(210, 214, 222, 1)',
                                pointStrokeColor    : '#c1c7d1',
                                pointHighlightFill  : '#fff',
                                pointHighlightStroke: 'rgba(220,220,220,1)',
                                data                : [65, 59, 80, 81, 56, 55, 40]
                            },
                        ]
                    }
                    var barChartCanvas = $('#barChart').get(0).getContext('2d')
                    var barChartData = $.extend(true, {}, areaChartData)
                    var temp0 = areaChartData.datasets[0]
                    var temp1 = areaChartData.datasets[1]
                    barChartData.datasets[0] = temp1
                    barChartData.datasets[1] = temp0

                    var barChartOptions = {
                        responsive              : true,
                        maintainAspectRatio     : false,
                        datasetFill             : false
                    }

                    new Chart(barChartCanvas, {
                        type: 'bar',
                        data: barChartData,
                        options: barChartOptions
                    })
                </script>
            @endcan
        {{-- Line Chart end --}}

@endsection