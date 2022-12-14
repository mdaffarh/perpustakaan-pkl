@extends('layout.main')
@section('title', "Report Staff")

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
                    <form action="/report/staffs" method="post">
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

                        <div class="form-floating mb-3">
                            <label for="floatingInput3">User</label>
                            <select name="user" id="" class="select2 form-control">
                                <option value="" disabled selected></option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->signed }}">
                                        {{ $user->signed == 2 ? "Terdaftar" : "Tidak terdaftar" }}  
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-group">
                            <div class="form-floating mb-3" style="width: 50%;">
                                <label for="floatingInput3">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="" class="select2 form-control">
                                    <option value="" disabled selected></option>
                                    @foreach ($genders as $gender)
                                        <option value="{{ $gender->jenis_kelamin }}">{{ $gender->jenis_kelamin }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-floating mb-3" style="width: 50%;">
                                <label for="floatingInput3">Tahun Lahir</label>
                                <select name="tahun_lahir" id="" class="select2 form-control">
                                    <option value="" disabled selected></option>
                                    @foreach ($bornYears as $bornYear)
                                        <option value="{{ $bornYear->tahun_lahir }}">{{ $bornYear->tahun_lahir }}</option>
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