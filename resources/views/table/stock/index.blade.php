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
								<th>Nama Buku</th>
								<th>Penulis</th>
								<th>Stok Semua</th>
								<th>Stok Akhir</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($stocks as $stock)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $stock->book->judul }}</td>
								<td>{{ $stock->book->penulis }}</td>
								<td>{{ $stock->stok_semua }}</td>
								<td>{{ $stock->stok_akhir }}</td>
								<td>
									<a href="#modalEditData{{ $stock->id }}" data-toggle="modal" class="btn btn-outline-info btn-sm">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M15 2.013H9V9H2v6h7v6.987h6V15h7V9h-7z"></path></svg>
									</a>
									
									<div class="modal fade" id="modalEditData{{ $stock->id }}">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title">Tambah Stok</h4>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<div class="modal-body">
														<form action="/table/stocks/{{ $stock->id }}" method="post" enctype="multipart/form-data">
															@csrf
															@method('put')
															<div class="form-floating mb-3">
																<label for="floatingInput3">Buku</label>
																<select class="form-select form-control" aria-label="Default select example" name="book_id" required disabled="">
																@foreach($books as $book)
																@if ($stock->book_id == $book->id)
																	<option value="{{ $book->id }}" selected>{{ $book->judul }}</option>
																@else
																	<option value="{{ $book->id }}">{{ $book->judul }}</option>
																@endif
																@endforeach
																</select>
															</div>
															<div class="form-floating mb-3">
																<label for="floatingInput3">Stok Tambahan</label>
																<input name="stok_tambahan" type="number" class="form-control" id="floatingInput3">
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
		
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
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