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
                    <div class="col-lg-3 col-6">
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
                    <div class="col-lg-3 col-6">
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

                    <div class="col-lg-3 col-6">
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
                    <div class="col-lg-3 col-6">
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
                                                                    <div class="badge badge-danger">{{ $b->status }}</div>
                                                                    @elseif($b->status == "Disetujui")
                                                                        @if($b->pengambilan_buku == "Belum")
                                                                            <div class="badge badge-warning">{{ $b->status }}</div>
                                                                        @elseif($b->pengambilan_buku == "Sudah")
                                                                            <div class="badge badge-info">Sedang Dipinjam</div>
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if($b->status == "Menunggu persetujuan")
                                                                        <button style="background: transparent;border:none;" data-toggle="modal" data-target="#menunggu{{ $b->id }}">
                                                                            <i class="fas fa-info-circle"></i>
                                                                        </button>
                                                                    @elseif($b->status == "Disetujui")
                                                                        @if($b->pengambilan_buku == "Belum")
                                                                            <button style="background: transparent;border:none;" data-toggle="modal" data-target="#disetujui{{ $b->id }}">
                                                                                <i class="fas fa-info-circle"></i>
                                                                            </button>
                                                                        @elseif($b->pengambilan_buku == "Sudah")
                                                                            <button style="background: transparent;border:none;" data-toggle="modal" data-target="#menunggu{{ $b->id }}">
                                                                                <i class="fas fa-info-circle"></i>
                                                                            </button>
                                                                        @endif
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
                                                                                    <hr>
                                                                                    <p class="px-4"><strong>Buku Yang Dipinjam :</strong></p>
                                                                                    <ol>
                                                                                        @foreach($b->borrowItem as $bi)
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

@endsection