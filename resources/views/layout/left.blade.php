<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-lightblue elevation-4">
    
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
        <img src="{{ asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Perpustakaan</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-1 mb-3 d-flex">
            <div class="image mt-1">
                @can('staff')
                    <img src="{{ asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">    
                @endcan
                @can('member')
                    @if(auth()->user()->member->profile)
                        <img src="{{ asset('storage/'. auth()->user()->member->profile) }}"
                            class="img-circle elevation-2" alt="User Image">
                    @elseif(auth()->user()->member->jenis_kelamin == "Laki-laki")
                        <img src="{{ asset('dist/img/avatar5.png')}}"
                            class="img-circle elevation-2" alt="User Image">
                    @else
                        <img src="{{ asset('dist/img/avatar2.png')}}"
                        class="img-circle elevation-2" alt="User Image">
                    @endif
                @endcan
            </div>
            <div class="info">
            @if (auth()->user()->staff_id)
                <a href="#">{{ auth()->user()->staff->nama }}</a>
                <p class="text-muted text-capitalize">{{ auth()->user()->role }} Perpustakaan</p>
            @else
                <a href="/profile" class="{{ Request::is('profile*') ? 'text-white' : '' }}">{{ auth()->user()->member->nama }}</a>
                <p class="text-muted">Anggota Perpustakaan</p>
            @endif
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2 pb-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @can('member')
                <li class="nav-item">
                    <a href="/transaction/wishlist" class="nav-link {{ Request::is('transaction/wishlist*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bookmark"></i>
                        <p>Wishlist Buku</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/transaction/borrows" class="nav-link {{ Request::is('transaction/borrows*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Peminjaman Buku</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/transaction/book-donations" class="nav-link {{ Request::is('transaction/book-donations*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book-medical"></i>
                        <p>Sumbangan Buku</p>
                    </a>
                </li>
                @endcan

                @can('staff')
                {{-- Transaksi --}} 
                <li class="nav-item">
                    <a href="#" class="nav-link {{ Request::is('transaction*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Transaksi<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                    @can('staff')
                        <li class="nav-item">
                            <a href="/transaction/member-registrations/index" class="nav-link {{ Request::is('transaction/member-registrations*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pendaftaran Anggota</p>
                            </a>
                        </li>
                    @endcan
                    @can('admin')
                        <li class="nav-item">
                            <a href="/transaction/staff-registrations/index" class="nav-link {{ Request::is('transaction/staff-registrations*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pendaftaran Staff</p>
                            </a>
                        </li>
                    @endcan
                
                        <!-- Transaksi Peminjaman Buku -->
                        <li class="nav-item">
                            <a href="/transaction/borrows" class="nav-link {{ Request::is('transaction/borrows*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Peminjaman Buku</p>
                            </a>
                        </li>
                        
                        <!-- Transaksi Pengembalian Dan Sumbangan Buku -->
                        @can('staff')
                            <li class="nav-item">
                                <a href="/transaction/return" class="nav-link {{ Request::is('transaction/return*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pengembalian Buku</p>
                                </a>
                            </li>

                        <li class="nav-item">
                            <a href="/transaction/book-donations" class="nav-link {{ Request::is('transaction/book-donations*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sumbangan Buku</p>
                            </a>
                        </li>           
                        @endcan

                        @can('staff')
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Jadwal Piket Staff</p>
                                </a>
                            </li>
                        @endcan
                    </ul>

                </li>
                @endcan

                <!-- Table -->
                @can('staff')
                <li class="nav-item">
                    <a href="#" class="nav-link {{ Request::is('table*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Tabel
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <!-- Table Anggota -->
                        <li class="nav-item">
                            <a href="/table/members" class="nav-link {{ Request::is('table/members*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Anggota</p>
                            </a>
                        </li>
                @endcan

                        <!-- Table Staff -->
                        @can('admin')
                        <li class="nav-item">
                            <a href="/table/staffs" class="nav-link {{ Request::is('table/staffs*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Staff</p>
                            </a>
                        </li>
                        @endcan

                        <!-- Table Buku -->
                        @can('staff')
                        <li class="nav-item">
                            <a href="/table/books" class="nav-link {{ Request::is('table/books*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Buku</p>
                            </a>
                        </li>

                        <!-- Table Stok Buku -->
                        <li class="nav-item">
                            <a href="/table/stocks" class="nav-link {{ Request::is('table/stock*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Stok</p>
                            </a>
                        </li>

                        <!-- Table Shift Jaga -->
                        <li class="nav-item">
                            <a href="/table/shifts" class="nav-link {{ Request::is('table/shifts*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Shift Jaga</p>
                            </a>
                        </li>

                        <!-- Table User Anggota -->
                        <li class="nav-item">
                            <a href="/table/member-users" class="nav-link {{ Request::is('table/member-users*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User Anggota</p>
                            </a>
                        </li>
                        @endcan
                
                        <!-- Table User Staff -->
                        @can('admin')
                        <li class="nav-item">
                            <a href="/table/staff-users" class="nav-link {{ Request::is('table/staff-users*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User Staff</p>
                            </a>
                        </li>

                        <!-- Table Sekolah -->
                        <li class="nav-item">
                            <a href="/table/schools" class="nav-link {{ Request::is('table/schools*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sekolah</p>
                            </a>
                        </li>  
                        @endcan

                    @can('staff')
                  
                    </ul>
                </li>
                @endcan

                @can('admin')
                <li class="nav-item">
                    <a href="#" class="nav-link {{ Request::is('report*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-pen-square"></i>
                        <p>
                            Laporan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <!-- Table Anggota -->
                        <li class="nav-item">
                            <a href="/report/fine" class="nav-link {{ Request::is('report/fine*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Denda</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan

            </ul>
        </nav>

      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>