<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,300,400,500,700,900" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="{{ asset('/upload/app/logos/logo.png') }}">
    <title>BPHTB ONLINE - Kabupaten Aceh Singkil</title>
    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('/web/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/web/css/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/web/css/fullpage.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/web/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('/web/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('/web/css/templatemo-style.css') }}">
    <link rel="stylesheet" href="{{ asset('/web/css/responsive.css') }}">
</head>

<body>

    @yield('container')


    <script src="{{ asset('web/js/jquery.js') }}"></script>
    <script src="{{ asset('web/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('web/js/fullpage.min.js') }}"></script>
    <script src="{{ asset('web/js/scrolloverflow.js') }}"></script>
    <script src="{{ asset('web/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('web/js/jquery.inview.min.js') }}"></script>
    <script src="{{ asset('web/js/form.js') }}"></script>
    <script src="{{ asset('web/js/custom.js') }}"></script>
    @include('templates.toastMessage')
    @yield('script')



</body>

</html>