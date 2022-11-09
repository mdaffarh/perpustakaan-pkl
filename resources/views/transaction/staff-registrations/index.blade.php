@extends('layout.main')
@section('title', "Pendaftaran Staff")

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
											<form action="/transaction/staff-registrations/stores" method="post" enctype="multipart/form-data">
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
								<th>NIP</th>
								<th>Nama</th>
								<th>Jenis Kelamin</th>
								<th>Status</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($staffRegistration as $sr)
							<tr>
								<div class="modal fade" id="show{{ $sr->id }}">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title">Details</h4>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<form action="/table/staffRegistration/{{ $sr->id }}" method="post" enctype="multipart/form-data" class="p-4">
													@method('put')
													@csrf
													
													<div class="form-floating mb-3">
														<label for="floatingInput3">NIP</label>
														<input required name="nip" type="number" maxlength="11" required class="form-control" id="floatingInput3" value="{{ $sr->nip }}" disabled>
													</div>
													<div class="form-floating mb-3">
														<label for="floatingInput3">Nama</label>
														<input required name="nama" type="text" required class="form-control" id="floatingInput3" value="{{ $sr->nama }}" disabled>
													</div>
													<div class="form-floating mb-3">
														<label for="floatingInput3">Email</label>
														<input required name="email" type="text" required class="form-control" id="floatingInput3" value="{{ $sr->email }}" disabled>
													</div>
													<div class="form-floating mb-3">
														<label for="floatingInput3">Jenis Kelamin</label>
														<input required name="jenis_kelamin" type="text" required class="form-control" id="floatingInput3" value="{{ $sr->jenis_kelamin }}" disabled>
													</div>
													<div class="form-floating mb-3">
														<label for="floatingInput3">Tanggal Lahir</label>
														<input required name="tanggal_lahir" type="date" required class="form-control" id="floatingInput3" value="{{ $sr->tanggal_lahir }}" disabled>
													</div>
													<div class="form-floating mb-3">
														<label for="floatingInput3">Nomor Telepon</label>
														<input required name="nomor_telepon" type="text" required class="form-control" id="floatingInput3" value="{{ $sr->nomor_telepon }}" disabled>
													</div>
													<div class="form-floating mb-3">
														<label for="floatingInput3">Alamat</label>
														<textarea name="alamat" id="floatingInput3" cols="99" rows="3" disabled>{{ $sr->alamat }}</textarea>
													</div>
												
													
												</form>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
											</div>
										</div>
									</div>
								</div>
								<div class="modal fade" id="accept{{ $sr->id }}">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title">Terima Pendaftaran</h4>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<div class="form-floating mb-3">
													<label for="floatingInput3">NIP</label>
													<input required name="nis" type="number" maxlength="11" required class="form-control" id="floatingInput3" value="{{ $sr->nip }}" disabled>
												</div>
												<div class="form-floating mb-3">
													<label for="floatingInput3">Nama</label>
													<input required name="nama" type="text" required class="form-control" id="floatingInput3" value="{{ $sr->nama }}" disabled>
												</div>
												<div class="form-floating mb-3">
													<label for="floatingInput3">Email</label>
													<input required name="email" type="email" required class="form-control" id="floatingInput3" value="{{ $sr->email }}" disabled>
												</div>
												<div class="form-floating mb-3">
													<label for="floatingInput3">Jenis Kelamin</label>
													<input required name="jenis_kelamin" type="text" required class="form-control" id="floatingInput3" value="{{ $sr->jenis_kelamin }}" disabled>
												</div>
												<div class="form-floating mb-3">
													<label for="floatingInput3">Tanggal Lahir</label>
													<input required name="tanggal_lahir" type="date" required class="form-control" id="floatingInput3" value="{{ $sr->tanggal_lahir }}" disabled>
												</div>
												<div class="form-floating mb-3">
													<label for="floatingInput3">Nomor Telepon</label>
													<input required name="nomor_telepon" type="text" required class="form-control" id="floatingInput3" value="{{ $sr->nomor_telepon }}" disabled>
												</div>
												<div class="form-floating mb-3">
													<label for="floatingInput3">Alamat</label>
													<textarea name="alamat" id="floatingInput3" cols="99" rows="3" disabled>{{ $sr->alamat }}</textarea>
												</div>
												<div class="form-floating mb-3">
													<label for="floatingInput3">Tanggal Pendaftaran</label>
													<input class="form-control" id="floatingInput3" value="{{ $sr->created_at }}" disabled>
												</div>
													
												</form>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

												<!-- Form Jadikan staff -->
												<form action="/transaction/staff-registrations/approved/{sr->id}" method="post" enctype="multipart/form-data">
													@csrf
													<div style="display: none;">
														<input name="id" value="{{ $sr->id }}">
														<input name="nip" value="{{ $sr->nip }}">
														<input name="nama" value="{{ $sr->nama }}">
														<input name="email" value="{{ $sr->email }}">
														<input name="jenis_kelamin" value="{{ $sr->jenis_kelamin }}">
														<input name="tanggal_lahir" value="{{ $sr->tanggal_lahir }}">
														<input name="nomor_telepon" value="{{ $sr->nomor_telepon }}">
														<input name="alamat" value="{{ $sr->alamat }}">
														<input name="status" value="2">
													</div>
													<button class="btn btn-success rounded me-1" type="submit">Jadikan Staff</button>
												</form>
											</div>
										</div>
									</div>
								</div>
								<div class="modal fade" id="decline{{ $sr->id }}">
									<div class="modal-dialog modal-lg">
										<div class="modal-content">
											<div class="modal-header" style="border: none;">
												<h4 class="modal-title">Tolak Pendaftaran</h4>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<div class="form-floating mb-3">
													<label for="floatingInput3">NIP</label>
													<input required name="nis" type="number" maxlength="11" required class="form-control" id="floatingInput3" value="{{ $sr->nip }}" disabled>
												</div>
												<div class="form-floating mb-3">
													<label for="floatingInput3">Nama</label>
													<input required name="nama" type="text" required class="form-control" id="floatingInput3" value="{{ $sr->nama }}" disabled>
												</div>
												<div class="form-floating mb-3">
													<label for="floatingInput3">Email</label>
													<input required name="email" type="email" required class="form-control" id="floatingInput3" value="{{ $sr->email }}" disabled>
												</div>
												<div class="form-floating mb-3">
													<label for="floatingInput3">Jenis Kelamin</label>
													<input required name="jenis_kelamin" type="text" required class="form-control" id="floatingInput3" value="{{ $sr->jenis_kelamin }}" disabled>
												</div>
												<div class="form-floating mb-3">
													<label for="floatingInput3">Tanggal Lahir</label>
													<input required name="tanggal_lahir" type="date" required class="form-control" id="floatingInput3" value="{{ $sr->tanggal_lahir }}" disabled>
												</div>
												<div class="form-floating mb-3">
													<label for="floatingInput3">Nomor Telepon</label>
													<input required name="nomor_telepon" type="text" required class="form-control" id="floatingInput3" value="{{ $sr->nomor_telepon }}" disabled>
												</div>
												<div class="form-floating mb-3">
													<label for="floatingInput3">Alamat</label>
													<textarea name="alamat" id="floatingInput3" cols="99" rows="3" disabled>{{ $sr->alamat }}</textarea>
												</div>
												<div class="form-floating mb-3">
													<label for="floatingInput3">Tanggal Pendaftaran</label>
													<input class="form-control" id="floatingInput3" value="{{ $sr->created_at }}" disabled>
												</div>
													
												</form>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 

												<!-- Form tolak -->
												<form action="/transaction/staff-registrations/tolak/{id}" method="post" enctype="multipart/form-data">
													@csrf
													<div style="display: none;">
														<input required name="id" type="number" maxlength="11" required class="form-control" id="floatingInput3" value="{{ $sr->id }}">
														<input required name="status" value="3">
													</div>
													<button class="btn btn-danger rounded me-1" type="submit">Tolak Pengajuan</button>
												</form>
											</div>
										</div>
									</div>
								</div>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $sr->nip }}</td>
								<td>{{ $sr->nama }}</td>
								<td>{{ $sr->jenis_kelamin }}</td>
								<td>
									@if($sr->status=="1")
									<span class="badge badge-warning">menunggu persetujuan</span>
									@elseif($sr->status=="2")
									<span class="badge badge-success">Disetujui</span>
									@elseif($sr->status=="3")
									<span class="badge badge-danger">Ditolak</span>
									@endif
								</td>
								<td>
									
									<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">  
										{{-- Show --}}
										<button class="btn btn-warning   btn-sm btn-detail" type="button" data-toggle="modal" data-target="#show{{ $sr->id }}"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail">
											<i class="fas fa-eye "></i>
										</button>

										{{-- TERIMA --}}
										<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#accept{{ $sr->id }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Jadikan Anggota">
											<i class="fas fa-check"></i> 
										</button>		

										{{-- TOLAK --}}
										<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#decline{{ $sr->id }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tolak"> 
											<i class="fas fa-times"></i>
										</button>
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