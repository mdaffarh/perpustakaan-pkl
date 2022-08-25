@extends('layout.main')
@section('title', "Tabel Stok")

@section('content')
	@include('sweetalert::alert')

	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Stok Buku</h3>
				</div>
		
				<div class="card-body">
					<div>
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">Tambah Buku</button>
						<div class="modal fade" id="modal-default">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title">Tambah Data</h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="modal-body">
											<form action="/table/stocks" method="post" enctype="multipart/form-data">
												@csrf
												<div class="form-floating mb-3">
													<label for="floatingInput3">Buku</label>
													<select class="form-select form-control" aria-label="Default select example" name="book_id" required>
														<option value="" selected disabled><-- Select Buku --></option>
														@foreach($books as $book)
														<option value="{{ $book->id }}">{{ $book->judul }}</option>
														@endforeach
													</select>
												</div>
												<div class="form-floating mb-3">
													<label for="floatingInput3">Stok Awal</label>
													<input required name="stokAwal" type="number" required class="form-control" id="floatingInput3">
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
					</div>
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Buku</th>
								<th>Penulis</th>
								<th>Stok Awal</th>
								<th>Stok Akhir</th>
							</tr>
						</thead>
						<tbody>
							@foreach($stocks as $stock)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $stock->book->judul }}</td>
								<td>{{ $stock->book->penulis }}</td>
								<td>{{ $stock->stok_awal }}</td>
								<td>{{ $stock->stok_akhir }}</td>
								<td>
									<a href="#modalEditData{{ $stock->id }}" data-toggle="modal" class="btn btn-outline-info btn-sm">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583v4.43zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585 1.594-1.58zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006v-1.589z"></path><path d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2z"></path></svg>
									</a>
									
									<div class="modal fade" id="modalEditData{{ $stock->id }}">
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
														<form action="/table/stocks/{$stock->id}" method="post" enctype="multipart/form-data">
															@csrf
															@method('put')
															<div class="form-floating mb-3">
																<label for="floatingInput3">Buku</label>
																<select class="form-select form-control" aria-label="Default select example" name="book_id" required>
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
		
		
									<a href="">
		
										<form action="/table/stock/{{ $stock->id }}" method="POST" class="d-inline">
											@method('delete')
											@csrf
											<button type="submit" onclick="return confirm('Sure?')" class="btn btn-outline-danger btn-sm">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm4 12H8v-9h2v9zm6 0h-2v-9h2v9zm.618-15L15 2H9L7.382 4H3v2h18V4z"></path></svg>
											</button>
										</form>
										
									</a>
		
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