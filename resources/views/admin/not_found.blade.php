@extends('templates/error_template')
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

<div class="error-page">
    <h1 class="headline text-danger">404</h1> 
    <div class="error-content">
        <h2 class="mt-5 mb5">
            <i class="fas fa-times-circle text-danger"></i> 
            Oops! Kami tidak dapat menemukan data yang anda maksud!
        </h2>

        <p class="text-justify">
            <br />Kemungkinan data tersebut telah dihapus, atau anda salah memasukkan data. 
            Silahkan <a href="/home"><b class="text-primary">kembali ke dashboard</b></a>
            untuk melanjutkan pekerjaan. 
            atau <a href="/hub-admin"><b class="text-primary">Hubungi admin!</b></a>
            untuk melaporkan, jika ini adalah sebuah kesalahan sistem.
            <br /> <strong> Terimakasih!</strong>
        </p>

        <form class="search-form">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search">

                <div class="input-group-append">
                    <button type="submit" name="submit" class="btn bg-primary"><i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <!-- /.input-group -->
        </form>
    </div>
    
    <!-- /.error-content -->
</div>
<!-- /.error-page -->


@endSection