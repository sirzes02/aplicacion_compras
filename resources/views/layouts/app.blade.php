<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Acreditacion USC</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('dist/img/AdminLTELogo.png') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('dist/css/adminlte.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div id="app">
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="material-icons">menu</i></a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="{{ url('/') }}" class="brand-link">
                    <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">App de compras</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="info">
                            <a href="#" class="d-block">
                                @guest
                                    <a class="nav-link mt-2" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    <a class="nav-link mt-2" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @else
                                    <h2><b>Welcome:</b></h2>
                                    <h3>{{ Auth::user()->name }}</h3>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <button class="btn btn-danger mt-4">Log out</button>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                @endguest
                            </a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        @guest
                        @else
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                data-accordion="false">
                                <li class="nav-item">
                                    <a href="/home"
                                        class="{{ Request::path() === '/home' ? 'nav-link active' : 'nav-link' }}">
                                        <i class="material-icons mr-2">home</i>
                                        <p>Home</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/car"
                                        class="{{ Request::path() === '/car' ? 'nav-link active' : 'nav-link' }}">
                                        <i class="material-icons mr-2">add_shopping_cart</i>
                                        <p>Car</p>
                                    </a>
                                </li>
                                @can('admin')
                                    <li class="nav-item">
                                        <a href="{{ url('/users') }}"
                                            class="{{ Request::path() === 'users' ? 'nav-link active' : 'nav-link' }}">
                                            <i class="material-icons mr-2">people</i>
                                            <p>
                                                Users
                                                <?php $users_count = DB::table('users')->count(); ?>
                                                <span class="right badge badge-danger">{{ $users_count ?? '0' }}</span>
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/roles') }}"
                                            class="{{ Request::path() === 'roles' ? 'nav-link active' : 'nav-link' }}">
                                            <i class="material-icons mr-2">collections_bookmark</i>
                                            <p>Roles</p>
                                            <?php $users_count = DB::table('roles')->count(); ?>
                                            <span class="right badge badge-danger">{{ $users_count ?? '0' }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/products') }}"
                                            class="{{ Request::path() === 'products' ? 'nav-link active' : 'nav-link' }}">
                                            <i class="material-icons mr-2">people</i>
                                            <p>
                                                Products
                                                <?php $users_count = DB::table('users')->count(); ?>
                                                <span class="right badge badge-danger">{{ $users_count ?? '0' }}</span>
                                            </p>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        @endguest
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Main content -->
                <section class="content">
                    @yield('content')
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <!-- NO QUITAR -->
                <div class="float-right d-none d-sm-inline-block">
                    Santiago Varela Mejía
                </div>
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    </script>
    @yield('scripts')
</body>

</html>
