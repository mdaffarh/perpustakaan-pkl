@extends('layout.main')
@section('title', "Report Tabel Stok")

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
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Buku</th>
								<th>Penulis</th>
								<th>Awal Stok</th>
								<th>Total Stok</th>
								<th>Stok Tersedia</th>
								<th>Stok Pinjam</th>
								<th>Stok Hilang</th>
							</tr>
						</thead>
						<tbody>
							@foreach($stocks as $stock)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $stock->book->judul }}</td>
								<td>{{ $stock->book->penulis }}</td>
								<td>{{ $stock->stok_awal }}</td>
								<td>{{ $stock->stok_semua }}</td>
								<td>{{ $stock->stok_akhir }}</td>
								<td>
									@if ($stock->stok_keluar)
									{{ $stock->stok_keluar }}
									@else
									0
									@endif
								</td>
								<td>{{ $stock->stok_semua-$stock->stok_akhir}}</td>
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