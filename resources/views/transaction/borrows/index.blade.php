@extends('layout.main')
@section('title', "Peminjaman Buku")

@section('content')
	@include('sweetalert::alert')
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-header">
                    <div class="container-fluid">
                        <div class="row">
                          <div class="col-sm-6">
                            <h3 class="mt-2">@yield('title')</h3>
                          </div><!-- /.col -->
                          <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right" style="background-color: rgba(255,0,0,0);">
                                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">@yield('title')</li>
                            </ol>
                          </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                    @can('member')
                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tabs-dipinjam-tab" data-toggle="pill" href="#tabs-dipinjam" role="tab" aria-controls="tabs-dipinjam" aria-selected="trues">Menunggu Persetujuan</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" id="tabs-disetujui-tab" data-toggle="pill" href="#tabs-disetujui" role="tab" aria-controls="tabs-disetujui" aria-selected="false">Disetujui</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tabs-selesai-tab" data-toggle="pill" href="#tabs-selesai" role="tab" aria-controls="tabs-selesai" aria-selected="false">Selesai</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tabs-ditolak-tab" data-toggle="pill" href="#tabs-ditolak" role="tab" aria-controls="tabs-ditolak" aria-selected="false">Ditolak</a>
                            </li>
                        </ul>
                    @endcan
				</div>
			
				<div class="card-body">
                    {{-- Tampilan staff --}}
                    @can('staff')
                        <button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#modal-default">Tambah Peminjaman</button>
                        <div class="modal fade" id="modal-default">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Tambah Peminjaman</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="modal-body">
                                            <form action="/transaction/borrows/directBorrow" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-floating mb-3">
                                                    <label for="floatingInput3">Nama Anggota</label>
                                                    <select class="form-select form-control select2" aria-label="Default select example" name="member_id" required>
                                                        <option value="" selected disabled> Pilih Nama Anggota </option>
                                                        @foreach ($members as $member)
                                                            <option value="{{ $member->id }}">{{ $member->nama }}</option>    
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-floating mb-3 book-container">
                                                    <label for="floatingInput3">Judul Buku</label>
                                                    <button class="float-right btn btn-sm btn-success btn-add-book" type="button">Tambah Buku</button>
                                                    <select class="form-select form-control select2" aria-label="Default select example" name="book_id[]" required>
                                                        <option value="" selected disabled> Pilih Judul Buku - Penulis</option>
                                                        @foreach($stocks as $stock)
                                                            <option value="{{ $stock->book->id }}">{{ $stock->book->judul }} - {{ $stock->book->penulis }} ( Stok : {{ $stock->stok_akhir }} )</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <label for="floatingInput3">
                                                    Tanggal Pinjam</label>
                                                    <input type="date" name="tanggal_pinjam" class="form-control">
                                                </div>
                                                <div class="input-group">
                                                    <button class="btn btn-success rounded me-1" type="submit">Tambah Peminjaman</button>
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
                        @foreach ($borrows as $borrow)
                            {{-- Modal Permintaan Peminjaman --}}
                            <div class="modal fade" id="request{{ $borrow->id }}">
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
                                            {{-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#reject{{ $borrow->id }}">Tolak Peminjaman</button> --}}
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

                            {{-- Modal Pengambilan Buku --}}
                            <div class="modal fade" id="take{{ $borrow->id }}">
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
                                                <input type="text" name="member_id" hidden value="{{ $borrow->member_id }}">
                                                <button type="submit" class="btn btn-success">Diambil</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Modal Show Data --}}
                            <div class="modal fade" id="show{{ $borrow->id }}">
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

                            {{-- Modal Edit --}}
                            <div class="modal fade" id="edit{{ $borrow->id }}">
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
                                                        @foreach ($members as $member)
                                                            @if ($member->id == $borrow->member_id)
                                                                <option value="{{ $member->id }}" selected>{{ $member->nama }}</option>                                   
                                                            @else
                                                                <option value="{{ $member->id }}">{{ $member->nama }}</option> 
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

                            {{-- Modal Delete --}}
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
                        @endforeach
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
                                            <button class="link-primary text-primary" type="button" id="detail{{ $borrow->id }}" onclick="showDetail{{ $borrow->id }}()" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail Peminjaman" style="border: none; cursor: pointer; background-color:rgba(255,255,255,0);">
                                                {{ $borrow->created_at->format('md') }}/PB/{{ $borrow->created_at->format('yis') }}
                                            </button>
                                        </td>
                                        <td>{{ $borrow->member->nis }}</td>
                                        <td>{{ $borrow->member->nama }}</td>
                                        <td>{{ $borrow->tanggal_pinjam }}</td>
                                        <td>
                                            @if ($borrow->status == "Menunggu persetujuan")
                                                <span class="badge bg-warning">Menunggu persetujuan</span>
                                            @elseif ($borrow->status == "Disetujui")
                                                <span class="badge bg-success">Disetujui</span>
                                            @elseif ($borrow->status == "Dalam peminjaman")
                                                <span class="badge bg-primary">Dalam Peminjaman</span>
                                            @endif

                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                @if ($borrow->status == "Menunggu persetujuan")
                                                    {{-- Detail --}}
                                                    <button class="btn btn-success btn-sm btn-detail" type="button" data-toggle="modal" data-target="#request{{ $borrow->id }}"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail Peminjaman">
                                                        <i class="fas fa-info-circle "></i>
                                                    </button>
                                                @elseif ($borrow->status != "Menunggu persetujuan" && $borrow->pengambilan_buku != "Sudah")
                                                      {{-- Pengambilan Buku --}}
                                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#take{{ $borrow->id }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Pengambilan Buku"> 
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                @endif
                                                   
                                                {{-- Show --}}
                                                <button class="btn btn-warning   btn-sm btn-detail" type="button" data-toggle="modal" data-target="#show{{ $borrow->id }}"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail Peminjaman">
                                                    <i class="fas fa-eye "></i>
                                                </button>

                                                {{-- Edit data --}}
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit{{ $borrow->id }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Peminjaman"> <i class="fas fa-pencil-alt"></i> </button>

                                                {{-- Delete --}}
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $borrow->id }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Batalkan Peminjaman"> 
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>        
                    @endcan
                    {{-- Akhir tampilan staff --}} 

                    {{-- Tampilan anggota --}}
                    @can('member')
                        @include('transaction.borrows.idxMember')
                    @endcan
                    {{-- Akhir tampilan anggota --}}
				</div>

                @can('staff')
                    {{-- Tabel Detail --}}
                    <div class="card-body">
                        @foreach ($borrows as $borrow)
                            <div class="detail-table" id="detailTable{{ $borrow->id }}" style="display: none;">
                                <div class="mb-2">
                                    <h5 class="d-inline">Detail Buku</h5>
                                    <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#default{{ $borrow->id }}"> Edit Buku </button>
                                    <div class="modal fade" id="default{{ $borrow->id }}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Peminjaman</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="modal-body">
                                                        <form action="/transaction/borrows/updateBorrow/{{ $borrow->id }}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="borrow_id" value="{{ $borrow->id }}">
                                                            <input type="hidden" name="member_id" value="{{ $borrow->member_id }}">
                                                            
                                                            <div class="form-floating mb-3 book-container">
                                                                <label for="floatingInput3">Judul Buku</label>
                                                                <button class="float-right btn btn-sm btn-success btn-add-book" type="button">Tambah Buku</button>

                                                                @foreach ($borrow->borrowItem as $key => $borrowItem)
                                                                    <div class="input-group mt-1 book">
                                                                        <select class="form-select form-control select2" aria-label="Default select example" name="book_id[]" required>
                                                                            @foreach ($stocksAll as $stock)
                                                                                @if ($stock->book->id == $borrowItem->book_id)
                                                                                    <option selected value="{{ $stock->book->id }}">{{ $stock->book->judul }} - {{ $stock->book->penulis }} ( Stok : {{ $stock->stok_akhir + 1 }} ) </option>
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
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 

                                </div>
                                            
                                {{-- Tabel Detail --}}
                                <table id="detailTable" class="table table-bordered table-striped" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Pinjam</th>
                                            <th>Judul</th>
                                            <th>Jumlah</th>
                                            <th>Stok</th>
                                            <th>Tanggal Tempo</th>
                                            {{-- <th>Aksi</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($borrow->borrowItem as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $borrow->kode_peminjaman }}</td>
                                                <td>{{ $item->book->judul }}</td>
                                                <td>1</td>
                                                <td>{{ $item->book->stock->stok_akhir + 1 }}</td>
                                                <td>{{ $borrow->tanggal_tempo }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>   
                            </div>    
                            
                            <script>
                                function showDetail{{ $borrow->id }}(){
                                    const oldTable = document.querySelectorAll('.detail-table');
                                    oldTable.forEach(element => {
                                        element.style.display = 'none';
                                    });
                                    
                                    const table = document.querySelector('#detailTable{{ $borrow->id }}');
                                    table.style.display = 'block';
                                    table.scrollIntoView({
                                        behavior: 'smooth'
                                    });
                                }
                            </script>
                        @endforeach    
                    </div>
                    {{-- Akhir Tabel Detail --}}
                @endcan
            
			</div>
		</div>
	</div>

    @can('staff')
        <script>
            $('.btn-add-book').click(function () {
                $('.book-container').append(book())

                $(function () {
                    $('.select2').select2()
                });
            })
            $(document).on('click','.btn-delete-book',function(){
                $(this).closest('.book').remove()
            })
            function book(){
                return `<div class="input-group mt-1 book">
                            <select class="form-select form-control select2" aria-label="Default select example" name="book_id[]" required>
                                <option value="" selected disabled>Pilih Judul Buku - Penulis</option>
                                @foreach ($stocksAll as $stock)
                                    @if ($stock->stok_akhir > 0)
                                        <option value="{{ $stock->book->id }}">{{ $stock->book->judul }} - {{ $stock->book->penulis }} ( Stok : {{ $stock->stok_akhir }} )</option>
                                    @endif
                                @endforeach
                            </select>                                    
                            <button type="button" class="btn btn-sm btn-danger btn-delete-book">Hapus</button>
                        </div>`
            }
                    
        $(function () {
			$("#example1").DataTable({
			"responsive": true, "lengthChange": false, "autoWidth": false,
			"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
			}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		});
        
        $(function () {
			$("#detailTable").DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
			});
		});
        </script>
    @endcan

    @can('member')
        <script>
            $(function () {
                $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false
                });
            });
        </script>        
    @endcan

@endsection