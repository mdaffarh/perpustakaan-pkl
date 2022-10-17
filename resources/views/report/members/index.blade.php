@extends('layout.main')
@section('title', "Report Anggota")

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
				</div>                    
                <div class="card-body">
					<div class="">
						<div class="btn-group">
							<a href="/report/member-registrations/set" class="btn btn-warning mr-1">Kembali <i class="far fa-arrow-alt-circle-left"></i></a>
							<form action="/member-report" method="get" target="__blank">
								@csrf
								@if ($tanggal_awal != NULL)
								<input type="hidden" name="tanggal_awal" value="{{ $tanggal_awal }}">
								@endif
								@if ($tanggal_akhir != NULL)
								<input type="hidden" name="tanggal_akhir" value="{{ $tanggal_akhir }}">
								@endif
								@if ($status != NULL)
								<input type="hidden" name="status" value="{{ $status }}">
								@endif
								@if ($kelas != NULL)
									<input type="hidden" name="kelas" value="{{ $kelas }}">
								@endif
								@if ($jurusan != NULL)
									<input type="hidden" name="jurusan" value="{{ $jurusan }}">
								@endif
								@if ($jenis_kelamin != NULL)
									<input type="hidden" name="jenis_kelamin" value="{{ $jenis_kelamin }}">
								@endif
								@if ($tahun_lahir != NULL)
									<input type="hidden" name="tahun_lahir" value="{{ $tahun_lahir }}">
								@endif
								@if ($user != NULL)
									<input type="hidden" name="user" value="{{ $user }}">
								@endif
								<button type="submit" class="btn btn-success">Cetak <i class="fas fa-print"></i></button>
							</form>
						</div>
						
					</div>
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>NIS</th>
								<th>Nama</th>
								<th>Jenis Kelamin</th>
								<th>Kelas</th>
								<th>Jurusan</th>
								<th>Tanggal Lahir</th>
								<th>Alamat</th>
								<th>Status</th>
								<th>User</th>
								<th>Terdaftar</th>
								<th>Nama Penjaga</th>
							</tr>
						</thead>
						<tbody>
							@foreach($members as $member)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>
										{{ $member->nis }}
									</td>
									<td>{{ $member->nama }}</td>
									<td>{{ $member->jenis_kelamin }}</td>
									<td>{{ $member->kelas }}</td>
									<td>{{ $member->jurusan }}</td>
									<td>{{ $member->tanggal_lahir }}</td>
									<td>{{ $member->alamat }}</td>
									<td>
										{{ $member->status == 1 ? "Aktif" : "Nonaktif" }}
									</td>
									<td>
										{{ $member->signed == 1 ? "Terdaftar" : "Tidak" }}
									</td>
									<td>{{ $member->created_at }}</td>
									<td>
										{{-- {{ $member->editor ? $member->editor->nama : $member->creator->nama}} --}}
										@if ($member->editor)
											{{ $member->editor->nama }}
										@elseif($member->creator)
											{{ $member->creator->nama }}
										@else
											-
										@endif
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
				"paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
			});
		});
    </script>
@endsection