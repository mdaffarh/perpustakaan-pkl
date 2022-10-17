@extends('layout.main')
@section('title', "Informasi Pendaftaran Anggota")

@can('admin')
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
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Jurusan</th>
                                    <th>Status</th>
                                    <th>Nama Penjaga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($memberRegistrations as $member)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <button class="link-primary text-primary" type="button" id="detail{{  $member->id }}" onclick="showDetail{{ $member->id }}()" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail Pendaftaran" style="border: none; cursor: pointer; background-color:rgba(255,255,255,0);">
                                                {{  $member->nis }}
                                            </button>
                                        </td>
                                        <td>{{ $member->nama }}</td>
                                        <td>{{ $member->kelas }}</td>
                                        <td>{{ $member->jurusan }}</td>
                                        <td>
                                            @if($member->status=="1")
                                            <span class="badge badge-warning">Menunggu persetujuan</span>
                                            @elseif($member->status=="2")
                                            <span class="badge badge-success">Disetujui</span>
                                            @elseif($member->status=="3")
                                            <span class="badge badge-danger">Ditolak</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $member->editor ? $member->editor->nama : $member->creator->nama }}
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                   
                                                {{-- Show --}}
                                                <button class="btn btn-warning   btn-sm btn-detail" type="button" data-toggle="modal" data-target="#showw{{ $member->id }}"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail">
                                                    <i class="fas fa-eye "></i>
                                                </button>
                                                <div class="modal fade" id="showw{{ $member->id }}">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Pendaftaran Anggota</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="/table/memberRegistration/{{ $member->id }}" method="post" enctype="multipart/form-data" class="p-4">
                                                                    @method('put')
                                                                    @csrf
                                                                    
                                                                    <div class="form-floating mb-3">
                                                                        <label for="floatingInput3">NIS</label>
                                                                        <input required name="nis" type="number" maxlength="11" required class="form-control" id="floatingInput3" value="{{ $member->nis }}" disabled>
                                                                    </div>
                                                                    <div class="form-floating mb-3">
                                                                        <label for="floatingInput3">Nama</label>
                                                                        <input required name="nama" type="text" required class="form-control" id="floatingInput3" value="{{ $member->nama }}" disabled>
                                                                    </div>
                                                                    <div class="form-floating mb-3">
                                                                        <label for="floatingInput3">Jenis Kelamin</label>
                                                                        <input required name="jenis_kelamin" type="text" required class="form-control" id="floatingInput3" value="{{ $member->jenis_kelamin }}" disabled>
                                                                    </div>
                                                                    <div class="form-floating mb-3">
                                                                        <label for="floatingInput3">Kelas</label>
                                                                        <input required name="kelas" type="text" required class="form-control" id="floatingInput3" value="{{ $member->kelas }}" disabled>
                                                                    </div>
                                                                    <div class="form-floating mb-3">
                                                                        <label for="floatingInput3">Jurusan</label>
                                                                        <input required name="jurusan" type="text" required class="form-control" id="floatingInput3" value="{{ $member->jurusan }}" disabled>
                                                                    </div>
                                                                    <div class="form-floating mb-3">
                                                                        <label for="floatingInput3">Tanggal Lahir</label>
                                                                        <input required name="tanggal_lahir" type="date" required class="form-control" id="floatingInput3" value="{{ $member->tanggal_lahir }}" disabled>
                                                                    </div>
                                                                    <div class="form-floating mb-3">
                                                                        <label for="floatingInput3">Nomor Telepon</label>
                                                                        <input required name="nomor_telepon" type="text" required class="form-control" id="floatingInput3" value="{{ $member->nomor_telepon }}" disabled>
                                                                    </div>
                                                                    <div class="form-floating mb-3">
                                                                        <label for="floatingInput3">Alamat</label>
                                                                        <input required name="alamat" type="text" required class="form-control" id="floatingInput3" value="{{ $member->alamat }}" disabled>
                                                                    </div>
                                                                    <div class="form-floating mb-3">
                                                                        <label for="floatingInput3">Nama Penjaga</label>
                                                                        <input required name="alamat" type="text" required class="form-control" id="floatingInput3" value="{{ $member->editor ? $member->editor->nama : $member->creator->nama }}" disabled>
                                                                    </div>
                                                                
                                                                    
                                                                </form>
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
                        @foreach ($memberRegistrations as $member)
                            <div class="detail-table" id="detailTable{{ $member->id }}" style="display: none;">
                                <div class="mb-2">
                                    <h5 class="d-inline">Detail Pendaftaran Anggota</h5>
                                </div>
                                            
                                {{-- Tabel Detail --}}
                                <table id="detailTable" class="table table-bordered table-striped" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIS</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>Jurusan</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Nomor Telepon</th>
                                            <th>Alamat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>{{ $member->nis }}</td>
                                            <td>{{ $member->nama }}</td>
                                            <td>{{ $member->kelas }}</td>
                                            <td>{{ $member->jurusan }}</td>
                                            <td>{{ $member->tanggal_lahir }}</td>
                                            <td>{{ $member->nomor_telepon }}</td>
                                            <td>{{ $member->alamat }}</td>
                                        </tr>
                                    </tbody>
                                </table>   
                            </div>    
                            
                            <script>
                                function showDetail{{  $member->id }}(){
                                    const oldTable = document.querySelectorAll('.detail-table');
                                    oldTable.forEach(element => {
                                        element.style.display = 'none';
                                    });
                                    
                                    const table = document.querySelector('#detailTable{{ $member->id }}');
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