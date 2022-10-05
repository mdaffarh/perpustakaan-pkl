@extends('layout.main')
@section('title', "Pengembalian Buku")

@section('content')
	@include('sweetalert::alert')
	<div class="row">
		<div class="col">
			<div class="card">
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
                    {{-- Tampilan staff --}}
                    @can('staff')
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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($returns as  $return)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <button class="link-primary text-primary" type="button" id="detail{{  $return->borrow->id }}" onclick="showDetail{{  $return->borrow->id }}()" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail Peminjaman" style="border: none; cursor: pointer; background-color:rgba(255,255,255,0);">
                                                {{  $return->borrow->kode_peminjaman }}
                                            </button>
                                        </td>
                                        <td>{{  $return->borrow->member->nis }}</td>
                                        <td>{{  $return->borrow->member->nama }}</td>
                                        <td>{{  $return->borrow->tanggal_pinjam }}</td>
                                        <td>{{  $return->borrow->tanggal_tempo }}</td>
                                        <td>
                                            @if (Carbon\Carbon::parse( $return->borrow->tanggal_tempo)->diffInDays(Carbon\Carbon::now(),false) > 0)
                                                <span class="badge bg-danger">Telat ({{ Carbon\Carbon::parse( $return->borrow->tanggal_tempo)->diffInDays(Carbon\Carbon::now(),false) }} Hari)</span>
                                            @else
                                                <span class="badge bg-primary">Dalam Peminjaman</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                    <form action="/transaction/returns/detail/{{  $return->borrow->id }}" method="post" class="{{ Request::is('/transaction/return/detail/*') ? 'active' : '' }}">
                                                        @csrf
                                                        <div style="display: none;">
                                                            <input name="borrow_id" value="{{  $return->borrow->id }}">
                                                            <input name="member_id" value="{{  $return->borrow->member->id }}">
                                                        </div>
                                                        <button class="btn btn-success btn-sm" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Pengembalian Buku"><i class="fas fa-arrow-down"></i></button>
                                                    </form> 
                                                {{-- Show --}}
                                                <button class="btn btn-warning   btn-sm btn-detail" type="button" data-toggle="modal" data-target="#showw{{  $return->borrow->id }}"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail Peminjaman">
                                                    <i class="fas fa-eye "></i>
                                                </button>
                                                <div class="modal fade" id="showw{{  $return->borrow->id }}">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Pengembalian</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row mx-md-n3">
                                                                    <div class="col px-md-5"><div class="p-2">Kode Pinjam</div></div>
                                                                    <div class="col px-md-5"><div class="p-2"><strong>: {{  $return->borrow->kode_peminjaman }}</strong></div></div>
                                                                </div>
                                                                <div class="row mx-md-n3">
                                                                    <div class="col px-md-5"><div class="p-2">NIS</div></div>
                                                                    <div class="col px-md-5"><div class="p-2">: {{  $return->borrow->member->nis }}</div></div>
                                                                </div>
                                                                <div class="row mx-md-n3">
                                                                    <div class="col px-md-5"><div class="p-2">Nama</div></div>
                                                                    <div class="col px-md-5"><div class="p-2">: {{  $return->borrow->member->nama }}</div></div>
                                                                </div>
                                                                <div class="row mx-md-n3">
                                                                    <div class="col px-md-5"><div class="p-2">Kelas / Jurusan</div></div>
                                                                    <div class="col px-md-5"><div class="p-2">: {{  $return->borrow->member->kelas }} {{  $return->borrow->member->jurusan }}</div></div>
                                                                </div>
                                                                <div class="row mx-md-n3">
                                                                    <div class="col px-md-5"><div class="p-2">Tanggal Pinjam</div></div>
                                                                    <div class="col px-md-5"><div class="p-2">: {{  $return->borrow->tanggal_pinjam }}</div></div>
                                                                </div>
                                                                <div class="row mx-md-n3">
                                                                    <div class="col px-md-5"><div class="p-2">Tanggal Kembali</div></div>
                                                                    <div class="col px-md-5"><div class="p-2">: {{  $return->borrow->tanggal_tempo }}</div></div>
                                                                </div>
                                                                @if (Carbon\Carbon::parse( $return->borrow->tanggal_tempo)->diffInDays(Carbon\Carbon::now(),false) > 0)
                                                                    <div class="row mx-md-n3">
                                                                        <div class="col px-md-5"><div class="p-2">Status</div></div>
                                                                        <div class="col px-md-5"><div class="p-2"><strong>: Telat ({{ Carbon\Carbon::parse( $return->borrow->tanggal_tempo)->diffInDays(Carbon\Carbon::now(),false) }} Hari)</strong></div></div>
                                                                    </div>
                                                                    <div class="row mx-md-n3">
                                                                        <div class="col px-md-5"><div class="p-2">Denda</div></div>
                                                                        <div class="col px-md-5"><div class="p-2"><strong>: {{  Carbon\Carbon::parse( $return->borrow->tanggal_tempo)->diffInDays(Carbon\Carbon::now(),false) * 500 }}</strong></div></div>
                                                                    </div>
                                                                @else
                                                                    <div class="row mx-md-n3">
                                                                        <div class="col px-md-5"><div class="p-2">Status</div></div>
                                                                        <div class="col px-md-5"><div class="p-2"><strong>: {{  $return->borrow->status }}</strong></div></div>
                                                                    </div>
                                                                @endif
        
                                                                <hr>
                                                                <p class="px-4"><strong>Buku Yang Dipinjam :</strong></p>
                                                                <ol>
                                                                    <p style="display: none">{{ $outOfStock = 0}}</p>
                                                                    @foreach( $return->borrow->borrowItem as $bi)
                                                                        @if ($bi->book->stock->stok_akhir < 0)
                                                                            <p style="display: none">{{ $outOfStock = true }}</p> 
                                                                        @endif
                                                                        <li>
                                                                            <div class="row mx-md-n3">
                                                                                <div class="col px-md-5"><div class="p-2">{{ $bi->book->judul }}</div></div>
                                                                                <div class="col px-md-5"><div class="p-2">1</div></div>
                                                                            </div>
                                                                        </li>
                                                                    @endforeach
    
                                                                </ol>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                    
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>        
                    @endcan
                    {{-- Akhir tampilan staff --}} 

				</div>

                @can('staff')
                    {{-- Tabel Detail --}}
                    <div class="card-body">
                        @foreach ($returns as  $return)
                            <div class="detail-table" id="detailTable{{  $return->borrow->id }}" style="display: none;">
                                <div class="mb-2">
                                    <h5 class="d-inline">Detail Buku</h5>
                                </div>
                                            
                                {{-- Tabel Detail --}}
                                <table id="detailTable" class="table table-bordered table-striped" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Pinjam</th>
                                            <th>Judul</th>
                                            <th>Jumlah</th>
                                            <th>Stok</th>
                                            <th>Tanggal Tempo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $return->borrow->borrowItem as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{  $return->borrow->kode_peminjaman }}</td>
                                                <td>{{ $item->book->judul }}</td>
                                                <td>1</td>
                                                <td>{{ $item->book->stock->stok_akhir + 1 }}</td>
                                                <td>{{  $return->borrow->tanggal_tempo }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>   
                            </div>    
                            
                            <script>
                                function showDetail{{  $return->borrow->id }}(){
                                    const oldTable = document.querySelectorAll('.detail-table');
                                    oldTable.forEach(element => {
                                        element.style.display = 'none';
                                    });
                                    
                                    const table = document.querySelector('#detailTable{{  $return->borrow->id }}');
                                    table.style.display = 'block';
                                    table.scrollIntoView({
                                        behavior: 'smooth'
                                    });
                                }
                            </script>
                        @endforeach    
                    </div>
                    {{-- Akhir Tabel Detail --}}
                @endcan
            
			</div>
		</div>
	</div>

    @can('staff')
        <script>
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
			"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
			}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		});
        
        $(function () {
			$("#detailTable").DataTable({
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