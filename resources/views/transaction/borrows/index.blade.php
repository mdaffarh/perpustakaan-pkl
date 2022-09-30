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
                                        <td>{{ $borrow->kode_peminjaman }}</td>
                                        <td>{{ $borrow->member->nis }}</td>
                                        <td>{{ $borrow->member->nama }}</td>
                                        <td>{{ $borrow->tanggal_pinjam }}</td>
                                        <td>{{ $borrow->status }}</td>
                                        <td>
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
                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>               

                                            
                                            {{-- Show --}}
                                            <button class="btn btn-success btn-sm btn-detail" type="button" id="detail{{ $borrow->id }}" onclick="showDetail()">
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
                                    

                                            {{-- Delete --}}
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $borrow->id }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Batalkan Peminjaman"> 
                                                <i class="fas fa-times-circle"></i>
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
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>        
                    @endcan
                    {{-- Akhir tampilan staff --}} 

                    {{-- Tampilan anggota --}}
                    @can('member')
                        <div class="tab-content" id="custom-tabs-two-tabContent">
                            <div class="tab-pane fade show active" id="tabs-dipinjam" role="tabpanel" aria-labelledby="tabs-dipinjam-tab">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Peminjaman</th>
                                            <th>Nama Peminjam</th>
                                            <th>Tanggal Pinjam</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($borrowedMenungguPersetujuan as $borrow)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $borrow->kode_peminjaman }}</td>
                                                <td>{{ $borrow->member->nama }}</td>
                                                <td>{{ $borrow->tanggal_pinjam }}</td>
                                                <td>							
                            
                                                    {{-- Show --}}
                                                    <a href="#show{{ $borrow->id }}" data-toggle="modal" class="btn btn-outline-success btn-sm">
                                                        <i class="fas fa-info-circle"></i>
                                                    </a>
                                                    
                                                    <div class="modal fade" id="show{{ $borrow->id }}">
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
                                                                    <div class="modal-body">
                                                                        <div class="row justify-content-between mb-3">
                                                                            <div class="col-auto"> <h6 class="color-1 mb-0 change-color"></h6> </div>
                                                                            <div class="col-auto font-weight-bolder">No Peminjaman : {{ $borrow->kode_peminjaman }}</div>
                                                                        </div>
                                                                        <p style="display: none">{{ $countForeach = 0 }}</p> 
                                                                        @foreach($borrow->borrowItem as $borrowItem)
                                                                           <p style="display: none">{{ $countForeach+=1 }}</p> 
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div class="card card-2">
                                                                                    <div class="card-body">
                                                                                        <div class="media">
                                                                                            <div class="sq align-self-center ">
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
                                                                                    <div class="col-auto"><h6 class="mb-1 text-dark"><b>Detail Peminjaman</b></h6></div>
                                                                                    <div class="flex-sm-col text-right col"> <h6 class="mb-1"><b>{{ $countForeach }} Buku akan di pinjam</b></h6> </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                        <div class="">
                                                                            <div class="d-flex justify-content-end">
                                                                                <div class="mr-auto  p-2">NIS</div>
                                                                                <div class="p-2">{{ $borrow->member->nis }}</div>
                                                                            </div>
                                                                            <div class="d-flex justify-content-end">
                                                                                <div class="mr-auto  p-2">Nama</div>
                                                                                <div class=" p-2">{{ $borrow->member->nama }}</div>
                                                                            </div>
                                                                            <div class="d-flex justify-content-end">
                                                                                <div class="mr-auto  p-2">Kelas</div>
                                                                                <div class=" p-2">{{ $borrow->member->kelas }}</div>
                                                                            </div>
                                                                            <div class="d-flex justify-content-end">
                                                                                <div class="mr-auto  p-2">Jurusan</small></div>
                                                                                <div class=" p-2">{{ $borrow->member->jurusan }}</div>
                                                                            </div>
                                                                            <div class="d-flex justify-content-end">
                                                                                <div class="mr-auto  p-2">Tanggal Pinjam</div>
                                                                                <div class=" p-2">{{ $borrow->tanggal_pinjam }}</div>
                                                                            </div>
                                                                            <div class="d-flex justify-content-end">
                                                                                <div class="mr-auto  p-2">Tanggal Kembali</div>
                                                                                <div class=" p-2">{{ $borrow->tanggal_tempo }}</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <div class="offset-5 py-3">
                                                                        <span><small>*Cetak Kartu untuk mengambil buku di perpustakaan</small></span>
                                                                        <br>
                                                                        <span><small>*Pastikan anda mengambil buku dan mengembalikannya di waktu yang tepat</small></span>
                                                                    </div>
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                            <div class="tab-pane fade" id="tabs-disetujui" role="tabpanel" aria-labelledby="tabs-disetujui-tab">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Peminjaman</th>
                                            <th>Nama Peminjam</th>
                                            <th>Tanggal Pinjam</th>
                                            <th>Tanggal Tempo</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($borrowedDisetujui as $borrow)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $borrow->kode_peminjaman }}</td>
                                                <td>{{ $borrow->member->nama }}</td>
                                                <td>{{ $borrow->tanggal_pinjam }}</td>
                                                <td>{{ $borrow->tanggal_tempo }}</td>
                                                <td>
                                                    @if(Carbon\Carbon::parse( $borrow->tanggal_tempo)->diffInDays(Carbon\Carbon::now(),false) > 0)
                                                        <span class="badge bg-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Kamu telat mengembalikan buku silakan cek kolom info untuk lihat denda.">Telat</span>
                                                    @elseif ($borrow->pengambilan_buku == "Sudah")
                                                        <span class="badge bg-primary">Dalam Peminjaman</span>
                                                    @else
                                                        <span class="badge bg-success" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Peminjaman telah disetujui silakan ambil buku di perpustakaan.">Disetujui</span>
                                                    @endif    
                                                </td>
                                                <td>							
                            
                                                    {{-- Show --}}
                                                    <a href="#show{{ $borrow->id }}" data-toggle="modal" class="btn btn-outline-success btn-sm">
                                                        <i class="fas fa-info-circle"></i>
                                                    </a>
                                                    
                                                    <div class="modal fade" id="show{{ $borrow->id }}">
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
                                                                    <div class="modal-body">
                                                                        <div class="row justify-content-between mb-3">
                                                                            <div class="col-auto"> <h6 class="color-1 mb-0 change-color"></h6> </div>
                                                                            <div class="col-auto font-weight-bolder">No Peminjaman : {{ $borrow->kode_peminjaman }}</div>
                                                                        </div>
                                                                        <p style="display: none">{{ $countForeach = 0 }}</p> 
                                                                        @foreach($borrow->borrowItem as $borrowItem)
                                                                        <p style="display: none">{{ $countForeach += 1 }}</p> 
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div class="card card-2">
                                                                                    <div class="card-body">
                                                                                        <div class="media">
                                                                                            <div class="sq align-self-center ">
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
                                                                                    <div class="col-auto"><h6 class="mb-1 text-dark"><b>Detail Peminjaman</b></h6></div>
                                                                                    <div class="flex-sm-col text-right col"> <h6 class="mb-1"><b>{{ $countForeach }} Buku di pinjam</b></h6> </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                        <div class="">
                                                                            <div class="d-flex justify-content-end">
                                                                                <div class="mr-auto  p-2">NIS</div>
                                                                                <div class="p-2">{{ $borrow->member->nis }}</div>
                                                                            </div>
                                                                            <div class="d-flex justify-content-end">
                                                                                <div class="mr-auto  p-2">Nama</div>
                                                                                <div class=" p-2">{{ $borrow->member->nama }}</div>
                                                                            </div>
                                                                            <div class="d-flex justify-content-end">
                                                                                <div class="mr-auto  p-2">Kelas</div>
                                                                                <div class=" p-2">{{ $borrow->member->kelas }}</div>
                                                                            </div>
                                                                            <div class="d-flex justify-content-end">
                                                                                <div class="mr-auto  p-2">Jurusan</small></div>
                                                                                <div class=" p-2">{{ $borrow->member->jurusan }}</div>
                                                                            </div>
                                                                            <div class="d-flex justify-content-end">
                                                                                <div class="mr-auto  p-2">Tanggal Pinjam</div>
                                                                                <div class=" p-2">{{ $borrow->tanggal_pinjam }}</div>
                                                                            </div>
                                                                            <div class="d-flex justify-content-end">
                                                                                <div class="mr-auto  p-2">Tanggal Kembali</div>
                                                                                <div class=" p-2">{{ $borrow->tanggal_tempo }}</div>
                                                                            </div>
                                                                            @if(Carbon\Carbon::parse( $borrow->tanggal_tempo)->diffInDays(Carbon\Carbon::now(),false) > 0)
                                                                                <div class="d-flex justify-content-end">
                                                                                    <div class="mr-auto  p-2">Denda</div>
                                                                                    <div class=" p-2">{{ Carbon\Carbon::parse( $borrow->tanggal_tempo)->diffInDays(Carbon\Carbon::now(),false) * 500 }}</div>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <div class="offset-5 py-3">
                                                                        <span><small>*Cetak Kartu untuk mengambil buku di perpustakaan</small></span>
                                                                        <br>
                                                                        <span><small>*Pastikan anda mengambil buku dan mengembalikannya di waktu yang tepat</small></span>
                                                                    </div>
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                            <div class="tab-pane fade" id="tabs-ditolak" role="tabpanel" aria-labelledby="tabs-ditolak-tab">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Peminjaman</th>
                                            <th>Nama Peminjam</th>
                                            <th>Tanggal Pinjam</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($borrowedDitolak as $borrow)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $borrow->kode_peminjaman }}</td>
                                                <td>{{ $borrow->member->nama }}</td>
                                                <td>{{ $borrow->tanggal_pinjam }}</td>
                                                <td>							
                            
                                                    {{-- Show --}}
                                                    <a href="#show{{ $borrow->id }}" data-toggle="modal" class="btn btn-outline-success btn-sm">
                                                        <i class="fas fa-info-circle"></i>
                                                    </a>
                                                    
                                                    <div class="modal fade" id="show{{ $borrow->id }}">
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
                                                                    <div class="modal-body">
                                                                        <div class="row justify-content-between mb-3">
                                                                            <div class="col-auto"> <h6 class="color-1 mb-0 change-color"></h6> </div>
                                                                            <div class="col-auto font-weight-bolder">No Peminjaman : {{ $borrow->kode_peminjaman }}</div>
                                                                        </div>
                                                                        <p style="display: none">{{  $countForeach = 0 }}</p>
                                                                        
                                                                        @foreach($borrow->borrowItem as $borrowItem)
                                                                        <p style="display: none">{{ $countForeach += 1 }}</p>
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div class="card card-2">
                                                                                    <div class="card-body">
                                                                                        <div class="media">
                                                                                            <div class="sq align-self-center ">
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
                                                                                    <div class="col-auto"><h6 class="mb-1 text-dark"><b>Detail Peminjaman</b></h6></div>
                                                                                    <div class="flex-sm-col text-right col"> <h6 class="mb-1"><b>{{ $countForeach }} Buku akan di pinjam</b></h6> </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                        <div class="">
                                                                            <div class="d-flex justify-content-end">
                                                                                <div class="mr-auto  p-2">NIS</div>
                                                                                <div class="p-2">{{ $borrow->member->nis }}</div>
                                                                            </div>
                                                                            <div class="d-flex justify-content-end">
                                                                                <div class="mr-auto  p-2">Nama</div>
                                                                                <div class=" p-2">{{ $borrow->member->nama }}</div>
                                                                            </div>
                                                                            <div class="d-flex justify-content-end">
                                                                                <div class="mr-auto  p-2">Kelas</div>
                                                                                <div class=" p-2">{{ $borrow->member->kelas }}</div>
                                                                            </div>
                                                                            <div class="d-flex justify-content-end">
                                                                                <div class="mr-auto  p-2">Jurusan</small></div>
                                                                                <div class=" p-2">{{ $borrow->member->jurusan }}</div>
                                                                            </div>
                                                                            <div class="d-flex justify-content-end">
                                                                                <div class="mr-auto  p-2">Tanggal Pinjam</div>
                                                                                <div class=" p-2">{{ $borrow->tanggal_pinjam }}</div>
                                                                            </div>
                                                                            <div class="d-flex justify-content-end">
                                                                                <div class="mr-auto  p-2">Tanggal Kembali</div>
                                                                                <div class=" p-2">{{ $borrow->tanggal_tempo }}</div>
                                                                            </div>
                                                                            <div class="d-flex justify-content-end">
                                                                                <div class="mr-auto  p-2">Status</div>
                                                                                <div class=" p-2">Ditolak</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <div class="offset-5 py-3">
                                                                        <span><small>*Peminjaman ditolak silakan cek notifikasi untuk info lebih lanjut.</small></span>
                                                                    </div>
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                            <div class="tab-pane fade" id="tabs-selesai" role="tabpanel" aria-labelledby="tabs-selesai-tab">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Peminjaman</th>
                                            <th>Nama Peminjam</th>
                                            <th>Tanggal Pinjam</th>
                                            <th>Selesai</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($borrowedSelesai as $borrow)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $borrow->kode_peminjaman }}</td>
                                                <td>{{ $borrow->member->nama }}</td>
                                                <td>{{ $borrow->tanggal_pinjam }}</td>
                                                <td>{{ $borrow->tanggal_kembali }}</td>
                                                <td>							
                            
                                                    {{-- Show --}}
                                                    <a href="#show{{ $borrow->id }}" data-toggle="modal" class="btn btn-outline-success btn-sm">
                                                        <i class="fas fa-info-circle"></i>
                                                    </a>
                                                    
                                                    <div class="modal fade" id="show{{ $borrow->id }}">
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
                                                                    <div class="modal-body">
                                                                        <div class="row justify-content-between mb-3">
                                                                            <div class="col-auto"> <h6 class="color-1 mb-0 change-color"></h6> </div>
                                                                            <div class="col-auto font-weight-bolder">No Peminjaman : {{ $borrow->kode_peminjaman }}</div>
                                                                        </div>
                                                                        <p style="display: none">{{ $countForeach = 0 }}</p>
                                                                        @foreach($borrow->borrowItem as $borrowItem)
                                                                        <p style="display: none">{{ $countForeach += 1 }}</p>
                                                                        <div class="row">
                                                                            <div class="col">
                                                                                <div class="card card-2">
                                                                                    <div class="card-body">
                                                                                        <div class="media">
                                                                                            <div class="sq align-self-center ">
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
                                                                                    <div class="col-auto"><h6 class="mb-1 text-dark"><b>Detail Peminjaman</b></h6></div>
                                                                                    <div class="flex-sm-col text-right col"> <h6 class="mb-1"><b>{{ $countForeach }} Buku telah kamu pinjam</b></h6> </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                        <div class="">
                                                                            <div class="d-flex justify-content-end">
                                                                                <div class="mr-auto  p-2">NIS</div>
                                                                                <div class="p-2">{{ $borrow->member->nis }}</div>
                                                                            </div>
                                                                            <div class="d-flex justify-content-end">
                                                                                <div class="mr-auto  p-2">Nama</div>
                                                                                <div class=" p-2">{{ $borrow->member->nama }}</div>
                                                                            </div>
                                                                            <div class="d-flex justify-content-end">
                                                                                <div class="mr-auto  p-2">Kelas</div>
                                                                                <div class=" p-2">{{ $borrow->member->kelas }}</div>
                                                                            </div>
                                                                            <div class="d-flex justify-content-end">
                                                                                <div class="mr-auto  p-2">Jurusan</small></div>
                                                                                <div class=" p-2">{{ $borrow->member->jurusan }}</div>
                                                                            </div>
                                                                            <div class="d-flex justify-content-end">
                                                                                <div class="mr-auto  p-2">Tanggal Pinjam</div>
                                                                                <div class=" p-2">{{ $borrow->tanggal_pinjam }}</div>
                                                                            </div>
                                                                            <div class="d-flex justify-content-end">
                                                                                <div class="mr-auto  p-2">Tanggal Tempo</div>
                                                                                <div class=" p-2">{{ $borrow->tanggal_tempo }}</div>
                                                                            </div>
                                                                            <div class="d-flex justify-content-end">
                                                                                <div class="mr-auto  p-2">Tanggal Kembali</div>
                                                                                <div class=" p-2">{{ $borrow->tanggal_kembali }}</div>
                                                                            </div>
                                                                            @if ($borrow->fines)
                                                                                <div class="d-flex justify-content-end">
                                                                                    <div class="mr-auto  p-2">Denda</div>
                                                                                    <div class=" p-2">{{ $borrow->fines->total }}</div>
                                                                                </div>
                                                                            @endif
                                                                            <div class="d-flex justify-content-end">
                                                                                <div class="mr-auto  p-2">Staff Perpustakaan</div>
                                                                                <div class=" p-2">{{ $borrow->staff->nama }}</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                    @endcan
                    {{-- Akhir tampilan anggota --}}

                    
				</div>

                <div class="card-body">
                    @foreach ($borrows as $borrow)
                        {{-- Tabel Detail --}}
                        <table id="detailTable{{ $borrow->id }}" class="table table-bordered table-striped" style="display: none">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Pinjam</th>
                                    <th>Judul</th>
                                    <th>Jumlah</th>
                                    <th>Stok</th>
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
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>     
                        <script>
                            function showDetail(){
                                const table = document.querySelector('#detailTable{{ $borrow->id }}');
                                table.style.display = 'block';
                            }
                        </script>
                    @endforeach    
                </div>
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
			$("#detailTable{{ $borrow->id }}").DataTable({
			"responsive": true, "lengthChange": false, "autoWidth": false
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