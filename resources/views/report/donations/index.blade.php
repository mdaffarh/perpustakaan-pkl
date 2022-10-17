@extends('layout.main')
@section('title', "Report Sumbangan Buku")

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
                    <div class="card card-info collapsed-card">
                        <div class="card-header">
                            <h5 class="card-title font-weight-bold">Filtering Table</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body" style="display: none;">
                            <div>
                                <h6 class="d-flex justify-content-center font-weight-bold mb-3">Flter tanggal sumbangan</h6>
                                <div class="form-group row">
                                    <div class="col-sm-6 row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">start date</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" id="inputEmail3" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 row">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">end date</label>
                                        <div class="col-sm-9">
                                            <input type="date" class="form-control" id="inputEmail3" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label for="inputPassword3" class="col-sm-2 col-form-label">status</label>
                                <div class="col-sm-10">
                                    <select name="" id="" class="form-control">
                                        <option disabled selected>Status sumbangan</option>
                                        <option value="">Menunggu Persetujuan</option>
                                        <option value="">Sudah Disetujui</option>
                                        <option value="">Sudah Serah Terima</option>
                                        <option value="">Ditolak</option>
                                        <option value="">Dicancel</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-info">filter</button>
                            </div>
                        </div>
                    </div>

                    <!-- Table -->
					<table id="example1" class="table table-bordered mt-4">
						<thead>
							<tr>
								<th rowspan="2">No</th>
								<th rowspan="2">Kode Sumbangan</th>
								<th rowspan="2">NIS</th>
								<th rowspan="2">Nama Penyumbang</th>
								<th rowspan="2">Kelas</th>
								<th rowspan="2">Jurusan</th>
								<th rowspan="2">No Telp</th>
								<th colspan="3">Buku Yang Disumbangkan</th>
							</tr>
                            <tr>
                                <th>ISBN</th>
                                <th>Judul</th>
                                <th>Qty</th>
                            </tr>
						</thead>
						<tbody>
                            @php
                                $rowid = 0;
                                $rowspan = 0;
                            @endphp
                            @foreach($donations as $key => $donation)
                                @php
                                    $rowspan = $donation->bookDonation->count();
                                @endphp
                                <tr>
                                    <td rowspan="{{ $rowspan }}">{{ $loop->iteration }}</td>
                                    <td rowspan="{{ $rowspan }}">{{ $donation->kode_sumbangan }}</td>
                                    <td rowspan="{{ $rowspan }}">{{ $donation->member->nis }}</td>
                                    <td rowspan="{{ $rowspan }}">{{ $donation->member->nama }}</td>
                                    <td rowspan="{{ $rowspan }}">{{ $donation->member->kelas }}</td>
                                    <td rowspan="{{ $rowspan }}">{{ $donation->member->jurusan }}</td>
                                    <td rowspan="{{ $rowspan }}">{{ $donation->member->nomor_telepon }}</td>
                                    @foreach($donation->bookDonation as $bukuDonasi)
                                    <td>{{ $bukuDonasi->isbn }}</td>
                                    <td>{{ $bukuDonasi->judul }}</td>
                                    <td>{{ $bukuDonasi->stok_masuk }}</td>
                                    @if ($rowspan != 0)
                                    </tr>
                                    @endif
                                @endforeach
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