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
                                    <th>Kode Sumbangan</th>
                                    <th>Nama Penyumbang</th>
                                    <th>Tanggal Sumbangan</th>
                                    <th>Status</th>
                                    <th>Staff yang menyetujui</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($donations as  $donation)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <button class="link-primary text-primary" type="button" id="detail{{ $donation->id }}" onclick="showDetail{{  $donation->id }}()" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail Buku" style="border: none; cursor: pointer; background-color:rgba(255,255,255,0);">
                                                {{  $donation->kode_sumbangan }}
                                            </button>
                                        </td>
                                        <td>{{ $donation->member->nama  }}</td>
                                        <td>{{  $donation->created_at }}</td>
                                        <td>
                                            @if ($donation->status == "menunggu persetujuan")
                                                <div class="badge badge-warning text-capitalize">{{  $donation->status }}</div>
                                            @elseif($donation->status == "disetujui" && $donation->diambil != "Sudah")
                                                <div class="badge badge-primary text-capitalize">{{  $donation->status }}</div>    
                                            @elseif($donation->status == "disetujui" && $donation->diambil == "Sudah")
                                                <div class="badge badge-success text-capitalize">Selesai</div> 
                                            @elseif($donation->status == "ditolak")
                                                <div class="badge badge-danger text-capitalize">{{  $donation->status }}</div> 
                                            @endif
                                        </td>
                                        <td>
                                            @if ($donation->staffygngambil == NULL && $donation->staff_approved == NULL)
                                                -
                                            @elseif($donation->staffygngambil == NULL )
                                                {{ $donation->creator->nama }}
                                            @else
                                                {{  $donation->editor->nama }}    
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                {{-- Show --}}
                                                <button class="btn btn-warning   btn-sm btn-detail" type="button" data-toggle="modal" data-target="#showw{{  $donation->id }}"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail Sumbangan">
                                                    <i class="fas fa-eye "></i>
                                                </button>
                                                <div class="modal fade" id="showw{{  $donation->id }}">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <div class="form-floating">
                                                                    <h5 class="font-weight-bold ml-3 mt-3">Detail Kode Sumbangan : {{ $donation->kode_sumbangan }}</h5>
                                                                </div>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-floating mb-3" style="text-align: center;">
                                                                    <label for="floatingInput3">Yang Menyumbakan :</label>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">NIS</label>
                                                                    <div class="col-sm-10">
                                                                        <input required name="nama" type="text" required class="form-control" id="floatingInput3" value="{{ $donation->member->nis }}" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                                                                    <div class="col-sm-10">
                                                                        <input required name="jenis_kelamin" type="text" required class="form-control" id="floatingInput3" value="{{ $donation->member->nama }}" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kelas</label>
                                                                    <div class="col-sm-10">
                                                                        <input required name="kelas" type="text" required class="form-control" id="floatingInput3" value="{{ $donation->member->kelas }}" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Jurusan</label>
                                                                    <div class="col-sm-10">
                                                                        <input required name="jurusan" type="text" required class="form-control" id="floatingInput3" value="{{ $donation->member->jurusan }}" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">No Telp</label>
                                                                    <div class="col-sm-10">
                                                                        <input required name="nomor_telepon" type="text" required class="form-control" id="floatingInput3" value="{{ $donation->member->nomor_telepon }}" disabled>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="mt-4">
                                                                    <div style="text-align: center;">
                                                                        <label>Buku yang akan di sumbangkan :</label>
                                                                    </div>
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th style="width: 10px">No</th>
                                                                                <th>ISBN</th>
                                                                                <th>Judul</th>
                                                                                <th>penulis</th>
                                                                                <th>penerbit</th>
                                                                                <th>Kategori</th>
                                                                                <th>Kuantitas</th>
                                                                                <th>cover</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach($donation->bookDonation as $bd)
                                                                            <tr>
                                                                                <td>{{ $loop->iteration }}</td>
                                                                                <td>{{ $bd->isbn }}</td>
                                                                                <td>{{ $bd->judul }}</td>
                                                                                <td>{{ $bd->penulis }}</td>
                                                                                <td>{{ $bd->penerbit }}</td>
                                                                                <td>{{ $bd->kategori }}</td>
                                                                                <td>{{ $bd->stok_masuk }}</td>
                                                                                <td>
                                                                                    @if (!$bd->image)
                                                                                        <span>-</span>
                                                                                    @else
                                                                                        <img src="{{ asset('storage/' . $bd->image) }}" id="img-preview" class="img-fluid img-preview mb-3 col-sm-5 d-block">
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <hr>
                                                                <div class="form-floating mb-3" style="text-align: center;">
                                                                    <label for="floatingInput3">Staff Yang menyetujui :</label>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                                                                    <div class="col-sm-10">
                                                                        <input required name="nama" type="text" required class="form-control" id="floatingInput3" value="
                                                                            @if ($donation->staffygngambil == NULL && $donation->staff_approved == NULL)
                                                                                -
                                                                            @elseif($donation->staffygngambil == NULL )
                                                                                {{ $donation->creator->nama }}
                                                                            @else
                                                                                {{  $donation->editor->nama }}    
                                                                            @endif" 
                                                                        disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                                                                <a href="/transaction/book-donations/cancel/{{ $donation->id }}" class="btn btn-danger">Batalkan Sumbangan</a>
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
                        @foreach ($donations as  $donation)
                            <div class="detail-table" id="detailTable{{  $donation->id }}" style="display: none;">
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
                                        @foreach($donation->bookDonation as $item)    
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->isbn }}</td>
                                                <td>{{ $item->judul }}</td>
                                                <td>{{ $item->penulis }}</td>
                                                <td>{{ $item->penerbit }}</td>
                                                <td>{{ $item->kategori }}</td>
                                                <td>{{ $item->tglTerbit }}</td>
                                                <td>{{ $item->tglMasuk }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>   
                            </div>    
                            
                            <script>
                                function showDetail{{  $donation->id }}(){
                                    const oldTable = document.querySelectorAll('.detail-table');
                                    oldTable.forEach(element => {
                                        element.style.display = 'none';
                                    });
                                    
                                    const table = document.querySelector('#detailTable{{  $donation->id }}');
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