
@extends('layout.main')
@section('title', "Dashboard")
    
@section('content')
@can('member')
    <link rel="stylesheet" href="{{ asset('assets/css/card.css') }}">
    @foreach($books1 as $book)
    <div class="cards__">
        <div class="card__">
            <div class="card__image-holder">
                @if ($book->image)
                <img src="{{ asset('storage/' . $book->image) }}" class="card__image">
                @else
                <img src="{{ asset("storage/images/book_cover_default.png") }}" class="card__image">
                @endif
            </div>
            <div class="card-title">
                <a href="#" class="toggle-info btn">
                    <span class="left"></span>
                    <span class="right"></span>
                </a>
                <h2>
                    Card title
                    <small>{{ $book->judul }}</small>
                </h2>
            </div>
            <div class="card-flap flap1">
                <div class="card-description">
                    This grid is an attempt to make something nice that works on touch devices. Ignoring hover states when they're not available etc.
                </div>
                <div class="card-flap flap2">
                    <div class="card-actions">
                        <a href="#" class="btn">Read more</a>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    @endforeach

    

    <script type="text/javascript">
      $('.carousel').carousel({
    interval: false,
  });
      </script> 
@endcan

@endsection

