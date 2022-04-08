@extends('templates.web_template')
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

<div id="video">
    <div class="preloader">
        <div class="preloader-bounce">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>

    <header id="header">
        <div class="container-fluid">
            <div class="navbar">
                <a href="{{ route('web.public') }}" id="logo" title="E-BPHTB Singkil">
                    <!-- <img src="images/e-bphtb-icon-3.png" alt="Alidata" height="30"> -->
                    BPHTB ONLINE
                </a>
                <div class="navigation-row">
                    <nav id="navigation">
                        <button type="button" class="navbar-toggle"> <i class="fa fa-bars"></i> </button>
                        <div class="nav-box navbar-collapse">
                            <ul class="navigation-menu nav navbar-nav navbars" id="nav">
                                <li data-menuanchor="slide01" class="active"><a href="#slide01">Home</a></li>
                                <li data-menuanchor="slide02"><a href="#slide02">Tentang E-BPHTB</a></li>
                                <li data-menuanchor="slide03"><a href="#slide03">Alur Sistem</a></li>
                                <li data-menuanchor="slide04"><a href="#slide04">Peraturan</a></li>
                                <li data-menuanchor="slide05"><a href="#slide05">Kanal Pembayaran</a></li>
                                <li data-menuanchor="slide06"><a href="#slide06">Profil</a></li>
                                <li data-menuanchor="slide07"><a href="#slide07">Hubungi Kami</a></li>
                                <li data-menuanchor="slide08"><a href="{{ route('register') }}">Daftar</a></li>
                                <li data-menuanchor="slide08"><a href="{{ route('login') }}">Masuk</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <video autoplay muted loop id="myVideo">
        <source src="{{ $dataAssets->file_video }}" type="video/mp4">
    </video>

    <div id="fullpage" class="fullpage-default">

        @include('web.slide.slide_1')
        @include('web.slide.slide_2')
        @include('web.slide.slide_3')
        @include('web.slide.slide_4')
        {{-- @include('web.slide.slide_5') --}} <!-- Tidak perlu  -->
        @include('web.slide.slide_6')
        @include('web.slide.slide_7')


    </div>

    <div id="social-icons">
        <div class="text-right">
            <ul class="social-icons">
                <li><a href="{{route('web.public')}}" target="_blank" title="Homepage BPHTB"><i class="fa fa-home"></i></a></li>
                <li><a href="http://bpkk.acehsingkilkab.go.id" target="_blank" title="Homepage BPKK Singkil"><i class="fa fa-globe"></i></a></li>
                <li><a href="{{route('contactAdminPublic')}}" target="_blank" title="Layanan Chat BPHTB"><i class="fa fa-whatsapp"></i></a></li>
                <!-- <li><a href="http://bpkk.acehsingkilkab.go.id" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a></li> -->
            </ul>
        </div>
    </div>
</div>

@endSection