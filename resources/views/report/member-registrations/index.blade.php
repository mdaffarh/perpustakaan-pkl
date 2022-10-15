@extends('layout.main')
@section('title', "Report Pendaftaran Anggota")

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
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">Ganti Tanggal</button>
						<div class="modal fade" id="modal-default">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div class="modal-header">
										<h4 class="modal-title">Ganti Tanggal</h4>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="modal-body">
											<form action="/report/borrows/set" method="post">
												@csrf
												<div class="form-floating mb-3">
													<label for="floatingInput3">Tanggal Awal</label>
													<input type="date" name="tanggal_awal" id="" class="form-control">
												</div>
												<div class="form-floating mb-3">
													<label for="floatingInput3">Tanggal Akhir</label>
													<input type="date" name="tanggal_akhir" id="" class="form-control">
												</div>
												<div class="input-group">
													<button class="btn btn-success rounded me-1" type="submit">Submit</button>
												</div>
											</form>
										</div>
									</div>
									<div class="modal-footer justify-content-between">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
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
							@foreach($members as $member)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $member->kode_peminjaman }}</td>
									<td>{{ $member->member->nis }}</td>
									<td>{{ $member->member->nama }}</td>
									<td>{{ $member->tanggal_pinjam }}</td>
									<td>{{ $member->tanggal_tempo }}</td>
									<td>{{ $member->status }}</td>
									<td>{{ $member->creator->nama }}</td>
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