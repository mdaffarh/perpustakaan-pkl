<div class="tab-content" id="custom-tabs-two-tabContent">
    <div class="tab-pane fade show active" id="tabs-dipinjam" role="tabpanel" aria-labelledby="tabs-dipinjam-tab">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Peminjaman</th>
                    <th>Nama Peminjam</th>
                    <th>Tanggal Pinjam</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($borrowedMenungguPersetujuan as $borrow)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $borrow->kode_peminjaman }}</td>
                        <td>{{ $borrow->member->nama }}</td>
                        <td>{{ $borrow->tanggal_pinjam }}</td>
                        <td>							
    
                            {{-- Show --}}
                            <a href="#show{{ $borrow->id }}" data-toggle="modal" class="btn btn-outline-success btn-sm">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            
                            <div class="modal fade" id="show{{ $borrow->id }}">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header" style="border: none;">
                                            <div class="media flex-sm-row flex-column-reverse justify-content-between  ">
                                                <div class="col my-auto">
                                                    <h4 class="mb-0">Kartu Pinjaman Buku,
                                                        <span class="change-color" style="color: blue;">{{ auth()->user()->member->nama }}</span> !
                                                    </h4> 
                                                </div>
                                            </div>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="modal-body">
                                                <div class="row justify-content-between mb-3">
                                                    <div class="col-auto"> <h6 class="color-1 mb-0 change-color"></h6> </div>
                                                    <div class="col-auto font-weight-bolder">No Peminjaman : {{ $borrow->kode_peminjaman }}</div>
                                                </div>
                                                <p style="display: none">{{ $countForeach = 0 }}</p> 
                                                @foreach($borrow->borrowItem as $borrowItem)
                                                   <p style="display: none">{{ $countForeach+=1 }}</p> 
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="card card-2">
                                                            <div class="card-body">
                                                                <div class="media">
                                                                    <div class="sq align-self-center ">
                                                                        @if ($borrowItem->book->image)
                                                                            <img src="{{ asset('storage/' . $borrowItem->book->image) }}" class="img-fluid  my-auto align-self-center mr-2 mr-md-4 pl-0 p-0 m-0" width="135" height="135">
                                                                        @else
                                                                            <img src="{{ asset("assets/img/book_cover_default.png") }}" class="img-fluid  my-auto align-self-center mr-2 mr-md-4 pl-0 p-0 m-0" width="135" height="135">
                                                                        @endif
                                                                    </div>
                                                                    <div class="media-body my-auto text-right">
                                                                        <div class="row  my-auto flex-column flex-md-row">
                                                                            <div class="col my-auto" style="text-align: left;"> <h6 class="mb-0">{{ $borrowItem->book->judul }}</h6>  </div>
                                                                            <div class="col-auto my-auto"> <small>Penulis : {{ $borrowItem->book->penulis }}</small></div>
                                                                            <div class="col my-auto"> <small>Qty : 1</small></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                <div class="row mt-4">
                                                    <div class="col">
                                                        <div class="row justify-content-between">
                                                            <div class="col-auto"><h6 class="mb-1 text-dark"><b>Detail Peminjaman</b></h6></div>
                                                            <div class="flex-sm-col text-right col"> <h6 class="mb-1"><b>{{ $countForeach }} Buku akan di pinjam</b></h6> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="">
                                                    <div class="d-flex justify-content-end">
                                                        <div class="mr-auto  p-2">NIS</div>
                                                        <div class="p-2">{{ $borrow->member->nis }}</div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="mr-auto  p-2">Nama</div>
                                                        <div class=" p-2">{{ $borrow->member->nama }}</div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="mr-auto  p-2">Kelas</div>
                                                        <div class=" p-2">{{ $borrow->member->kelas }}</div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="mr-auto  p-2">Jurusan</small></div>
                                                        <div class=" p-2">{{ $borrow->member->jurusan }}</div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="mr-auto  p-2">Tanggal Pinjam</div>
                                                        <div class=" p-2">{{ $borrow->tanggal_pinjam }}</div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="mr-auto  p-2">Tanggal Kembali</div>
                                                        <div class=" p-2">{{ $borrow->tanggal_tempo }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <div class="offset-5 py-3">
                                                <span><small>*Cetak Kartu untuk mengambil buku di perpustakaan</small></span>
                                                <br>
                                                <span><small>*Pastikan anda mengambil buku dan mengembalikannya di waktu yang tepat</small></span>
                                            </div>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
    <div class="tab-pane fade" id="tabs-disetujui" role="tabpanel" aria-labelledby="tabs-disetujui-tab">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Peminjaman</th>
                    <th>Nama Peminjam</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Tempo</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($borrowedDisetujui as $borrow)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $borrow->kode_peminjaman }}</td>
                        <td>{{ $borrow->member->nama }}</td>
                        <td>{{ $borrow->tanggal_pinjam }}</td>
                        <td>{{ $borrow->tanggal_tempo }}</td>
                        <td>
                            @if(Carbon\Carbon::parse( $borrow->tanggal_tempo)->diffInDays(Carbon\Carbon::now(),false) > 0)
                                <span class="badge bg-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Kamu telat mengembalikan buku silakan cek kolom info untuk lihat denda.">Telat</span>
                            @elseif ($borrow->status == "Dalam peminjaman")
                                <span class="badge bg-primary">Dalam Peminjaman</span>
                            @else
                                <span class="badge bg-success" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Peminjaman telah disetujui silakan ambil buku di perpustakaan.">Disetujui</span>
                            @endif    
                        </td>
                        <td>							
    
                            {{-- Show --}}
                            <a href="#show{{ $borrow->id }}" data-toggle="modal" class="btn btn-outline-success btn-sm">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            
                            <div class="modal fade" id="show{{ $borrow->id }}">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header" style="border: none;">
                                            <div class="media flex-sm-row flex-column-reverse justify-content-between  ">
                                                <div class="col my-auto">
                                                    <h4 class="mb-0">Kartu Pinjaman Buku,
                                                        <span class="change-color" style="color: blue;">{{ auth()->user()->member->nama }}</span> !
                                                    </h4> 
                                                </div>
                                            </div>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="modal-body">
                                                <div class="row justify-content-between mb-3">
                                                    <div class="col-auto"> <h6 class="color-1 mb-0 change-color"></h6> </div>
                                                    <div class="col-auto font-weight-bolder">No Peminjaman : {{ $borrow->kode_peminjaman }}</div>
                                                </div>
                                                <p style="display: none">{{ $countForeach = 0 }}</p> 
                                                @foreach($borrow->borrowItem as $borrowItem)
                                                <p style="display: none">{{ $countForeach += 1 }}</p> 
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="card card-2">
                                                            <div class="card-body">
                                                                <div class="media">
                                                                    <div class="sq align-self-center ">
                                                                        @if ($borrowItem->book->image)
                                                                            <img src="{{ asset('storage/' . $borrowItem->book->image) }}" class="img-fluid  my-auto align-self-center mr-2 mr-md-4 pl-0 p-0 m-0" width="135" height="135">
                                                                        @else
                                                                            <img src="{{ asset("assets/img/book_cover_default.png") }}" class="img-fluid  my-auto align-self-center mr-2 mr-md-4 pl-0 p-0 m-0" width="135" height="135">
                                                                        @endif
                                                                    </div>
                                                                    <div class="media-body my-auto text-right">
                                                                        <div class="row  my-auto flex-column flex-md-row">
                                                                            <div class="col my-auto" style="text-align: left;"> <h6 class="mb-0">{{ $borrowItem->book->judul }}</h6>  </div>
                                                                            <div class="col-auto my-auto"> <small>Penulis : {{ $borrowItem->book->penulis }}</small></div>
                                                                            <div class="col my-auto"> <small>Qty : 1</small></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                <div class="row mt-4">
                                                    <div class="col">
                                                        <div class="row justify-content-between">
                                                            <div class="col-auto"><h6 class="mb-1 text-dark"><b>Detail Peminjaman</b></h6></div>
                                                            <div class="flex-sm-col text-right col"> <h6 class="mb-1"><b>{{ $countForeach }} Buku di pinjam</b></h6> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="">
                                                    <div class="d-flex justify-content-end">
                                                        <div class="mr-auto  p-2">NIS</div>
                                                        <div class="p-2">{{ $borrow->member->nis }}</div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="mr-auto  p-2">Nama</div>
                                                        <div class=" p-2">{{ $borrow->member->nama }}</div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="mr-auto  p-2">Kelas</div>
                                                        <div class=" p-2">{{ $borrow->member->kelas }}</div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="mr-auto  p-2">Jurusan</small></div>
                                                        <div class=" p-2">{{ $borrow->member->jurusan }}</div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="mr-auto  p-2">Tanggal Pinjam</div>
                                                        <div class=" p-2">{{ $borrow->tanggal_pinjam }}</div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="mr-auto  p-2">Tanggal Kembali</div>
                                                        <div class=" p-2">{{ $borrow->tanggal_tempo }}</div>
                                                    </div>
                                                    @if(Carbon\Carbon::parse( $borrow->tanggal_tempo)->diffInDays(Carbon\Carbon::now(),false) > 0)
                                                        <div class="d-flex justify-content-end">
                                                            <div class="mr-auto  p-2">Denda</div>
                                                            <div class=" p-2">{{ Carbon\Carbon::parse( $borrow->tanggal_tempo)->diffInDays(Carbon\Carbon::now(),false) * 500 }}</div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <div class="offset-5 py-3">
                                                <span><small>*Cetak Kartu untuk mengambil buku di perpustakaan</small></span>
                                                <br>
                                                <span><small>*Pastikan anda mengambil buku dan mengembalikannya di waktu yang tepat</small></span>
                                            </div>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
    <div class="tab-pane fade" id="tabs-ditolak" role="tabpanel" aria-labelledby="tabs-ditolak-tab">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Peminjaman</th>
                    <th>Nama Peminjam</th>
                    <th>Tanggal Pinjam</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($borrowedDitolak as $borrow)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $borrow->kode_peminjaman }}</td>
                        <td>{{ $borrow->member->nama }}</td>
                        <td>{{ $borrow->tanggal_pinjam }}</td>
                        <td>							
    
                            {{-- Show --}}
                            <a href="#show{{ $borrow->id }}" data-toggle="modal" class="btn btn-outline-success btn-sm">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            
                            <div class="modal fade" id="show{{ $borrow->id }}">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header" style="border: none;">
                                            <div class="media flex-sm-row flex-column-reverse justify-content-between  ">
                                                <div class="col my-auto">
                                                    <h4 class="mb-0">Kartu Pinjaman Buku,
                                                        <span class="change-color" style="color: blue;">{{ auth()->user()->member->nama }}</span> !
                                                    </h4> 
                                                </div>
                                            </div>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="modal-body">
                                                <div class="row justify-content-between mb-3">
                                                    <div class="col-auto"> <h6 class="color-1 mb-0 change-color"></h6> </div>
                                                    <div class="col-auto font-weight-bolder">No Peminjaman : {{ $borrow->kode_peminjaman }}</div>
                                                </div>
                                                <p style="display: none">{{  $countForeach = 0 }}</p>
                                                
                                                @foreach($borrow->borrowItem as $borrowItem)
                                                <p style="display: none">{{ $countForeach += 1 }}</p>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="card card-2">
                                                            <div class="card-body">
                                                                <div class="media">
                                                                    <div class="sq align-self-center ">
                                                                        @if ($borrowItem->book->image)
                                                                            <img src="{{ asset('storage/' . $borrowItem->book->image) }}" class="img-fluid  my-auto align-self-center mr-2 mr-md-4 pl-0 p-0 m-0" width="135" height="135">
                                                                        @else
                                                                            <img src="{{ asset("assets/img/book_cover_default.png") }}" class="img-fluid  my-auto align-self-center mr-2 mr-md-4 pl-0 p-0 m-0" width="135" height="135">
                                                                        @endif
                                                                    </div>
                                                                    <div class="media-body my-auto text-right">
                                                                        <div class="row  my-auto flex-column flex-md-row">
                                                                            <div class="col my-auto" style="text-align: left;"> <h6 class="mb-0">{{ $borrowItem->book->judul }}</h6>  </div>
                                                                            <div class="col-auto my-auto"> <small>Penulis : {{ $borrowItem->book->penulis }}</small></div>
                                                                            <div class="col my-auto"> <small>Qty : 1</small></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                <div class="row mt-4">
                                                    <div class="col">
                                                        <div class="row justify-content-between">
                                                            <div class="col-auto"><h6 class="mb-1 text-dark"><b>Detail Peminjaman</b></h6></div>
                                                            <div class="flex-sm-col text-right col"> <h6 class="mb-1"><b>{{ $countForeach }} Buku akan di pinjam</b></h6> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="">
                                                    <div class="d-flex justify-content-end">
                                                        <div class="mr-auto  p-2">NIS</div>
                                                        <div class="p-2">{{ $borrow->member->nis }}</div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="mr-auto  p-2">Nama</div>
                                                        <div class=" p-2">{{ $borrow->member->nama }}</div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="mr-auto  p-2">Kelas</div>
                                                        <div class=" p-2">{{ $borrow->member->kelas }}</div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="mr-auto  p-2">Jurusan</small></div>
                                                        <div class=" p-2">{{ $borrow->member->jurusan }}</div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="mr-auto  p-2">Tanggal Pinjam</div>
                                                        <div class=" p-2">{{ $borrow->tanggal_pinjam }}</div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="mr-auto  p-2">Tanggal Kembali</div>
                                                        <div class=" p-2">{{ $borrow->tanggal_tempo }}</div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="mr-auto  p-2">Status</div>
                                                        <div class=" p-2">Ditolak</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <div class="offset-5 py-3">
                                                <span><small>*Peminjaman ditolak silakan cek notifikasi untuk info lebih lanjut.</small></span>
                                            </div>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
    <div class="tab-pane fade" id="tabs-selesai" role="tabpanel" aria-labelledby="tabs-selesai-tab">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Peminjaman</th>
                    <th>Nama Peminjam</th>
                    <th>Tanggal Pinjam</th>
                    <th>Selesai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($borrowedSelesai as $borrow)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $borrow->kode_peminjaman }}</td>
                        <td>{{ $borrow->member->nama }}</td>
                        <td>{{ $borrow->tanggal_pinjam }}</td>
                        <td>{{ $borrow->return->tanggal_kembali }}</td>
                        <td>							
    
                            {{-- Show --}}
                            <a href="#show{{ $borrow->id }}" data-toggle="modal" class="btn btn-outline-success btn-sm">
                                <i class="fas fa-info-circle"></i>
                            </a>
                            
                            <div class="modal fade" id="show{{ $borrow->id }}">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header" style="border: none;">
                                            <div class="media flex-sm-row flex-column-reverse justify-content-between  ">
                                                <div class="col my-auto">
                                                    <h4 class="mb-0">Kartu Pinjaman Buku,
                                                        <span class="change-color" style="color: blue;">{{ auth()->user()->member->nama }}</span> !
                                                    </h4> 
                                                </div>
                                            </div>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="modal-body">
                                                <div class="row justify-content-between mb-3">
                                                    <div class="col-auto"> <h6 class="color-1 mb-0 change-color"></h6> </div>
                                                    <div class="col-auto font-weight-bolder">No Peminjaman : {{ $borrow->kode_peminjaman }}</div>
                                                </div>
                                                <p style="display: none">{{ $countForeach = 0 }}</p>
                                                @foreach($borrow->borrowItem as $borrowItem)
                                                <p style="display: none">{{ $countForeach += 1 }}</p>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="card card-2">
                                                            <div class="card-body">
                                                                <div class="media">
                                                                    <div class="sq align-self-center ">
                                                                        @if ($borrowItem->book->image)
                                                                            <img src="{{ asset('storage/' . $borrowItem->book->image) }}" class="img-fluid  my-auto align-self-center mr-2 mr-md-4 pl-0 p-0 m-0" width="135" height="135">
                                                                        @else
                                                                            <img src="{{ asset("assets/img/book_cover_default.png") }}" class="img-fluid  my-auto align-self-center mr-2 mr-md-4 pl-0 p-0 m-0" width="135" height="135">
                                                                        @endif
                                                                    </div>
                                                                    <div class="media-body my-auto text-right">
                                                                        <div class="row  my-auto flex-column flex-md-row">
                                                                            <div class="col my-auto" style="text-align: left;"> <h6 class="mb-0">{{ $borrowItem->book->judul }}</h6>  </div>
                                                                            <div class="col-auto my-auto"> <small>Penulis : {{ $borrowItem->book->penulis }}</small></div>
                                                                            <div class="col my-auto"> <small>Qty : 1</small></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                                <div class="row mt-4">
                                                    <div class="col">
                                                        <div class="row justify-content-between">
                                                            <div class="col-auto"><h6 class="mb-1 text-dark"><b>Detail Peminjaman</b></h6></div>
                                                            <div class="flex-sm-col text-right col"> <h6 class="mb-1"><b>{{ $countForeach }} Buku telah kamu pinjam</b></h6> </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="">
                                                    <div class="d-flex justify-content-end">
                                                        <div class="mr-auto  p-2">NIS</div>
                                                        <div class="p-2">{{ $borrow->member->nis }}</div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="mr-auto  p-2">Nama</div>
                                                        <div class=" p-2">{{ $borrow->member->nama }}</div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="mr-auto  p-2">Kelas</div>
                                                        <div class=" p-2">{{ $borrow->member->kelas }}</div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="mr-auto  p-2">Jurusan</small></div>
                                                        <div class=" p-2">{{ $borrow->member->jurusan }}</div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="mr-auto  p-2">Tanggal Pinjam</div>
                                                        <div class=" p-2">{{ $borrow->tanggal_pinjam }}</div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="mr-auto  p-2">Tanggal Tempo</div>
                                                        <div class=" p-2">{{ $borrow->tanggal_tempo }}</div>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="mr-auto  p-2">Tanggal Kembali</div>
                                                        <div class=" p-2">{{ $borrow->return->tanggal_kembali }}</div>
                                                    </div>
                                                    @if ($borrow->fines)
                                                        <div class="d-flex justify-content-end">
                                                            <div class="mr-auto  p-2">Denda</div>
                                                            <div class=" p-2">{{ $borrow->fines->total }}</div>
                                                        </div>
                                                    @endif
                                                    <div class="d-flex justify-content-end">
                                                        <div class="mr-auto  p-2">Staff Perpustakaan</div>
                                                        <div class=" p-2">{{ $borrow->creator->nama }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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