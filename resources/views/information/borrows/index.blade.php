@extends('layout.main')
@section('title', "Informasi Peminjaman Buku")

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
                                    <th>Nama Penjaga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($borrows as  $borrow)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <button class="link-primary text-primary" type="button" id="detail{{  $borrow->id }}" onclick="showDetail{{  $borrow->id }}()" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail Peminjaman" style="border: none; cursor: pointer; background-color:rgba(255,255,255,0);">
                                                {{  $borrow->kode_peminjaman }}
                                            </button>
                                        </td>
                                        <td>{{  $borrow->member->nis }}</td>
                                        <td>{{  $borrow->member->nama }}</td>
                                        <td>{{  $borrow->tanggal_pinjam }}</td>
                                        <td>
                                            {{  $borrow->tanggal_tempo }}
                                        </td>
                                        <td>
                                            @if ($borrow->status == "Menunggu persetujuan")
                                                <div class="badge badge-warning">{{  $borrow->status }}</div>
                                            @elseif($borrow->status == "Disetujui")
                                                <div class="badge badge-info">{{  $borrow->status }}</div>
                                            @elseif($borrow->status == "Dalam peminjaman")
                                                <div class="badge badge-primary">{{  $borrow->status }}</div>
                                            @elseif($borrow->status == "Dibatalkan")
                                                <div class="badge badge-danger">{{  $borrow->status }}</div>
                                            @elseif($borrow->status == "Ditolak")
                                                <div class="badge badge-danger">{{  $borrow->status }}</div>
                                            @elseif($borrow->status == "Selesai")
                                                <div class="badge badge-success">{{  $borrow->status }}</div>    
                                            @endif
                                        </td>
                                        <td>
                                            @if ($borrow->updated_by)
                                                {{  $borrow->editor->nama }}    
                                            @elseif($borrow->created_by)
                                                {{ $borrow->creator->nama }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                {{-- Show --}}
                                                <button class="btn btn-success   btn-sm btn-detail" type="button" data-toggle="modal" data-target="#showw{{  $borrow->id }}"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail Peminjaman">
                                                    <i class="fas fa-eye "></i>
                                                </button>
                                                <div class="modal fade" id="showw{{  $borrow->id }}">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Peminjaman</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row mx-md-n3">
                                                                    <div class="col px-md-5"><div class="p-2">Kode Pinjam</div></div>
                                                                    <div class="col px-md-5"><div class="p-2"><strong>: {{  $borrow->kode_peminjaman }}</strong></div></div>
                                                                </div>
                                                                <div class="row mx-md-n3">
                                                                    <div class="col px-md-5"><div class="p-2">NIS</div></div>
                                                                    <div class="col px-md-5"><div class="p-2">: {{  $borrow->member->nis }}</div></div>
                                                                </div>
                                                                <div class="row mx-md-n3">
                                                                    <div class="col px-md-5"><div class="p-2">Nama</div></div>
                                                                    <div class="col px-md-5"><div class="p-2">: {{  $borrow->member->nama }}</div></div>
                                                                </div>
                                                                <div class="row mx-md-n3">
                                                                    <div class="col px-md-5"><div class="p-2">Kelas / Jurusan</div></div>
                                                                    <div class="col px-md-5"><div class="p-2">: {{  $borrow->member->kelas }} {{  $borrow->member->jurusan }}</div></div>
                                                                </div>
                                                                <div class="row mx-md-n3">
                                                                    <div class="col px-md-5"><div class="p-2">Tanggal Pinjam</div></div>
                                                                    <div class="col px-md-5"><div class="p-2">: {{  $borrow->tanggal_pinjam }}</div></div>
                                                                </div>
                                                                <div class="row mx-md-n3">
                                                                    <div class="col px-md-5"><div class="p-2">Tanggal Tempo</div></div>
                                                                    <div class="col px-md-5"><div class="p-2">: {{  $borrow->tanggal_tempo }}</div></div>
                                                                </div>
                                    
                                                            
                                                                    <div class="row mx-md-n3">
                                                                        <div class="col px-md-5"><div class="p-2">Status</div></div>
                                                                        <div class="col px-md-5"><div class="p-2">
                                                                        <strong>: 
                                                                            {{  $borrow->status }}
                                                                        </strong></div></div>
                                                                    </div>
                                                                    <div class="row mx-md-n3">
                                                                        <div class="col px-md-5"><div class="p-2">Nama Penjaga</div></div>
                                                                        <div class="col px-md-5"><div class="p-2">: 
                                                                            @if ($borrow->updated_by)
                                                                                {{  $borrow->editor->nama }}    
                                                                            @elseif($borrow->created_by)
                                                                                {{ $borrow->creator->nama }}
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        </div></div>
                                                                    </div>
                                                                    
        
                                                                <hr>
                                                                <p class="px-4"><strong>Buku Yang Dipinjam :</strong></p>
                                                                <ol>
                                                                    <p style="display: none">{{ $outOfStock = 0}}</p>
                                                                    @foreach( $borrow->borrowItem as $bi)
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
                        {{-- Akhir tampilan staff --}} 

                    </div>

                    {{-- Tabel Detail --}}
                    <div class="card-body">
                        @foreach ($borrows as  $borrow)
                            <div class="detail-table" id="detailTable{{  $borrow->id }}" style="display: none;">
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
                                            <th>Tanggal Tempo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $borrow->borrowItem as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{  $borrow->kode_peminjaman }}</td>
                                                <td>{{ $item->book->judul }}</td>
                                                <td>1</td>
                                                <td>{{  $borrow->tanggal_tempo }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>   
                            </div>    
                            
                            <script>
                                function showDetail{{  $borrow->id }}(){
                                    const oldTable = document.querySelectorAll('.detail-table');
                                    oldTable.forEach(element => {
                                        element.style.display = 'none';
                                    });
                                    
                                    const table = document.querySelector('#detailTable{{  $borrow->id }}');
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