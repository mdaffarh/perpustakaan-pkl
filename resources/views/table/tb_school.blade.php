@extends('layout.main')
@section('title', "Perpustakaan")

@section('right')
@include('layout.right')
@endsection

@section('left')
@include('layout.left')
@endsection

@section('content')
<script>
    $(document).ready(function () {
        $('#tb_school').DataTable();
    });
</script>
<table id="tb_school" class="display" style="width:100%">
    <thead>
        <tr>
            <th>Id</th>
            <th>name</th>
            <th>address</th>
            <th>city</th>
            <th>post_code</th>
            <th>email</th>
            <th>website</th>
            <th>fax</th>
            <th>phone_number</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tb_school as $key => $value) { 
            
            ?>
        <td>{{ $value->id }}</td>
        <td>{{ $value->name }}</td> 
        <td>{{ $value->address }}</td>
        <td>{{ $value->city }}</td>
        <td>{{ $value->post_code }}</td> 
        <td>{{ $value->email }}</td>
        <td>{{ $value->website }}</td>
        <td>{{ $value->fax }}</td> 
        <td>{{ $value->phone_number }}</td>
        <?php } ?>
    </tbody>
@endsection

@section('footer')
@include('layout.footer')
@endsection
