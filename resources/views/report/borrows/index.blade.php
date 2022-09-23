@extends('layout.main')
@section('title', "Peminjaman Buku")

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
								<th>ISBN</th>
								<th>Judul Buku</th>
								<th>Penulis</th>
								<th>Tanggal Masuk</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach($books as $book)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $book->isbn }}</td>
								<td>{{ $book->judul }}</td>
								<td>{{ $book->penulis }}</td>
								<td>{{ $book->tglMasuk }}</td>
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