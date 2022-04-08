<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title> @yield('tittle') - {{session()->get('datasatker')->nama_satker}}</title>

    <link rel="shortcut icon" type="image/png" href="{{asset('/upload/app/logos/logo.png')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('/lte/plugins/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{asset('lte/css/adminlte.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('lte/plugins/animate.css')}}">
    <style>
        .navbar .nav-link {
            color: #fff !important;
        }
    </style>

    @yield('css')

</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
    <div class="wrapper">

        <!-- Content Wrapper. Contains page content -->
        {{-- <div class="content-wrapper"> --}}

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4 class="text-primary">
                            <a href="{{url('/')}}">BPKK ACEH SINGKIL</a>
                        </h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <span class="badge badge-info">
                                <a href="{{route('display.status')}}" class="text-white">
                                    @yield('bread')
                                </a>
                            </span>
                            <span>
                                <a href="#!" class="toggle-expand-btn btn bg-yellow btn-sm" onclick="javascript:toggleFullScreen()">
                                    <i class="fa fa-expand"></i>
                                </a>
                            </span>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid" id="contentFull">
                <!-- <div class="row"> -->
                @yield('container')
                <!-- </div> -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        {{-- </div> --}}
        <!-- /.content-wrapper -->

        <footer class="main-footer no-print">
            <div class="float-right d-none d-sm-block">
                <small><b>SIPS </b>| Version 1.0.1</small>
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

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    {{--
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script> 
    --}}

    <script src="{{asset('lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- // jQuery Auto Scroll -->
    {{-- <script src="{{asset('lte/js/jquery-scroll.js')}}"></script> --}}

    <!-- lte App -->
    <script src="{{asset('lte/js/adminlte.min.js')}}"></script>

    <script>
        $(".toggle-expand-btn").click(function(e) {
            $(this).closest('.box.box-warning').toggleClass('panel-fullscreen');
        });

        // toggle full screen
        var elem = document.getElementById("contentFull");

        function toggleFullScreen() {
            if (!elem.fullscreenElement && // alternative standard method
                !elem.mozFullScreenElement && !elem.webkitFullscreenElement) { // current working methods
                if (elem.requestFullscreen) {
                    elem.requestFullscreen();
                } else if (elem.mozRequestFullScreen) {
                    elem.mozRequestFullScreen();
                } else if (elem.webkitRequestFullscreen) {
                    elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                }
            } else {
                if (elem.cancelFullScreen) {
                    elem.cancelFullScreen();
                } else if (elem.mozCancelFullScreen) {
                    elem.mozCancelFullScreen();
                } else if (elem.webkitCancelFullScreen) {
                    elem.webkitCancelFullScreen();
                }
            }
        }
    </script>
    <script type="text/javascript">
        window.onload = function() {
            jam();
            // tambahan tanggal
            tanggal();
        }

        function jam() {
            var e = document.getElementById('jam'),
                d = new Date(),
                h, m, s;
            h = d.getHours();
            m = set(d.getMinutes());
            s = set(d.getSeconds());

            e.innerHTML = h + ':' + m + ':' + s;

            setTimeout('jam()', 1000);
        }

        function set(e) {
            e = e < 10 ? '0' + e : e;
            return e;
        }

        // Tambahan tanggal
        function tanggal() {
            var tgl = document.getElementById('tanggal')
            var hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            var bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            var tanggal = new Date().getDate();
            var xhari = new Date().getDay();
            var xbulan = new Date().getMonth();
            var xtahun = new Date().getYear();

            var hari = hari[xhari];
            var bulan = bulan[xbulan];
            var tahun = (xtahun < 1000) ? xtahun + 1900 : xtahun;
            tgl.innerHTML = hari + ', ' + tanggal + ' ' + bulan + ' ' + tahun;
            // document.write(hari + ', ' + tanggal + ' ' + bulan + ' ' + tahun);

        }
    </script>
    @yield('script')

</body>

</html>