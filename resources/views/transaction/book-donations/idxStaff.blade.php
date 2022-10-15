<div class="tab-content" id="custom-tabs-two-tabContent">
    <div class="tab-pane fade show active" id="tabs-waiting" role="tabpanel" aria-labelledby="tabs-waiting-tab">
        
        <!-- Tambah data -->
        <a href="/transaction/book-donations/create">
            <button type="button" class="btn btn-default mb-4">Tambah Data</button>
        </a>

        {{-- Tabel --}}
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Sumbangan</th>
                    <th>Nama Penyumbang</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($donationsWaiting as $dw)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $dw->kode_sumbangan }}</td>
                    <td>{{ $dw->member->nama }}</td>
                    <td><span class="badge badge-warning">{{ $dw->status }}</span></td>
                    <td>
                        
                        <!-- Edit -->
                        <a href="/transaction/book-donations/edit/{{ $dw->id }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-pencil-alt"></i>
                        </a>

                        <!-- Detail -->
                        <button class="btn btn-info   btn-sm btn-detail" type="button" data-toggle="modal" data-target="#show{{ $dw->id }}"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail">
                            <i class="fas fa-eye "></i>
                        </button>
                        <div class="modal fade" id="show{{ $dw->id }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="form-floating">
                                            <h5 class="font-weight-bold ml-3 mt-3">Detail Kode Sumbangan : {{ $dw->kode_sumbangan }}</h5>
                                        </div>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-floating mb-3" style="text-align: center;">
                                            <label for="floatingInput3">Yang Menyumbakan :</label>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">NIS</label>
                                            <div class="col-sm-10">
                                                <input required name="nama" type="text" required class="form-control" id="floatingInput3" value="{{ $dw->member->nis }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                                            <div class="col-sm-10">
                                                <input required name="jenis_kelamin" type="text" required class="form-control" id="floatingInput3" value="{{ $dw->member->nama }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Kelas</label>
                                            <div class="col-sm-10">
                                                <input required name="kelas" type="text" required class="form-control" id="floatingInput3" value="{{ $dw->member->kelas }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Jurusan</label>
                                            <div class="col-sm-10">
                                                <input required name="jurusan" type="text" required class="form-control" id="floatingInput3" value="{{ $dw->member->jurusan }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">No Telp</label>
                                            <div class="col-sm-10">
                                                <input required name="nomor_telepon" type="text" required class="form-control" id="floatingInput3" value="{{ $dw->member->nomor_telepon }}" disabled>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mt-4">
                                            <div style="text-align: center;">
                                                <label>Buku yang akan di sumbangkan :</label>
                                            </div>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10px">No</th>
                                                        <th>ISBN</th>
                                                        <th>Judul</th>
                                                        <th>Penulis</th>
                                                        <th>Penerbit</th>
                                                        <th>Kategori</th>
                                                        <th>Kuantitas</th>
                                                        <th>Cover</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($dw->bookDonation as $bd)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $bd->isbn }}</td>
                                                        <td>{{ $bd->judul }}</td>
                                                        <td>{{ $bd->penulis }}</td>
                                                        <td>{{ $bd->penerbit }}</td>
                                                        <td>{{ $bd->kategori }}</td>
                                                        <td>{{ $bd->stok_masuk }}</td>
                                                        <td>
                                                            @if ($bd->image == "NULL")
                                                                <span>-</span>
                                                            @else
                                                            <img src="{{ asset('storage/' . $bd->image) }}" id="img-preview" class="img-fluid img-preview mb-3 col-sm-5 d-block">
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- approved -->
                        <button class="btn btn-success btn-sm btn-approved" type="button" data-toggle="modal" data-target="#approved{{ $dw->id }}"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Menyetujui">
                            <i class="fas fa-check"></i> 
                        </button>
                        <div class="modal fade" id="approved{{ $dw->id }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Details</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-floating mb-3 d-flex justify-content-end">
                                            <label for="floatingInput3">Kode Sumbangan : {{ $dw->kode_sumbangan }}</label>
                                        </div>
                                        <div class="form-floating mb-3" style="text-align: center;">
                                            <label for="floatingInput3">Yang Menyumbakan :</label>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">NIS</label>
                                            <div class="col-sm-10">
                                                <input required name="nama" type="text" required class="form-control" id="floatingInput3" value="{{ $dw->member->nis }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                                            <div class="col-sm-10">
                                                <input required name="jenis_kelamin" type="text" required class="form-control" id="floatingInput3" value="{{ $dw->member->nama }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Kelas</label>
                                            <div class="col-sm-10">
                                                <input required name="kelas" type="text" required class="form-control" id="floatingInput3" value="{{ $dw->member->kelas }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Jurusan</label>
                                            <div class="col-sm-10">
                                                <input required name="jurusan" type="text" required class="form-control" id="floatingInput3" value="{{ $dw->member->jurusan }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">No Telp</label>
                                            <div class="col-sm-10">
                                                <input required name="nomor_telepon" type="text" required class="form-control" id="floatingInput3" value="{{ $dw->member->nomor_telepon }}" disabled>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mt-4">
                                            <div style="text-align: center;">
                                                <label>Buku yang akan di sumbangkan :</label>
                                            </div>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10px">No</th>
                                                        <th>ISBN</th>
                                                        <th>Judul</th>
                                                        <th>penulis</th>
                                                        <th>penerbit</th>
                                                        <th>Kategori</th>
                                                        <th>Kuantitas</th>
                                                        <th>cover</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($dw->bookDonation as $bd)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $bd->isbn }}</td>
                                                        <td>{{ $bd->judul }}</td>
                                                        <td>{{ $bd->penulis }}</td>
                                                        <td>{{ $bd->penerbit }}</td>
                                                        <td>{{ $bd->kategori }}</td>
                                                        <td>{{ $bd->stok_masuk }}</td>
                                                        <td>
                                                            @if (!$bd->image)
                                                                <span>-</span>
                                                            @else
                                                                <img src="{{ asset('storage/' . $bd->image) }}" id="img-preview" class="img-fluid img-preview mb-3 col-sm-5 d-block">
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <a href="/transaction/book-donations/approved/{{ $dw->id }}" class="btn btn-success">Menyetujui</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- reject -->
                        <button class="btn btn-success btn-sm btn-danger" type="button" data-toggle="modal" data-target="#reject{{ $dw->id }}"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tolak">
                            <i class="fas fa-times"></i>
                        </button>
                        <div class="modal fade" id="reject{{ $dw->id }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Details</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-floating mb-3 d-flex justify-content-end">
                                            <label for="floatingInput3">Kode Sumbangan : {{ $dw->kode_sumbangan }}</label>
                                        </div>
                                        <div class="form-floating mb-3" style="text-align: center;">
                                            <label for="floatingInput3">Yang Menyumbakan :</label>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">NIS</label>
                                            <div class="col-sm-10">
                                                <input required name="nama" type="text" required class="form-control" id="floatingInput3" value="{{ $dw->member->nis }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                                            <div class="col-sm-10">
                                                <input required name="jenis_kelamin" type="text" required class="form-control" id="floatingInput3" value="{{ $dw->member->nama }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Kelas</label>
                                            <div class="col-sm-10">
                                                <input required name="kelas" type="text" required class="form-control" id="floatingInput3" value="{{ $dw->member->kelas }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Jurusan</label>
                                            <div class="col-sm-10">
                                                <input required name="jurusan" type="text" required class="form-control" id="floatingInput3" value="{{ $dw->member->jurusan }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">No Telp</label>
                                            <div class="col-sm-10">
                                                <input required name="nomor_telepon" type="text" required class="form-control" id="floatingInput3" value="{{ $dw->member->nomor_telepon }}" disabled>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mt-4">
                                            <div style="text-align: center;">
                                                <label>Buku yang akan di sumbangkan :</label>
                                            </div>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10px">No</th>
                                                        <th>ISBN</th>
                                                        <th>Judul</th>
                                                        <th>penulis</th>
                                                        <th>penerbit</th>
                                                        <th>Kategori</th>
                                                        <th>Kuantitas</th>
                                                        <th>cover</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($dw->bookDonation as $bd)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $bd->isbn }}</td>
                                                        <td>{{ $bd->judul }}</td>
                                                        <td>{{ $bd->penulis }}</td>
                                                        <td>{{ $bd->penerbit }}</td>
                                                        <td>{{ $bd->kategori }}</td>
                                                        <td>{{ $bd->stok_masuk }}</td>
                                                        <td>
                                                            @if (!$bd->image)
                                                                <span>-</span>
                                                            @else
                                                                <img src="{{ asset('storage/' . $bd->image) }}" id="img-preview" class="img-fluid img-preview mb-3 col-sm-5 d-block">
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <a href="/transaction/book-donations/reject/{{ $dw->id }}" class="btn btn-danger">Tolak</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <div class="tab-pane fade" id="tabs-pengambilan-buku" role="tabpanel" aria-labelledby="tabs-pengambilan-buku-tab">
        
        {{-- Tabel --}}
        <table id="example2" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Sumbangan</th>
                    <th>Nama Penyumbang</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($donationsGet as $donation)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $donation->kode_sumbangan }}</td>
                    <td>{{ $donation->member->nama }}</td>
                    <td><span class="badge badge-success">{{ $donation->status }}</span></td>
                    <td>

                        <!-- Detail -->
                        <button class="btn btn-info btn-sm btn-detail" type="button" data-toggle="modal" data-target="#show{{ $donation->id }}"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail">
                            <i class="fas fa-eye "></i>
                        </button>
                        <div class="modal fade" id="show{{ $donation->id }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="form-floating">
                                            <h5 class="font-weight-bold ml-3 mt-3">Detail Kode Sumbangan : {{ $donation->kode_sumbangan }}</h5>
                                        </div>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-floating mb-3" style="text-align: center;">
                                            <label for="floatingInput3">Yang Menyumbakan :</label>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">NIS</label>
                                            <div class="col-sm-10">
                                                <input required name="nama" type="text" required class="form-control" id="floatingInput3" value="{{ $donation->member->nis }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                                            <div class="col-sm-10">
                                                <input required name="jenis_kelamin" type="text" required class="form-control" id="floatingInput3" value="{{ $donation->member->nama }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Kelas</label>
                                            <div class="col-sm-10">
                                                <input required name="kelas" type="text" required class="form-control" id="floatingInput3" value="{{ $donation->member->kelas }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Jurusan</label>
                                            <div class="col-sm-10">
                                                <input required name="jurusan" type="text" required class="form-control" id="floatingInput3" value="{{ $donation->member->jurusan }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">No Telp</label>
                                            <div class="col-sm-10">
                                                <input required name="nomor_telepon" type="text" required class="form-control" id="floatingInput3" value="{{ $donation->member->nomor_telepon }}" disabled>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mt-4">
                                            <div style="text-align: center;">
                                                <label>Buku yang akan di sumbangkan :</label>
                                            </div>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10px">No</th>
                                                        <th>ISBN</th>
                                                        <th>Judul</th>
                                                        <th>Penulis</th>
                                                        <th>Penerbit</th>
                                                        <th>Kategori</th>
                                                        <th>Kuantitas</th>
                                                        <th>cover</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($donation->bookDonation as $bd)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $bd->isbn }}</td>
                                                        <td>{{ $bd->judul }}</td>
                                                        <td>{{ $bd->penulis }}</td>
                                                        <td>{{ $bd->penerbit }}</td>
                                                        <td>{{ $bd->kategori }}</td>
                                                        <td>{{ $bd->stok_masuk }}</td>
                                                        <td>
                                                            @if (!$bd->image)
                                                                <span>-</span>
                                                            @else
                                                                <img src="{{ asset('storage/' . $bd->image) }}" id="img-preview" class="img-fluid img-preview mb-3 col-sm-5 d-block">
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- serah terima -->
                        <button class="btn btn-success btn-sm btn-handover" type="button" data-toggle="modal" data-target="#handover{{ $donation->id }}"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Serah Terima">
                            <i class="fas fa-check"></i> 
                        </button>
                        <div class="modal fade" id="handover{{ $donation->id }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="form-floating">
                                            <h5 class="font-weight-bold ml-3 mt-3">Detail Kode Sumbangan : {{ $donation->kode_sumbangan }}</h5>
                                        </div>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-floating mb-3" style="text-align: center;">
                                            <label for="floatingInput3">Yang Menyumbakan :</label>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">NIS</label>
                                            <div class="col-sm-10">
                                                <input required name="nama" type="text" required class="form-control" id="floatingInput3" value="{{ $donation->member->nis }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                                            <div class="col-sm-10">
                                                <input required name="jenis_kelamin" type="text" required class="form-control" id="floatingInput3" value="{{ $donation->member->nama }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Kelas</label>
                                            <div class="col-sm-10">
                                                <input required name="kelas" type="text" required class="form-control" id="floatingInput3" value="{{ $donation->member->kelas }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Jurusan</label>
                                            <div class="col-sm-10">
                                                <input required name="jurusan" type="text" required class="form-control" id="floatingInput3" value="{{ $donation->member->jurusan }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">No Telp</label>
                                            <div class="col-sm-10">
                                                <input required name="nomor_telepon" type="text" required class="form-control" id="floatingInput3" value="{{ $donation->member->nomor_telepon }}" disabled>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mt-4">
                                            <div style="text-align: center;">
                                                <label>Buku yang akan di sumbangkan :</label>
                                            </div>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10px">No</th>
                                                        <th>ISBN</th>
                                                        <th>Judul</th>
                                                        <th>Penulis</th>
                                                        <th>Penerbit</th>
                                                        <th>Kategori</th>
                                                        <th>Kuantitas</th>
                                                        <th>cover</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($donation->bookDonation as $bd)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $bd->isbn }}</td>
                                                        <td>{{ $bd->judul }}</td>
                                                        <td>{{ $bd->penulis }}</td>
                                                        <td>{{ $bd->penerbit }}</td>
                                                        <td>{{ $bd->kategori }}</td>
                                                        <td>{{ $bd->stok_masuk }}</td>
                                                        <td>
                                                            @if (!$bd->image)
                                                                <span>-</span>
                                                            @else
                                                                <img src="{{ asset('storage/' . $bd->image) }}" id="img-preview" class="img-fluid img-preview mb-3 col-sm-5 d-block">
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                                        <a href="/transaction/book-donations/handover/{{ $donation->id }}" class="btn btn-success">Sudah Diterima</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- cancel -->
                        <button class="btn btn-danger btn-sm btn-cancel" type="button" data-toggle="modal" data-target="#cancel{{ $donation->id }}"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Batalkan Sumbangan">
                            <i class="fas fa-times"></i>
                        </button>
                        <div class="modal fade" id="cancel{{ $donation->id }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="form-floating">
                                            <h5 class="font-weight-bold ml-3 mt-3">Detail Kode Sumbangan : {{ $donation->kode_sumbangan }}</h5>
                                        </div>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-floating mb-3" style="text-align: center;">
                                            <label for="floatingInput3">Yang Menyumbakan :</label>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">NIS</label>
                                            <div class="col-sm-10">
                                                <input required name="nama" type="text" required class="form-control" id="floatingInput3" value="{{ $donation->member->nis }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                                            <div class="col-sm-10">
                                                <input required name="jenis_kelamin" type="text" required class="form-control" id="floatingInput3" value="{{ $donation->member->nama }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Kelas</label>
                                            <div class="col-sm-10">
                                                <input required name="kelas" type="text" required class="form-control" id="floatingInput3" value="{{ $donation->member->kelas }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">Jurusan</label>
                                            <div class="col-sm-10">
                                                <input required name="jurusan" type="text" required class="form-control" id="floatingInput3" value="{{ $donation->member->jurusan }}" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-2 col-form-label">No Telp</label>
                                            <div class="col-sm-10">
                                                <input required name="nomor_telepon" type="text" required class="form-control" id="floatingInput3" value="{{ $donation->member->nomor_telepon }}" disabled>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mt-4">
                                            <div style="text-align: center;">
                                                <label>Buku yang akan di sumbangkan :</label>
                                            </div>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10px">No</th>
                                                        <th>ISBN</th>
                                                        <th>Judul</th>
                                                        <th>penulis</th>
                                                        <th>penerbit</th>
                                                        <th>Kategori</th>
                                                        <th>Kuantitas</th>
                                                        <th>cover</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($donation->bookDonation as $bd)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $bd->isbn }}</td>
                                                        <td>{{ $bd->judul }}</td>
                                                        <td>{{ $bd->penulis }}</td>
                                                        <td>{{ $bd->penerbit }}</td>
                                                        <td>{{ $bd->kategori }}</td>
                                                        <td>{{ $bd->stok_masuk }}</td>
                                                        <td>
                                                            @if (!$bd->image)
                                                                <span>-</span>
                                                            @else
                                                                <img src="{{ asset('storage/' . $bd->image) }}" id="img-preview" class="img-fluid img-preview mb-3 col-sm-5 d-block">
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                                        <a href="/transaction/book-donations/cancel/{{ $donation->id }}" class="btn btn-danger">Batalkan Sumbangan</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>