@extends('layout.main')
@section('title', "Tabel Staff")

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
					<div>
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">Tambah Data</button>
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
											<form action="/table/staffs" method="post" enctype="multipart/form-data">
												@csrf
							
														{{-- NIP --}}
														<div class="form-floating mb-3">
															<label for="floatingInput3">NIP</label>
															<input required name="nip" type="number" maxlength="11" required class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip') }}" id="floatingInput3">
															@error('nip')
																<div class="invalid-feedback">
																	{{ $message }}
														</div>
															@enderror
														</div>
							
														<!-- nama input -->
														<div class="form-floating mb-3">
															<label for="floatingInput3">Nama</label>
															<input required name="nama" type="text"required class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" id="floatingInput3">
															@error('nama')
																<div class="invalid-feedback">
																	{{ $message }}
														</div>
															@enderror
														</div>
							
														<!-- email input -->
														<div class="form-floating mb-3">
															<label for="floatingInput3">Email</label>
															<input required name="email" type="email" required class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="floatingInput3">
															@error('email')
																<div class="invalid-feedback">
																	{{ $message }}
																</div>
															@enderror
														</div>
							
														<!-- Gender input -->
														<div class="form-floating mb-3">
															<label for="floatingInput3">Jenis Kelamin</label>
															<select class="form-select form-control" aria-label="Default select example" name="jenis_kelamin" required>
																<option value="" selected disabled></option>
																<option value="Laki-laki">Laki-laki</option>
																<option value="Perempuan">Perempuan</option>
															</select>
														</div>
														<!-- ttl input -->
														<div class="form-floating mb-3">
															<label for="floatingInput3">Tanggal Lahir</label>
															<input required name="tanggal_lahir" type="date" required class="form-control " value="{{ old('tanggal_lahir') }} " id="floatingInput3">
														</div>

														<!-- no telp input -->
														<div class="form-floating mb-3">
															<label for="floatingInput3">Nomor Telepon</label>
															<input required name="nomor_telepon" type="number"  required class="form-control @error('nomor_telepon') is-invalid @enderror" value="{{ old('nomor_telepon') }}" id="floatingInput3">
															@error('nomor_telepon')
																<div class="invalid-feedback">
																	{{ $message }}
														</div>
															@enderror
														</div>
														<!-- Alamat input -->
														<div class="mb-4">
															<label for="floatingInput3">Alamat</label>
															<textarea name="alamat" placeholder="Alamat" class="form-control"> {{ old('alamat') }}</textarea>
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
								<th>Nama</th>
								<th>Nomor Telepon</th>
								<th>Email</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($staffs as $staff)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $staff->nama }}</td>
								<td>{{ $staff->nomor_telepon }}</td>
								<td>{{ $staff->email }}</td>
								<td>
									<a href="#modalEditData{{ $staff->id }}" data-toggle="modal" class="btn btn-outline-info btn-sm">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583v4.43zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585 1.594-1.58zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006v-1.589z"></path><path d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2z"></path></svg>
									</a>
									
									<div class="modal fade" id="modalEditData{{ $staff->id }}">
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
														<form action="/table/staffs/{{ $staff->id }}" method="post" enctype="multipart/form-data">
															@method('put')
															@csrf
															
															<div class="form-floating mb-3">
																<label for="floatingInput3">NIP</label>
																<input required name="nip" type="number"  required class="form-control" id="floatingInput3" value="{{ $staff->nip }}">
															</div>
															<div class="form-floating mb-3">
																<label for="floatingInput3">Nama</label>
																<input required name="nama" type="text" required class="form-control" id="floatingInput3" value="{{ $staff->nama }}">
															</div>
															<div class="form-floating mb-3">
																<label for="floatingInput3">Jenis Kelamin</label>
																<select class="form-select form-control" aria-label="Default select example" name="jenis_kelamin" required>
																	<option value="" selected disabled></option>
																	<option value="Laki-laki" {{ $staff->jenis_kelamin == "Laki-laki" ? 'selected' : ''  }}>Laki-laki</option>
																	<option value="Perempuan" {{ $staff->jenis_kelamin == "Perempuan" ? 'selected' : ''  }}>Perempuan</option>
																</select>
															</div>
															<div class="form-floating mb-3">
																<label for="floatingInput3">Tanggal Lahir</label>
																<input required name="tanggal_lahir" type="date" required class="form-control" id="floatingInput3" value="{{ $staff->tanggal_lahir }}">
															</div>
															<div class="form-floating mb-3">
																<label for="floatingInput3">Nomor Telepon</label>
																<input required name="nomor_telepon" type="text" required class="form-control" id="floatingInput3" value="{{ $staff->nomor_telepon }}">
															</div>
															<div class="form-floating mb-3">
																<label for="floatingInput3">Alamat</label>
																<input required name="alamat" type="text" required class="form-control" id="floatingInput3" value="{{ $staff->alamat }}">
															</div>
															<div class="form-floating mb-3">
																<label for="floatingInput3">Email</label>
																<input required name="email" type="email" required class="form-control" id="floatingInput3" value="{{ $staff->email }}">
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
									<a href="#show{{ $staff->id }}" data-toggle="modal" class="btn btn-outline-success btn-sm">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;" class="bi bi-eye" viewBox="0 0 16 16">
											<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
											<path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
										</svg>
									</a>
									
									<div class="modal fade" id="show{{ $staff->id }}">
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
														<form action="/table/staffs/{{ $staff->id }}" method="post" enctype="multipart/form-data">
															@method('put')
															@csrf
															<div class="form-floating mb-3">
																<label for="floatingInput3">NIP</label>
																<input required name="nip" type="number"  required class="form-control" id="floatingInput3" value="{{ $staff->nip }}" disabled>
															</div>
															<div class="form-floating mb-3">
																<label for="floatingInput3">Nama</label>
																<input required name="nama" type="text" required class="form-control" id="floatingInput3" value="{{ $staff->nama }}" disabled>
															</div>
															<div class="form-floating mb-3">
																<label for="floatingInput3">Jenis Kelamin</label>
																<input required name="jenis_kelamin" type="text" required class="form-control" id="floatingInput3" value="{{ $staff->jenis_kelamin }}" disabled>
															</div>
															<div class="form-floating mb-3">
																<label for="floatingInput3">Tanggal Lahir</label>
																<input required name="tanggal_lahir" type="date" required class="form-control" id="floatingInput3" value="{{ $staff->tanggal_lahir }}" disabled>
															</div>
															<div class="form-floating mb-3">
																<label for="floatingInput3">Nomor Telepon</label>
																<input required name="nomor_telepon" type="text" required class="form-control" id="floatingInput3" value="{{ $staff->nomor_telepon }}" disabled>
															</div>
															<div class="form-floating mb-3">
																<label for="floatingInput3">Alamat</label>
																<input required name="alamat" type="text" required class="form-control" id="floatingInput3" value="{{ $staff->alamat }}" disabled>
															</div>
															<div class="form-floating mb-3">
																<label for="floatingInput3">Email</label>
																<input required name="email" type="email" required class="form-control" id="floatingInput3" value="{{ $staff->email }}" disabled>
															</div>
															@if ($staff->created_by)
																<div class="form-floating mb-3">
																	<label for="floatingInput3">Didaftarkan pada {{ $staff->created_at }} oleh {{ $staff->creator->nama }}</label>
																</div>
															@endif
															@if ($staff->updated_by)
																<div class="form-floating mb-3">
																	<label for="floatingInput3">Dieditkan pada {{ $staff->updated_at }} oleh {{ $staff->editor->nama }}</label>
																</div>
															@endif
														</form>
													</div>
												</div>
												<div class="modal-footer justify-content-between">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>
		
										<form action="/table/staffs/{{ $staff->id }}" method="POST" class="d-inline">
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