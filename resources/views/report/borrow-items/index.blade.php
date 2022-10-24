@extends('layout.main')
@section('title', "Report Histori Buku")

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
							<a href="/report/borrow-items/set" class="btn btn-warning mr-1">Kembali <i class="far fa-arrow-alt-circle-left"></i></a>
							<form action="/borrow-item-report" method="get" target="__blank">
								@csrf
								@if ($isbn != NULL)
									<input type="hidden" name="isbn" value="{{ $isbn }}">
								@endif
								@if ($judul != NULL)
									<input type="hidden" name="judul" value="{{ $judul }}">
								@endif
								@if ($kode_peminjaman != NULL)
									<input type="hidden" name="kode_peminjaman" value="{{ $kode_peminjaman }}">
								@endif
								@if ($member_id != NULL)
									<input type="hidden" name="member_id" value="{{ $member_id }}">
									<input type="hidden" name="nama" value="{{ $nama }}">
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
								<th>ISBN</th>
								<th>Judul</th>
								<th>Kode Peminjaman</th>
								<th>Nama Anggota</th>
								<th>Tanggal Pinjam</th>
								<th>Tanggal Kembali</th>
								<th>Status</th>
								<th>Nama Penjaga</th>
							</tr>
						</thead>
						<tbody>
							@foreach($borrowItems as $item)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>
										{{ $item->isbn}}
									</td>
									<td>{{ $item->judul}}</td>
									<td>{{ $item->kode_peminjaman }}</td>
									<td>{{ $item->member->nama }}</td>
									<td>{{ $item->tanggal_pinjam }}</td>
									<td>
										{{ $item->finished == 2 ? Carbon\Carbon::parse($item->updated_at)->format('Y-m-d') : '-'}}
									</td>
									<td>
										{{ $item->finished == 1 ? "Dipinjam" : "Selesai" }}
									</td>
									<td>
										{{ $item->updated_by ? $item->editor->nama : $item->creator->nama}}
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