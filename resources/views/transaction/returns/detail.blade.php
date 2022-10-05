@extends('layout.main')
@section('title', "Details")

@section('content')
@include('sweetalert::alert')
    <style>
        .theme-color{

            color: #004cb9;
        }
    </style>

	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-header" style=" border: none;">
					<div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
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
                    <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i> </div>
                    
                    @foreach($borrowed as $b)
                        <div class="px-4">
                            <h5 class="text-uppercase">{{ $nama_borrow }}</h5>
                            <span class="font-weight-bold">Nis : {{ $b->member->nis }}</span> <br>
                            <span class="font-weight-bold">Kelas / Jurusan : {{ $b->member->kelas }} {{ $b->member->jurusan }}</span> <br>
                            <span class="font-weight-bold">Kode Pinjam : {{ $b->kode_peminjaman }}</span> <br>
                            <hr>
                            <div class="row mx-md-n3">
                                <div class="col px-md-5"><div class="p-2">Tanggal Pinjam</div></div>
                                <div class="col px-md-5"><div class="p-2">: {{ $tanggal_pinjam }}</div></div>
                            </div>
                            <div class="row mx-md-n3">
                                <div class="col px-md-5"><div class="p-2">Tanggal Tempo</div></div>
                                <div class="col px-md-5"><div class="p-2">: {{ $tanggal_tempo->toFormattedDateString() }}</div></div>
                            </div>
                            <div class="row mx-md-n3">
                                <div class="col px-md-5"><div class="p-2">Tanggal Sekarang</div></div>
                                <div class="col px-md-5"><div class="p-2">: {{ $now->toFormattedDateString() }}</div></div>
                            </div>
                            <div class="row mx-md-n3">
                                <div class="col px-md-5"><div class="p-2">Telat Pengembalian</div></div>
                                <div class="col px-md-5">
                                    <div class="p-2">
                                        @if ($selisih > 0)
                                            : {{ $selisih }} Hari
                                        @else 
                                            : 0 Hari
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row mx-md-n3">
                                <div class="col px-md-5"><div class="p-2">Denda</div></div>
                                <div class="col px-md-5"><div class="p-2">: {{ $denda }},00</div></div>
                            </div>
                            <br>
                                <h6 class="font-weight-bold">Buku Yang Di Pinjam : </h6>
                                <ol>
                                    @foreach($b->borrowItem as $bi)
                                    <li>
                                        <div class="row mx-md-n3">
                                            <div class="col px-md-5"><div class="p-2">{{ $bi->book->judul }}</div></div>
                                            <div class="col px-md-5"><div class="p-2">1</div></div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ol>
                        
                        </div>
                        <form action="/transaction/returnBook/{{ $b->id }}" method="post" class="py-5">
                            @csrf
                            <input name="borrow_id" hidden value="{{ $b->id }}">
                            <input name="member_id" hidden value="{{ $b->member->id }}">
                            
                            <div class="text-center mt-5 py-2">
                                <button class="btn btn-primary" type="submit"><strong>Buku Dikembalikan</strong></button>
                            </div>         
                        </form>     
                    @endforeach
                </div>
			</div>
		</div>
	</div>


@endsection
