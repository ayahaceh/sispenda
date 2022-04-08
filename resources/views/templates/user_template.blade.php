<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('tittle') - BPHTB ONLINE {{ session()->get('datasatker')->nama_satker }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('/upload/app/logos/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('lte/css/GoogleSansPro.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/toastr/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/toastr/toastr.css') }}">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand-md navbar-dark navbar-indigo border-bottom-0">
            <div class="container">
                <a href="{{ url('/home') }}" class="navbar-brand">
                    <img src="/upload/app/logos/default.png" alt="BPHTB ONLINE" class="brand-image elevation-0"
                        style="opacity: .9">
                    <span class="brand-text font-weight-dark"> BPHTB Online</span>
                </a>

                <ul class="navbar-nav navbar-no-expand ml-auto">

                    @if (Auth()->user()->user_group == USER_PPAT)
                        @include('templates.menu.menu_ppat')
                    @elseif(Auth()->user()->user_group == USER_BPN)
                        @include('templates.menu.menu_bpn')
                    @endif

                    <!-- .Menu User -->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            <img src="/upload/users/comp/{{ Auth()->user()->foto }}"
                                class="user-image img-circle elevation-2" alt="User Image">
                            <span class="d-none d-md-inline"> {{ Auth()->user()->username }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <!-- User image -->
                            <li class="user-header bg-indigo">
                                <img src="/upload/users/comp/{{ Auth()->user()->foto }}"
                                    class="img-circle elevation-2" alt="User Image">
                                <p>
                                    {{ Auth()->user()->nama }}
                                    <small> {{ Auth()->user()->email }}</small>
                                </p>
                            </li>

                            <!-- Menu Body -->
                            <li class="user-body">
                                <a href="{{ route('my-account.photo') }}" class="dropdown-item">
                                    <i class="fas fa-file-image text-indigo mr-2"></i>Ganti Foto
                                </a>

                                <a href="{{ route('my-account') }}" class="dropdown-item">
                                    <i class="fa fa-edit text-indigo mr-2"></i> Edit Profil
                                </a>
                                <a href="{{ route('my-account.pass') }}" class="dropdown-item">
                                    <i class="fa fa-ellipsis-h text-indigo mr-2"></i> Ubah Password
                                </a>

                                <a href="{{ route('my.logs') }}" class="dropdown-item">
                                    <i class="fa fa-bullseye text-indigo mr-2"></i> Aktifitas saya
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('logout') }}" class="logout dropdown-item">
                                    <i class="fas fa-sign-out-alt text-red mr-2 "></i> Keluar <i>(Sign Out)</i>
                                </a>
                                <div class="dropdown-divider"></div>
                                {{-- <a href="{{ route('help.userguide') }}" target="_blank" class="dropdown-item">
                                <i class="fa fa-question-circle text-indigo mr-2"></i> Petunjuk Penggunaan
                                </a> --}}
                                <a href="{{ route('contactAdmin') }}" class="dropdown-item">
                                    <i class="fa fa-envelope-square text-indigo mr-2"></i> Hubungi Admin
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>
        <!-- /.navbar -->




        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-indigo"> @yield('tittle') </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6 mt-2 mt-md-0">
                            <ol class="breadcrumb float-sm-right">
                                <span class="badge bg-indigo">
                                    @yield('bread')
                                </span>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">

                    @yield('container')

                </div>
            </div>

        </div>




        <!-- Main Footer -->
        <footer class="main-footer d-print-none">
            <!-- To the right -->
            <div class="float-right d-print-none d-sm-inline">
                <small><b> BPHTB ONLINE </b> | Aceh Singkil</small>
            </div>
            <strong class="d-print-none">Copyright &copy; 2021
                <a href="https://bpkk.acehsingkilkab.go.id" class="text-indigo">
                    {{ session()->get('datasatker')->nama_satker }}
                </a>.
            </strong>
            All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->



    <!-- REQUIRED SCRIPTS -->

    <script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/jquery/jquery.form.js') }}"></script>
    <script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/sweetalert.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('lte/js/adminlte.min.js') }}"></script>

    @include('templates.toastMessage')

    @yield('script')
</body>

</html>
