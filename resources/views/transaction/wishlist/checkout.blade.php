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
				<div class="card-header" style="border: none;">
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
                
                    <div class="px-4">
                        <h5 class="text-uppercase">{{ $nama }}</h5>
                        <span class="theme-color">Detail peminjaman</span>
                        <hr>
                        <br>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted">Buku</span>
                            <span class="text-muted">Quantity</span>
                        </div>
                        @foreach($wishlists as $co)
                        <div class="d-flex justify-content-between">
                            <span class="font-weight-bold">{{ $co->book->judul }}</span>
                            <span class="font-weight-bold">1</span>
                        </div>
                        @endforeach
                        
                        <form action="/transaction/borrows" method="post" class="py-5">
                            @csrf
                            @foreach($wishlists as $co)
                            <input hidden name="wishlist_id[]" value="{{ $co->id }}">
                            <input hidden name="book_id[]" value="{{ $co->book_id }}">
                            @endforeach
                            
                            <div class="offset-lg-7">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div style="background-color: grey;color:white;" class="input-group-text">Tanggal Pinjam</div>
                                    </div>
                                    <input type="date" name="tanggal_pinjam" class="form-control" id="tanggalpinjam" placeholder="Username">
                                </div>
                            </div>
                            
                            <div class="text-center mt-5 py-2">
                                <button class="btn btn-primary" type="submit"><strong>Pinjam</strong></button>
                            </div>         
                        </form>          

                    </div>
                </div>
			</div>
		</div>
	</div>

    <script>
        $('input[type=date]').on('change', function(evt) {
            var tanggalkembali = 3 ;
            var hariKedepan = new Date(new Date().getTime()+(inputHari*24*60*60*1000));
            document.getElementById("demo").innerHTML = "<b>" + nama +"</b>";
            $("#anjing").html("<button type='submit' class='btn btn-outline-success'>Pinjam " + n + " Buku</button>");
        });
    </script>

@endsection
