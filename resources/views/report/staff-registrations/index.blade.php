@extends('layout.main')
@section('title', "Report Pendaftaran Staff")

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
							<a href="/report/staff-registrations/set" class="btn btn-warning mr-1">Kembali <i class="far fa-arrow-alt-circle-left"></i></a>
							<form action="/staff-registration-report" method="get" target="__blank">
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
								@if ($jenis_kelamin != NULL)
									<input type="hidden" name="jenis_kelamin" value="{{ $jenis_kelamin }}">
								@endif
								@if ($tahun_lahir != NULL)
									<input type="hidden" name="tahun_lahir" value="{{ $tahun_lahir }}">
								@endif
								<button type="submit" class="btn btn-success">Cetak <i class="fas fa-print"></i></button>
							</form>
						</div>
						
					</div>
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>NIP</th>
								<th>Nama</th>
								<th>Email</th>
								<th>Jenis Kelamin</th>
								<th>Tanggal Lahir</th>
								<th>Nomor Telepon</th>
								<th>Alamat</th>
								<th>Tanggal Pendaftaran</th>
								<th>Status</th>
								<th>Nama Admin</th>
							</tr>
						</thead>
						<tbody>
							@foreach($staffRegistrations as $staff)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>
										{{ $staff->nip }}
									</td>
									<td>{{ $staff->nama }}</td>
									<td>{{ $staff->email }}</td>
									<td>{{ $staff->jenis_kelamin }}</td>
									<td>{{ $staff->tanggal_lahir }}</td>
									<td>{{ $staff->nomor_telepon }}</td>
									<td>{{ $staff->alamat }}</td>
									<td>{{ $staff->created_at }}</td>
									<td>
										@if ($staff->status == 2)
											Diterima
										@elseif($staff->status == 3)
											Ditolak
										@else
											Menunggu persetujuan
										@endif
									</td>
									<td>
										{{ $staff->editor ? $staff->editor->nama : $staff->creator->nama}}
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