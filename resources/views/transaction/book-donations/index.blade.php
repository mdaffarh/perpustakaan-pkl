@extends('layout.main')
@section('title', "Donasi Buku")

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
                    @can('staff')
                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tabs-waiting-tab" data-toggle="pill" href="#tabs-waiting" role="tab" aria-controls="tabs-waiting" aria-selected="trues">Menunggu Persetujuan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tabs-pengambilan-buku-tab" data-toggle="pill" href="#tabs-pengambilan-buku" role="tab" aria-controls="tabs-pengambilan-buku" aria-selected="false">Serah Terima Buku</a>
                            </li>
                        </ul>
            					
                    @endcan
				</div>
			
				<div class="card-body">
                    {{-- Tampilan staff --}}
                    @can('staff')
                        @include('transaction.book-donations.idxStaff')
                    @endcan
                    {{-- Akhir tampilan staff --}} 

                    {{-- Tampilan anggota --}}
                    @can('member')
                        @include('transaction.book-donations.idxMember')
                    @endcan
                    {{-- Akhir tampilan anggota --}}

                    
				</div>
			</div>
		</div>
	</div>

    @can('staff')
        <script>
            
            $(function () {
                $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            });

        </script>

    @endcan

    @can('member')
        <script>
            $(function () {
                $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false
                });
            });
        </script>        
    @endcan

@endsection