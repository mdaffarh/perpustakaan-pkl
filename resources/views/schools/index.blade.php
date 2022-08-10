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
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content --> 
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with minimal features & hover style</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Kode Pos</th>
                    <th>Email</th>
                    <th>Website</th>
                    <th>Fax</th>
                    <th>Phone Number</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($schools as $school)
                        
                    
                    <tr>
                        <td>{{ $school->name }}</td>
                        <td>{{ $school->address }}</td>
                        <td>{{ $school->post_code }}</td>
                        <td>{{ $school->email }}</td>
                        <td>{{ $school->website }}</td>
                        <td>{{ $school->fax }}</td>
                        <td>{{ $school->phone_number }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
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
