@extends('layout.main')
@section('title', "Informasi Pengembalian Buku")

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
                                    <th>Kode Pengembalian</th>
                                    <th>NIS</th>
                                    <th>Nama Peminjam</th>
                                    <th>Tanggal Tempo</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Status</th>
                                    <th>Nama Penjaga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($returns as  $return)
                                    <tr>
                                        {{-- Modal Show --}}
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
                                                            <div class="col px-md-5"><div class="p-2">Kode Pengembalian</div></div>
                                                            <div class="col px-md-5"><div class="p-2"><strong>: {{  $return->kode_pengembalian}}</strong></div></div>
                                                        </div>
                                                        <div class="row mx-md-n3">
                                                            <div class="col px-md-5"><div class="p-2">NIS</div></div>
                                                            <div class="col px-md-5"><div class="p-2">: {{  $return->member->nis }}</div></div>
                                                        </div>
                                                        <div class="row mx-md-n3">
                                                            <div class="col px-md-5"><div class="p-2">Nama</div></div>
                                                            <div class="col px-md-5"><div class="p-2">: {{  $return->member->nama }}</div></div>
                                                        </div>
                                                        <div class="row mx-md-n3">
                                                            <div class="col px-md-5"><div class="p-2">Kelas / Jurusan</div></div>
                                                            <div class="col px-md-5"><div class="p-2">: {{  $return->member->kelas }} {{  $return->member->jurusan }}</div></div>
                                                        </div>
                                                        <div class="row mx-md-n3">
                                                            <div class="col px-md-5"><div class="p-2">Tanggal Pinjam</div></div>
                                                            <div class="col px-md-5"><div class="p-2">: {{  $return->borrow->tanggal_pinjam }}</div></div>
                                                        </div>
                                                        <div class="row mx-md-n3">
                                                            <div class="col px-md-5"><div class="p-2">Tanggal Tempo</div></div>
                                                            <div class="col px-md-5"><div class="p-2">: {{  $return->borrow->tanggal_tempo }}</div></div>
                                                        </div>
                                                        <div class="row mx-md-n3">
                                                            <div class="col px-md-5"><div class="p-2">Tanggal Kembali</div></div>
                                                            <div class="col px-md-5"><div class="p-2">:
                                                                @if ($return->tanggal_kembali == "0000-00-00")
                                                                    Belum
                                                                @else
                                                                    {{  $return->tanggal_kembali }}
                                                                @endif
                                                            </div></div>
                                                        </div>
                                                    
                                                            <div class="row mx-md-n3">
                                                                <div class="col px-md-5"><div class="p-2">Status</div></div>
                                                                <div class="col px-md-5"><div class="p-2">
                                                                <strong>: 
                                                                    @if ($return->dikembalikan == "Sudah")
                                                                        Selesai
                                                                    @else
                                                                        Belum dikembalikan
                                                                    @endif 
                                                                </strong></div></div>
                                                            </div>
                                                            <div class="row mx-md-n3">
                                                                <div class="col px-md-5"><div class="p-2">Nama Penjaga</div></div>
                                                                <div class="col px-md-5"><div class="p-2">: 
                                                                    @if ($return->updated_by == NULL)
                                                                        {{ $return->creator->nama }}
                                                                    @else
                                                                        {{  $return->editor->nama }}    
                                                                    @endif   
                                                                </div></div>
                                                            </div>
                                                            

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
                                        
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <button class="link-primary text-primary" type="button" id="detail{{  $return->borrow->id }}" onclick="showDetail{{  $return->borrow->id }}()" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail Peminjaman" style="border: none; cursor: pointer; background-color:rgba(255,255,255,0);">
                                                {{  $return->kode_pengembalian }}
                                            </button>
                                        </td>
                                        <td>{{  $return->member->nis }}</td>
                                        <td>{{  $return->member->nama }}</td>
                                        <td>{{  $return->borrow->tanggal_tempo }}</td>
                                        <td>
                                            @if ($return->tanggal_kembali == "0000-00-00")
                                                Belum
                                            @else
                                                {{  $return->tanggal_kembali }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($return->dikembalikan == "Sudah")
                                                <div class="badge badge-success">Selesai</div>
                                            @else
                                                <div class="badge badge-warning">Belum dikembalikan</div>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($return->updated_by == NULL)
                                                {{ $return->creator->nama }}
                                            @else
                                                {{  $return->editor->nama }}    
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                {{-- Show --}}
                                                <button class="btn btn-success   btn-sm btn-detail" type="button" data-toggle="modal" data-target="#showw{{  $return->borrow->id }}"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail Peminjaman">
                                                    <i class="fas fa-eye "></i>
                                                </button>                                    
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
                                            <th>Kode Pengembalian</th>
                                            <th>Judul</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal Tempo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $return->borrow->borrowItem as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{  $return->kode_pengembalian }}</td>
                                                <td>{{ $item->book->judul }}</td>
                                                <td>1</td>
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