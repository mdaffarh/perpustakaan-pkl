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
                    <form action="/report/borrow-items" method="post">
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
                                <label for="floatingInput3">ISBN</label>
                                <select name="isbn" id="" class="select2 form-control">
                                    <option value="" disabled selected></option>
                                    @foreach ($books as $book)
                                        <option value="{{ $book->book->isbn }}">{{ $book->book->isbn }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-floating mb-3" style="width: 50%">
                                <label for="floatingInput3">Judul</label>
                                <select name="judul" id="" class="select2 form-control">
                                    <option value="" disabled selected></option>
                                    @foreach ($books as $book)
                                        <option value="{{ $book->book->judul }}">{{ $book->book->judul }}</option>
                                    @endforeach
                                </select>
                            </div>    
                        </div>
                        <div class="input-group">
                            <div class="form-floating mb-3" style="width: 50%">
                                <label for="floatingInput3">Kode Peminjaman</label>
                                <select name="kode_peminjaman" id="" class="select2 form-control">
                                    <option value="" disabled selected></option>
                                    @foreach ($borrows as $borrow)
                                        <option value="{{ $borrow->kode_peminjaman }}">{{ $borrow->kode_peminjaman }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-floating mb-3" style="width: 50%">
                                <label for="floatingInput3">Nama Anggota</label>
                                <select name="member_id" id="" class="select2 form-control">
                                    <option value="" disabled selected></option>
                                    @foreach ($members as $member)
                                        <option value="{{ $member->member->id }}">{{ $member->member->nama }}</option>
                                    @endforeach
                                </select>
                            </div>    
                        </div>
                        <div class="form-floating mb-3">
                            <label for="floatingInput3">Status</label>
                            <select name="status" id="" class="select2 form-control">
                                <option value="" disabled selected></option>
                                @foreach ($status as $stat)
                                    <option value="{{ $stat->finished }}">{{ $stat->finished == 2 ? 'Selesai' : 'Dipinjam' }}</option>
                                @endforeach
                            </select>
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