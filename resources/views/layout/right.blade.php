<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        
        <!-- Navbar Search -->
        <li class="nav-item">
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
        </li>


        <!-- Notification Menu -->
        @can('member')
            @if ($notiCount != 0)
                <button type="button" class="btn btn-outline-primary btn-sm" style=" pointer-events: none;"><strong>{{ $notiCount }} Notifikasi Baru!</strong></button>
            @endif
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    @if ($notiCount != 0)
                        <span class="badge badge-danger navbar-badge">{{ $notiCount }}</span>
                    @endif
                </a>
            
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                    {{-- Viewed all --}}
                    <div class="d-flex align-items-center">
                        @if ($notiCount != 0)
                        <form action="" method="post">
                            <button class="text-sm float-left" style="background-color:rgba(255,2,255,0);color:rgba(255,2,255,0) ; border: none;pointer-events: none;">
                                <i class="fa fa-times ml-1 mt-2"></i>
                            </button>
                        </form>  
                        <form action="/notification/viewedAll" method="post" class="flex-grow-1 text-center">
                            @csrf
                            <input type="hidden" name="member_id" value="{{ auth()->user()->member_id }}">
                            <button type="submit" style="background-color:rgba(255,2,255,0); ; border: none;" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Tandai sudah dilihat semua">
                                <span class="dropdown-item dropdown-header">{{ $notiCount }} Notifikasi Baru</span>
                            </button>
                        </form>
                        @else
                        <span class="dropdown-item dropdown-header w-100">{{ $notiCount }} Notifikasi Baru</span>
                        @endif
                        @if ($notiCounts != 0)
                        <form action="/notification/deleteAll/{id}" method="post" >
                            @csrf
                            <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                            <button type="submit" class="text-dark text-sm float-right" style="background-color:rgba(255,2,255,0); ; border: none;" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Hapus semua notifikasi">
                                <i class="fa fa-times mb-1 mr-3"></i>
                            </button>
                        </form>  
                        @endif
                    </div>
                    {{-- Viewed all end --}}

                    <div class="overflow-auto notiscroll" style="max-height: 400px">
                    @foreach ($notifications as $item)
                        <div class="dropdown-item px-2">
                        <!-- Message Start -->
                        <div class="media">
                            <i class="fas fa-book mr-2 mt-2"></i>
                            <div class="media-body">
                            {{-- Delete --}}
                            <form action="/notification/{{ $item->id }}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="text-danger text-sm float-right" style="position: absolute; z-index:2; left:90%; background-color:rgba(255,2,255,0); ; border: none;" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Hapus notifikasi">
                                <i class="fa fa-times mt-2"></i>
                                </button>
                            </form>
                            {{-- Delete end --}}
        
                            @if ($item->viewed == true)
                                <p class="text-sm text-wrap mt-1 lh-1 pl-1 pr-3 ">{{ $item->message }}</p>
                            @else
                            {{-- Viewed --}}
                                <form action="/notification/viewed" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <button type="submit" style="background-color:rgba(255,2,255,0); ; border: none;" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Halaman peminjaman">
                                        <a href="/transaction/borrows"><p class="text-sm text-wrap mt-1 lh-1 pe-1" style="text-align: left !important; padding-right: 10px !important;">{{ $item->message }}</p></a>
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
            
                </div>
            </li>
        @endcan

        <!-- Cart wishlist Menu -->
        @can('member')
        <a class="nav-link" href="/transaction/wishlist" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Wishlist">
            <i class="fas fa-shopping-cart"></i>
            @if ($wishlistCount != 0)
                <span class="badge badge-danger navbar-badge">{{ $wishlistCount }}</span>
            @endif
        </a>
        @endcan

        <!-- Staff Nontifikasi -->
        @can('staff')
            @if ($notiStaffCount != 0)
                <button type="button" class="btn btn-outline-primary btn-sm" style=" pointer-events: none;"><strong>{{ $notiStaffCount }} Notifikasi Baru!</strong></button>
            @endif
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    @if ($notiStaffCount != 0)
                        <span class="badge badge-danger navbar-badge">{{ $notiStaffCount }}</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <div class="d-flex align-items-center">
                    @if ($notiStaffCount != 0)
                        <form action="" method="post">
                        <button class="text-sm float-left" style="background-color:rgba(255,2,255,0);color:rgba(255,2,255,0) ; border: none;pointer-events: none;">
                            <i class="fa fa-times ml-1 mt-2"></i>
                        </button>
                        </form>  
                        <form action="/notification/viewedAllStaff" method="post" class="flex-grow-1 text-center">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <button type="submit" style="background-color:rgba(255,2,255,0); ; border: none;" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Tandai sudah dilihat semua">
                            <span class="dropdown-item dropdown-header">{{ $notiStaffCount }} Notifikasi Baru</span>
                        </button>
                        </form>
                    @else
                        <span class="dropdown-item dropdown-header w-100">{{ $notiStaffCount }} Notifikasi Baru</span>
                    @endif
                    @if ($notiStaffCounts != 0)
                        <form action="/notification/deleteAllStaff/{id}" method="post" >
                            @csrf
                            <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                            <button type="submit" class="text-dark text-sm float-right" style="background-color:rgba(255,2,255,0); ; border: none;" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Hapus semua notifikasi">
                            <i class="fa fa-times mb-1 mr-3"></i>
                            </button>
                        </form>  
                    @endif
                    </div>
                    
                    <div class="overflow-auto notiscroll" style="max-height: 400px">
                      @foreach ($notiStaff as $item)
                        <div class="dropdown-item px-2">
                            <!-- Message Start -->
                            <div class="media">
                            <i class="fas fa-book mr-2 mt-2"></i>
                            <div class="media-body">
                                {{-- Delete --}}
                                <form action="/notification/{{ $item->id }}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="text-danger text-sm ps-1"  style="position: absolute; z-index:2; left:90%; background-color:rgba(255,2,255,0); ; border: none;" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Hapus notifikasi">
                                    <i class="fa fa-times mt-2"></i>
                                </button>
                                </form>
                                {{-- Delete end --}}
                                @if ($item->viewed == true)
                                    <p class="text-sm text-wrap mt-1 pl-1 lh-1 pe-1" style="text-align: left !important; padding-right: 15px !important;">{{ $item->message }}</p>
                                @else
                                {{-- Viewed --}}
                                    <form action="/notification/viewed" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <button type="submit" style="background-color:rgba(255,2,255,0); ; border: none;" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Halaman peminjaman">
                                        <a href="/transaction/borrows"><p class="text-sm text-wrap mt-1 lh-1 pe-1" style="text-align: left !important; padding-right: 10px !important;">{{ $item->message }}</p></a>
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
                </div>
            </li>
        @endcan
        <!-- Notifications Dropdown Menu End -->

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Layar Penuh">
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