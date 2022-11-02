@extends('layout.main')
@section('title', "Informasi Buku")

@can('staff')
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
                        {{-- isbn judul penulis penerbit stok_semua stok_keluar --}}
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ISBN</th>
                                    <th>Judul</th>
                                    <th>Penulis</th>
                                    <th>Penerbit</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Stok Tersedia</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($books as  $book)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <button class="link-primary text-primary" type="button" id="detail{{ $book->id }}" onclick="showDetail{{  $book->id }}()" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail Buku" style="border: none; cursor: pointer; background-color:rgba(255,255,255,0);">
                                                {{  $book->isbn }}
                                            </button>
                                        </td>
                                        <td>{{  $book->judul }}</td>
                                        <td>{{ $book->penulis }}</td>
                                        <td>
                                            {{  $book->penerbit }}
                                        </td>
                                        <td>{{ $book->tglMasuk }}</td>
                                        <td>
                                         {{  $book->stock->stok_akhir }}
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                {{-- Show --}}
                                                <button class="btn btn-success   btn-sm btn-detail" type="button" data-toggle="modal" data-target="#showw{{  $book->id }}"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail Buku">
                                                    <i class="fas fa-eye "></i>
                                                </button>
                                                <div class="modal fade" id="showw{{  $book->id }}">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Informasi Buku</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="media">
                                                                    <div class="sq align-self-center ">
                                                                        @if ($book->image)
                                                                            <img src="{{ asset('storage/' . $book->image) }}" class="img-fluid  my-auto align-self-center mr-2 mr-md-4 pl-0 p-0 m-0" width="270" height="270">
                                                                        @else
                                                                            <img src="{{ asset("assets/img/book_cover_default.png") }}" class="img-fluid  my-auto align-self-center mr-2 mr-md-4 pl-0 p-0 m-0" width="270" height="270">
                                                                        @endif
                                                                    </div>
                                                                    <div class="media-body my-auto">
                                                                        <div class="row mx-md-n3">
                                                                            <div class="col px-md-5"><div class="p-2">ISBN</div></div>
                                                                            <div class="col px-md-5"><div class="p-2"><strong>: {{  $book->isbn }}</strong></div></div>
                                                                        </div>
                                                                        <div class="row mx-md-n3">
                                                                            <div class="col px-md-5"><div class="p-2">Judul</div></div>
                                                                            <div class="col px-md-5"><div class="p-2">: {{  $book->judul }}</div></div>
                                                                        </div>
                                                                        <div class="row mx-md-n3">
                                                                            <div class="col px-md-5"><div class="p-2">Penulis</div></div>
                                                                            <div class="col px-md-5"><div class="p-2">: 
                                                                                {{  $book->penulis }} 
                                                                            </div></div>
                                                                        </div>
                                                                        <div class="row mx-md-n3">
                                                                            <div class="col px-md-5"><div class="p-2">Penerbit</div></div>
                                                                            <div class="col px-md-5"><div class="p-2">: {{  $book->penerbit }}</div></div>
                                                                        </div>
        
                                                                        <div class="row mx-md-n3">
                                                                            <div class="col px-md-5"><div class="p-2">Kategori</div></div>
                                                                            <div class="col px-md-5"><div class="p-2">: {{  $book->kategori }}</div></div>
                                                                        </div>
        
                                                                        <div class="row mx-md-n3">
                                                                            <div class="col px-md-5"><div class="p-2">Tanggal Terbit</div></div>
                                                                            <div class="col px-md-5"><div class="p-2">: {{  $book->tglTerbit }}</div></div>
                                                                        </div>
        
                                                                        <div class="row mx-md-n3">
                                                                            <div class="col px-md-5"><div class="p-2">Tanggal Masuk</div></div>
                                                                            <div class="col px-md-5"><div class="p-2">: {{  $book->tglMasuk }}</div></div>
                                                                        </div>
        
                                                                        <div class="row mx-md-n3">
                                                                            <div class="col px-md-5"><div class="p-2">Stok Tersedia</div></div>
                                                                            <div class="col px-md-5"><div class="p-2">: {{  $book->stok_akhir }}</div></div>
                                                                        </div>
        
                                                                    </div>
                                                                </div>
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
                        {{-- Akhir tampilan staff --}} 

                    </div>

                    {{-- Tabel Detail --}}
                    <div class="card-body">
                        @foreach ($books as  $book)
                            <div class="detail-table" id="detailTable{{  $book->id }}" style="display: none;">
                                <div class="mb-2">
                                    <h5 class="d-inline">Detail Buku</h5>
                                </div>
                                {{-- member_id,isbn,judul,penulis,penerbit,kategori,
                                    tglTerbit,tglMasuk,keterangan,stock_masuk,image,staff_approved
                                    ,status,diambil,staffygngambil, --}}
                                <table id="detailTable" class="table table-bordered table-striped" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ISBN</th>
                                            <th>Judul</th>
                                            <th>Penulis</th>
                                            <th>Penerbit</th>
                                            <th>Kategori</th>
                                            <th>Tanggal Terbit</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Total Stok</th>
                                            <th>Stok Keluar</th>
                                            <th>Stok Tersedia</th>
                                        </tr>
                                    </thead>
                                    <tbody>    
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{  $book->isbn }}</td>
                                                <td>{{ $book->judul }}</td>
                                                <td>{{ $book->penulis }}</td>
                                                <td>{{ $book->penerbit }}</td>
                                                <td>{{ $book->kategori }}</td>
                                                <td>{{ $book->tglTerbit }}</td>
                                                <td>{{ $book->tglMasuk }}</td>
                                                <td>{{ $book->stock->stok_semua }}</td>
                                                <td>
                                                    @if ($book->stock->stok_keluar != NULL)
                                                        {{ $book->stock->stok_keluar }}
                                                    @else
                                                        0
                                                    @endif
                                                </td>
                                                <td>{{ $book->stock->stok_akhir }}</td>
                                            </tr>
                                    </tbody>
                                </table>   
                            </div>    
                            
                            <script>
                                function showDetail{{  $book->id }}(){
                                    const oldTable = document.querySelectorAll('.detail-table');
                                    oldTable.forEach(element => {
                                        element.style.display = 'none';
                                    });
                                    
                                    const table = document.querySelector('#detailTable{{  $book->id }}');
                                    table.style.display = 'block';
                                    table.scrollIntoView({
                                        behavior: 'smooth'
                                    });
                                }
                            </script>
                        @endforeach    
                    </div>
                    {{-- Akhir Tabel Detail --}}
                
                </div>
            </div>
        </div>

            <script>                    
                $(function () {
                    $("#example1").DataTable({
                        "paging": true,
                        "lengthChange": false,
                        "searching": true,
                        "ordering": true,
                        "info": true,
                        "autoWidth": false,
                        "responsive": true,
                    });
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
    @endsection 
@endcan