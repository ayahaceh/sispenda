<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title> @yield('tittle')</title>
    <link rel="shortcut icon" type="image/png" href="{{asset('/upload/app/logos/logo.PNG')}}">
    <link rel="stylesheet" href="{{asset('/lte/plugins/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('lte/login/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('lte/login/css/style.css')}}">
    <!-- <link rel="stylesheet" href="{{asset('lte/css/adminlte.min.css')}}"> -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('lte/plugins/toastr/toastr.css')}}">
    @yield('css')
</head>

<body class="bg-primary">
    <div class="container-fluid">
        <div class="row conya img-riple">
            <div class="col-lg-9 side-left">
                <div class="sid-layy">
                    <div class="slid-roo"><br /><br /><br /><br /><br />
                        <div class="box">
                            <div class="row">
                                <div class="col-md-2">
                                    <img class="logo" src="{{asset('/upload/app/logos/logo.PNG')}}" style="margin-bottom: 5px; width:auto; height:80px; margin-top:2px;">
                                </div>
                                <div class="col-md-10">
                                    <h5 class="text-left">@yield('satkera')
                                        <br />@yield('satkerb')
                                    </h5>
                                    <h2 class="text-left text-warning">PORTAL LAYANAN BPHTB ONLINE</h2>
                                </div>
                            </div>
                            <!-- <ul>
                                <li>Phone : +628 111 65 7788</li>
                                <li>Email : razali.kpu@gmail.com</li>
                            </ul> -->
                        </div>
                        <div class="row">
                            @yield('tabelspm')
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 side-right">
                @yield('container')
                <div class="copyco">
                    <p>Copyrigh 2021 | E-BPHTB - BPKK Aceh Singkil</p>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('lte/login/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('lte/plugins/jquery.ripples.js')}}"></script>
    <script src="{{asset('lte/login/js/popper.min.js')}}"></script>
    <script src="{{asset('lte/login/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('lte/login/js/script.js')}}"></script>
    <script src="{{asset('lte/plugins/toastr/toastr.min.js')}}"></script>
    <script>
        $('.img-riple').ripples({
            // Image Url
            imageUrl: null,
            // The width and height of the WebGL texture to render to.
            // The larger this value, the smoother the rendering and the slower the ripples will propagate.
            resolution: 256,
            // The size (in pixels) of the drop that results by clicking or moving the mouse over the canvas.
            dropRadius: 10, // dropRadius: 20,
            // Basically the amount of refraction caused by a ripple.
            // 0 means there is no refraction.
            perturbance: 0.004, // perturbance: 0.04,
            // Whether mouse clicks and mouse movement triggers the effect.
            interactive: true,
            // The crossOrigin attribute to use for the affected image.
            crossOrigin: ''
        });
    </script>
    @include('templates.toastMessage')
    @yield('script')
</body>

</html>