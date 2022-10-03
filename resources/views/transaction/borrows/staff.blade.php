<div class="tab-content" id="custom-tabs-two-tabContent">
    <div class="tab-pane fade show active" id="tabs-waiting" role="tabpanel" aria-labelledby="tabs-waiting-tab">
        <button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#modal-default">Tambah Peminjaman</button>
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Peminjaman</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body">
                            <form action="/transaction/borrows/directBorrow" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-floating mb-3">
                                    <label for="floatingInput3">Nama Anggota</label>
                                    <select class="form-select form-control select2" aria-label="Default select example" name="member_id" required>
                                        <option value="" selected disabled> Pilih Nama Anggota </option>
                                        @foreach ($members as $member)
                                            <option value="{{ $member->id }}">{{ $member->nama }}</option>    
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-floating mb-3 book-container">
                                    <label for="floatingInput3">Judul Buku</label>
                                    <button class="float-right btn btn-sm btn-success btn-add-book" type="button">Tambah Buku</button>
                                    <select class="form-select form-control select2" aria-label="Default select example" name="book_id[]" required>
                                        <option value="" selected disabled> Pilih Judul Buku - Penulis</option>
                                        @foreach ($stocks as $stock)
                                            <option value="{{ $stock->book->id }}">{{ $stock->book->judul }} - {{ $stock->book->penulis }} ( Stok : {{ $stock->stok_akhir }} )</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group">
                                    <button class="btn btn-success rounded me-1" type="submit">Tambah Peminjaman</button>
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
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Pinjam</th>
                    <th>NIS</th>
                    <th>Nama Peminjam</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($borrowsWaiting as $borrow)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $borrow->kode_peminjaman }}</td>
                        <td>{{ $borrow->member->nis }}</td>
                        <td>{{ $borrow->member->nama }}</td>
                        <td>{{ $borrow->tanggal_pinjam }}</td>
                        <td>{{ $borrow->tanggal_tempo }}</td>
                        <td>
                            {{--  --}}
                            {{-- <button type="button" onClick="show_detail();"  class="btn btn-primary btn-sm">
                                <i class="fas fa-info-circle"></i>
                            </button> --}}
                            {{-- Edit data --}}
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default{{ $borrow->id }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Peminjaman"> <i class="fas fa-pencil-alt"></i> </button>
                            <div class="modal fade" id="modal-default{{ $borrow->id }}">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Peminjaman</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="modal-body">
                                                <form action="/transaction/borrows/updateBorrow/{{ $borrow->id }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="borrow_id" value="{{ $borrow->id }}">
                                                    <div class="form-floating mb-3">
                                                        <label for="floatingInput3">Nama Anggota</label>
                                                        <select class="form-select form-control select2" aria-label="Default select example" name="member_id" required>
                                                            @foreach ($members as $member)
                                                                @if ($member->id == $borrow->member_id)
                                                                    <option value="{{ $member->id }}" selected>{{ $member->nama }}</option>                                   
                                                                @else
                                                                    <option value="{{ $member->id }}">{{ $member->nama }}</option> 
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    
                                                    <div class="form-floating mb-3 book-container">
                                                        <label for="floatingInput3">Judul Buku</label>
                                                        <button class="float-right btn btn-sm btn-success btn-add-book" type="button">Tambah Buku</button>

                                                        @foreach ($borrow->borrowItem as $key => $borrowItem)
                                                            <div class="input-group mt-1 book">
                                                                <select class="form-select form-control select2" aria-label="Default select example" name="book_id[]" required>
                                                                    @foreach ($stocksAll as $stock)
                                                                        @if ($stock->book->id == $borrowItem->book_id)
                                                                            <option selected value="{{ $stock->book->id }}">{{ $stock->book->judul }} - {{ $stock->book->penulis }} ( Stok : {{ $stock->stok_akhir + 1 }} )</option>
                                                                        @elseif ($stock->stok_akhir > 0)
                                                                            <option value="{{ $stock->book->id }}">{{ $stock->book->judul }} - {{ $stock->book->penulis }} ( Stok : {{ $stock->stok_akhir }} )</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                                @if ($key > 0)
                                                                    <button type="button" class="btn btn-sm btn-danger btn-delete-book">Hapus</button>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="input-group">
                                                        <button class="btn btn-success rounded me-1" type="submit">Update Peminjaman</button>
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
                            <a href="#show{{ $borrow->id }}" data-toggle="modal" class="btn btn-success btn-sm">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            
                            
                            <div class="modal fade" id="show{{ $borrow->id }}">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Pengajuan Peminjaman</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row mx-md-n3">
                                                <div class="col px-md-5"><div class="p-2">Kode Pinjam</div></div>
                                                <div class="col px-md-5"><div class="p-2"><strong>: {{ $borrow->kode_peminjaman }}</strong></div></div>
                                            </div>
                                            <div class="row mx-md-n3">
                                                <div class="col px-md-5"><div class="p-2">NIS</div></div>
                                                <div class="col px-md-5"><div class="p-2">: {{ $borrow->member->nis }}</div></div>
                                            </div>
                                            <div class="row mx-md-n3">
                                                <div class="col px-md-5"><div class="p-2">Nama</div></div>
                                                <div class="col px-md-5"><div class="p-2">: {{ $borrow->member->nama }}</div></div>
                                            </div>
                                            <div class="row mx-md-n3">
                                                <div class="col px-md-5"><div class="p-2">Kelas / Jurusan</div></div>
                                                <div class="col px-md-5"><div class="p-2">: {{ $borrow->member->kelas }} {{ $borrow->member->jurusan }}</div></div>
                                            </div>
                                            <div class="row mx-md-n3">
                                                <div class="col px-md-5"><div class="p-2">Tanggal Pinjam</div></div>
                                                <div class="col px-md-5"><div class="p-2">: {{ $borrow->tanggal_pinjam }}</div></div>
                                            </div>
                                            <div class="row mx-md-n3">
                                                <div class="col px-md-5"><div class="p-2">Tanggal Kembali</div></div>
                                                <div class="col px-md-5"><div class="p-2">: {{ $borrow->tanggal_tempo }}</div></div>
                                            </div>
                                            <div class="row mx-md-n3">
                                                <div class="col px-md-5"><div class="p-2">Status</div></div>
                                                <div class="col px-md-5"><div class="p-2"><strong>: {{ $borrow->status }}</strong></div></div>
                                            </div>
                                            <hr>
                                            <p class="px-4"><strong>Buku Yang Dipinjam :</strong></p>
                                            <ol>
                                                <p style="display: none">{{ $outOfStock = 0}}</p>
                                                @foreach($borrow->borrowItem as $bi)
                                                    @if ($bi->book->stock->stok_akhir < 0)
                                                        <p style="display: none">{{ $outOfStock = true }}</p> 
                                                    @endif
                                                    <li>
                                                        <div class="row mx-md-n3">
                                                            <div class="col px-md-5"><div class="p-2">{{ $bi->book->judul }}</div></div>
                                                            <div class="col px-md-5"><div class="p-2">1</div></div>
                                                        </div>
                                                    </li>
                                                @endforeach

                                            </ol>
                                        </div>
                                        <div class="modal-footer">
                                            @if ($outOfStock == true)
                                                <p class="text-danger flex-fill fw-bold">Stok salah satu buku habis!</p>
                                            @endif
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            @if ($outOfStock != true)     
                                                <form action="/transaction/borrows/approve/{borrow->id}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div style="display: none;">
                                                        <input name="id" value="{{ $borrow->id }}">
                                                        <input name="kode_peminjaman" value="{{ $borrow->kode_peminjaman }}">
                                                        <input name="member_id" value="{{ $borrow->member->id }}">
                                                        @foreach($borrow->borrowItem as $borrowItem)
                                                            <input type="text" name="book_id[]" id="" value="{{ $borrowItem->book_id }}">
                                                        @endforeach
                                                    </div>
                                                    <button class="btn btn-success rounded me-1" type="submit">Terima Peminjaman</button>
                                                </form>
                                            @endif
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#reject{{ $borrow->id }}">Tolak Peminjaman</button>
                                            <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="reject{{ $borrow->id }}" data-backdrop="false">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <p class="modal-title">Tolak Peminjaman</p>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="/transaction/borrows/reject/{id}" method="post" enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="form-floating mb-3">
                                                                    <label for="">Alasan <small>Opsional</small> </label>
                                                                    <input type="text" name="reason" id="" class="form-control">
                                                                </div>
                                                                <div style="display: none;">
                                                                    <input required name="kode_peminjaman" type="number" maxlength="11" required class="form-control" id="floatingInput3" value="{{ $borrow->kode_peminjaman }}">
                                                                    <input required name="id" type="number" maxlength="11" required class="form-control" id="floatingInput3" value="{{ $borrow->id }}">
                                                                    <input name="member_id" value="{{ $borrow->member->id }}">
                                                                </div>
                                                                
                                                            </div>
                                                        <div class="modal-footer">
                                                                <button class="btn btn-danger rounded me-1" type="submit">Tolak Peminjaman</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                     

                        {{-- Delete --}}
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $borrow->id }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Batalkan Peminjaman"> 
                            <i class="fas fa-times-circle"></i>
                        </button>
                        <div class="modal fade" id="delete{{ $borrow->id }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header" style="border: none;">
                                        <h5 class="modal-title mt-3 px-4">Kode Peminjaman <p class="font-weight-bolder">{{ $borrow->kode_peminjaman }}</p></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mx-md-n3">
                                            <div class="col px-md-5"><div class="p-2">NIS</div></div>
                                            <div class="col px-md-5"><div class="p-2">: {{ $borrow->member->nis }}</div></div>
                                        </div>
                                        <div class="row mx-md-n3">
                                            <div class="col px-md-5"><div class="p-2">Nama</div></div>
                                            <div class="col px-md-5"><div class="p-2">: {{ $borrow->member->nama }}</div></div>
                                        </div>
                                        <div class="row mx-md-n3">
                                            <div class="col px-md-5"><div class="p-2">Kelas / Jurusan</div></div>
                                            <div class="col px-md-5"><div class="p-2">: {{ $borrow->member->kelas }} {{ $borrow->member->jurusan }}</div></div>
                                        </div>
                                        <div class="row mx-md-n3">
                                            <div class="col px-md-5"><div class="p-2">Tanggal Pinjam</div></div>
                                            <div class="col px-md-5"><div class="p-2">: {{ $borrow->tanggal_pinjam }}</div></div>
                                        </div>
                                        <div class="row mx-md-n3">
                                            <div class="col px-md-5"><div class="p-2">Tanggal Kembali</div></div>
                                            <div class="col px-md-5"><div class="p-2">: {{ $borrow->tanggal_tempo }}</div></div>
                                        </div>
                                        <hr>
                                        <p class="px-4"><strong>Buku Yang Dipinjam :</strong></p>
                                        <ol>
                                            @foreach($borrow->borrowItem as $bi)
                                            <li>
                                                <div class="row mx-md-n3">
                                                    <div class="col px-md-5"><div class="p-2">{{ $bi->book->judul }}</div></div>
                                                    <div class="col px-md-5"><div class="p-2">1</div></div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ol>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <form action="/transaction/borrows/deleteBorrow/{{ $borrow->id }}" method="post">
                                            @csrf
                                            <input type="text" name="borrow_id" hidden value="{{ $borrow->id }}">
                                            <button type="submit" class="btn btn-danger">Batalkan</button>
                                        </form>
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
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Peminjaman</th>
                    <th>Nama Peminjam</th>
                    <th>Tanggal Pengambilan</th>
                    <th>Tanggal Tempo</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($borrowsApproved as $borrow)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $borrow->kode_peminjaman }}</td>
                    <td>{{ $borrow->member->nama }}</td>
                    <td>{{ $borrow->tanggal_pinjam }}</td>
                    <td>{{ $borrow->tanggal_tempo }}</td>
                    <td>							

                        {{-- Edit data --}}
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-default{{ $borrow->id }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Peminjaman"> <i class="fas fa-pencil-alt"></i> </button>
                        <div class="modal fade" id="modal-default{{ $borrow->id }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edit Peminjaman</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="modal-body">
                                            <form action="/transaction/borrows/updateBorrow/{{ $borrow->id }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="borrow_id" value="{{ $borrow->id }}">
                                                <div class="form-floating mb-3">
                                                    <label for="floatingInput3">Nama Anggota</label>
                                                    <select class="form-select form-control select2" aria-label="Default select example" name="member_id" required>
                                                        @foreach ($members as $member)
                                                            @if ($member->id == $borrow->member_id)
                                                                <option value="{{ $member->id }}" selected>{{ $member->nama }}</option>                                   
                                                            @else
                                                                <option value="{{ $member->id }}">{{ $member->nama }}</option> 
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                
                                                <div class="form-floating mb-3 book-container">
                                                    <label for="floatingInput3">Judul Buku</label>
                                                    <button class="float-right btn btn-sm btn-success btn-add-book" type="button">Tambah Buku</button>

                                                    @foreach ($borrow->borrowItem as $key => $borrowItem)
                                                        <div class="input-group mt-1 book">
                                                            <select class="form-select form-control select2" aria-label="Default select example" name="book_id[]" required>
                                                                @foreach ($stocksAll as $stock)
                                                                    @if ($stock->book->id == $borrowItem->book_id)
                                                                        <option selected value="{{ $stock->book->id }}">{{ $stock->book->judul }} - {{ $stock->book->penulis }} ( Stok : {{ $stock->stok_akhir + 1 }} )</option>
                                                                    @elseif ($stock->stok_akhir > 0)
                                                                        <option value="{{ $stock->book->id }}">{{ $stock->book->judul }} - {{ $stock->book->penulis }} ( Stok : {{ $stock->stok_akhir }} )</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                            @if ($key > 0)
                                                                <button type="button" class="btn btn-sm btn-danger btn-delete-book">Hapus</button>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="input-group">
                                                    <button class="btn btn-success rounded me-1" type="submit">Update Peminjaman</button>
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
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#show{{ $borrow->id }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Proses Peminjaman"> 
                            <i class="fas fa-eye"></i>
                        </button>
                        <div class="modal fade" id="show{{ $borrow->id }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header" style="border: none;">
                                        <h5 class="modal-title mt-3 px-4">Kode Peminjaman <p class="font-weight-bolder">{{ $borrow->kode_peminjaman }}</p></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mx-md-n3">
                                            <div class="col px-md-5"><div class="p-2">NIS</div></div>
                                            <div class="col px-md-5"><div class="p-2">: {{ $borrow->member->nis }}</div></div>
                                        </div>
                                        <div class="row mx-md-n3">
                                            <div class="col px-md-5"><div class="p-2">Nama</div></div>
                                            <div class="col px-md-5"><div class="p-2">: {{ $borrow->member->nama }}</div></div>
                                        </div>
                                        <div class="row mx-md-n3">
                                            <div class="col px-md-5"><div class="p-2">Kelas / Jurusan</div></div>
                                            <div class="col px-md-5"><div class="p-2">: {{ $borrow->member->kelas }} {{ $borrow->member->jurusan }}</div></div>
                                        </div>
                                        <div class="row mx-md-n3">
                                            <div class="col px-md-5"><div class="p-2">Tanggal Pinjam</div></div>
                                            <div class="col px-md-5"><div class="p-2">: {{ $borrow->tanggal_pinjam }}</div></div>
                                        </div>
                                        <div class="row mx-md-n3">
                                            <div class="col px-md-5"><div class="p-2">Tanggal Kembali</div></div>
                                            <div class="col px-md-5"><div class="p-2">: {{ $borrow->tanggal_tempo }}</div></div>
                                        </div>
                                        <hr>
                                        <p class="px-4"><strong>Buku Yang Dipinjam :</strong></p>
                                        <ol>
                                            @foreach($borrow->borrowItem as $bi)
                                            <li>
                                                <div class="row mx-md-n3">
                                                    <div class="col px-md-5"><div class="p-2">{{ $bi->book->judul }}</div></div>
                                                    <div class="col px-md-5"><div class="p-2">1</div></div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ol>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <form action="/transaction/pengambilan_buku/{{ $borrow->id }}" method="post">
                                            @csrf
                                            <input type="text" name="id" hidden value="{{ $borrow->id }}">
                                            <button type="submit" class="btn btn-success">Diambil</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Delete --}}
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $borrow->id }}" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Batalkan Peminjaman"> 
                            <i class="fas fa-times-circle"></i>
                        </button>
                        <div class="modal fade" id="delete{{ $borrow->id }}">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header" style="border: none;">
                                        <h5 class="modal-title mt-3 px-4">Kode Peminjaman <p class="font-weight-bolder">{{ $borrow->kode_peminjaman }}</p></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mx-md-n3">
                                            <div class="col px-md-5"><div class="p-2">NIS</div></div>
                                            <div class="col px-md-5"><div class="p-2">: {{ $borrow->member->nis }}</div></div>
                                        </div>
                                        <div class="row mx-md-n3">
                                            <div class="col px-md-5"><div class="p-2">Nama</div></div>
                                            <div class="col px-md-5"><div class="p-2">: {{ $borrow->member->nama }}</div></div>
                                        </div>
                                        <div class="row mx-md-n3">
                                            <div class="col px-md-5"><div class="p-2">Kelas / Jurusan</div></div>
                                            <div class="col px-md-5"><div class="p-2">: {{ $borrow->member->kelas }} {{ $borrow->member->jurusan }}</div></div>
                                        </div>
                                        <div class="row mx-md-n3">
                                            <div class="col px-md-5"><div class="p-2">Tanggal Pinjam</div></div>
                                            <div class="col px-md-5"><div class="p-2">: {{ $borrow->tanggal_pinjam }}</div></div>
                                        </div>
                                        <div class="row mx-md-n3">
                                            <div class="col px-md-5"><div class="p-2">Tanggal Kembali</div></div>
                                            <div class="col px-md-5"><div class="p-2">: {{ $borrow->tanggal_tempo }}</div></div>
                                        </div>
                                        <hr>
                                        <p class="px-4"><strong>Buku Yang Dipinjam :</strong></p>
                                        <ol>
                                            @foreach($borrow->borrowItem as $bi)
                                            <li>
                                                <div class="row mx-md-n3">
                                                    <div class="col px-md-5"><div class="p-2">{{ $bi->book->judul }}</div></div>
                                                    <div class="col px-md-5"><div class="p-2">1</div></div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ol>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <form action="/transaction/borrows/deleteBorrow/{{ $borrow->id }}" method="post">
                                            @csrf
                                            <input type="text" name="borrow_id" hidden value="{{ $borrow->id }}">
                                            <button type="submit" class="btn btn-danger">Batalkan</button>
                                        </form>
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
    <div class="tab-pane fade" id="tabs-rejected" role="tabpanel" aria-labelledby="tabs-rejected-tab">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Pinjam</th>
                    <th>Nama Peminjam</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($borrows as $borrow)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $borrow->kode_peminjaman }}</td>
                    <td>{{ $borrow->member->nama }}</td>
                    <td>{{ $borrow->tanggal_pinjam }}</td>
                    <td>{{ $borrow->tanggal_tempo }}</td>
                    <td> 
                        @if(Carbon\Carbon::parse( $borrow->tanggal_tempo)->diffInDays(Carbon\Carbon::now(),false) > 0)
                            <span class="badge bg-danger" data-bs-toggle="tooltip" data-bs-placement="bottom">Telat</span>
                        @else
                            <span class="badge bg-primary">Dalam Peminjaman</span>
                        @endif  
                    </td>
                           
                    <td>
                        <form action="/transaction/return/detail/{{ $borrow->id }}" method="post" class="{{ Request::is('/transaction/return/detail/*') ? 'active' : '' }}">
                            @csrf
                            <div style="display: none;">
                                <input name="borrow_id" value="{{ $borrow->id }}">
                                <input name="member_id" value="{{ $borrow->member->id }}">
                            </div>
                            <button class="btn btn-success rounded me-1" type="submit">Dikembalikan</button>
                        </form>    
                

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>   
        <div id="display_detail" style="display:none">
            <table id="example1_detail"  class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Peminjaman</th>
                        <th>Nama Peminjam</th>
                        <th>Tanggal Pengambilan</th>
                        <th>Tanggal Tempo</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>