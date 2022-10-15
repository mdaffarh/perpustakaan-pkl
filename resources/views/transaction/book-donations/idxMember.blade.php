<div>
    <a href="/transaction/book-donations/create">
        <button type="button" class="btn btn-default">Donasi Buku disini!</button>
    </a>
</div>

{{-- Tabel --}}
<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Sumbangan</th>
            <th>Status</th>
            <th>Disumbangkan pada tanggal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($donationsMember as $donation)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $donation->kode_sumbangan }}</td>
            <td>
                <!-- menunggu persetujuan -->
                @if($donation->status=="menunggu persetujuan" && $donation->diambil== NULL)
                <span class="badge badge-warning">Menunggu Persetujuan</span>
                <!-- Jika di setujui -->
                @elseif($donation->status=="disetujui" && $donation->diambil=="belum")
                <span class="badge badge-info">Disetujui</span>
                <!-- ditolak -->
                @elseif($donation->status=="ditolak")
                <span class="badge badge-danger">Ditolak</span>
                <!-- di cancel sebelum disetujui -->
                @elseif($donation->status=="Dicancel")
                <span class="badge badge-danger">Dicancel</span>
                <!-- cancel setealah disetujui -->
                @elseif($donation->diambil=="Dicancel")
                <span class="badge badge-danger">Dicancel</span>
                <!-- selesai -->
                @elseif($donation->status=="disetujui" && $donation->diambil=="Sudah")
                <span class="badge badge-success">Selesai</span>
                @endif
            </td>
            <td>{{ $donation->created_at }}</td>
            <td>
                
                <!-- Detail -->
                <button class="btn btn-info   btn-sm btn-detail" type="button" data-toggle="modal" data-target="#show{{ $donation->id }}"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Detail">
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
                                <div>
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
                                @if($donation->status=="disetujui" && "ditolak")
                                <hr>
                                <div class="form-floating mb-3" style="text-align: center;">
                                    <label for="floatingInput3">Staff Approved/Reject :</label>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input required name="nama" type="text" required class="form-control" id="floatingInput3" value="
                                            @if ($donation->staffygngambil == NULL && $donation->staff_approved == NULL)
                                                -
                                            @elseif($donation->staffygngambil == NULL )
                                                {{ $donation->creator->nama }}
                                            @else
                                                {{  $donation->editor->nama }}    
                                            @endif" 
                                        disabled>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
                            </div>
                        </div>
                    </div>
                </div>
                
                @if($donation->status=="menunggu persetujuan")
                <!-- edit (hanya bisa saat belum di setujui) -->
                    <a href="/transaction/book-donations/edit/{{ $donation->id }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-pencil-alt"></i>
                    </a>

                <!-- pembatalan sebelum di setujui -->
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
                                    <div>
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
                                    <a href="/transaction/book-donations/delete/{{ $donation->id }}" class="btn btn-danger">Batalkan Sumbangan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- pembatalan saat sudah di setujui -->
                @if($donation->status=="disetujui" && $donation->diambil=="belum")
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
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>