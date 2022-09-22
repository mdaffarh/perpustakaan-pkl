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
                    
			</div>
		</div>
	</div>
@endsection