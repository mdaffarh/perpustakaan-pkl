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
                                <h3 class="mt-2">Edit @yield('title')</h3>
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
                            <form action="/profile/update" method="post" enctype="multipart/form-data" style="display: inline;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $member->id }}">
                                <input type="hidden" name="oldImage" value="{{ $member->profile }}">
                                <div class="row">
                                    <div class="col-lg-3">
                                        @if($member->profile)
                                            <img src="{{ asset('storage/'. $member->profile) }}" id="img-preview" class="img-thumbnail rounded-circle border img-fluid" alt="{{ $member->nama }}">
                                        @elseif($member->jenis_kelamin == "Laki-laki")
                                            <img src="{{ asset('dist/img/avatar5.png')}}"
                                                id="img-preview" class="img-thumbnail rounded-circle border img-fluid" alt="{{ $member->nama }}">
                                        @else
                                            <img src="{{ asset('dist/img/avatar2.png')}}"
                                            id="img-preview" class="img-thumbnail rounded-circle border img-fluid" alt="{{ $member->nama }}">
                                        @endif
                                        <div class="input-group">
                                            <input type="file" class="form-control @error('profile') is-invalid @enderror" id="profile" onchange="previewImage()" name="profile">
                                        </div>
                                        @error('profile')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <div>
                                            <button type="submit" class="btn btn-success mt-3 w-100">Simpan</button>
                                        </div>
                                    </div>
                            
                                    <div class="col-lg-8 mt-4">
                                        <h3><input type="text" name="nama" id="" value="{{ $member->nama }}" class="border border-dark rounded p-1"></h3>
                                        <p class="fs-5 text-uppercase">
                                            <input type="number" name="kelas" id="" value="{{ $member->kelas }}" class="border border-dark rounded p-1"> 
                                            <input type="text" name="jurusan" id="" value="{{ $member->jurusan }}" class="text-uppercase" class="border border-dark rounded p-1">
                                        </p>
                                        <p class="fs-5">
                                            <input type="tel" name="nomor_telepon" id="" value="{{ $member->nomor_telepon }}" maxlength="14" class="border border-dark rounded p-1">
                                        </p>
                                        <p class="fs-5">
                                            <textarea name="alamat" id="" cols="40" rows="5" class="border border-dark rounded p-1" style="resize: none">{{ $member->alamat }}</textarea>
                                        </p>
                                        
                                    </div> 
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <script>
         	function previewImage(){
				const image = document.querySelector('#profile');
				const imgPreview = document.querySelector('#img-preview');
				imgPreview.style.display = 'block';
				const oFReader = new FileReader();
				oFReader.readAsDataURL(image.files[0]);
				oFReader.onload = function(oFREvent){
					imgPreview.src = oFREvent.target.result;
					}
			}   
        </script>
    @endsection
    
@endcan