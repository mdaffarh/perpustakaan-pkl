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
                    <form action="/report/borrow-ranks" method="post">
                        @csrf
                        <div class="input-group">
                            <div class="form-floating mb-3" style="width: 50%;">
                                <label for="floatingInput3">Tanggal Awal</label>
                                <input name="tanggal_awal" type="date"  class="form-control" id="floatingInput3">
                            </div>
                            <div class="form-floating mb-3" style="width: 50%;">
                                <label for="floatingInput3">Tanggal Akhir</label>
                                <input name="tanggal_akhir" type="date" class="form-control" id="floatingInput3">
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="form-floating mb-3" style="width: 50%">
                                <label for="floatingInput3">Penulis</label>
                                <select name="penulis" id="" class="select2 form-control">
                                    <option value="" disabled selected></option>
                                    @foreach ($writters as $item)
                                        <option value="{{ $item->penulis }}">{{ $item->penulis }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-floating mb-3" style="width: 50%">
                                <label for="floatingInput3">Kategori</label>
                                <select name="kategori" id="" class="select2 form-control">
                                    <option value="" disabled selected></option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->kategori }}">{{ $item->kategori }}</option>
                                    @endforeach
                                </select>
                            </div>    
                        </div>
                        <div class="input-group">
                            <div class="form-floating mb-3" style="width: 50%">
                                <label for="floatingInput3">Penerbit</label>
                                <select name="penerbit" id="" class="select2 form-control">
                                    <option value="" disabled selected></option>
                                    @foreach ($publishers as $item)
                                        <option value="{{ $item->penerbit }}">{{ $item->penerbit }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-floating mb-3" style="width: 50%">
                                <label for="floatingInput3">Tahun Terbit</label>
                                <select name="tahun_terbit" id="" class="select2 form-control">
                                    <option value="" disabled selected></option>
                                    @foreach ($years as $item)
                                        <option value="{{ $item->year}}">{{ $item->year }}</option>
                                    @endforeach
                                </select>
                            </div>    
                        </div>
                        <label>Kosongkan jika ingin menampilan semua report</label>
                        <div class="input-group">
                            <button class="btn btn-success rounded me-1" type="submit">Submit</button>
                        </div>
                    </form>
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
		});
    </script>
@endsection