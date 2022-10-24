@extends('layout.main')
@section('title', "Report Peringkat Buku")

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
							<a href="/report/borrow-ranks/set" class="btn btn-warning mr-1">Kembali <i class="far fa-arrow-alt-circle-left"></i></a>
							<form action="/borrow-rank-report" method="get" target="__blank">
								@csrf
								@if ($penulis != NULL)
									<input type="hidden" name="penulis" value="{{ $penulis }}">
								@endif
								@if ($kategori != NULL)
									<input type="hidden" name="kategori" value="{{ $kategori }}">
								@endif
								@if ($penerbit != NULL)
									<input type="hidden" name="penerbit" value="{{ $penerbit }}">
								@endif
								@if ($tahun_terbit != NULL)
									<input type="hidden" name="tahun_terbit" value="{{ $tahun_terbit }}">
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
								<th>ISBN</th>
								<th>Judul</th>
								<th>Penulis</th>
								<th>Kategori</th>
								<th>Penerbit</th>
								<th>Tahun Terbit</th>
								<th>Jumlah Peminjaman</th>
							</tr>
						</thead>
						<tbody>
							@foreach($borrowRanks as $item)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>
										{{ $item->isbn}}
									</td>
									<td>{{ $item->judul}}</td>
									<td>{{ $item->penulis }}</td>
									<td>{{ $item->kategori }}</td>
									<td>{{ $item->penerbit }}</td>
									<td>

										{{ Carbon\Carbon::parse($item->tglTerbit)->format('Y') }}
									</td>
									<td>
										{{ $item->count}}
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