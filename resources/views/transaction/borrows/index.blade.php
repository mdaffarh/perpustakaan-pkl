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
                    @can('member')
                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tabs-dipinjam-tab" data-toggle="pill" href="#tabs-dipinjam" role="tab" aria-controls="tabs-dipinjam" aria-selected="trues">Menunggu Persetujuan</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" id="tabs-disetujui-tab" data-toggle="pill" href="#tabs-disetujui" role="tab" aria-controls="tabs-disetujui" aria-selected="false">Disetujui</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tabs-selesai-tab" data-toggle="pill" href="#tabs-selesai" role="tab" aria-controls="tabs-selesai" aria-selected="false">Selesai</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tabs-ditolak-tab" data-toggle="pill" href="#tabs-ditolak" role="tab" aria-controls="tabs-ditolak" aria-selected="false">Ditolak</a>
                            </li>
                        </ul>
                    @endcan
                    @can('staff')
                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tabs-waiting-tab" data-toggle="pill" href="#tabs-waiting" role="tab" aria-controls="tabs-waiting" aria-selected="trues">Menunggu Persetujuan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tabs-pengambilan-buku-tab" data-toggle="pill" href="#tabs-pengambilan-buku" role="tab" aria-controls="tabs-pengambilan-buku" aria-selected="false">Pengambilan Buku</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tabs-rejected-tab" data-toggle="pill" href="#tabs-rejected" role="tab" aria-controls="tabs-rejected" aria-selected="false">Sedang Dipinjam</a>
                            </li>
                        </ul>
            					
                    @endcan
				</div>
			
				<div class="card-body">
                    {{-- Tampilan staff --}}
                    @can('staff')
                        @include('transaction.borrows.staff')
                    @endcan
                    {{-- Akhir tampilan staff --}} 

                    {{-- Tampilan anggota --}}
                    @can('member')
                        @include('transaction.borrows.member')
                    @endcan
                    {{-- Akhir tampilan anggota --}}

                    
				</div>
			</div>
		</div>
	</div>

    @can('staff')
        <script>
            function show_detail(borrow_id){
                $("#display_detail").show();
                $("#example1_detail").DataTable();
            }
            $('.btn-add-book').click(function () {
                $('.book-container').append(book())

                $(function () {
                    $('.select2').select2()
                });
            })
            $(document).on('click','.btn-delete-book',function(){
                $(this).closest('.book').remove()
            })
            function book(){
                return `<div class="input-group mt-1 book">
                            <select class="form-select form-control select2" aria-label="Default select example" name="book_id[]" required>
                                <option value="" selected disabled>Pilih Judul Buku - Penulis</option>
                                @foreach ($stocksAll as $stock)
                                    @if ($stock->stok_akhir > 0)
                                        <option value="{{ $stock->book->id }}">{{ $stock->book->judul }} - {{ $stock->book->penulis }} ( Stok : {{ $stock->stok_akhir }} )</option>
                                    @endif
                                @endforeach
                            </select>                                    
                            <button type="button" class="btn btn-sm btn-danger btn-delete-book">Hapus</button>
                        </div>`                    

            }
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