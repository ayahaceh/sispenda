@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

    <!-- /.row -->
    <div class="row d-flex justify-content-center">
        <div class="col-md-12 col-lg-6">
            <div class="card">
                <div class="card-header text-indigo">
                    <h3 class="card-title"><i class="fas fa-users mr-2"></i> Informasi Kantor</h3>

                    <div class="card-tools">
                        <a href="{{ route('setting.satkers.edit') }}" method="get" class="d-inline">
                            <button type="submit" class="btn btn-sm bg-indigo">
                                <i class="fas fa-edit mr-2"></i>Edit
                            </button>
                        </a>
                    </div>
                </div>

                <!-- /.card-header -->
                <div class="card-body text-indigo p-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-4">
                                <p><strong>Informasi / Identitas Kantor :</strong> </p>
                                <i class="mb-4">Data ini digunakan pada bagian KOP Lembar Tanda Terima dan Daftar
                                    Agenda SPM, <br>
                                    mengubah informasi ini akan ikut mengubah bentuk KOP Formulir/Lembar Tanda Terima</i>
                            </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-4 col-form-label">Nama Kantor </label>
                                <div class="col-sm-8">
                                    <div class="attachment-block clearfix">
                                        <div class="attachment-text">
                                            {{ $satkers->nama_satker }}
                                        </div>
                                    </div>
                                </div>
                                <label for="inputName" class="col-sm-4 col-form-label">Alamat / Telp</label>
                                <div class="col-sm-8">
                                    <div class="attachment-block clearfix">
                                        <div class="attachment-text">
                                            {{ $satkers->alamat_satker }}
                                        </div>
                                    </div>
                                </div>
                                <label for="inputName" class="col-sm-4 col-form-label">Nama Satker Baris
                                    1</label>
                                <div class="col-sm-8">
                                    <div class="attachment-block clearfix">
                                        <div class="attachment-text">
                                            {{ $satkers->nama_satkera }}
                                        </div>
                                    </div>
                                </div>
                                <label for="inputName" class="col-sm-4 col-form-label">Nama Satker Baris
                                    2</label>
                                <div class="col-sm-8">
                                    <div class="attachment-block clearfix">
                                        <div class="attachment-text">
                                            {{ $satkers->nama_satkerb }}
                                        </div>
                                    </div>
                                </div>
                                <label for="inputName" class="col-sm-4 col-form-label">Kab / Kota</label>
                                <div class="col-sm-8">
                                    <div class="attachment-block clearfix">
                                        <div class="attachment-text">
                                            {{ $satkers->kota_satker }}
                                        </div>
                                    </div>
                                </div>
                                <label for="inputName" class="col-sm-4 col-form-label">Provinsi</label>
                                <div class="col-sm-8">
                                    <div class="attachment-block clearfix">
                                        <div class="attachment-text">
                                            {{ $satkers->prov_satker }}
                                        </div>
                                    </div>
                                </div>
                                <label for="inputName" class="col-sm-4 col-form-label">Nomor Telpon</label>
                                <div class="col-sm-8">
                                    <div class="attachment-block clearfix">
                                        <div class="attachment-text">
                                            {{ $satkers->telp_satker }}
                                        </div>
                                    </div>
                                </div>
                                <label for="inputName" class="col-sm-4 col-form-label">Alamat Email </label>
                                <div class="col-sm-8">
                                    <div class="attachment-block clearfix">
                                        <div class="attachment-text">
                                            {{ $satkers->email_satker }}
                                        </div>
                                    </div>
                                </div>
                                <label for="inputName" class="col-sm-4 col-form-label">Keterangan</label>
                                <div class="col-sm-8">
                                    <div class="attachment-block clearfix">
                                        <div class="attachment-text">
                                            {{ $satkers->ket_satker }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <p class=mb-4"><strong>Informasi / Identitas Kepala :</strong> </p>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="isi_ringkas" class="col-form-label">Nama Kepala</label>
                                </div>

                                <div class="col-sm-8">
                                    <div class="attachment-block clearfix">
                                        <div class="attachment-text">
                                            {{ $satkers->nama_kepala }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="isi_ringkas" class="col-form-label">Nip Kepala</label>
                                </div>

                                <div class="col-sm-8">
                                    <div class="attachment-block clearfix">
                                        <div class="attachment-text">
                                            {{ $satkers->nip_kepala }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label for="isi_ringkas" class="col-form-label">Sebutan Jabatan</label>
                                </div>

                                <div class="col-sm-8">
                                    <div class="attachment-block clearfix">
                                        <div class="attachment-text">
                                            {{ $satkers->jab_kepala }}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <p class="mb-4"><strong>Logo Kantor :</strong> </p>
                                </div>

                                <div class="col-sm-8">
                                    <img class="img-fluid mb-3 img-thumbnail"
                                        src="{{ asset('/upload/app/logos/' . $satkers->logo_satker) }}" alt="logo">
                                </div>
                            </div>
                            <i class="mb-4">Silahkan klik Edit untuk mengubah logo/mengedit informasi kantor.</i>
                        </div>
                    </div>
                </div>

            </div> <!-- /.card -->
        </div><!-- /.col -->
    </div><!-- /.row -->




@endSection
