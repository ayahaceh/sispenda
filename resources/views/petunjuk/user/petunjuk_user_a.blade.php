{{-- @extends(setTemplate()) --}}
@extends('templates.login_template')
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h4 class="card-tittle text-primary">
                    <i class="fas fa-question-circle"></i>
                    Petunjuk penambahan pengguna aplikasi!
                </h4>
            </div>

            <div class="card-body p-2">
                <div class="row">
                    <div class="col-md-6">
                        <div class="callout callout-info p-2">
                            <label class="text-primary">Username</label>
                            <p>
                                Kolom username harus berupa angka, huruf, atau gabungan angka dan huruf,
                                tanpa spasi, dan tidak melebihi 25 karakter.
                            </p>
                        </div>
                        <div class="callout callout-info p-2">
                            <label class="text-primary">Password</label>
                            <p>
                                Secara default, password pengguna (user) SKPD adalah
                                " <strong>garuda</strong> "
                                huruf kecil semua, tanpa tanda kutip.
                                <br />
                                Sedangkan untuk pengguna (user) BPKK, password defaultnya adalah
                                " <strong>rahasia</strong> "
                                huruf kecil semua, tanpa tanda kutip.
                            </p>
                        </div>
                        <div class="callout callout-info p-2">
                            <label class="text-primary">Foto</label>
                            <p>
                                Foto hanya mendukung file gambar (image) berformat : JPG, JPEG, PNG, dan GIF.
                                Maksimal 2 MB / 2.000 KB
                            </p>
                        </div>
                        <div class="callout callout-info p-2">
                            <label class="text-primary">Email</label>
                            <p>
                                Email yang dimasukkan adalah email aktiv. Ini untuk memudahkan pengguna mengganti Password
                                dan tetap menjaga kerahasiaan password barunya.
                                <br />
                                Email ini juga berfungsi untuk dapat menerima pengiriman Notifikasi-notifikasi terkait data SPM/SP2D
                                yang dikirimkan oleh Aplikasi.
                            </p>
                        </div>

                        <div class="callout callout-info p-2">
                            <label class="text-primary">Foto</label>
                            <p>
                                Foto hanya mendukung file gambar (image) berformat : JPG, JPEG, PNG, dan GIF.
                                Maksimal 2 MB / 2.000 KB
                            </p>
                        </div>


                    </div>

                    <div class="col-md-6">

                    </div>

                </div>

            </div>
        </div><!-- /.card -->
    </div> <!-- /.col -->
</div><!-- /.row -->

@endSection