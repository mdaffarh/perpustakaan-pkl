@extends('layout.main')
@section('title', "Informasi Pendaftaran Staff")

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
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Admin</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($staffRegistrations as  $staff)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <button class="link-primary text-primary" type="button" id="detail{{ $staff->id }}" onclick="showDetail{{  $staff->id }}()" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail Staff" style="border: none; cursor: pointer; background-color:rgba(255,255,255,0);">
                                                {{  $staff->nip }}
                                            </button>
                                        </td>
                                        <td>{{  $staff->nama }}</td>
                                        <td>{{  $staff->email }}</td>
                                        <td>
                                            @if ($staff->status == 2)
                                                <span class="badge badge-success">Disetujui</span>
                                            @elseif ($staff->status == 1)
                                                <span class="badge badge-warning">Menunggu persetujuan</span>
                                            @else
                                                <span class="badge badge-danger">Ditolak</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $staff->editor ? $staff->editor->nama : $staff->creator->nama }}
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                                                {{-- Show --}}
                                                <button class="btn btn-warning   btn-sm btn-detail" type="button" data-toggle="modal" data-target="#showw{{  $staff->id }}"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail">
                                                    <i class="fas fa-eye "></i>
                                                </button>
                                                <div class="modal fade" id="showw{{  $staff->id }}">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Pendaftaran Staff</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row mx-md-n3">
                                                                    <div class="col px-md-5"><div class="p-2">NIP</div></div>
                                                                    <div class="col px-md-5"><div class="p-2"><strong>: {{  $staff->nip }}</strong></div></div>
                                                                </div>
                                                                <div class="row mx-md-n3">
                                                                    <div class="col px-md-5"><div class="p-2">Nama</div></div>
                                                                    <div class="col px-md-5"><div class="p-2">: {{  $staff->nama }}</div></div>
                                                                </div>
                                                                <div class="row mx-md-n3">
                                                                    <div class="col px-md-5"><div class="p-2">Email</div></div>
                                                                    <div class="col px-md-5"><div class="p-2">: {{  $staff->email }}</div></div>
                                                                </div>
                                                                <div class="row mx-md-n3">
                                                                    <div class="col px-md-5"><div class="p-2">Status</div></div>
                                                                    <div class="col px-md-5"><div class="p-2">:
                                                                        @if ($staff->status == 2)
                                                                            <span class="badge badge-success">Disetujui</span>
                                                                        @elseif ($staff->status == 1)
                                                                            <span class="badge badge-warning">Menunggu persetujuan</span>
                                                                        @else
                                                                            <span class="badge badge-danger">Ditolak</span>
                                                                        @endif
                                                                    </div></div>
                                                                </div>
                                                                <div class="row mx-md-n3">
                                                                    <div class="col px-md-5"><div class="p-2">Tanggal Pinjam</div></div>
                                                                    <div class="col px-md-5"><div class="p-2">: 
                                                                        {{ $staff->editor ? $staff->editor->nama : $staff->creator->nama }}
                                                                    </div></div>
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
                        @foreach ($staffRegistrations as  $staff)
                            <div class="detail-table" id="detailTable{{  $staff->id }}" style="display: none;">
                                <div class="mb-2">
                                    <h5 class="d-inline">Detail Staff</h5>
                                </div>
                                            
                                {{-- Tabel Detail --}}
                                <table id="detailTable" class="table table-bordered table-striped" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIP</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tanggal Lahir</th>
                                            <th>No. Telepon</th>
                                            <th>Alamat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>{{  $staff->nip }}</td>
                                                <td>{{ $staff->nama }}</td>
                                                <td>{{ $staff->jenis_kelamin }}</td>
                                                <td>{{  $staff->tanggal_lahir }}</td>
                                                <td>{{  $staff->nomor_telepon }}</td>
                                                <td>{{  $staff->alamat }}</td>
                                            </tr>
                                    </tbody>
                                </table>   
                            </div>    
                            
                            <script>
                                function showDetail{{  $staff->id }}(){
                                    const oldTable = document.querySelectorAll('.detail-table');
                                    oldTable.forEach(element => {
                                        element.style.display = 'none';
                                    });
                                    
                                    const table = document.querySelector('#detailTable{{  $staff->id }}');
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