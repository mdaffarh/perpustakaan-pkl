@extends('layout.main')
@section('title', "Pendaftaran Anggota")

@section('content')
	@include('sweetalert::alert')
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Data Pendaftaran Anggota</h3>
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
											<form action="/transaction/member-registrations/directStore" method="post" enctype="multipart/form-data">
												@csrf
												<div class="form-floating mb-3">
													<label for="floatingInput3">NIS</label>
													<input required name="nis" type="number" maxlength="11" required class="form-control" id="floatingInput3">
												</div>
												<div class="form-floating mb-3">
													<label for="floatingInput3">Nama</label>
													<input required name="nama" type="text" required class="form-control" id="floatingInput3">
												</div>
												<div class="form-floating mb-3">
													<label for="floatingInput3">Jenis Kelamin</label>
													<select class="form-select form-control" aria-label="Default select example" name="jenis_kelamin" required>
														<option value="" selected disabled></option>
														<option value="Laki-laki">Laki-laki</option>
														<option value="Perempuan">Perempuan</option>
													</select>
												</div>
												<div class="form-floating mb-3">
													<label for="floatingInput3">Kelas</label>
													<input required name="kelas" type="text" required class="form-control" id="floatingInput3">
												</div>
												<div class="form-floating mb-3">
													<label for="floatingInput3">Jurusan</label>
													<input required name="jurusan" type="text" required class="form-control" id="floatingInput3">
												</div>
												<div class="form-floating mb-3">
													<label for="floatingInput3">Tanggal Lahir</label>
													<input required name="tanggal_lahir" type="date" required class="form-control" id="floatingInput3">
												</div>
												<div class="form-floating mb-3">
													<label for="floatingInput3">Nomor Telepon</label>
													<input required name="nomor_telepon" type="text" required class="form-control" id="floatingInput3">
												</div>
												<div class="form-floating mb-3">
													<label for="floatingInput3">Alamat</label>
													<input required name="alamat" type="text" required class="form-control" id="floatingInput3">
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
								<th>Kelas</th>
								<th>Jurusan</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($memberRegistration as $member)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $member->nama }}</td>
								<td>{{ $member->kelas }}</td>
								<td>{{ $member->jurusan }}</td>
								<td>

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
														<form action="/table/memberRegistration/{{ $member->id }}" method="post" enctype="multipart/form-data">
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
																<input required name="jenis_kelamin" type="text" required class="form-control" id="floatingInput3" value="{{ $member->jenis_kelamin }}" disabled>
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
															@if ($member->created_by)
																<div class="form-floating mb-3">
																	<label for="floatingInput3">Didaftarkan pada {{ $member->created_at }} oleh {{ $member->creator->nama }}</label>
																</div>
															@endif
															@if ($member->updated_by)
																<div class="form-floating mb-3">
																	<label for="floatingInput3">Dieditkan pada {{ $member->updated_at }} oleh {{ $member->editor->nama }}</label>
																</div>
															@endif
															
														</form>
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<form action="/transaction/member-registrations/approved/{member-id}" method="post" enctype="multipart/form-data">
														@csrf
														<div style="display: none;">
															<input required name="id" type="number" maxlength="11" required class="form-control" id="floatingInput3" value="{{ $member->id }}">
															<input required name="nis" type="number" maxlength="11" required class="form-control" id="floatingInput3" value="{{ $member->nis }}">
															<input required name="nama" type="text" required class="form-control" id="floatingInput3" value="{{ $member->nama }}">
															<select class="form-select form-control" aria-label="Default select example" name="jenis_kelamin" required>
																<option value="" selected disabled></option>
																<option value="Laki-Laki" {{ $member->jenis_kelamin == "Laki-Laki" ? 'selected' : ''  }}>Laki-laki</option>
																<option value="Perempuan" {{ $member->jenis_kelamin == "Perempuan" ? 'selected' : ''  }}>Perempuan</option>
															</select>
															<input required name="kelas" type="text" required class="form-control" id="floatingInput3" value="{{ $member->kelas }}">
															<input required name="jurusan" type="text" required class="form-control" id="floatingInput3" value="{{ $member->jurusan }}">
															<input required name="tanggal_lahir" type="date" required class="form-control" id="floatingInput3" value="{{ $member->tanggal_lahir }}">
															<input required name="nomor_telepon" type="text" required class="form-control" id="floatingInput3" value="{{ $member->nomor_telepon }}">
															<input required name="alamat" type="text" required class="form-control" id="floatingInput3" value="{{ $member->alamat }}">
															<input required name="status" value="1">
														</div>
														<button class="btn btn-success rounded me-1" type="submit">Jadikan Anggota</button>
													</form>
													<form action="/transaction/member-registrations/tolak/{member-id}" method="post" enctype="multipart/form-data">
														@csrf
														<div style="display: none;">
															<input required name="id" type="number" maxlength="11" required class="form-control" id="floatingInput3" value="{{ $member->id }}">
															<input required name="status" value="2">
														</div>
														<button class="btn btn-danger rounded me-1" type="submit">Tolak Pengajuan</button>
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