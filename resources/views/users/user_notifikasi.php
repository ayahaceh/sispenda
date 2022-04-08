@extends('templates/main_template')
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

<!-- /.row -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title">
                    <i class="fas fa-user mr-2"></i> Pengaturan Notifikasi
                </h3>
            </div>
            <form action="{{ route('user.profilePasswordRequestStore')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body table-responsive p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row text-cyan">
                                <label for="" class="col-sm-3 col-form-label text-primary">Nama</label>
                                <div class="col-sm-9">
                                    <input name="nama" type="text" class="form-control" value="{{$users->nama}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row text-cyan">
                                <label for="" class="col-sm-3 col-form-label text-primary">Email</label>
                                <div class="col-sm-9">
                                    <input name="email" type="email" value="{{$users->email}}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group row text-cyan">
                                <p class="col-sm-9">
                                    Untuk melakukan ganti password, silahkan klik <b>"Kirim Permintaan"</b>!
                                    Link untuk melakukan ganti password dikirim ke email yang telah terdaftar
                                    tersebut.
                                </p>
                            </div>
                        </div>
                    </div>
                </div><!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary float-right">
                                <i class="fas fa-paper-plane mr-2"></i> Kirim Permintaan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div><!-- /.card -->
    </div>
</div>
<!-- /.row -->
@endSection