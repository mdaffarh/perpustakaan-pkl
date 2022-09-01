@extends('layout.main')
@section('title', "Pendaftaran Staff")

@section('content')
	@include('sweetalert::alert')

	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Pendaftaran Staff</h3>
				</div>
		
				<div class="card-body">
                    <form action="/transaction/staff-registrations" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-floating mb-3">
                            <label for="nip">NIP</label>
                            <input required name="nip" type="number"  required class="form-control @error('nip') is-invalid @enderror" id="nip" value="{{ old('nip') }}">
                            @error('nip')
								<div class="invalid-feedback">
									{{ $message }}
							    </div>
							@enderror							
                        </div>
                        <div class="form-floating mb-3">
                            <label for="nama">Nama</label>
                            <input required name="nama" type="text" required class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{ old('nama') }}">
                            @error('nama')
								<div class="invalid-feedback">
									{{ $message }}
							    </div>
							@enderror
                        </div>
                        <div class="form-floating mb-3">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-select form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" aria-label="Default select example" name="jenis_kelamin" required>
                                @if (old('jenis_kelamin') == "Laki-laki")
                                    <option value="" disabled></option>
                                    <option value="Laki-laki" selected>Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                @elseif (old('jenis_kelamin') == "Perempuan")
                                    <option value="" disabled></option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan" selected>Perempuan</option>
                                @else
                                    <option value="" selected disabled></option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                @endif
                            </select>
                            @error('jenis_kelamin')
								<div class="invalid-feedback">
									{{ $message }}
							    </div>
							@enderror
                        </div>
                        <div class="form-floating mb-3">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input required name="tanggal_lahir" type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                            @error('tanggal_lahir')
								<div class="invalid-feedback">
									{{ $message }}
							    </div>
							@enderror
                        </div>
                        <div class="form-floating mb-3">
                            <label for="nomor_telepon">Nomor Telepon</label>
                            <input required name="nomor_telepon" type="tel" maxlength="13" class="form-control @error('nomor_telepon') is-invalid @enderror" id="nomor_telepon" value="{{ old('nomor_telepon') }}">
                            @error('nomor_telepon')
								<div class="invalid-feedback">
									{{ $message }}
							    </div>
							@enderror
                        </div>
                        <div class="form-floating mb-3">
                            <label for="alamat">Alamat</label>
                            <input required name="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" value="{{ old('alamat') }}">
                            @error('alamat')
								<div class="invalid-feedback">
									{{ $message }}
							    </div>
							@enderror
                        </div>
                        <div class="form-floating mb-3">
                            <label for="email">Email</label>
                            <input required name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('') }}">
                            @error('email')
								<div class="invalid-feedback">
									{{ $message }}
							    </div>
							@enderror
                        </div>
                        <div class="input-group">
                            <button class="btn btn-success rounded me-1" type="submit">Submit</button>
                        </div>
                    </form>
                
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