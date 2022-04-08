<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title> OM SP2D @yield('tittle') - {{session()->get('datasatker')->nama_satker}}</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('/upload/app/logos/logo.png')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('/lte/plugins/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('lte/css/GoogleSansPro.css')}}">
    <link rel="stylesheet" href="{{asset('lte/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('lte/plugins/toastr/toastr.css')}}">
</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
    <div class="wrapper">
        <!-- Navbar -->
        <!-- <nav class="main-header navbar navbar-expand navbar-white navbar-dark"> -->
        <nav class="main-header navbar navbar-expand navbar-dark bg-primary no-border">

            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <div class="nav-link">
                        <strong>{{ strtoupper(session()->get('datasatker')->nama_satker) }}</strong> |
                        ONLINE MONITORING SP2D
                    </div>
                </li>
            </ul>


            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Menu Download APK -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-cloud-download-alt"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header bg-primary">Download APK</span>
                        <div class="dropdown-divider"></div>
                        <a href="{{asset('upload/app/docs/Earsip.apk')}}" class="dropdown-item  text-primary">
                            <i class="fas fa-mobile-alt mr-2 text-primary"></i> Aplikasi Mobile
                            <span class="float-right text-muted  text-yellow text-sm">E-Arsip.apk</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{asset('upload/app/docs/Cara_Instal_Android.pdf')}}" class="dropdown-item  text-primary">
                            <i class="fas fa-file-pdf mr-2 text-primary"></i> Petunjuk Pemasangan
                        </a>
                        <!-- <a href="" class="dropdown-item dropdown-footer text-primary">Cara Install</a> -->
                    </div>
                </li>
                <!-- .Menu Download APK -->

                <!-- .Menu User -->
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="/upload/users/comp/{{ Auth()->user()->foto }}" class="user-image img-circle elevation-2" alt="User Image">
                        <span class="d-none d-md-inline"> {{ Auth()->user()->username }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-primary">
                            <img src="/upload/users/comp/{{ Auth()->user()->foto }}" class="img-circle elevation-2" alt="User Image">

                            <p>
                                {{ Auth()->user()->nama }}
                                <small> {{ Auth()->user()->email }}</small>
                            </p>
                        </li>

                        <!-- Menu Body -->
                        <li class="user-body">
                            <a href="{{route('user.profilePhoto')}}">
                                <i class="fas fa-file-image text-primary mr-2"></i> Ganti Foto
                            </a><br>
                            <a href="{{route('user.profile')}}">
                                <i class="fa fa-edit text-primary mr-2"></i> Edit Profil

                            </a><br>
                            <a href="{{route('user.profilePasswordRequest')}}">
                                <i class="fa fa-ellipsis-h text-primary mr-2"></i> Ubah Password
                            </a><br>
                            <a href="{{route('home')}}">
                                <i class="fa fa-bullseye text-primary mr-2"></i> Aktifitas saya
                            </a><br>
                            <hr>
                            <a href="{{ route('logout') }}" class="logout">
                                <i class="fas fa-sign-out-alt text-red mr-2 "></i> Keluar <i>(Sign Out)</i>
                            </a>
                            <hr>
                            <a href="{{asset('upload/app/docs/Bidang_Userguide.pdf')}}" target=_blank>
                                <i class="fa fa-question-circle text-primary mr-2"></i> Petunjuk Penggunaan
                            </a><br>
                            <a href="{{route('home')}}">
                                <i class="fa fa-envelope-square text-primary mr-2"></i> Hubungi Admin
                            </a><br>
                        </li>
                    </ul>
                </li>

            </ul>

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-warning bg-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{url('/')}}" class="brand-link bg-primary">
                <img src="/upload/app/logos/default.png" alt="E-Arsip Logo" class="brand-image elevation-4" style="opacity: .8">
                <span class="brand-text font-weight-dark">OMS </span>
            </a>

            <!-- Sidebar -->
            <!-- <div class="sidebar nav-child-indent">
                <nav class="mt-3">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                    </ul>
                </nav>
            </div> -->
            <!-- /.sidebar -->

        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h4 class="text-primary">@yield('tittle')</h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <span class="badge badge-primary">
                                    @yield('bread')
                                </span>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <section class="content">
                <div class="container-fluid">

                    @yield('container')

                </div><!-- /.container-fluid -->
            </section><!-- /.content -->

        </div><!-- /.content-wrapper -->

        <footer class="main-footer no-print">
            <div class="float-right d-none d-sm-block">
                <small><b>OMS </b>| Version 1.0.1</small>
            </div>
            <strong>Copyright &copy; 2021
                <a href="https://bpkk.acehsingkilkab.go.id" class="text-primary">
                    {{ session()->get('datasatker')->nama_satker }}
                </a>.
            </strong>
            All rights reserved.
        </footer>


    </div>
    <!-- ./wrapper -->

    <!-- jQuery 4.2.2 -->
    <script src="{{asset('lte/plugins/jquery/jquery.form.js')}}"></script>
    <script src="{{asset('lte/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('lte/plugins/sweetalert.min.js')}}"></script>
    <script src="{{asset('lte/plugins/toastr/toastr.min.js')}}"></script>

    <!-- lte App -->
    <script src="{{asset('lte/js/adminlte.min.js')}}"></script>

    @include('sweet::alert')
    @yield('script')
    @include('templates.toastMessage')

    <script>
        $(document).ready(function() {
            bsCustomFileInput.init();
        });

        $('body').on('click', '.logout', function(event) {
            event.preventDefault();
            event.stopImmediatePropagation();
            var me = $(this),
                url = me.attr('href');
            console.log(url);
            swal({
                title: "Apakah anda ingin logout ?",
                text: "Anda dapat login kembali untuk melanjutkan aktivitas",
                icon: "warning",
                buttons: true
            }).then((willDelete) => {
                if (willDelete) {
                    window.location = url;
                    // $('#logout-form').submit();
                    // document.getElementById('logout-form').submit();
                } else {
                    swal("Cancel", "Anda belum logout ", "error");
                }
            })
        });

        function previewImg() {
            const berkas = document.querySelector('#berkas');
            const berkaslabel = document.querySelector('.custom-file-label');
            const imgPreview = document.querySelector('.img-preview');
            berkaslabel.textContent = berkas.files[0].name;

            const fileberkas = new FileReader();
            fileberkas.readAsDataURL(berkas.files[0]);
            fileberkas.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }

        $(function() {
            //Enable check and uncheck all functionality
            $('.checkbox-toggle').click(function() {
                var clicks = $(this).data('clicks')
                if (clicks) {
                    //Uncheck all checkboxes
                    $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
                    $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
                } else {
                    //Check all checkboxes
                    $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
                    $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
                }
                $(this).data('clicks', !clicks)
            })
        })
    </script>

    @if(session::has('sukses'))
    <script>
        //Alert Sukses sweet alert!
        swal("sukses", "{!! Session::get('sukses') !!}", "success", {
            button: "OK",
        })
    </script>
    @endif
    @if(session::has('gagal'))
    <script>
        //Alert Gagal Toarts
        toastr.success("{!! Session::get('sukses') !!}");
    </script>
    @endif

</body>

</html>