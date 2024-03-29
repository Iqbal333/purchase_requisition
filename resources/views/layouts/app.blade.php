<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Requisition Creatsign</title>

    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/app-dark.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('assets/css/shared/iconly.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css' rel='stylesheet' type='text/css'>

</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="javascript:void(0);"><small>CreatSign</small></a>
                        </div>
                        <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21"><g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path><g transform="translate(-210 -1)"><path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path><circle cx="220.5" cy="11.5" r="4"></circle><path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path></g></g></svg>
                            <div class="form-check form-switch fs-6">
                                <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" >
                                <label class="form-check-label" ></label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="currentColor" d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z"></path></svg>
                        </div>
                        <div class="sidebar-toggler  x">
                            <a href="javascript:void(0);" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li
                            class="sidebar-item {{ (request()->is('home')) ? 'active' : '' }}">
                            <a href="{{ url('home') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        @can('request_items-list')
                        <li
                            class="sidebar-item {{ (request()->is('request_items')) ? 'active' : '' }}">
                            <a href="{{ url('request_items') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Request Items</span>
                            </a>
                        </li>
                        @endcan

                        @can('list_request')
                        <li class="sidebar-item {{ (request()->is('list_request')) ? 'active' : '' }}">
                            <a href="{{ url('list_request') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>List Request</span>
                            </a>
                        </li>
                        @endcan
                        @can('list_approve')
                        <li class="sidebar-item {{ (request()->is('approve')) ? 'active' : '' }}">
                            <a href="{{ url('approve') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>List Approve</span>
                            </a>
                        </li>
                        @endcan
                        @can('list_reject')
                        <li class="sidebar-item {{ (request()->is('reject')) ? 'active' : '' }}">
                            <a href="{{ url('reject') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>List Reject</span>
                            </a>
                        </li>
                        @endcan
                        @can('division-list')
                        <li class="sidebar-item {{ (request()->is('division')) ? 'active' : '' }}">
                            <a href="{{ url('division') }}" class="sidebar-link">
                                <i class="bi bi-grid-fill"></i>
                                <span>Division</span>
                            </a>
                        </li>
                        @endcan

                        @can('employee-list')
                        <li class="sidebar-item {{ (request()->is('employee')) ? 'active' : '' }}">
                            <a href="{{ url('employee') }}" class="sidebar-link">
                                <i class="bi bi-grid-fill"></i>
                                <span>Employee</span>
                            </a>
                        </li>
                        @endcan

                        <li class="sidebar-title">Pages</li>

                        <li class="sidebar-item has-sub">
                            <a href="javascript:void(0);" class='sidebar-link'>
                                <i class="bi bi-person-badge-fill"></i>
                                <span>Authentication</span>
                            </a>
                            <ul class="submenu ">
                                @guest
                                    @if (Route::has('login'))
                                        <li class="submenu-item {{ (request()->is('login')) ? 'active' : '' }}">
                                            <a href="{{ route('login') }}">Login</a>
                                        </li>
                                    @endif
                                    @if (Route::has('register'))
                                        <li class="submenu-item {{ (request()->is('register')) ? 'active' : '' }}">
                                            <a href="{{ route('register') }}">Register</a>
                                        </li>
                                    @endif
                                @else
                                    @can('user-list')
                                        <li class="submenu-item {{ (request()->is('users')) ? 'active' : '' }}">
                                            <a href="{{ route('users.index') }}">Users</a>
                                        </li>
                                    @endcan
                                    @can('role-list')
                                        <li class="submenu-item {{ (request()->is('roles')) ? 'active' : '' }}">
                                            <a href="{{ route('roles.index') }}">Roles</a>
                                        </li>
                                    @endcan
                                    @can('permission-list')
                                        <li class="submenu-item {{ (request()->is('permissions')) ? 'active' : '' }}">
                                            <a href="{{ route('permissions.index') }}">Permission</a>
                                        </li>
                                    @endcan
                                    @can('request_items-list')
                                        <li class="submenu-item {{ (request()->is('request_items.index')) ? 'active' : '' }}">
                                            <a href="{{ route('request_items.index') }}">Pengajuan Barang</a>
                                        </li>
                                    @endcan
                                    @can('post-list')
                                        <li class="submenu-item">
                                            <a href="{{ route('posts.index') }}">Posts</a>
                                        </li>
                                    @endcan
                                @endguest

                            </ul>
                        </li>

                        {{-- <li class="sidebar-item has-sub">
                            <a href="javascript:void(0);" class='sidebar-link'>
                                <i class="bi bi-x-octagon-fill"></i>
                                <span>Errors</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="error-403.html">403</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="error-404.html">404</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="error-500.html">500</a>
                                </li>
                            </ul>
                        </li> --}}

                        <li class="sidebar-title">Raise Support</li>

                        <li class="sidebar-item  ">
                            <a href="javascript:void()" class='sidebar-link'>
                                <i class="bi bi-life-preserver"></i>
                                <span>Documentation</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="sidebar-link">
                                <i class="bi bi-door-open-fill"></i>
                                <span>Logout</span>
                            </a>
                            <form action="{{ route('logout') }}" method="POST" class="d-none" id="logout-form">
                                @csrf
                            </form>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div id="main">
            <header class='mb-3'>
                <nav class="navbar navbar-expand navbar-light navbar-top">
                    <div class="container-fluid">
                        <a href="javascript:void(0);" class="burger-btn d-block">
                            <i class="bi bi-justify fs-3"></i>
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-lg-0">
                                <li class="nav-item dropdown me-1">
                                    <a class="nav-link active dropdown-toggle text-gray-600" href="#" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class='bi bi-envelope bi-sub fs-4'></i>
                                    </a>
                                    {{-- <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <h6 class="dropdown-header">Mail</h6>
                                        </li>
                                        <li><a class="dropdown-item" href="#">No new mail</a></li>
                                    </ul> --}}
                                </li>
                                <li class="nav-item dropdown me-3">
                                    <a class="nav-link active dropdown-toggle text-gray-600" href="#" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                        <i class='bi bi-bell bi-sub fs-4'></i>
                                    </a>
                                    {{-- <ul class="dropdown-menu dropdown-menu-end notification-dropdown" aria-labelledby="dropdownMenuButton">
                                        <li class="dropdown-header">
                                            <h6>Notifications</h6>
                                        </li>
                                        <li class="dropdown-item notification-item">
                                            <a class="d-flex align-items-center" href="#">
                                                <div class="notification-icon bg-primary">
                                                    <i class="bi bi-cart-check"></i>
                                                </div>
                                                <div class="notification-text ms-4">
                                                    <p class="notification-title font-bold">Successfully check out</p>
                                                    <p class="notification-subtitle font-thin text-sm">Order ID #256</p>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="dropdown-item notification-item">
                                            <a class="d-flex align-items-center" href="#">
                                                <div class="notification-icon bg-success">
                                                    <i class="bi bi-file-earmark-check"></i>
                                                </div>
                                                <div class="notification-text ms-4">
                                                    <p class="notification-title font-bold">Homework submitted</p>
                                                    <p class="notification-subtitle font-thin text-sm">Algebra math homework</p>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <p class="text-center py-2 mb-0"><a href="#">See all notification</a></p>
                                        </li>
                                    </ul> --}}
                                </li>
                            </ul>
                            <div class="dropdown">
                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-menu d-flex">
                                        <div class="user-name text-end me-3">
                                            <h6 class="mb-0 text-gray-600">{{ auth()->user()->name }}</h6>
                                            <p class="mb-0 text-sm text-gray-600">{{ Auth::user()->roles()->pluck("name")->first() }} | {{ auth()->user()->division->division_name }}</p>
                                        </div>
                                        {{-- <div class="user-img d-flex align-items-center">
                                            <div class="avatar avatar-md">
                                                <img src="{{ asset('assets/images/faces/1.jpg') }}">
                                            </div>
                                        </div> --}}
                                    </div>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                                    <li>
                                        <h6 class="dropdown-header">Hello, {{ auth()->user()->name }}!</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="icon-mid bi bi-person me-2"></i> My
                                            Profile</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="icon-mid bi bi-gear me-2"></i>
                                            Settings</a></li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="icon-mid bi bi-box-arrow-left me-2"></i>
                                            Logout
                                        </a>
                                        <form action="{{ route('logout') }}" method="POST" class="d-none" id="logout-form">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </nav>
            </header>

            <div class="page-content">
                @yield('content')
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2022 &copy; Purchase Requisition</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="javascript:void()">Muhammad Iqbal</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="{{ asset('assets/js/pages/datatables.js') }}"></script>
<script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
<script src="{{ asset('assets/js/pages/form-element-select.js') }}"></script>
<script src="{{ asset('assets/extensions/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/ui-chartjs.js') }}"></script>
<script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/extensions/parsleyjs/parsley.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/parsley.js') }}"></script>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.13.4/dataRender/datetime.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js' type='text/javascript'></script>

<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css"></script>

@stack('scripts')
@yield('grafik')

</body>
</html>
