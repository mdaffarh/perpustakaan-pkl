@extends('layout.main')
@section('title', "Perpustakaan")

@section('content')

<div class="content-wrapper">

	<div class="card">
		<div class="card-header">
			<h3 class="card-title">DATA BUKU</h3>
		</div>

		<div class="card-body">
			<div>
				<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">Tambah Data</button>
				
				<div class="modal fade" id="modal-default">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Tambah Data</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="modal-body">
                                    <form action="/table/books" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <label for="floatingInput3">ISBN</label>
                                            <input required name="isbn" type="text" requ class="form-control @error('isbn') is-invalid @enderror " id="floatingInput3"  value="{{ old('isbn') }}">
												@error('isbn')
												 	<div class="invalid-feedback">
														{{ $message }}
													</div>
												@enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="floatingInput3">Judul Buku</label>
                                            <input required name="judul" type="text" requi class="form-control @error('judul') is-invalid @enderror " id="floatingInput3" value="{{ old('judul') }}">
												@error('judul')
												 	<div class="invalid-feedback">
														{{ $message }}
													</div>
												@enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="floatingInput3">Penulis</label>
                                            <input required name="penulis" type="text" require class="form-control @error('penulis') is-invalid @enderror " id="floatingInput3" value="{{ old('penulis') }}" >
												@error('penulis')
												 	<div class="invalid-feedback">
														{{ $message }}
													</div>
												@enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="floatingInput3">Penerbit</label>
                                            <input required name="penerbit" type="text" required class="form-control @error('penerbit') is-invalid @enderror " id="floatingInput3" value="{{ old('penerbit') }}" >
												@error('penerbit')
												 	<div class="invalid-feedback">
														{{ $message }}
													</div>
												@enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="floatingInput3">Kategori</label>
                                            <input required name="kategori" type="text" required class="form-control @error('kategori') is-invalid @enderror " id="floatingInput3" value="{{ old('kategori') }}">
												@error('kategori')
												 	<div class="invalid-feedback">
														{{ $message }}
													</div>
												@enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="floatingInput3">Tanggal Terbit</label>
                                            <input required name="tglTerbit" type="date" required  class="form-control @error('tglTerbit') is-invalid @enderror " id="floatingInput3" value="{{ old('tglTerbit') }}">
											@error('tglTerbit')
												<div class="invalid-feedback">
											   		{{ $message }}
										   		</div>
									   		@enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="floatingInput3">Tanggal Masuk</label>
                                            <input required name="tglMasuk" type="date" required class="form-control @error('tglMasuk') is-invalid @enderror " id="floatingInput3" value="{{ old('tglMasuk') }}">
											@error('tglMasuk')
												<div class="invalid-feedback">
													{{ $message }}
												</div>
									   		@enderror
                                        </div>
                                        <div class="form-floating mb-3">
                        					<label for="image" class="form-label">Foto</label>
                        					<img class="img-preview-add img-fluid mb-3 col-sm-5">
											<div class="custom-file">
												<input type="file" class="custom-file-input" name="imageAdd" id="imageAdd" onchange="previewImageAdd()" value="{{ old('image') }}">
												<label class="custom-file-label" for="imageAdd"></label>
											</div>
                        					{{-- <input id="imageAdd" name="imageAdd" class="form-control @error('image') is-invalid @enderror" type="file" onchange="previewImageAdd()" value="{{ old('image') }}"/> --}}
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
							<div class="modal-footer justify-content-between">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
									
				</div>
			</div>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>ISBN</th>
						<th>Judul Buku</th>
						<th>Penulis</th>
						<th>Tanggal Masuk</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($books as $book)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $book->isbn }}</td>
						<td>{{ $book->judul }}</td>
						<td>{{ $book->penulis }}</td>
						<td>{{ $book->tglMasuk }}</td>
						<td>
							<a href="#modalEditData{{ $book->id }}" data-toggle="modal">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583v4.43zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585 1.594-1.58zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006v-1.589z"></path><path d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2z"></path></svg>
							</a>
                            
                            <div class="modal fade" id="modalEditData{{ $book->id }}">
                            	<div class="modal-dialog">
                            		<div class="modal-content">
                            			<div class="modal-header">
                            				<h4 class="modal-title">Edit Data</h4>
                            				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            					<span aria-hidden="true">&times;</span>
                            				</button>
                            			</div>
                            			<div class="modal-body">
                            				<div class="modal-body">
                            					<form action="/table/books/{{ $book->id }}" method="post" enctype="multipart/form-data">
                            						@method('put')
                            						@csrf
                            						<div class="form-floating mb-3">
                            							<label for="floatingInput3">ISBN</label>
                            							<input required name="isbn" type="text" required class="form-control" id="floatingInput3" value="{{ $book->isbn }}">
                            						</div>
                            						<div class="form-floating mb-3">
                            							<label for="floatingInput3">Judul Buku</label>
                            							<input required name="judul" type="text" required class="form-control" id="floatingInput3" value="{{ $book->judul }}">
                            						</div>
                            						<div class="form-floating mb-3">
                            							<label for="floatingInput3">Penulis</label>
                            							<input required name="penulis" type="text" required class="form-control" id="floatingInput3" value="{{ $book->penulis }}">
                            						</div>
                            						<div class="form-floating mb-3">
                            							<label for="floatingInput3">Penerbit</label>
                            							<input required name="penerbit" type="text" required class="form-control" id="floatingInput3"value="{{ $book->penerbit }}">
                            						</div>
                            						<div class="form-floating mb-3">
                            							<label for="floatingInput3">Kategori</label>
                            							<input required name="kategori" type="text" required class="form-control" id="floatingInput3" value="{{ $book->kategori }}">
                            						</div>
                                                    <div class="form-floating mb-3">
                                                        <label for="floatingInput3">Tanggal Terbit</label>
                                                        <input required name="tglTerbit" type="date" required class="form-control" id="floatingInput3" value="{{ $book->tglTerbit }}">
                                                    </div>
                                                    <div class="form-floating mb-3">
                                                        <label for="floatingInput3">Tanggal Masuk</label>
                                                        <input required name="tglMasuk" type="date" required class="form-control" id="floatingInput3" value="{{ $book->tglMasuk }}">
                                                    </div>
                            						<div class="form-floating mb-3">
                            							<label for="image" class="form-label">Cover</label>
														<input type="hidden" name="oldImage" value="{{ $book->image }}">
														@if ($book->image)
															<img src="{{ asset('storage/' . $book->image) }}" class="img-fluid img-preview-edit mb-3 col-sm-5 d-block">
														@else
															<img class="img-fluid img-preview mb-3 col-sm-5">
														@endif
										
														<div class="custom-file">
															<input type="file" class="custom-file-input" name="imageAdd" id="imageAdd" onchange="previewImageAdd()">
															<label class="custom-file-label" for="imageAdd"></label>
														</div>
														{{-- <input class="form-control" type="file" id="image" name="image" onchange="previewImage()"> --}}
                    								</div>									 
													</div>
                    								<div class="input-group">
                        								<button class="btn btn-success rounded me-1" type="submit">Submit</button>
                    								</div>
												</form>
                                			</div>
										</div>
										<div class="modal-footer justify-content-between">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
										
									</div>
								</div>
                            </div>


                            <a href="">

                                <form action="/table/books/{{ $book->id }}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                        <button type="submit" onclick="return confirm('Sure?')" class="btn btn-danger btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm4 12H8v-9h2v9zm6 0h-2v-9h2v9zm.618-15L15 2H9L7.382 4H3v2h18V4z"></path></svg>
                                        </button>
                                </form>
                                
                            </a>

						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

