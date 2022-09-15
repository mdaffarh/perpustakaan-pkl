@extends('layout.main')
@section('title', "Dashboard")

@section('content')
    @include('sweetalert::alert')
    {{-- Stat --}}
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $stock }}</h3>
    
              <p>Judul Buku Tersedia</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
            <a href="/transaction/borrows" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        @can('member')
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $borrowed }}</h3>
      
                <p>Peminjaman Berjalan</p>
              </div>
              <div class="icon">
                <i class="fas fa-book-reader"></i>
              </div>
              <a href="/transaction/borrows" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        @endcan

        @can('staff')
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $borrowRequest }}</h3>
      
                <p>Permintaan Peminjaman</p>
              </div>
              <div class="icon">
                <i class="fas fa-book-reader"></i>
              </div>
              <a href="/transaction/borrows" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $memberRegist }}</h3>
      
                <p>Pendaftar Anggota</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="/transaction/member-registrations/index" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        @endcan
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>65</h3>
    
              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
    </div>
    <div class="row">
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
            $(document).ready(function(){
                var zindex = 10;
                
                $("div.card__").click(function(e){
                    e.preventDefault();

                    var isShowing = false;

                    if ($(this).hasClass("show")) {
                    isShowing = true
                    }

                    if ($("div.cards__").hasClass("showing")) {
                    // a card is already in view
                    $("div.card.show")
                        .removeClass("show");

                    if (isShowing) {
                        // this card was showing - reset the grid
                        $("div.cards__")
                        .removeClass("showing");
                    } else {
                        // this card isn't showing - get in with it
                        $(this)
                        .css({zIndex: zindex})
                        .addClass("show");

                    }

                    zindex++;

                    } else {
                    // no cards__ in view
                    $("div.cards__")
                        .addClass("showing");
                    $(this)
                        .css({zIndex:zindex})
                        .addClass("show");

                    zindex++;
                    }
                    
                });
            });
        </script>
      @endcan
    </div>
@endsection