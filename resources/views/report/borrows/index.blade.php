@extends('layout.main')
@section('title', "Report Peminjaman Buku")

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
							<a href="/report/borrows/set" class="btn btn-warning mr-1">Kembali <i class="far fa-arrow-alt-circle-left"></i></a>
							<form action="/borrow-report" method="get" target="__blank">
								@csrf
								@if ($member_id != NULL)
									<input type="hidden" name="member_id" value="{{ $member_id }}">
								@endif
								@if ($status != NULL)
									<input type="hidden" name="status" value="{{ $status }}">
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
								<th>Kode Pinjam</th>
								<th>NIS</th>
								<th>Nama Peminjam</th>
								<th>Tanggal Pinjam</th>
								<th>Tanggal Tempo</th>
								<th>Status</th>
								<th>Nama Penjaga</th>
							</tr>
						</thead>
						<tbody>
							@foreach($borrows as $borrow)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>
										{{ $borrow->kode_peminjaman }}
									</td>
									<td>{{ $borrow->member->nis }}</td>
									<td>{{ $borrow->member->nama }}</td>
									<td>{{ $borrow->tanggal_pinjam }}</td>
									<td>{{ $borrow->tanggal_tempo }}</td>
									<td>{{ $borrow->status }}</td>
									<td>
										@if ($borrow->editor)
											{{ $borrow->editor->nam }}
										@elseif($borrow->creator)
											{{ $borrow->creator->nama }}
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