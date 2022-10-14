<div class="tab-content" id="custom-tabs-two-tabContent">
    <div class="tab-pane fade show active" id="tabs-waiting" role="tabpanel" aria-labelledby="tabs-waiting-tab">
        
        <!-- Tambah data -->
        <button type="button" class="btn btn-default mb-4" data-toggle="modal" data-target="#modal-default">Tambah Data</button>
        <!-- Modal Tambah Data -->
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body">
                            <form action="/transaction/book-donations" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-floating mb-3">
                                    <label for="floatingInput3">Nama Anggota</label>
                                    <select name="member_id" id="" class="form-control select2">
                                        <option disabled selected>Pilih Anggota</option>
                                        @foreach($anggota as $a)
                                        <option value="{{ $a->id }}">{{ $a->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-floating mb-3">
                                    <label for="floatingInput3">ISBN</label>
                                    <input required name="isbn" type="text" required class="form-control @error('isbn') is-invalid @enderror " id="floatingInput3"  value="{{ old('isbn') }}">
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
                                    <select name="kategori" type="text" required class="select2 form-control @error('kategori') is-invalid @enderror " id="floatingInput3" value="{{ old('kategori') }}">
                                        <option disabled selected>Pilih Kategori</option>
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
                                    <input required name="stock_masuk" type="number" required class="form-control " id="floatingInput3">
                                    
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
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
                            
        </div>
        <!-- End tambah data -->

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
                @foreach($bookDonationsWaiting as $bookDonation)
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
                        @endif
                    </td>
                    <td>


                        <!-- Form Approved -->
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#show{{ $bookDonation->id }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Approved"> 
                            <i class="fas fa-check"></i>
                        </button>
                        <div class="modal fade" id="show{{ $bookDonation->id }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
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
                                                <label for="floatingInput3">Kategori</label>
                                                <input required name="kategori" type="text" required class="form-control" id="floatingInput3"value="{{ $bookDonation->kategori }}" disabled>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <label for="floatingInput3">Tanggal Terbit</label>
                                                <input required name="tglTerbit" type="text" required class="form-control" id="floatingInput3"value="{{ $bookDonation->tglTerbit }}" disabled>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <label for="floatingInput3">Tanggal Masuk</label>
                                                <input required name="tglMasuk" type="text" required class="form-control" id="floatingInput3"value="{{ $bookDonation->tglMasuk }}" disabled>
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
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <form action="/transaction/book-donations/approved" method="post">
                                            @csrf
                                            <input type="text" name="id" hidden value="{{ $bookDonation->id }}">
                                            <button type="submit" class="btn btn-success">Approved</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End Form Approved --}}
                        {{-- Detail show data --}}
                        <button class="btn btn-primary   btn-sm btn-detail" type="button" data-toggle="modal" data-target="#showw{{ $bookDonation->id }}"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail Donasi">
                            <i class="fas fa-eye "></i>
                        </button>
                        <div class="modal fade" id="showw{{ $bookDonation->id }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Detail Donasi</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
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
                                                <label for="floatingInput3">Kategori</label>
                                                <input required name="kategori" type="text" required class="form-control" id="floatingInput3"value="{{ $bookDonation->kategori }}" disabled>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <label for="floatingInput3">Tanggal Terbit</label>
                                                <input required name="tglTerbit" type="text" required class="form-control" id="floatingInput3"value="{{ $bookDonation->tglTerbit }}" disabled>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <label for="floatingInput3">Tanggal Masuk</label>
                                                <input required name="tglMasuk" type="text" required class="form-control" id="floatingInput3"value="{{ $bookDonation->tglMasuk }}" disabled>
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
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <!-- End Detail show data -->

                        <!-- Edit Data -->
                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-default{{ $bookDonation->id }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Donasi Buku"> <i class="fas fa-pencil-alt"></i> </button>
                            <div class="modal fade" id="modal-default{{ $bookDonation->id }}">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Donasi Buku</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/transaction/book-donations/{{ $bookDonation->id }}" method="post" enctype="multipart/form-data">
                                                @method('put')
                                                @csrf
                                                <div class="form-floating mb-3">
                                                    <label for="floatingInput3">ISBN</label>
                                                    <input required name="isbn" type="number" required class="form-control" id="floatingInput3" value="{{ $bookDonation->isbn }}">
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
                                                    <label for="floatingInput3">Kategori</label>
                                                    <select name="kategori" type="text" required class="select2 form-control" id="floatingInput3" value="{{ $bookDonation->kategori }}">
                                                        <option disabled selected>{{ $bookDonation->kategori }}</option>
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
                                                <div class="form-floating mb-3">
                                                    <label for="floatingInput3">Tanggal Terbit</label>
                                                    <input required name="tglTerbit" type="date" required class="form-control" id="floatingInput3" value="{{ $bookDonation->tglTerbit }}">
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <label for="floatingInput3">Tanggal Masuk</label>
                                                    <input required name="tglMasuk" type="date" required class="form-control" id="floatingInput3" value="{{ $bookDonation->tglMasuk }}">
                                                </div>                                                             
                                                <div class="form-floating mb-3">
                                                    <label for="floatingInput3">Kuantitas</label>
                                                    <input required name="stock_masuk" type="number" required class="form-control" id="floatingInput3" value="{{ $bookDonation->stock_masuk }}">
                                                </div>
                                                <div class="form-floating mb-3">
                                                    <label for="">Cover</label>
                                                    @if (!$bookDonation->image)
                                                        <img id="img-preview" class="img-fluid img-preview mb-3 col-sm-5">
                                                    @else
                                                        <img src="{{ asset('storage/' . $bookDonation->image) }}" id="img-preview" class="img-fluid img-preview mb-3 col-sm-5 d-block">
                                                    @endif
                                                    <input class="form-control" type="file" id="image" name="image" onchange="previewImage()">
                                                    <input type="hidden" name="oldImage" value="{{ $bookDonation->image }}">
                                                    
                                                </div>
                                                <div class="input-group">
                                                    <button class="btn btn-success rounded me-1" type="submit">Update</button>
                                                </div>
                                            </form>  
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        <!-- End Edit data -->

                        <!-- Form Tolak -->
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#tolak{{ $bookDonation->id }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tolak"> 
                            <i class="fas fa-times"></i>
                        </button>
                        <div class="modal fade" id="tolak{{ $bookDonation->id }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form action="/transaction/book-donations/reject/{{ $bookDonation->id }}" method="post" enctype="multipart/form-data">
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
                                                <label for="floatingInput3">Kategori</label>
                                                <input required name="kategori" type="text" required class="form-control" id="floatingInput3"value="{{ $bookDonation->kategori }}" disabled>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <label for="floatingInput3">Tanggal Terbit</label>
                                                <input required name="tglTerbit" type="text" required class="form-control" id="floatingInput3"value="{{ $bookDonation->tglTerbit }}" disabled>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <label for="floatingInput3">Tanggal Masuk</label>
                                                <input required name="tglMasuk" type="text" required class="form-control" id="floatingInput3"value="{{ $bookDonation->tglMasuk }}" disabled>
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
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <form action="/transaction/book-donations/reject/{{ $bookDonation->id }}" method="post">
                                            @csrf
                                            <input type="text" name="id" hidden value="{{ $bookDonation->id }}">
                                            <button type="submit" class="btn btn-danger">Tolak</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End Form Tolak --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="tab-pane fade" id="tabs-pengambilan-buku" role="tabpanel" aria-labelledby="tabs-pengambilan-buku-tab">
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
                @foreach($bookDonationsGet as $bookDonation)
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
                        @endif
                    </td>
                    <td>
                        {{-- Form Approved --}}
                        {{-- <form action="/transaction/book-donations/addBook" method="post">
                            @csrf
                            <input type="text" hidden value="{{ $bookDonation->id }}" name="id" >
                            <input type="text" hidden value="{{ $bookDonation->isbn }}" name="isbn">
                            <button type="submit" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default{{ $bookDonation->id }}{{ $bookDonation->isbn }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Kirim ke Tabel Buku !">
                                <i class="fas fa-check"></i> 
                            </button>
                        </form> --}}
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#show{{ $bookDonation->id }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Send it !"> 
                            <i class="fas fa-arrow-up"></i>
                        </button>
                        <div class="modal fade" id="show{{ $bookDonation->id }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form action="/transaction/book-donations/addBook" method="post" enctype="multipart/form-data">
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
                                                <label for="floatingInput3">Kategori</label>
                                                <input required name="kategori" type="text" required class="form-control" id="floatingInput3"value="{{ $bookDonation->kategori }}" disabled>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <label for="floatingInput3">Tanggal Terbit</label>
                                                <input required name="tglTerbit" type="text" required class="form-control" id="floatingInput3"value="{{ $bookDonation->tglTerbit }}" disabled>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <label for="floatingInput3">Tanggal Masuk</label>
                                                <input required name="tglMasuk" type="text" required class="form-control" id="floatingInput3"value="{{ $bookDonation->tglMasuk }}" disabled>
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
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <form action="/transaction/book-donations/addBook" method="post">
                                            @csrf
                                            <input type="text" name="id" hidden value="{{ $bookDonation->id }}">
                                            <input type="text" hidden value="{{ $bookDonation->isbn }}" name="isbn">
                                            <button type="submit" class="btn btn-success">Send To Book's Table !</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End Form Approved --}}

                        {{-- Show --}}
                        <button class="btn btn-primary   btn-sm btn-detail" type="button" data-toggle="modal" data-target="#showw{{ $bookDonation->id }}"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail Donasi">
                            <i class="fas fa-eye "></i>
                        </button>
                        <div class="modal fade" id="showw{{ $bookDonation->id }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Detail Donasi</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
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
                                                <label for="floatingInput3">Kategori</label>
                                                <input required name="kategori" type="text" required class="form-control" id="floatingInput3"value="{{ $bookDonation->kategori }}" disabled>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <label for="floatingInput3">Tanggal Terbit</label>
                                                <input required name="tglTerbit" type="text" required class="form-control" id="floatingInput3"value="{{ $bookDonation->tglTerbit }}" disabled>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <label for="floatingInput3">Tanggal Masuk</label>
                                                <input required name="tglMasuk" type="text" required class="form-control" id="floatingInput3"value="{{ $bookDonation->tglMasuk }}" disabled>
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
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End Show --}}
                        
                        {{-- Form Reject --}}
                        {{-- <form action="/transaction/book-donations/cancel" method="post">
                            @csrf
                            <input type="text" hidden value="{{ $bookDonation->id }}" name="id" >
                            <button type="submit" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-default{{ $bookDonation->id }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tolak">
                                <i class="fas fa-times"></i> 
                            </button>
                        </form> --}}
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#tolak{{ $bookDonation->id }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Cancel"> 
                            <i class="fas fa-times"></i>
                        </button>
                        <div class="modal fade" id="tolak{{ $bookDonation->id }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form action="/transaction/book-donations/cancel" method="post" enctype="multipart/form-data">
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
                                                <label for="floatingInput3">Kategori</label>
                                                <input required name="kategori" type="text" required class="form-control" id="floatingInput3"value="{{ $bookDonation->kategori }}" disabled>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <label for="floatingInput3">Tanggal Terbit</label>
                                                <input required name="tglTerbit" type="text" required class="form-control" id="floatingInput3"value="{{ $bookDonation->tglTerbit }}" disabled>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <label for="floatingInput3">Tanggal Masuk</label>
                                                <input required name="tglMasuk" type="text" required class="form-control" id="floatingInput3"value="{{ $bookDonation->tglMasuk }}" disabled>
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
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <form action="/transaction/book-donations/cancel" method="post">
                                            @csrf
                                            <input type="text" name="id" hidden value="{{ $bookDonation->id }}">
                                            <button type="submit" class="btn btn-danger">Cancel</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End Form Reject --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>