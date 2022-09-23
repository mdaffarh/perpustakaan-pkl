@extends('layout.main')
@section('title', "Laporan Denda")

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

					{{-- Tabel --}}
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Kode Peminjaman</th>
								<th>Nama Peminjam</th>
								<th>Kelas</th>
								<th>Jurusan</th>
								<th>Tanggal Tempo</th>
								<th>Tanggal Pengembalian</th>
								<th>Tenggat Waktu</th>
                                <th>Denda</th>
							</tr>
						</thead>
						<tbody>
							@foreach($fines as $fine)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $fine->borrow->kode_peminjaman }}</td>
								<td>{{ $fine->borrow->member->nama }}</td>
								<td>{{ $fine->borrow->member->kelas }}</td>
								<td>{{ $fine->borrow->member->jurusan }}</td>
								<td>{{ $fine->borrow->tanggal_tempo }}</td>
								<td>{{ $fine->borrow->tanggal_kembali }}</td>
								<td>{{ $fine->waktu_tenggat }}</td>
								<td>{{ $fine->total }}</td>
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
			"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],

			
			
			}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		});
    </script>
@endsection