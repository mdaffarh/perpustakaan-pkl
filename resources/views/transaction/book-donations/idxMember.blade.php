<div>
    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">Donasi Buku disini !</button>
    {{-- Tambah Data --}}
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Donasi Buku</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body">
                        <form action="/transaction/book-donations" method="post" enctype="multipart/form-data">
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
                                <input required name="judul" type="text" required class="form-control @error('judul') is-invalid @enderror " id="floatingInput3" value="{{ old('judul') }}">
                                    @error('judul')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <label for="floatingInput3">Penulis</label>
                                <input required name="penulis" type="text" required class="form-control @error('penulis') is-invalid @enderror " id="floatingInput3" value="{{ old('penulis') }}" >
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
                                <label for="floatingInput3">Kuantitas</label>
                                <input required name="stock_awal" type="number" required class="form-control @error('stock_awal') is-invalid @enderror " id="floatingInput3" value="{{ old('stock_awal') }}">
                                @error('stock_awal')
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

{{-- Tabel --}}
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>ISBN</th>
            <th>Judul Buku</th>
            <th>Penulis</th>
            <th>Kuantitas</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bookDonations as $bookDonation)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $bookDonation->isbn }}</td>
            <td>{{ $bookDonation->judul }}</td>
            <td>{{ $bookDonation->penulis }}</td>
            <td>{{ $bookDonation->stock_masuk }}</td>
            <td>
                @if($bookDonation->status=="menunggu persetujuan")
                <span class="badge badge-warning">Menunggu Persetujuan</span>
                @elseif($bookDonation->status=="disetujui")
                <span class="badge badge-success">Disetujui</span>
                @elseif($bookDonation->status=="ditolak")
                <span class="badge badge-danger">Ditolak</span>
                @endif
            </td>
            <td>

                {{-- Edit --}}
                @if($bookDonation->status=="menunggu persetujuan")
                <a href="#modalEditData{{ $bookDonation->id }}" data-toggle="modal" class="btn btn-outline-info btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(0, 0, 0, 1);transform: msFilter"><path d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583v4.43zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585 1.594-1.58zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006v-1.589z"></path><path d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2z"></path></svg>
                </a>
                @endif
                
                <div class="modal fade" id="modalEditData{{ $bookDonation->id }}">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Data</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="modal-body">
                                    <form action="/transaction/book-donations/{{ $bookDonation->id }}" method="post" enctype="multipart/form-data">
                                        @method('put')
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <label for="floatingInput3">ISBN</label>
                                            <input required name="isbn" type="text" required class="form-control" id="floatingInput3" value="{{ $bookDonation->isbn }}">
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="floatingInput3">Judul Buku</label>
                                            <input required name="judul" type="text" required class="form-control" id="floatingInput3" value="{{ $bookDonation->judul }}">
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="floatingInput3">Penulis</label>
                                            <input required name="penulis" type="text" required class="form-control" id="floatingInput3" value="{{ $bookDonation->penulis }}">
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="floatingInput3">Penerbit</label>
                                            <input required name="penerbit" type="text" required class="form-control" id="floatingInput3"value="{{ $bookDonation->penerbit }}">
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="floatingInput3">Kuantitas</label>
                                            <input required name="stock_masuk" type="text" required class="form-control" id="floatingInput3"value="{{ $bookDonation->stock_masuk }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Cover</label>
                                            <input type="hidden" name="oldImage" value="{{ $bookDonation->image }}">
                                            @if (!$bookDonation->image)
                                                <img class="img-fluid img-preview mb-3 col-sm-5">
                                            @else
                                                <img src="{{ asset('storage/' . $bookDonation->image) }}" class="img-fluid img-preview mb-3 col-sm-5 d-block">
                                            @endif
                                            
                                            <input class="form-control" type="file" id="image" name="image" onchange="previewImage()">
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
                
                {{-- Show --}}
                <a href="#show{{ $bookDonation->id }}" data-toggle="modal" class="btn btn-outline-success btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(0, 0, 0, 1);transform: msFilter" class="bi bi-eye" viewBox="0 0 16 16">
                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                    </svg>
                </a>
                
                <div class="modal fade" id="show{{ $bookDonation->id }}">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Tampil Data</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="modal-body">
                                    <form action="/transaction/book-donations/{{ $bookDonation->id }}" method="post" enctype="multipart/form-data">
                                        @method('put')
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <label for="floatingInput3">ISBN</label>
                                            <input required name="isbn" type="text" required class="form-control" id="floatingInput3" value="{{ $bookDonation->isbn }}" disabled>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="floatingInput3">Judul Buku</label>
                                            <input required name="judul" type="text" required class="form-control" id="floatingInput3" value="{{ $bookDonation->judul }}" disabled>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="floatingInput3">Penulis</label>
                                            <input required name="penulis" type="text" required class="form-control" id="floatingInput3" value="{{ $bookDonation->penulis }}" disabled>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="floatingInput3">Penerbit</label>
                                            <input required name="penerbit" type="text" required class="form-control" id="floatingInput3"value="{{ $bookDonation->penerbit }}" disabled>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="floatingInput3">Kuantitas</label>
                                            <input required name="stock_masuk" type="text" required class="form-control" id="floatingInput3"value="{{ $bookDonation->stock_masuk }}" disabled>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <label for="image" class="form-label">Cover</label>
                                            @if ($bookDonation->image)
                                                <img src="{{ asset('storage/' . $bookDonation->image) }}" class="img-fluid mb-3 col-sm-5 d-block">
                                            @else
                                                <img src="{{ asset("assets/img/book_cover_default.png") }}" class="img-fluid mb-3 col-sm-4 d-block">
                                            @endif
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
                    @if($bookDonation->status=="menunggu persetujuan")
                        <form action="/transaction/book-donations/{{ $bookDonation->id }}" method="POST" class="d-inline">
                            @method('delete')
                            @csrf
                            <button type="submit" onclick="return confirm('Sure?')" class="btn btn-outline-danger btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(0, 0, 0, 1);transform: msFilter"><path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm4 12H8v-9h2v9zm6 0h-2v-9h2v9zm.618-15L15 2H9L7.382 4H3v2h18V4z"></path></svg>
                            </button>
                        </form>
                    @endif
                

            </td>
        </tr>
        @endforeach
    </tbody>
</table>