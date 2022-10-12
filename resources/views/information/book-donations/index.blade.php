@extends('layout.main')
@section('title', "Informasi Sumbangan Buku")

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
                        {{-- member_id,isbn,judul,penulis,penerbit,kategori,
                        tglTerbit,tglMasuk,keterangan,stock_masuk,image,staff_approved
                        ,status,diambil,staffygngambil, --}}
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Anggota</th>
                                    <th>ISBN</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Keterangan</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                    <th>Nama Penjaga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookDonations as  $bookDonation)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $bookDonation->member->nama  }}</td>
                                        <td>
                                            <button class="link-primary text-primary" type="button" id="detail{{ $bookDonation->id }}" onclick="showDetail{{  $bookDonation->id }}()" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail Buku" style="border: none; cursor: pointer; background-color:rgba(255,255,255,0);">
                                                {{  $bookDonation->isbn }}
                                            </button>
                                        </td>
                                        <td>{{  $bookDonation->tglMasuk }}</td>
                                        <td>
                                            @if ($bookDonation->keterangan)
                                                {{  $bookDonation->keterangan }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            {{  $bookDonation->stock_masuk }}
                                        </td>
                                        <td>
                                            @if ($bookDonation->status == "menunggu persetujuan")
                                                <div class="badge badge-warning text-capitalize">{{  $bookDonation->status }}</div>
                                            @elseif($bookDonation->status == "disetujui" && $bookDonation->diambil != "Sudah")
                                                <div class="badge badge-primary text-capitalize">{{  $bookDonation->status }}</div>    
                                            @elseif($bookDonation->status == "disetujui" && $bookDonation->diambil == "Sudah")
                                                <div class="badge badge-success text-capitalize">Selesai</div> 
                                            @elseif($bookDonation->status == "ditolak")
                                                <div class="badge badge-danger text-capitalize">{{  $bookDonation->status }}</div> 
                                            @endif
                                        </td>
                                        <td>
                                            @if ($bookDonation->staffygngambil == NULL && $bookDonation->staff_approved == NULL)
                                                -
                                            @elseif($bookDonation->staffygngambil == NULL )
                                                {{ $bookDonation->creator->nama }}
                                            @else
                                                {{  $bookDonation->editor->nama }}    
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                {{-- Show --}}
                                                <button class="btn btn-warning   btn-sm btn-detail" type="button" data-toggle="modal" data-target="#showw{{  $bookDonation->id }}"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail Sumbangan">
                                                    <i class="fas fa-eye "></i>
                                                </button>
                                                <div class="modal fade" id="showw{{  $bookDonation->id }}">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Sumbangan Buku</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row mx-md-n3">
                                                                    <div class="col px-md-5"><div class="p-2">Nama Anggota</div></div>
                                                                    <div class="col px-md-5"><div class="p-2"><strong>: {{  $bookDonation->member->nama }}</strong></div></div>
                                                                </div>
                                                                <div class="row mx-md-n3">
                                                                    <div class="col px-md-5"><div class="p-2">Tanggal Masuk</div></div>
                                                                    <div class="col px-md-5"><div class="p-2">: {{  $bookDonation->tglMasuk }}</div></div>
                                                                </div>
                                                                <div class="row mx-md-n3">
                                                                    <div class="col px-md-5"><div class="p-2">Keterangan</div></div>
                                                                    <div class="col px-md-5"><div class="p-2">: 
                                                                        @if ($bookDonation->keterangan)
                                                                            {{  $bookDonation->keterangan }}
                                                                        @else
                                                                            -
                                                                        @endif    
                                                                    </div></div>
                                                                </div>
                                                                <div class="row mx-md-n3">
                                                                    <div class="col px-md-5"><div class="p-2">Jumlah</div></div>
                                                                    <div class="col px-md-5"><div class="p-2">: {{  $bookDonation->stock_masuk }}</div></div>
                                                                </div>

                                                                    <div class="row mx-md-n3">
                                                                        <div class="col px-md-5"><div class="p-2">Status</div></div>
                                                                        <div class="col px-md-5"><div class="p-2">
                                                                        <strong class="text-capitalize">: 
                                                                            {{  $bookDonation->status }}
                                                                        </strong></div></div>
                                                                    </div>

                                                                    <div class="row mx-md-n3">
                                                                        <div class="col px-md-5"><div class="p-2">Nama Penjaga</div></div>
                                                                        <div class="col px-md-5"><div class="p-2">: 
                                                                            @if ($bookDonation->staffygngambil == NULL && $bookDonation->staff_approved == NULL)
                                                                                -
                                                                            @elseif($bookDonation->staffygngambil == NULL )
                                                                                {{ $bookDonation->creator->nama }}
                                                                            @else
                                                                                {{  $bookDonation->editor->nama }}    
                                                                            @endif    
                                                                        </div></div>
                                                                    </div>
                                                                    
        
                                                                <hr>
                                                                <p class="px-4"><strong>Buku Yang Disumbangkan :</strong></p>
                                                                <ol>
                                                                        <li>
                                                                            <div class="row mx-md-n3">
                                                                                <div class="media">
                                                                                    <div class="sq align-self-center ">
                                                                                        @if ($bookDonation->image)
                                                                                            <img src="{{ asset('storage/' . $bookDonation->image) }}" class="img-fluid  my-auto align-self-center mr-2 mr-md-4 pl-0 p-0 m-0" width="135" height="135">
                                                                                        @else
                                                                                            <img src="{{ asset("assets/img/book_cover_default.png") }}" class="img-fluid  my-auto align-self-center mr-2 mr-md-4 pl-0 p-0 m-0" width="135" height="135">
                                                                                        @endif
                                                                                    </div>
                                                                                    <div class="media-body my-auto text-right">
                                                                                        <div class="row  my-auto flex-column flex-md-row">
                                                                                            <div class="col my-auto" style="text-align: left;"> <h6 class="mb-0">{{ $bookDonation->judul }}</h6>  </div>
                                                                                            <div class="col-auto my-auto"> <small>Penulis : {{ $bookDonation->penulis }}</small></div>
                                                                                            <div class="col my-auto"> <small>Qty : {{ $bookDonation->stock_masuk }}</small></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>

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
                        {{-- Akhir tampilan staff --}} 

                    </div>

                    {{-- Tabel Detail --}}
                    <div class="card-body">
                        @foreach ($bookDonations as  $bookDonation)
                            <div class="detail-table" id="detailTable{{  $bookDonation->id }}" style="display: none;">
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
                                        </tr>
                                    </thead>
                                    <tbody>    
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{  $bookDonation->isbn }}</td>
                                                <td>{{ $bookDonation->judul }}</td>
                                                <td>{{ $bookDonation->penulis }}</td>
                                                <td>{{ $bookDonation->penerbit }}</td>
                                                <td>{{ $bookDonation->kategori }}</td>
                                                <td>{{ $bookDonation->tglTerbit }}</td>
                                                <td>{{ $bookDonation->tglMasuk }}</td>
                                            </tr>
                                    </tbody>
                                </table>   
                            </div>    
                            
                            <script>
                                function showDetail{{  $bookDonation->id }}(){
                                    const oldTable = document.querySelectorAll('.detail-table');
                                    oldTable.forEach(element => {
                                        element.style.display = 'none';
                                    });
                                    
                                    const table = document.querySelector('#detailTable{{  $bookDonation->id }}');
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