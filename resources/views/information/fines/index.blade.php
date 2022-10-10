@extends('layout.main')
@section('title', "Informasi Denda Peminjaman")

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
									<th>Kode Peminjaman</th>
									<th>Nama Peminjam</th>
									<th>Tanggal Tempo</th>
									<th>Tanggal Kembali</th>
									<th>Telat</th>
									<th>Denda</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($fines as  $fine)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            {{  $fine->borrow->kode_peminjaman }}
                                        </td>
                                        <td>{{  $fine->member->nama }}</td>
                                        <td>{{  $fine->borrow->tanggal_tempo }}</td>
                                        <td>
                                            {{  $fine->tanggal_kembali }}
                                        </td>
                                        <td>
											{{ $fine->waktu_tenggat }}
                                        </td>
                                        <td>
											{{ $fine->total }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>        
                        {{-- Akhir tampilan staff --}} 

                    </div>

    
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
                
            </script>
    @endsection 
@endcan