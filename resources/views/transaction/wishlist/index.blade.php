@extends('layout.main')
@section('title', "Wishlist Buku")

@section('content')
@include('sweetalert::alert')

    <form action="/transaction/wishlist/checkout" method="post" class="{{ Request::is('/transaction/wishlist/checkout*') ? 'active' : '' }}">
        @csrf
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="mt-2">@yield('title')</h3>
                                    <div id="total_wishlist">
                                        <p>Total Wishlist : {{ $wishlist_count }}</p>
                                    </div>

                                    <!-- Tambah Data -->
                                    <a href="#add" data-toggle="modal" class="btn btn-outline-success btn-sm">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                                        
                                    <div class="modal fade" id="add" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="formModalLabel">Tambahkan Wishlist Book</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="myForm" name="myForm" class="form-horizontal" novalidate="">
                                                        <div class="form-group">
                                                            <label>Nama</label>
                                                            <select name="" class="form-control" id="">
                                                                @foreach($books as $b)
                                                                <option value="{{ $b->id }}">{{ $b->judul }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.col -->
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right" style="background-color: rgba(255,0,0,0);">
                                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                                        <li class="breadcrumb-item active">@yield('title')</li>
                                    </ol>
                                </div><!-- /.col -->
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                        <div style="text-align: right;">
                            <div id="anjing"></div>
                        </div>
                    </div>
		
                    <div class="card-body">
                        
                        {{-- Tabel --}}
                        <table id="example1" class="table">
                            <tbody>
                                @foreach($wishlists as $key => $wishlist)
                                    <tr>
                                        <td style="border :none;">{{ $loop->iteration }}</td>
                                        <td style="border: none;">
                                            <div class="row">
                                                <div class="col-6">
                                                    @if ($wishlist->book->image)
                                                        <img src="{{ asset('storage/' . $wishlist->book->image) }}" class="" width="50%">
                                                    @else
                                                        <img src="{{ asset("storage/images/book_cover_default.png") }}" class="" width="50%">
                                                    @endif
                                                </div>
                                                <div class="col-6">
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <td style="border: none;">ISBN</td>
                                                                <td style="border: none;">: {{ $wishlist->book->isbn }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="border: none;">Judul</td>
                                                                <td style="border: none;">: {{ $wishlist->book->judul }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
<<<<<<< HEAD
                                            <div class="col-6">
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td style="border: none;">ISBN</td>
                                                            <td style="border: none;">: {{ $wishlist->book->isbn }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="border: none;">Judul</td>
                                                            <td style="border: none;">: {{ $wishlist->book->judul }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center" style="border: none; font-size:20px;">
                                        <input style="font-size:20px;" name='id[]' type="checkbox" id="checkItem" value="{{ $wishlist->id }}">
                                    </td>
                                    <td  style="border: none;">
                                        <a href="javascript:void(0)" data-url="/wishlist/delete/{{$wishlist->id}}" class="btn btn-xs btn-danger delete-user">Hapus dari draff</a>
                                    </td>
                                </tr>
=======
                                        </td>
                                        <td class="text-center" style="border: none; font-size:20px;">
                                            <input style="font-size:20px;" name='id[]' type="checkbox" id="checkItem" value="<?php echo $wishlists[$key]->id; ?>">
                                        </td>
                                        <td  style="border: none;">
                                            <a href="/transaction/wishlist/destroy/{{ $wishlist->id }}" style="font-size :12px;" class="btn btn-danger" onclick="return confirm('sure?')" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Hapus dari draff"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
>>>>>>> 2b88e42effebf0e2613c52f4147b757fc9eb6375
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>

	<script>

        $('input[type=checkbox]').on('change', function(evt) {
            if($('input[id=checkItem]:checked').length >= 4) {
                this.checked = false;
                alert('Hanya boleh memilih maksimal 3 kategori !');
            }
            var n = $('input[id=checkItem]:checked').length;
            $("#anjing").html("<button type='submit' class='btn btn-outline-success'>Pinjam " + n + " Buku</button>");
        });

        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            /*------------------------------------------
            --------------------------------------------
            When click user on Show Button
            --------------------------------------------
            --------------------------------------------*/
            $(document).on('click', '.delete-user', function() {

                var userURL = $(this).data('url');
                var trObj = $(this);

                if (confirm("Are you sure you want to delete this?") == true) {
                    $.ajax({
                        url: userURL,
                        type: 'DELETE',
                        dataType: 'json',
                        data: { _token: '{{csrf_token()}}' },
                        success: function(data) {
                            //alert(data.success);
                            trObj.parents("tr").remove();
                            $("#total_wishlist").append('<p id="total_wishlist">Total Wishlist :' + value.wishlist_count + '</p>');
                        }
                    });
                }

            });

        });

        // jQuery(document).ready(function($){
        //     //----- Open model CREATE -----//
        //     jQuery('#btn-add').click(function () {
        //         jQuery('#btn-save').val("add");
        //         jQuery('#myForm').trigger("reset");
        //         jQuery('#add').modal('show');
        //     });
        //     // CREATE
        //     $("#btn-save").click(function (e) {
        //         $.ajaxSetup({
        //             headers: {
        //                 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        //             }
        //         });
        //         e.preventDefault();
        //         var formData = {
        //             title: jQuery('#title').val(),
        //             description: jQuery('#description').val(),
        //         };
        //         var state = jQuery('#btn-save').val();
        //         var type = "POST";
        //         var todo_id = jQuery('#todo_id').val();
        //         var ajaxurl = 'todo';
        //         $.ajax({
        //             type: type,
        //             url: ajaxurl,
        //             data: formData,
        //             dataType: 'json',
        //             success: function (data) {
        //                 var todo = '<tr id="todo' + data.id + '"><td>' + data.id + '</td><td>' + data.title + '</td><td>' + data.description + '</td>';
        //                 if (state == "add") {
        //                     jQuery('#todo-list').append(todo);
        //                 } else {
        //                     jQuery("#todo" + todo_id).replaceWith(todo);
        //                 }
        //                 jQuery('#myForm').trigger("reset");
        //                 jQuery('#formModal').modal('hide')
        //             },
        //             error: function (data) {
        //                 console.log(data);
        //             }
        //         });
        //     });
        // });

	</script>
@endsection