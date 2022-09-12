  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="/dashboard" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> --}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      {{-- <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li> --}}

      <!-- Notification Menu -->
      @can('member')
        <li class="nav-item dropdown">
          {{-- Viewed not done--}}
          <a class="nav-link" data-toggle="dropdown" href="#">
              <i class="far fa-bell"></i>
              @if ($notiCount != 0)
                <span class="badge badge-danger navbar-badge">{{ $notiCount }}</span>
              @endif
          </a>
          {{-- Viewed End--}}
          
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            {{-- Viewed all --}}
              @if ($notiCount != 0)
                <form action="/notification/viewedAll" method="post">
                  @csrf
                  <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                  <button class="w-100" type="submit" style="background-color:rgba(255,2,255,0); ; border: none;" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Tandai sudah dilihat semua">
                    <span class="dropdown-item dropdown-header">{{ $notiCount }} New Notifications</span>
                  </button>
                </form>  
              @else
                <span class="dropdown-item dropdown-header">{{ $notiCount }} New Notifications</span>
              @endif
            {{-- Viewed all end --}}
            @foreach ($notifications as $item)
              <div class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                  <i class="fas fa-book mr-2 mt-2"></i>
                  <div class="media-body">
                    {{-- Delete --}}
                    <form action="/notification/{{ $item->id }}" method="post">
                      @method('delete')
                      @csrf
                      <button type="submit" class="text-danger text-sm float-right" style="background-color:rgba(255,2,255,0); ; border: none;" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Hapus notifikasi">
                        <i class="fa fa-times ml-1 mt-2"></i>
                      </button>
                    </form>
                    {{-- Delete end --}}

                    @if ($item->viewed == true)
                      <p class="text-sm text-wrap mt-1 pl-1">{{ $item->message }}</p>
                    @else
                    {{-- Viewed --}}
                      <form action="/notification/viewed" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <button class="d-inline" type="submit" style="background-color:rgba(255,2,255,0); ; border: none;" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Halaman peminjaman">
                          <a href="/transaction/borrows"><p class="text-sm text-wrap mt-1">{{ $item->message }}</p></a>
                        </button>
                      </form>
                    {{-- Viewed end --}}
                    @endif
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{ $item->created_at->diffForHumans() }}</p>
                  </div>
                </div>
                <!-- Message End -->
              </div>
              <div class="dropdown-divider"></div>
            @endforeach
            
          </div>
        </li>
      @endcan

      @can('staff')
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            @if ($notiStaffCount != 0)
              <span class="badge badge-danger navbar-badge">{{ $notiStaffCount }}</span>
            @endif
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            {{-- Viewed all --}}
            @if ($notiStaffCount != 0)
              <form action="/notification/viewedAllStaff" method="post">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <button class="w-100" type="submit" style="background-color:rgba(255,2,255,0); ; border: none;" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Tandai sudah dilihat semua">
                  <span class="dropdown-item dropdown-header">{{ $notiStaffCount }} New Notifications</span>
                </button>
              </form>  
            @else
              <span class="dropdown-item dropdown-header">{{ $notiStaffCount }} New Notifications</span>
            @endif
            {{-- Viewed end --}}
            @foreach ($notiStaff as $item)
              <div class="dropdown-item">
                <!-- Message Start -->
                <div class="media">
                  <i class="fas fa-book mr-2 mt-2"></i>
                  <div class="media-body">
                    {{-- Delete --}}
                    <form action="/notification/{{ $item->id }}" method="post">
                      @method('delete')
                      @csrf
                      <button type="submit" class="text-danger text-sm float-right" style="background-color:rgba(255,2,255,0); ; border: none;" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Hapus notifikasi">
                        <i class="fa fa-times ml-1 mt-2"></i>
                      </button>
                    </form>
                    {{-- Delete end --}}
                    
                    @if ($item->viewed == true)
                      <p class="text-sm text-wrap mt-1 pl-1">{{ $item->message }}</p>
                    @else
                      {{-- Viewed --}}
                        <form action="/notification/viewed" method="post">
                          @csrf
                          <input type="hidden" name="id" value="{{ $item->id }}">
                          <button class="d-inline" type="submit" style="background-color:rgba(255,2,255,0); ; border: none;" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Halaman peminjaman">
                            <a href="/transaction/borrows"><p class="text-sm text-wrap mt-1">{{ $item->message }}</p></a>
                          </button>
                        </form>
                      {{-- Viewed end --}}
                    @endif
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{ $item->created_at->diffForHumans() }}</p>
                  </div>
                </div>
                <!-- Message End -->
              </div>
              <div class="dropdown-divider"></div>
            @endforeach
            
          </div>
        </li>
      @endcan
      <!-- Notifications Dropdown Menu End -->

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>

<form method="POST" action="/logout">
    @csrf
    <button class="btn btn-primary" type="submit" value="Logout">Logout</button>
</form>
  </nav>
  <!-- /.navbar -->