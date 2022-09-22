@extends('layout.main')
@section('title', "Create Buku")

@section('content')
@include('sweetalert::alert')

            <div class="modal-body">
                <div class="modal-body">
                    <form action="/table/books" method="post" enctype="multipart/form-data">
                        @csrf
                        @if()
                        <div class="form-floating mb-3">
                            <label for="floatingInput3">ISBN</label>
                            <input required name="isbn" type="text" required class="form-control" id="floatingInput3" value="{{ $bookDonation->isbn }}">
                        </div>
                        @else()
                        <div class="form-floating mb-3">
                            <label for="floatingInput3">ISBN</label>
                            <input required name="isbn" type="text" required class="form-control @error('isbn') is-invalid @enderror " id="floatingInput3"  value="{{ old('isbn') }}">
                                @error('isbn')
                                     <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                        </div>
                        @endif
                        <div class="form-floating mb-3">
                            <label for="floatingInput3">Judul Buku</label>
                            <input required name="judul" type="text" required class="form-control @error('judul') is-invalid @enderror " id="floatingInput3" value="{{ old('judul') }}">
                                @error('judul')
                                     <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                        </div>
                        <div class="input-group">
                            <div class="form-floating mb-3" style="width: 50%;">
                                <label for="floatingInput3">Penulis</label>
                                <input required name="penulis" type="text" required class="form-control @error('penulis') is-invalid @enderror " id="floatingInput3" value="{{ old('penulis') }}" >
                                    @error('penulis')
                                         <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                            <div class="form-floating mb-3" style="width: 50%;">
                                <label for="floatingInput3">Penerbit</label>
                                <input required name="penerbit" type="text" required class="form-control @error('penerbit') is-invalid @enderror " id="floatingInput3" value="{{ old('penerbit') }}" >
                                    @error('penerbit')
                                         <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <label for="floatingInput3">Kategori</label>
                            <select name="kategori" type="text" required class="form-control @error('kategori') is-invalid @enderror " id="floatingInput3" value="{{ old('kategori') }}">
                                <option></option>
                                <option>Novel</option>
                                <option>Komik</option>
                                <option>Ensiklopedia</option>
                                <option>Biografi</option>
                                <option>Majalah</option>
                                <option>Kamus</option>
                                <option>Buku Ilmiah</option>
                                <option>Tafsir</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <div class="form-floating mb-3" style="width: 50%;">
                                <label for="floatingInput3">Tanggal Terbit</label>
                                <input required name="tglTerbit" type="date" required  class="form-control @error('tglTerbit') is-invalid @enderror " id="floatingInput3" value="{{ old('tglTerbit') }}">
                                @error('tglTerbit')
                                    <div class="invalid-feedback">
                                           {{ $message }}
                                       </div>
                                   @enderror
                            </div>
                            <div class="form-floating mb-3" style="width: 50%;">
                                <label for="floatingInput3">Tanggal Masuk</label>
                                <input required name="tglMasuk" type="date" required class="form-control @error('tglMasuk') is-invalid @enderror " id="floatingInput3" value="{{ old('tglMasuk') }}">
                                @error('tglMasuk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                   @enderror
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <label for="floatingInput3">Kuantitas</label>
                            <input required name="stok_awal" type="number" required class="form-control @error('stok_awal') is-invalid @enderror " id="floatingInput3" value="{{ old('stok_awal') }}">
                            @error('stok_awal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                               @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <label for="image" class="form-label">Foto</label>
                            <img class="img-preview-add mb-3 col-sm-3 img-fluid">
                            <input id="imageAdd" name="image" class="form-control @error('image') is-invalid @enderror" type="file" onchange="previewImageAdd()" value="{{ old('image') }}"/>
                                @error('image')
                                     <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                        </div>
                        <div class="input-group">
                            <button class="btn btn-success rounded me-1" type="submit">Submit</button>
                        </div>
                    </form>
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

	$(function () {
		$("#example1").DataTable({
		"responsive": true, "lengthChange": false, "autoWidth": false,
		"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		// $('#example2').DataTable({
		//   "paging": true,
		//   "lengthChange": false,
		//   "searching": false,
		//   "ordering": true,
		//   "info": true,
		//   "autoWidth": false,
		//   "responsive": true,
		// });
	});
	</script>

@endsection