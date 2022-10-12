@extends('layout.main')
@section('title', "Pendaftaran Anggota")

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
					<div class="py-3">
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">Tambah Data</button>
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
													<select class="form-select form-control select2" aria-label="Default select example" name="jenis_kelamin" required>
														<option value="" selected disabled></option>
														<option value="Laki-laki">Laki-laki</option>
														<option value="Perempuan">Perempuan</option>
													</select>
												</div>
												<div class="form-floating mb-3">
													<label for="floatingInput3">Kelas</label>
													<select class="form-select form-control select2" aria-label="Default select example" name="kelas" required>
														<option value="" selected disabled></option>
														<option value="10">10</option>
														<option value="11">11</option>
														<option value="12">12</option>
														<option value="13">13</option>
													</select>
												</div>
												<div class="form-floating mb-3">
													<label for="floatingInput3">Jurusan</label>
													<select class="form-select form-control select2" aria-label="Default select example" name="jurusan" required>
														<option value="" selected disabled></option>
														<option value="Sistem Informasi Jaringan dan Aplikasi">Sistem Informasi Jaringan dan Aplikasi</option>
														<option value="Multimedia">Multimedia</option>
														<option value="Rekaya Perangkat Lunak">Rekaya Perangkat Lunak</option>
														<option value="Desain Pemodelan dan Informasi Bangunan">Desain Pemodelan dan Informasi Bangunan</option>
														<option value="Teknik Pemesinan">Teknik Pemesinan</option>
														<option value="Teknik Fabrikasi Logam dan Manufaktur">Teknik Fabrikasi Logam dan Manufaktur</option>
														<option value="Teknik Kendaraan Ringan">Teknik Kendaraan Ringan</option>
														<option value="Bisnis Konstruksi dan Properti">Bisnis Konstruksi dan Properti</option>
														<option value="Teknik Otomasi Industri">Teknik Otomasi Industri</option>
														<option value="Teknik Komputer dan Jaringan">Teknik Komputer dan Jaringan</option>
													</select>
												</div>
												<div class="form-floating mb-3">
													<label for="floatingInput3">Tanggal Lahir</label>
													<input required name="tanggal_lahir" type="date" required class="form-control" id="floatingInput3">
												</div>
												<div class="form-floating mb-3">
													<label for="floatingInput3">Nomor Telepon</label>
													<input required name="nomor_telepon" type="text" required class="form-control" id="floatingInput3">
												</div>
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
								<th>Kelas</th>
								<th>Jurusan</th>
								<th>Status</th>
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
									@if($member->status=="0")
									<span class="badge badge-warning">menunggu persetujuan</span>
									@elseif($member->status=="1")
									<span class="badge badge-success">Disetujui</span>
									@elseif($member->status=="2")
									<span class="badge badge-danger">Ditolak</span>
									@endif
								</td>
								<td>
									
									<div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                   
										{{-- Show --}}
										<button class="btn btn-warning   btn-sm btn-detail" type="button" data-toggle="modal" data-target="#showw{{ $member->id }}"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail">
											<i class="fas fa-eye "></i>
										</button>
										<div class="modal fade" id="showw{{ $member->id }}">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title">Details</h4>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<form action="/table/memberRegistration/{{ $member->id }}" method="post" enctype="multipart/form-data" class="p-4">
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
														
															
														</form>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
													</div>
												</div>
											</div>
										</div>

										{{-- TERIMA --}}
										<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default{{ $member->id }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Jadikan Anggota"><i class="fas fa-check"></i> </button>
										<div class="modal fade" id="modal-default{{ $member->id }}">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title">Jadikan Anggota</h4>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<form action="/table/memberRegistration/{{ $member->id }}" method="post" enctype="multipart/form-data" class="p-4">
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
														
															
														</form>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

														<!-- Form Jadikan anggota -->
														<form action="/transaction/member-registrations/approved/{member-id}" method="post" enctype="multipart/form-data">
															@csrf
															<input hidden required name="id" type="number" maxlength="11" required class="form-control" id="floatingInput3" value="{{ $member->id }}">
															<input hidden required name="nis" type="number" maxlength="11" required class="form-control" id="floatingInput3" value="{{ $member->nis }}">
															<input hidden required name="nama" type="text" required class="form-control" id="floatingInput3" value="{{ $member->nama }}">
															<input hidden type="text" name="jenis_kelamin" id="" value="{{ $member->jenis_kelamin }}">
															<input hidden required name="kelas" type="text" required class="form-control" id="floatingInput3" value="{{ $member->kelas }}">
															<input hidden required name="jurusan" type="text" required class="form-control" id="floatingInput3" value="{{ $member->jurusan }}">
															<input hidden required name="tanggal_lahir" type="date" required class="form-control" id="floatingInput3" value="{{ $member->tanggal_lahir }}">
															<input hidden required name="nomor_telepon" type="text" required class="form-control" id="floatingInput3" value="{{ $member->nomor_telepon }}">
															<input hidden required name="alamat" type="text" required class="form-control" id="floatingInput3" value="{{ $member->alamat }}">
															<input hidden required name="status" value="1">
															<button class="btn btn-success" type="submit" title="Detail Peminjaman">Jadikan Anggota</i></button>
														</form>
													</div>
												</div>
											</div>
										</div>		

										{{-- TOLAK --}}
										<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $member->id }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tolak"> 
											<i class="fas fa-times"></i>
										</button>
										<div class="modal fade" id="delete{{ $member->id }}">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header" style="border: none;">
														<h4 class="modal-title">Edit Peminjaman</h4>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<form action="/table/memberRegistration/{{ $member->id }}" method="post" enctype="multipart/form-data" class="p-4">
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
														
															
														</form>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
														<!-- Form tolak -->
														<form action="/transaction/member-registrations/tolak/{member-id}" method="post" enctype="multipart/form-data">
															@csrf
															<input hidden required name="id" type="number" maxlength="11" required class="form-control" id="floatingInput3" value="{{ $member->id }}">
															<input hidden required name="status" value="2">
															<button class="btn btn-danger" type="submit">Tolak Pendaftaran</button>
														</form>
													</div>
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