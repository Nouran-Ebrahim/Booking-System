<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8"> --}}
        <span class="brand-text font-weight-light">Booking System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            {{-- <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div> --}}
            <div class="info mx-auto">
                <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        {{-- <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{ route('admin.home') }}"
                        class="nav-link {{ Route::currentRouteName() == 'admin.home.index' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>



                @if (auth()->user()->can('Index-role') || auth()->user()->can('Create-role'))
                    <li
                        class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'admin.roles.') ? 'menu-open' : '' }} ">
                        <a href="#"
                            class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.roles.') ? 'active' : '' }} ">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Roles
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('Create-role')
                                <li class="nav-item">
                                    <a href="{{ route('admin.roles.create') }}"
                                        class="nav-link {{ Route::currentRouteName() == 'admin.roles.create' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>add</p>
                                    </a>
                                </li>
                            @endcan
                            @can('Index-role')
                                <li class="nav-item">
                                    <a href="{{ route('admin.roles.index') }}"
                                        class="nav-link {{ Route::currentRouteName() == 'admin.roles.index' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>index</p>
                                    </a>
                                </li>
                            @endcan



                        </ul>
                    </li>
                @endif
                @if (auth()->user()->can('Index-admin') || auth()->user()->can('Create-admin'))
                    <li
                        class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'admin.admins.') ? 'menu-open' : '' }} ">
                        <a href="#"
                            class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.admins.') ? 'active' : '' }} ">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Admins
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('Create-admin')
                                <li class="nav-item">
                                    <a href="{{ route('admin.admins.create') }}"
                                        class="nav-link {{ Route::currentRouteName() == 'admin.admins.create' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>add</p>
                                    </a>
                                </li>
                            @endcan
                            @can('Index-admin')
                                <li class="nav-item">
                                    <a href="{{ route('admin.admins.index') }}"
                                        class="nav-link {{ Route::currentRouteName() == 'admin.admins.index' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>index</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif
                @if (auth()->user()->can('Index-room') || auth()->user()->can('Create-room'))
                    <li
                        class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'admin.rooms.') ? 'menu-open' : '' }} ">
                        <a href="#"
                            class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.rooms.') ? 'active' : '' }} ">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Rooms
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('Create-room')
                                <li class="nav-item">
                                    <a href="{{ route('admin.rooms.create') }}"
                                        class="nav-link {{ Route::currentRouteName() == 'admin.rooms.create' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>add</p>
                                    </a>
                                </li>
                            @endcan
                            @can('Index-room')
                                <li class="nav-item">
                                    <a href="{{ route('admin.rooms.index') }}"
                                        class="nav-link {{ Route::currentRouteName() == 'admin.rooms.index' ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>index</p>
                                    </a>
                                </li>
                            @endcan

                        </ul>
                    </li>
                @endif
                @can('Index-client')
                    <li
                        class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'admin.clients.') ? 'active' : '' }}">
                        <a href="{{ route('admin.clients.index') }}"
                            class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.clients.') ? 'active' : '' }}">
                            <i class="far fa-user nav-icon"></i>
                            <p>Clients</p>
                        </a>
                    </li>
                @endcan
                @can('Index-booking')
                    <li
                        class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'admin.bookings.') ? 'active' : '' }}">
                        <a href="{{ route('admin.bookings.index') }}"
                            class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'admin.bookings.') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Bookings</p>
                        </a>
                    </li>
                @endcan

                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link"
                        onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                        LogOut
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
