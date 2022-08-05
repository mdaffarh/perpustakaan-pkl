@extends('layout.main')
@section('title', "Perpustakaan")

@section('right')
@include('layout.right')
@endsection

@section('left')
@include('layout.left')
@endsection

@section('content')
@include('layout.content')
@endsection

@section('footer')
@include('layout.footer')
@endsection


{{-- 
<h1>Halo {{ auth()->user()->name }}</h1>
<form method="POST" action="/logout">
    @csrf
    <button type="submit" value="Logout">Logout</button>
</form> --}}