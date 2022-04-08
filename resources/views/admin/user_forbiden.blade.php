@extends('templates/user_template')
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

<div class="error-page">
    <h1 class="headline text-indigo">609</h1>

    <div class="error-content">
        <h3><i class="fas fa-exclamation-triangle text-indigo"></i> Oops! Anda tidak memiliki izin untuk mengakses halaman ini!</h3>
        <p>
            Silahkan <a href="/home"><b class="text-indigo">kembali ke dashboard</b></a>
            untuk melanjutkan pekerjaan.
        </p>

        <form class="search-form">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search">

                <div class="input-group-append">
                    <button type="submit" name="submit" class="btn bg-indigo"><i class="fas fa-search"></i>
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