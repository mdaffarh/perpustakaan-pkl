@extends('layout.main')
@section('title', "Donasi Buku")

@section('content')
	@include('sweetalert::alert')
	<div class="row">
		<div class="col">
			<div class="card card-outline-tabs">
				<div class="card-header">
                    <div class="container-fluid">
                        <div class="row">
                          <div class="col-sm-6">
                            <h3 class="mt-2">@yield('title')</h3>
                          </div><!-- /.col -->
                          <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right" style="background-color: rgba(255,0,0,0);">
                                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                                <li class="breadcrumb-item active">@yield('title')</li>
                            </ol>
                          </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                    @can('staff')
                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tabs-waiting-tab" data-toggle="pill" href="#tabs-waiting" role="tab" aria-controls="tabs-waiting" aria-selected="trues">Menunggu Persetujuan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tabs-pengambilan-buku-tab" data-toggle="pill" href="#tabs-pengambilan-buku" role="tab" aria-controls="tabs-pengambilan-buku" aria-selected="false">Serah Terima Buku</a>
                            </li>
                        </ul>
            					
                    @endcan
				</div>
			
				<div class="card-body">
                    {{-- Tampilan staff --}}
                    @can('staff')
                        @include('transaction.book-donations.idxStaff')
                    @endcan
                    {{-- Akhir tampilan staff --}} 

                    {{-- Tampilan anggota --}}
                    @can('member')
                        @include('transaction.book-donations.idxMember')
                    @endcan
                    {{-- Akhir tampilan anggota --}}

                    
				</div>
			</div>
		</div>
	</div>

    @can('staff')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <script>
            
            $(function () {
                $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
                }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            });

        </script>

        <script type="text/javascript">

            $('.livesearch').select2({
                ajax: {
                    url: '/ajax-autocomplete-search',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    nama: item.nama,
                                    id: item.id,
                                    nis: item.nis,
                                    kelas: item.kelas,
                                    jurusan: item.jurusan,
                                }
                            })
                        };
                    },
                    cache: true
                },
                placeholder: 'Select Member',
                minimumInputLength: 2,
                templateResult: formatRepo,
            });
            
            // container result
            function formatRepo (repo) {
                if (repo.loading) {
                    return repo.text;
                }

                var $container = $(
                    "<div class='select2-result-repository clearfix'>" +
                        "<div class='select2-result-repository__meta'>" +
                            "<div class='select2-result-repository__statistics'>" +
                                "<div class='select2-result-repository__forks'>  NIS : " + repo.nis + "</div>" +
                                "<div class='select2-result-repository__forks'>  Nama : " + repo.nama + "</div>" +
                                "<div class='select2-result-repository__forks'>  Kelas : " + repo.kelas + "</div>" +
                                "<div class='select2-result-repository__forks'>  Jurusan : " + repo.jurusan + "</div>" +
                            "</div>" +
                        "</div>" +
                    "</div>"
                );
                    
                return $container;
            }
            
            
        </script>
    @endcan

    @can('member')
        <script>
            $(function () {
                $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false
                });
            });
        </script>        
    @endcan

@endsection