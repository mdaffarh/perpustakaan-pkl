@extends('layout.main')
@section('title', "Form Donasi Buku")

@section('content')
@section('content')
	@include('sweetalert::alert')
	<div class="row">
		<div class="col">
			<div class="card card-outline-tabs">
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
                
                <form action="/transaction/book-donations" method="post" enctype="multipart/form-data">
                    @csrf
				    <div class="card-body book-container">
                        @if(auth()->user()->role == "admin")
                            <div class="form-floating mb-3">
                                <label for="floatingInput3">Nama Anggota</label>
                                <select name="member_id" id="" class="form-control select2" required>
                                    <option disabled selected>Pilih Anggota</option>
                                    @foreach($members as $member)
                                    <option value="{{ $member->id }}">{{ $member->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="card card-info book">
                            <div class="card-header">
                                <h3 class="card-title">Identitas Buku</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputIsbn" class="col-sm-2 col-form-label">ISBN</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputIsbn"name="isbn[]">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputJudul" class="col-sm-2 col-form-label">Judul Buku</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputJudul" name="judul[]">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPenulis" class="col-sm-2 col-form-label">Penulis</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputPenulis" name="penulis[]">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPenerbit" class="col-sm-2 col-form-label">Penerbit</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputPenerbit" name="penerbit[]">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kategori</label>
                                    <div class="col-sm-10">
                                        <select name="kategori[]" class="form-control" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="kategori[]">   
                                        <option disabled selected>Pilih Category</option>
                                        @foreach($categorys as $c)
                                        <option value="{{ $c->category }}">{{ $c->category }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputTB" class="col-sm-2 col-form-label">Tanggal Terbit</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="inputTB" name="tanggal_terbit[]">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputTM" class="col-sm-2 col-form-label">Tanggal Masuk</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="inputTM" name="tanggal_masuk[]">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputKuantitas" class="col-sm-2 col-form-label">Kuantitas</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="inputKuantitas" name="kuatitas[]">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Foto</label>
                                    <div class="col-sm-10">
                                        <div class="custom-file">
                                            <input id="imageAdd" name="image[]" class="form-control @error('image') is-invalid @enderror" type="file" onchange="previewImageAdd()" value="{{ old('image') }}"/>
                                        </div>
                                    </div>
                                    <img class="img-preview-add mb-3 col-sm-3 img-fluid">
                                </div>
                            </div>
                        </div>
				    </div>
                    <div style="text-align: right;" class="mb-5 mr-5">
                        <button class="btn btn-success rounded me-1" type="submit">Submit</button> 
                        <button type="button" class="btn btn-info btn-add-book">Tambah Buku</button>
                    </div>
                </form>
			</div>
		</div>
	</div>


    <script>
    	function previewImageAdd(){
		const image = document.querySelector('#imageAdd');
		const imgPreview = document.querySelector('.img-preview-add');
		imgPreview.style.display = 'block';
		const oFReader = new FileReader();
		oFReader.readAsDataURL(image.files[0]);
		oFReader.onload = function(oFREvent){
			imgPreview.src = oFREvent.target.result;
			}
		}

        $('.btn-add-book').click(function() {
            $('.book-container').append(book())
        })

        $(document).on('click', '.btn-delete-book', function() {
            $(this).closest('.books').remove()
        })

        function book() {
            return `<div class="card card-info books mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Identitas Buku</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="inputIsbn" class="col-sm-2 col-form-label">ISBN</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputIsbn" name="isbn[]">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputJudul" class="col-sm-2 col-form-label">Judul Buku</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputJudul" name="judul[]">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPenulis" class="col-sm-2 col-form-label">Penulis</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputPenulis" name="penulis[]">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPenerbit" class="col-sm-2 col-form-label">Penerbit</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputPenerbit" name="penerbit[]">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kategori</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="kategori[]" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true" name="kategori[]">   
                                            <option disabled selected>Pilih Category</option>
                                            @foreach($categorys as $c)
                                            <option value="{{ $c->category }}">{{ $c->category }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputTB" class="col-sm-2 col-form-label">Tanggal Terbit</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="inputTB" name="tanggal_terbit[]">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputTM" class="col-sm-2 col-form-label">Tanggal Masuk</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="inputTM" name="tanggal_masuk[]">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputKuantitas" class="col-sm-2 col-form-label">Kuantitas</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="inputKuantitas" name="kuatitas[]">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Foto</label>
                                    <div class="col-sm-10">
                                        <div class="custom-file">
                                            <input id="imageAdd" name="image[]" class="form-control @error('image') is-invalid @enderror" type="file" onchange="previewImageAdd()" value="{{ old('image') }}"/>
                                        </div>
                                    </div>
                                    <img class="img-preview-add mb-3 col-sm-3 img-fluid">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-info float-right btn-delete-book">Delete</button>
                            </div>
                        </div>`
        }

	</script>

@endsection