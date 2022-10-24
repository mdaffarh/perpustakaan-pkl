@extends('layout.main')
@section('title', "Tabel Stok")

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
				</div>
		
				<div class="card-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>ISBN</th>
								<th>Nama Buku</th>
								<th>Penulis</th>
								{{-- <th>Stok Semua</th> --}}
								<th>Stok Tersedia</th>
								<th>Stok Yang Dipinjam</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($stocks as $stock)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>
									<button class="link-primary text-primary" type="button" id="detail{{ $stock->id }}" onclick="showDetail{{ $stock->id }}()" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail Stok" style="border: none; cursor: pointer; background-color:rgba(255,255,255,0);">
										{{ $stock->book->isbn }}
									</button>
								</td>
								<td>{{ $stock->book->judul }}</td>
								<td>{{ $stock->book->penulis }}</td>
								{{-- <td>{{ $stock->stok_semua }}</td> --}}
								<td><span class="badge badge-success">{{ $stock->stok_akhir}}</span></td>
								<td>
									@if ($stock->stok_keluar)
									<span class="badge badge-warning">{{ $stock->stok_keluar }}</span>
									@else
									<span class="badge badge-warning">0</span> 
									@endif
								</td>
								<td>
									<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
										

										{{-- Edit data --}}
										<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default{{ $stock->id }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail Stok">
											<i class="fas fa-pencil-alt"></i>
										</button>
										<div class="modal fade" id="modal-default{{ $stock->id }}">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title">Edit Stok Buku</h4>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<form action="/table/stocks/{{ $stock->id }}" method="post" enctype="multipart/form-data">
														<div class="modal-body">
															<div class="modal-body">
																@csrf
																@method('put')
																<div class="form-floating mb-3">
																	<label for="floatingInput3">ISBN</label>
																	<input disabled required name="isbn" type="text" required class="form-control" id="floatingInput3" value="{{ $stock->book->isbn }}">
																</div>
																<div class="form-floating mb-3">
																	<label for="floatingInput3">Nama Buku</label>
																	<input disabled required name="isbn" type="text" required class="form-control" id="floatingInput3" value="{{ $stock->book->judul }}">
																</div>
																<div class="form-floating mb-3">
																	<label for="floatingInput3">Stok Awal</label>
																	<input  name="stok_awal" type="number"  class="form-control" id="floatingInput3" value="{{ $stock->stok_awal }}">
																</div>
																<div class="form-floating mb-3">
																	<label for="floatingInput3">Stok Tersedia</label>
																	<input  name="stok_akhir" type="number"  class="form-control" id="floatingInput3" value="{{ $stock->stok_akhir }}">
																</div>
																<div class="form-floating mb-3">
																	<label for="floatingInput3">Stok Yang Dipinjam</label>
																	<input  name="stok_keluar" type="number"  class="form-control" id="floatingInput3" value="{{ $stock->stok_keluar }}">
																</div>
																<div class="form-floating mb-3">
																	<label for="floatingInput3">Semua Stok</label>
																	<input  name="stok_semua" type="number"  class="form-control" id="floatingInput3" value="{{ $stock->stok_semua }}">
																</div>
															</div>
														</div>	
														<div class="modal-footer">
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
															<button type="submit" class="btn btn-success">Edit Stok Buku</button>
														</div>
													</form>
												</div>
											</div>
										</div>               
						
										

										{{-- Tambah Stok --}}
										<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#tambah{{ $stock->id }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Penambahan Stok"> 
											<i class="fas fa-plus"></i>
										</button>
										<div class="modal fade" id="tambah{{ $stock->id }}">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header" style="border: none;">
														<h4 class="modal-title">Tambahan Stok</h4>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<form action="/table/stocks/plus" method="post" enctype="multipart/form-data">
														@csrf
														<div class="modal-body">
															<div class="form-floating mb-3" style="text-align: center;">
																<label for="floatingInput3">Stok yang akan Ditambahkan :</label>
																<input required name="stok_tambahan" type="text" class="form-control" id="floatingInput3">
																<input required hidden name="id" type="text" class="form-control" id="floatingInput3" value="{{ $stock->id }}">
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
															<button type="submit" class="btn btn-success">Tambah Stok</button>
														</div>
													</form>
												</div>
											</div>
										</div>

										{{-- Pengurangan Stok --}}
										<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#kurang{{ $stock->id }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Pengurangan Stok"> 
											<i class="fas fa-minus"></i>
										</button>
										<div class="modal fade" id="kurang{{ $stock->id }}">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header" style="border: none;">
														<h4 class="modal-title">Pengurangan Stok</h4>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div> 
													<form action="/table/stocks/minus" method="post" enctype="multipart/form-data">
														@csrf
														<div class="modal-body">
															<div class="form-floating mb-3" style="text-align: center;">
																<label for="floatingInput3">Stok Yang Akan Dikurangi :</label>
																<input required name="stok_kurang" type="number" required class="form-control" id="floatingInput3">
																<input type="text" value="{{ $stock->id }}" hidden name="id">
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
															<button type="submit" class="btn btn-danger">Kurangi Stok</button>
														</div>
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
				</div>
				<div class="card-body">
					@foreach ($stocks as $stock)
						<div class="detail-table" id="detailTable{{ $stock->id }}" style="display: none;">
							<div class="mb-2">
								<h5 class="d-inline">Detail Stok</h5>
							</div>
										
							{{-- Tabel Detail --}}
							<table id="detailTable" class="table table-bordered table-striped" >
								<thead>
									<tr>
										<th>No</th>
										<th>Judul Buku</th>
										{{-- <th>Stok Awal</th> --}}
										<th>Stok Total</th>
										<th>Stok Tersedia</th>
										<th>Stok Tambahan</th>
										<th>Stok Yang Dipinjam</th>
										<th>Stok Hilang</th>
										{{-- <th>Aksi</th> --}}
									</tr>
								</thead>
								<tbody>
										<tr>
											<td>{{ $loop->iteration }}</td>
											<td>{{ $stock->book->judul }}</td>
											{{-- <td>{{ $stock->stok_awal }}</td> --}}
											<td><span class="badge badge-primary">{{ $stock->stok_semua }}</span></td>
											<td><span class="badge badge-success">{{ $stock->stok_akhir}}</span></td>

											<td>
												@if ($stock->stok_tambahan == 0)
													<span class="badge badge-info">{{ $stock->stok_tambahan }}0</span>
												@elseif ($stock->stok_tambahan)
													<span class="badge badge-info">{{ $stock->stok_tambahan }}+</span>
												@endif
											</td>

											<td>
												@if ($stock->stok_keluar == 0)
													<span class="badge badge-warning">0</span>
												@elseif ($stock->stok_keluar)
													<span class="badge badge-warning">{{ $stock->stok_keluar }}</span>
												@endif
											</td>
											<td>
												@if($stock->stok_kurang == 0)
													<span class="badge badge-danger">0</span>
												@elseif($stock->stok_kurang)
													<span class="badge badge-danger">{{ $stock->stok_kurang}}</span>
												@endif
											</td>
											
										</tr>
								</tbody>
							</table>   
						</div>    
						
						<script>
							function showDetail{{ $stock->id }}(){
								const oldTable = document.querySelectorAll('.detail-table');
								oldTable.forEach(element => {
									element.style.display = 'none';
								});
								
								const table = document.querySelector('#detailTable{{ $stock->id }}');
								table.style.display = 'block';
								table.scrollIntoView({
									behavior: 'smooth'
								});
							}
						</script>
					@endforeach    
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
	</script>

@endsection