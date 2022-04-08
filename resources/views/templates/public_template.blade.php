<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('tittle') - BPHTB Online {{ session()->get('datasatker')->nama_satker }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('/upload/app/logos/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('lte/css/GoogleSansPro.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/toastr/toastr.css') }}">
</head>

<body class="hold-transition register-page" style="min-height: 100vh">



    <!-- Lokasi view blade -->
    @yield('container')
    <!-- .Lokasi view blade -->


    @yield('modal')

    <!-- jQuery 4.2.2 -->
    <script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/jquery/jquery.form.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/sweetalert.min.js') }}"></script>
    <!-- lte App -->
    <script src="{{ asset('lte/js/adminlte.min.js') }}"></script>

    @include('sweet::alert')
    @yield('script')
    @include('templates.toastMessage')


    @if (session::has('sukses'))
    <script>
        //Alert Sukses sweet alert!
        swal("sukses", "{!! Session::get('sukses') !!}", "success", {
            button: "OK",
        })
    </script>
    @endif
    @if (session::has('gagal'))
    <script>
        //Alert Gagal Toarts
        toastr.success("{!! Session::get('sukses') !!}");
    </script>
    @endif




</body>

</html>