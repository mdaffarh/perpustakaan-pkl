@can('member')

    @extends('layout.main')
    @section('title', "Profil")
        
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
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-3">
                                    @if($member->profile)
                                        <img src="{{ asset('storage/'. $member->profile) }}"
                                            class="img-thumbnail rounded-circle border img-fluid" alt="{{ $member->nama }}">
                                    @elseif($member->jenis_kelamin == "Laki-laki")
                                        <img src="{{ asset('dist/img/avatar5.png')}}"
                                            class="img-thumbnail rounded-circle border img-fluid" alt="{{ $member->nama }}">
                                    @else
                                        <img src="{{ asset('dist/img/avatar2.png')}}"
                                        class="img-thumbnail rounded-circle border img-fluid" alt="{{ $member->nama }}">
                                    @endif
                                    <div>
                                        <a href="/profile/edit" class="btn btn-outline-success mt-3 w-100">Edit Profil</a>
                                    </div>
                                </div>
                        
                                <div class="col-lg-8 mt-4">
                                    <h3>{{ $member->nama }}</h3>
                                    <p class="fs-5 text-uppercase">{{ $member->kelas }} {{ $member->jurusan }}</p>
                                    <p class="fs-5">{{ $member->nomor_telepon }}</p>
                                    <p class="fs-5">{{ $member->alamat }}</p>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection
    
@endcan