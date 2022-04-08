@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

    @include('dashboard.panel.panel_wp')

    @if ($data !== null)

        @if ($data->status_profil == STATUS_PROFIL_VALID)
            <div class="alert alert-warning">
                Jika mengedit profil, maka Anda harus menunggu admin untuk memverifikasi semua data Anda kembali!
            </div>
        @endif

        <div class="row pb-4">
            <div class="col-md-6">
                <div class="card bg-light">
                    <h6 class="card-header text-indigo">
                        <i class="fas fa-user mr-2"></i> Data Diri
                        <span class="badge bg-indigo float-right">
                            <a href="#" class="text-dark" data-toggle="modal" data-target="#dataDiri">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                        </span>
                    </h6>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="nama" maxlength="200" class="col-sm-3 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input name="nama" type="text" class="form-control" value="{{ $data->nama }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nik" class="col-sm-3 col-form-label">NIK <small>(NIK KTP)</small></label>
                            <div class="col-sm-9">
                                <input name="nik" type="text" class="form-control" value="{{ $data->nik }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kk" class="col-sm-3 col-form-label">No. KK</label>
                            <div class="col-sm-9">
                                <input name="kk" type="text" class="form-control" value="{{ $data->kk }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jk" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9">
                                <input name="jk" type="text" class="form-control" value="{{ $data->jk }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card bg-light">
                    <h6 class="card-header text-indigo">
                        <i class="fas fa-map-marker-alt mr-2"></i>
                        Tempat Tinggal
                        <span class="badge bg-indigo float-right">
                            <a href="{{ route('profil.user.edit', $data->id) }}" class="text-dark"
                                data-toggle="modal" data-target="#tempatTinggal">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                        </span>
                    </h6>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="prov" class="col-sm-3 col-form-label">Provinsi</label>
                            <div class="col-sm-9">
                                <input name="prov" type="text" class="form-control"
                                    value="{{ $data->joinProv->nama_prov }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kode_kab" class="col-sm-3 col-form-label">Kabupaten</label>
                            <div class="col-sm-9">
                                <input name="kab" type="text" class="form-control"
                                    value="{{ $data->joinKab->nama_kab }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kode_kec" class="col-sm-3 col-form-label">Kecamatan</label>
                            <div class="col-sm-9">
                                <input name="kec" type="text" class="form-control"
                                    value="{{ $data->joinKec->nama_kec }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kode_desa" class="col-sm-3 col-form-label">Desa</label>
                            <div class="col-sm-9">
                                <input name="desa" type="text" class="form-control"
                                    value="{{ $data->joinDesa->nama_desa }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rtrw" class="col-sm-3 col-form-label">RT / RW </label>
                            <div class="col-sm-9">
                                <input name="rtrw" type="text" class="form-control" value="{{ $data->rtrw }}" disabled>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <textarea name="alamat" class="form-control" disabled>{{ $data->alamat }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kode_pos" class="col-sm-3 col-form-label">Kode Pos</label>
                            <div class="col-sm-9">
                                <input name="kode_pos" type="text" class="form-control" value="{{ $data->kode_pos }}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card bg-light">
                    <h6 class="card-header text-indigo">
                        <i class="fas fa-mobile-alt mr-2"></i>
                        Kontak
                        <span class="badge bg-indigo float-right">
                            <a href="{{ route('profil.user.edit', $data->id) }}" class="text-dark"
                                data-toggle="modal" data-target="#kontak">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                        </span>
                    </h6>

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="hp" class="col-sm-3 col-form-label">Handphone</label>
                            <div class="col-sm-9">
                                <input name="hp" type="text" class="form-control" value="{{ $data->hp }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="wa" class="col-sm-3 col-form-label">WhatsApp</label>
                            <div class="col-sm-9">
                                <input name="wa" type="text" class="form-control" value="{{ $data->wa }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tg" class="col-sm-3 col-form-label">Telegram</label>
                            <div class="col-sm-9">
                                <input name="tg" type="text" class="form-control" value="{{ $data->tg }}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input name="email" type="text" class="form-control" value="{{ $data->email }}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card bg-light">
                    <h6 class="card-header text-indigo">
                        <i class="fas fa-cloud-upload-alt mr-2"></i>
                        Berkas Identitas
                        <span class="badge bg-indigo float-right">
                            <a href="{{ route('profil.user.edit', $data->id) }}" class="text-dark"
                                data-toggle="modal" data-target="#berkasIdentitas">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                        </span>
                    </h6>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <img id="" src="{{ $data->file_foto }}" style="margin-bottom: 15px"
                                    class="img-thumbnail" width="160" height="160" />
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <p class="text-indigo">Unduh Berkas :</p>
                                    <a href="{{ $data->file_foto }}" target="_blank"
                                        class="btn btn-xs btn-default text-indigo"><i class="fa fa-paperclip mr-2"></i> Foto
                                        Wajah</a>
                                    <a href="{{ $data->file_ktp }}" target="_blank"
                                        class="btn btn-xs btn-default text-indigo"><i class="fa fa-paperclip mr-2"></i>
                                        Berkas
                                        KTP</a>
                                    <a href="{{ $data->file_kk }}" target="_blank"
                                        class="btn btn-xs btn-default text-indigo"><i class="fa fa-paperclip mr-2"></i>
                                        Berkas
                                        KK</a>
                                    <p class="mt-3">Status Profil: <span
                                            class="badge badge-{{ $warna }}">{{ $data->status_profil }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div> <!-- .row -->
                </div>
            </div>
        </div>

        @include('profil.modal_data_diri')

        @include('profil.modal_tempat_tinggal')

        @include('profil.modal_kontak')

        @include('profil.modal_berkas_identitas')
    @else
        <p class="text-center my-4">User profil tidak ditemukan</p>
    @endif



@endSection

@if ($data !== null)
    @section('script')
        <script>
            $(document).ready(function() {
                UpdateKab();
                UpdateKec();
                UpdateDesa();
            });

            function loadPreview(input, id) {
                id = id || '#preview_img';
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $(id)
                            .attr('src', e.target.result)
                            .width(128)
                            .height(128);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }

            function UpdateKab() {
                let provinsi = $('#provinsi option:selected').val();
                if (provinsi != '' && provinsi != null) {
                    $.ajax({
                        url: "{{ url('') }}/alamat/pilih/kab/" + provinsi,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#kabupaten').empty();
                                $('#kabupaten').append('<option value=""> Pilih </option>');
                                $.each(data, function(key, value) {
                                    let dataKab = '{{ $data->kode_kab }}';
                                    if (dataKab == value.kode_kab) {
                                        $('#kabupaten').append('<option value="' + value.kode_kab +
                                            '" selected>' + value.nama_kab + '</option>');
                                        $("#kabupaten").val(value.kode_kab).change();
                                    } else {
                                        $('#kabupaten').append('<option value="' + value.kode_kab + '">' +
                                            value.nama_kab + '</option>');
                                    }
                                });
                            } else {
                                $('#kabupaten').empty();
                            }
                        }
                    });
                }
            }

            function UpdateKec() {
                let kabupaten = $('#kabupaten option:selected').val();
                if (kabupaten != '' && kabupaten != null) {
                    $.ajax({
                        url: "{{ url('') }}/alamat/pilih/kec/" + kabupaten,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#kecamatan').empty();
                                $('#kecamatan').append('<option value=""> Pilih </option>');
                                $.each(data, function(key, value) {
                                    let dataKec = '{{ $data->kode_kec }}';
                                    if (dataKec == value.kode_kec) {
                                        $('#kecamatan').append('<option value="' + value.kode_kec +
                                            '" selected>' + value.nama_kec + '</option>');
                                        $("#kecamatan").val(value.kode_kec).change();
                                    } else {
                                        $('#kecamatan').append('<option value="' + value.kode_kec + '">' +
                                            value.nama_kec + '</option>');
                                    }
                                });
                            } else {
                                $('#kecamatan').empty();
                            }
                        }
                    });
                }
            }

            function UpdateDesa() {
                let kecamatan = $('#kecamatan option:selected').val();
                if (kecamatan != '' && kecamatan != null) {
                    $.ajax({
                        url: "{{ url('') }}/alamat/pilih/desa/" + kecamatan,
                        type: "GET",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('#desa').empty();
                                $('#desa').append('<option value=""> Pilih </option>');
                                $.each(data, function(key, value) {
                                    let dataDesa = '{{ $data->kode_desa }}';
                                    if (dataDesa == value.kode_desa) {
                                        $('#desa').append('<option value="' + value.kode_desa +
                                            '" selected>' + value.nama_desa + '</option>');
                                        $("#desa").val(value.kode_desa).change();
                                    } else {
                                        $('#desa').append('<option value="' + value.kode_desa + '">' + value
                                            .nama_desa + '</option>');
                                    }
                                });
                            } else {
                                $('#desa').empty();
                            }
                        }
                    });
                }
            }
        </script>
    @endsection
@endif