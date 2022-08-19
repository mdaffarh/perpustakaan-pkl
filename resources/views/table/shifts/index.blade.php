@extends('layout.main')
@section('title', "Perpustakaan")
@section('content')

<div class="content-wrapper">
  @include('sweetalert::alert')
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Data Shift</h3>
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
                                      <form action="/table/shifts" method="post" enctype="multipart/form-data">
                                          @csrf
                                          <div class="form-floating mb-3">
                                            <label for="floatingInput3">Staff</label>
                                            <select class="form-select form-control" aria-label="Default select example" name="staff_id" required>
                                              <option value="" selected disabled><-- Pilih Staff --></option>
                                              @foreach($staffs as $staff)
                                                <option value="{{ $staff->id }}">{{ $staff->nama }}</option>
                                              @endforeach
                                            </select>
                                          </div>
                                          <div class="form-floating mb-3">
                                              <label for="floatingInput3">Kategori Shift</label>
                                              <input required name="kategori_shift" type="text" required class="form-control" id="floatingInput3">
                                          </div>
                                          <div class="form-floating mb-3">
                                              <label for="floatingInput3">Waktu Mulai</label>
                                              <input required name="waktu_mulai" type="time" required class="form-control" id="floatingInput3">
                                          </div>
                                          <div class="form-floating mb-3">
                                              <label for="floatingInput3">Waktu Selesai</label>
                                              <input required name="waktu_selesai" type="time" required class="form-control" id="floatingInput3">
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
              <th>Staff ID</th>
              <th>Kategori Shift</th>
              <th>Waktu Mulai</th>
              <th>Waktu Selesai</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($shifts as $shift)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $shift->staff_id }}</td>
              <td>{{ $shift->kategori_shift }}</td>
              <td>{{ $shift->waktu_mulai }}</td>
              <td>{{ $shift->waktu_selesai }}</td>
              <td>
                <a href="#modalEditData{{ $shift->id }}" data-toggle="modal" class="btn btn-outline-info btn-sm">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="m7 17.013 4.413-.015 9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583v4.43zM18.045 4.458l1.589 1.583-1.597 1.582-1.586-1.585 1.594-1.58zM9 13.417l6.03-5.973 1.586 1.586-6.029 5.971L9 15.006v-1.589z"></path><path d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2z"></path></svg>
                </a>
                              
                              <div class="modal fade" id="modalEditData{{ $shift->id }}">
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
                                        <form action="/table/shifts/{{ $shift->id }}" method="post" enctype="multipart/form-data">
                                          @method('put')
                                          @csrf
                                          <div class="form-floating mb-3">
                                            <label for="floatingInput3">Staff</label>
                                            <select class="form-select form-control" aria-label="Default select example" name="staff_id" required>
                                              @foreach($staffs as $staff)
                                                @if ($shift->staff_id == $staff->id)
                                                  <option value="{{ $staff->id }}" selected >{{ $staff->nama }}</option>
                                                @endif
                                              @endforeach
                                            </select>
                                          </div>
                                          <div class="form-floating mb-3">
                                            <label for="floatingInput3">Kategori Shift</label>
                                            <input required name="kategori_shift" type="text" required class="form-control" id="floatingInput3" value="{{ $shift->kategori_shift }}">
                                          </div>
                                          <div class="form-floating mb-3">
                                            <label for="floatingInput3">Waktu Mulai</label>
                                            <input required name="waktu_mulai" type="time" required class="form-control" id="floatingInput3" value="{{ $shift->waktu_mulai }}">
                                          </div>
                                          <div class="form-floating mb-3">
                                            <label for="floatingInput3">Waktu Selesai</label>
                                            <input required name="waktu_selesai" type="time" required class="form-control" id="floatingInput3" value="{{ $shift->waktu_selesai }}">
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

                              <a href="#show{{ $shift->id }}" data-toggle="modal" class="btn btn-outline-success btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;" class="bi bi-eye" viewBox="0 0 16 16">
                                  <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                  </svg>
                              </a>
                                            
                                            <div class="modal fade" id="show{{ $shift->id }}">
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
                                                      <form action="/table/shifts/{{ $shift->id }}" method="post" enctype="multipart/form-data">
                                                        @method('put')
                                                        @csrf
                                                        <div class="form-floating mb-3">
                                                          <label for="floatingInput3">Staff ID</label>
                                                          <input required name="staff_id" type="number" required class="form-control" id="floatingInput3" value="{{ $shift->staff_id }}" disabled>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                          <label for="floatingInput3">Kategori Shift</label>
                                                          <input required name="kategori_shift" type="text" required class="form-control" id="floatingInput3" value="{{ $shift->kategori_shift }}" disabled>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                          <label for="floatingInput3">Waktu Mulai</label>
                                                          <input required name="waktu_mulai" type="time" required class="form-control" id="floatingInput3" value="{{ $shift->waktu_mulai }}" disabled>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                          <label for="floatingInput3">Waktu Selesai</label>
                                                          <input required name="waktu_selesai" type="time" required class="form-control" id="floatingInput3" value="{{ $shift->waktu_selesai }}" disabled>
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
  
                                  <form action="/table/shifts/{{ $shift->id }}" method="POST" class="d-inline">
                                      @method('delete')
                                      @csrf
                                      <button type="submit" onclick="return confirm('Sure?')" class="btn btn-outline-danger btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm4 12H8v-9h2v9zm6 0h-2v-9h2v9zm.618-15L15 2H9L7.382 4H3v2h18V4z"></path></svg>
                                      </button>
                                  </form>
                                  
                         
  
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
