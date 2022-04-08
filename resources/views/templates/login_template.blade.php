<html>

<head>
    <meta charset="utf-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title> @yield('tittle')</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('/upload/app/logos/logo.png')}}">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <link rel="stylesheet" href="{{asset('/lte/plugins/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('lte/css/adminlte.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>


<!-- <body class="hold-transition sidebar-mini sidebar-collapse"> -->

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class=" main-header navbar navbar-expand navbar-primary navbar-dark border-bottom-0">
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Menu Database -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-info-circle"></i>
                    </a>
                </li>
                <!-- .Menu Database -->
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper img-riple" class="img-fluid" alt="Responsive image">
            <!-- Main content -->
            <section class="content-header">
                <div class="container-fluid">
                    <!-- Your Page Content Here -->
                    @yield('container')
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->





    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="{{asset('lte/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('lte/js/adminlte.min.js')}}"></script>


    @yield('script')
</body>

</html>