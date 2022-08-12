@extends('layout.main')
@section('title', "Perpustakaan")

@section('right')
@include('layout.right')
@endsection

@section('left')
@include('layout.left')
@endsection

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
								<h4 class="modal-title">Default Modal</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="modal-body">
                                    <form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <label for="floatingInput3">ISBN</label>
                                            <input required name="isbn" type="text" required class="form-control" id="floatingInput3">
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="floatingInput3">Judul Buku</label>
                                            <input required name="title" type="text" required class="form-control" id="floatingInput3">
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="floatingInput3">Penulis</label>
                                            <input required name="author" type="text" required class="form-control" id="floatingInput3">
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="floatingInput3">Penerbit</label>
                                            <input required name="publisher" type="text" required class="form-control" id="floatingInput3">
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="floatingInput3">Kategori</label>
                                            <input required name="category" type="text" required class="form-control" id="floatingInput3">
                                        </div>
                                        <div class="form-floating mb-3">
                        					<label for="image" class="form-label">Foto</label>
                        					<img class="img-preview img-fluid mb-3 col-sm-5">
                        					<input name="cover" class="form-control" type="file" id="image" name="image" onchange="previewImage()">  
                        					<script>
        									// preview image
        										function previewImage() {
            										const image = document.querySelector("#image");
            										const imgPreview = document.querySelector(".img-preview");

            										imgPreview.style.display = "block";

            										const oFReader = new FileReader();
            										oFReader.readAsDataURL(image.file[0]);

            										oFReader.onload = function(oFEvent) {
                										imgPreview.src = oFEvent.target.result;
            										}
        										}
    										</script>   
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
						<th>Kategori</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($books as $book)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $book->isbn }}</td>
						<td>{{ $book->title }}</td>
						<td>{{ $book->author }}</td>
						<td>{{ $book->category }}</td>
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
                            					<form action="/books/{{ $book->id }}" method="post" enctype="multipart/form-data">
                            						@method('put')
                            						@csrf
                            						<div class="form-floating mb-3">
                            							<label for="floatingInput3">ISBN</label>
                            							<input required name="isbn" type="text" required class="form-control" id="floatingInput3" value="{{ $book->isbn }}">
                            						</div>
                            						<div class="form-floating mb-3">
                            							<label for="floatingInput3">Judul Buku</label>
                            							<input required name="title" type="text" required class="form-control" id="floatingInput3" value="{{ $book->title }}">
                            						</div>
                            						<div class="form-floating mb-3">
                            							<label for="floatingInput3">Penulis</label>
                            							<input required name="author" type="text" required class="form-control" id="floatingInput3" value="{{ $book->author }}">
                            						</div>
                            						<div class="form-floating mb-3">
                            							<label for="floatingInput3">Penerbit</label>
                            							<input required name="publisher" type="text" required class="form-control" id="floatingInput3"value="{{ $book->publisher }}">
                            						</div>
                            						<div class="form-floating mb-3">
                            							<label for="floatingInput3">Kategori</label>
                            							<input required name="category" type="text" required class="form-control" id="floatingInput3" value="{{ $book->category }}">
                            						</div>
                            						<div class="form-floating mb-3">
                            							<label for="image" class="form-label">Foto</label>
                                                            @if ($book->cover)
                                                                <img src="{{ asset('storage/' . $book->cover) }}" class="img-preview img-fluid mb-3 col-sm-5">
                                                            @else                           
                                                                <img class="img-preview img-fluid mb-3 col-sm-5">
                                                            @endif
                                                                <input name="cover" class="form-control" type="file" id="image" name="image" onchange="previewImage()"> 
                                                        <script>
        												// preview image
        												function previewImage() {
            												const image = document.querySelector("#image");
            												const imgPreview = document.querySelector(".img-preview");

            												imgPreview.style.display = "block";

           	 												const oFReader = new FileReader();
            												oFReader.readAsDataURL(image.file[0]);

            												oFReader.onload = function(oFEvent) {
                												imgPreview.src = oFEvent.target.result;
            												}
        												}
    													</script>
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

                                <form action="/book/{{ $book->id }}" method="POST" class="d-inline">
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
</script>

@endsection
@section('footer')
@include('layout.footer')
@endsection