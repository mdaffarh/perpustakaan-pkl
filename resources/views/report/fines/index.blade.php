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
				<!-- Card body -->
                <div class="card-body">
					{{-- Tabel --}}
					<table id="example" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>Kode Peminjaman</th>
								<th>Nama Peminjam</th>
								<th>Kelas</th>
								<th>Jurusan</th>
								<th>Tanggal Tempo</th>
								<th>Tanggal Pengembalian</th>
								<th>Telat</th>
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
								<td>{{ $fine->borrow->return->tanggal_kembali }}</td>
								<td>{{ $fine->waktu_tenggat }} Hari</td>
								<td>{{ $fine->total }}</td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th>No</th>
								<th>Kode Peminjaman</th>
								<th>Nama Peminjam</th>
								<th>Kelas</th>
								<th>Jurusan</th>
								<th>Tanggal Tempo</th>
								<th>Tanggal Pengembalian</th>
								<th>Telat</th>
                                <th>Denda</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>


    <script>
        $(document).ready(function () {
			$('#example').DataTable({
				initComplete: function () {
					this.api()
						.columns()
						.every(function () {
							var column = this;
							var select = $('<select><option value=""></option></select>')
								.appendTo($(column.footer()).empty())
								.on('change', function () {
									var val = $.fn.dataTable.util.escapeRegex($(this).val());
		
									column.search(val ? '^' + val + '$' : '', true, false).draw();
								});
		
							column
								.data()
								.unique()
								.sort()
								.each(function (d, j) {
									select.append('<option value="' + d + '">' + d + '</option>');
								});
						});
				},
			});
		});
    </script>
@endsection