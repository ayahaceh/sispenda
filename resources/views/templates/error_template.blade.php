<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title> @yield('tittle') - {{session()->get('datasatker')->nama_satker}}</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('/upload/app/logos/logo.png')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('/lte/plugins/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{asset('lte/plugins/toastr/toastr.css')}}">

    <link rel="stylesheet" href="{{asset('lte/css/adminlte.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- MDB -->
    <link rel="stylesheet" href="{{asset('lte/css/mdb.min.css')}}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>

    </style>
</head>

<body class="hold-transition lockscreen bg-teal">
    <div class="wrapper">

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-5 bg-teal">
                    <div class="col-sm-6">
                        <!-- <h4 class="text-primary">BPKK ACEH SINGKIL</h4> -->
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <!-- "@"yield('bread') -->
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid" id="contentFull">

                @yield('container')

            </div>
        </section>
        <!-- /.content -->




    </div>
    <!-- ./wrapper -->


    <!-- Bootstrap 4 -->
    <script src="{{asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- lte App -->
    <script src="{{asset('lte/plugins/sweetalert.min.js')}}"></script>
    <script src="{{asset('lte/plugins/toastr/toastr.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('lte/js/mdb.min.js')}}"></script>
    <script src="{{asset('lte/js/adminlte.min.js')}}"></script>

    @include('sweet::alert')
    @yield('script')
    @include('templates.toastMessage')

    @if(session::has('salah'))
    <script>
        //Alert Sukses sweet alert!
        swal("Gagal!", "{!! Session::get('salah') !!}", "error", {
            button: "OK",
        })
    </script>
    @endif
    @if(session::has('sukses'))
    <script>
        //Alert Gagal Toarts
        toastr.success("{!! Session::get('sukses') !!}");
    </script>
    @endif

    <script>

    </script>
</body>

</html>