</div>

<script src="{{asset('plugins/jquery/jquery.min.js')}}}}"></script>

<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}}}"></script>

<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script src="{{asset('dist/js/adminlte.min.js?v=3.2.0')}}"></script>

<script src="{{asset('dist/js/demo.js')}}"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  
  function previewImageAdd(){
	  const image = document.querySelector('#imageAdd');
	  const imgPreview = document.querySelector('.img-preview-add')
		$('.custom-file-label').text(image.files[0].name);
	  imgPreview.style.display = 'block';
	  const oFReader = new FileReader();
	  oFReader.readAsDataURL(image.files[0]);
	  oFReader.onload = function(oFREvent){
		  imgPreview.src = oFREvent.target.result;

		}
    }
function previewImage(){
		const image = document.querySelector('#image');
		const imgPreview = document.querySelector('.img-preview');
		const imgPreviewEdit = document.querySelector('.img-preview-edit');
			$('.custom-file-label').text(image.files[0].name);
		imgPreview.style.display = 'block';
		imgPreviewEdit.style.display = 'none';
		const oFReader = new FileReader();
		oFReader.readAsDataURL(image.files[0]);
		oFReader.onload = function(oFREvent){
			imgPreview.src = oFREvent.target.result;
		}
}

</script>
@endsection
