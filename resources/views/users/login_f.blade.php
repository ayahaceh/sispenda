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
                <a href="{{route('web.public')}}" id="logo" title="E-BPHTB Singkil">
                    BPKK Aceh Singkil
                </a>

            </div>
        </div>
    </header>

    <video autoplay muted loop id="myVideo">
        <source src="{{ $dataAssets->file_video}}" type="video/mp4">
    </video>

    <div id="fullpage" class="fullpage-default">

        <div class="section animated-row" data-section="slide07">
            <div class="section-inner">
                <div class="row justify-content-center">
                    <div class="col-md-7 wide-col-laptop">
                        <div class="title-block animate" data-animate="fadeInUp">
                            <span>Layanan BPHTB Online</span>
                            <h2>LOGIN</h2>
                        </div>
                        <div class="contact-section">
                            <div class="row justify-content-center">
                                <div class="col-md-4 animate" data-animate="fadeInUp">
                                    <form action="{{route('login')}}" id="form-login" novalidate method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="input-field">
                                            <input type="text" class="form-control" name="username" id="name" required placeholder="Username">
                                        </div>
                                        <div class="input-field">
                                            <input type="password" class="form-control" name="password" id="password" required placeholder="password">
                                        </div>
                                        <div class="input-field">
                                            <div class="row justify-content-center">

                                                <div class="captcha">
                                                    <figure class="about-img animate" data-animate="pulse">
                                                        <span>{!! captcha_img() !!}</span>
                                                        <button class="scroll-down" id="refresh-captcha">
                                                            <i class="fa fa-refresh"></i>
                                                        </button>
                                                    </figure>
                                                    <!-- <br /> -->
                                                    <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha" required>
                                                </div>
                                            </div>

                                        </div>

                                        <button class="btn">Masuk</button>
                                    </form>

                                    <div id="form-messages" class="mt-3">
                                        @error('username')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        @error('captcha')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="social-icons">
        <div class="text-right">
            <ul class="social-icons">
                <li><a href="http://bpkk.acehsingkilkab.go.id" target="_blank" title="Homepage"><i class="fa fa-home"></i></a></li>
                <li><a href="http://bpkk.acehsingkilkab.go.id" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                <li><a href="http://bpkk.acehsingkilkab.go.id" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                <li><a href="http://bpkk.acehsingkilkab.go.id" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a></li>
            </ul>
        </div>
    </div>
</div>

@endSection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('.form-checkbox').click(function() {
            if ($(this).is(':checked')) {
                $('#password').attr('type', 'text');
            } else {
                $('#password').attr('type', 'password');
            }
        });
        $('#refresh-captcha').click(function(e) {
            e.preventDefault();
            
            $.ajax({
                type: "GET",
                url: "{{route('captcha.refresh')}}",
                success: function(data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });
    });
</script>
@endSection