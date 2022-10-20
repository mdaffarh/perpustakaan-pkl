@extends('layout.main')
@section('title', "Report Denda Peminjaman")

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
							<a href="/report/fines/set" class="btn btn-warning mr-1">Kembali <i class="far fa-arrow-alt-circle-left"></i></a>
							<form action="/fine-report" method="get" target="__blank">
								@csrf
								@if ($member_id != NULL)
									<input type="hidden" name="member_id" value="{{ $member_id }}">
								@endif
								@if ($days != NULL)
									<input type="hidden" name="days" value="{{ $days }}">
								@endif
								@if ($tanggal_awal != NULL)
									<input type="hidden" name="tanggal_awal" value="{{ $tanggal_awal }}">
								@endif
								@if ($tanggal_akhir != NULL)
									<input type="hidden" name="tanggal_akhir" value="{{ $tanggal_akhir }}">
								@endif
								<button type="submit" class="btn btn-success">Cetak <i class="fas fa-print"></i></button>
							</form>
						</div>
						
					</div>
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Kode Peminjaman</th>
								<th>NIS</th>
								<th>Nama Peminjam</th>
								<th>Tanggal Kembali</th>
								<th>Telat</th>
								<th>Denda</th>
								<th>Nama Penjaga</th>
							</tr>
						</thead>
						<tbody>
							@foreach($fines as $fine)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>
										{{ $fine->borrow->kode_peminjaman }}
									</td>
									<td>{{ $fine->member->nis }}</td>
									<td>{{ $fine->member->nama }}</td>
									<td>{{ $fine->tanggal_kembali }}</td>
									<td>{{ $fine->waktu_tenggat }}</td>
									<td>{{ $fine->total }}</td>
									<td>
										{{ $fine->editor ? $fine->editor->nama : $fine->creator->nama}}
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
			// $('#example1').DataTable({
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