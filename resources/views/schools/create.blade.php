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
{{-- Form test --}}
    <form action="/dashboard/schools" method="post">
       @csrf
       <h5>Nama</h5>
       <input type="text" name="name" id="name"> 
       <h5>Alamat</h5>
       <input type="text" name="address" id="address"> 
       <h5>Kota</h5>
       <input type="text" name="city" id="city"> 
       <h5>Kode Pos</h5>
       <input type="text" name="post_code" id="post_code"> 
       <h5>Email</h5>
       <input type="text" name="email" id="email"> 
       <h5>Website</h5>
       <input type="text" name="website" id="website"> 
       <h5>Fax</h5>
       <input type="text" name="fax" id="fax"> 
       <h5>Nomor Telepon</h5>
       <input type="text" name="phone_number" id="phone_number"> 
       <input type="submit" value="Submit">
   </form>
</div>
@endsection

@section('footer')
@include('layout.footer')
@endsection
