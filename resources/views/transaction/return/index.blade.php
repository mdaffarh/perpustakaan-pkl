@extends('layout.main')
@section('title', "Peminjaman Buku")

@section('content')
	@include('sweetalert::alert')

	<div class="row">
		<div class="col">
			<div class="card card-outline-tabs">
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
                            <a class="nav-link active" id="tabs-stok-tab" data-toggle="pill" href="#tabs-stok" role="tab" aria-controls="tabs-stok" aria-selected="trues">Stok Buku</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" id="tabs-peminjaman-tab" data-toggle="pill" href="#tabs-peminjaman" role="tab" aria-controls="tabs-peminjaman" aria-selected="false">Status Peminjaman</a>
                            </li>
                        </ul>
                    @endcan
				</div>
			
				<div class="card-body">
                    {{-- Tampilan staff --}}
                    @can('staff')
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nama Peminjam</th>
                                    <th>No. Buku</th>
                                    <th>Judul Buku</th>
                                    <th>Penulis</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($borrows as $borrow)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $borrow->member->nama }}</td>
                                    <td>{{ $borrow->book->id }}</td>
                                    <td>{{ $borrow->book->judul }}</td>
                                    <td>{{ $borrow->book->penulis }}</td>
                                    <td>{{ $borrow->tanggal_pinjam }}</td>
                                    <td>{{ $borrow->status }}</td>
                                    <td>							
                
                                        {{-- Show --}}
                                        <a href="#show{{ $borrow->id }}" data-toggle="modal" class="btn btn-outline-success btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                            </svg>
                                        </a>
                                        
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
                                                      
                                                            <form action="" method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('put')
                                                                {{-- // member_id,book_id,staff_id,tanggal_pinjam,tanggal_tempo,school_id,deskrisi --}}
                                                                <div class="form-floating mb-3">
                                                                    <label for="floatingInput3">Nama Peminjam</label>
                                                                    <input required type="text" required class="form-control" id="floatingInput3" value="{{ $borrow->member->nama }}" disabled>
                                                                </div>
                                                                <div class="form-floating mb-3">
                                                                    <label for="floatingInput3">Judul Buku</label>
                                                                    <input required type="text" required class="form-control" id="floatingInput3" value="{{ $borrow->book->judul }}" disabled>
                                                                </div>
                                                                <div class="form-floating mb-3">
                                                                    <label for="floatingInput3">Tanggal Pinjam</label>
                                                                    <input required type="text" required class="form-control" id="floatingInput3" value="{{ $borrow->tanggal_pinjam }}" disabled>
                                                                </div>
                                                                <div class="form-floating mb-3">
                                                                    <label for="floatingInput3">Tanggal Tempo</label>
                                                                    <input required type="text" required class="form-control" id="floatingInput3" value="{{ $borrow->tanggal_tempo }}" disabled>
                                                                </div>

                                                            </form>
                         
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                                                        {{-- Pengembalian Buku --}}
                                                            <form action="/transaction/return" method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                <div style="display: none;">
                                                                    <input name="borrow_id" value="{{ $borrow->id }}">
                                                                    <input name="member_id" value="{{ $borrow->member->id }}">
                                                                </div>
                                                                <button class="btn btn-success rounded me-1" type="submit">Pengembalian Buku</button>
                                                            </form>
                                                        {{-- End Pengembalian Buku --}}

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
                    
				</div>
			</div>
		</div>
	</div>

	<script>

    
	$(function () {
		$("#example1").DataTable({
		"responsive": true, "lengthChange": false, "autoWidth": false,
		"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		// $('#example2').DataTable({
		//   "paging": true,
		//   "lengthChange": false,
		//   "searching": false,
		//   "ordering": true,
		//   "info": true,
		//   "autoWidth": false,
		//   "responsive": true,
		// });
	});

@endsection