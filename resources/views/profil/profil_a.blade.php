@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-default">
            <div class="card-header bg-light">
                <h3 class="card-title text-indigo"><i class="fas fa-chalkboard-teacher mr-2"></i> Tambah Profil Wajib Pajak Baru</h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm">
                        <li class="page-item">
                            <a href="{{ route('profil.user') }}" class="page-link text-indigo">
                                <i class="fas fa-angle-double-left text-indigo mr-2"></i>
                                Kembali
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <form action="{{ route('profil.user.simpan') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <p class="text-muted">
                            Isilah formulir pendaftaran Profil dibawah ini dengan menggunakan data yang benar
                            sesuai data kependudukan yang terdaftar pada Dinas Catatan Sipil.
                        </p>
                        <div class="col-md-6">
                            <div class="card-header bg-light p-2">
                                <h6 class="text-indigo"><i class="fas fa-user mr-2"></i> Data Diri Wajib Pajak</h6>
                            </div>
                            <br />
                            <div class="form-group row">
                                <label for="nama" maxlength="200" class="col-sm-3 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-9">
                                    <input name="nama" type="text" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Nama Lengkap sesuai KTP ..." required>
                                    @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nik" class="col-sm-3 col-form-label">NIK <small>(NIK KTP)</small></label>
                                <div class="col-sm-9">
                                    <input name="nik" type="text" maxlength="16" onkeypress="return hanyaAngka (event)" id="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}" placeholder="NIK KTP ..." required>
                                    @error('nik')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kk" class="col-sm-3 col-form-label">No. KK</label>
                                <div class="col-sm-9">
                                    <input name="kk" type="text" maxlength="16" onkeypress="return hanyaAngka (event)" id="kk" class="form-control @error('kk') is-invalid @enderror" value="{{ old('kk') }}" placeholder="No. Kartu Keluarga ...">
                                    @error('kk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jk" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-9">
                                    <select id="jk" name="jk" class="form-control" required>
                                        <option value="">Pilih</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-header bg-light p-2">
                                <h6 class="text-indigo"><i class="fas fa-map-marker-alt mr-2"></i>Tempat Tinggal Wajib Pajak</h6>
                            </div>
                            <br />
                            <h4 class="text-purple"></h4>
                            <div class="form-group row">
                                <label for="prov" class="col-sm-3 col-form-label">Provinsi</label>
                                <div class="col-sm-9">
                                    <select id="prov" name="kode_prov" onchange="UpdateKab()" class="form-control" required>
                                        <option value="">Pilih Provinsi</option>
                                        @foreach($dataProv as $dProv)
                                        <option value="{{$dProv->kode_prov}}">{{$dProv->nama_prov}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kode_kab" class="col-sm-3 col-form-label">Kabupaten</label>
                                <div class="col-sm-9">
                                    <select id="kab" name="kode_kab" onchange="UpdateKec()" class="form-control" disabled required>
                                        <option value="">Pilih Kabupaten</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kode_kec" class="col-sm-3 col-form-label">Kecamatan</label>
                                <div class="col-sm-9">
                                    <select id="kec" name="kode_kec" onchange="UpdateDesa()" class="form-control" disabled required>
                                        <option value="">Pilih Kecamatan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kode_desa" class="col-sm-3 col-form-label">Desa</label>
                                <div class="col-sm-9">
                                    <select id="desa" name="kode_desa" class="form-control" disabled required>
                                        <option value="">Pilih Desa</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="rtrw" class="col-sm-3 col-form-label">RT / RW </label>
                                <div class="col-sm-9">
                                    <input name="rtrw" type="text" id="rtrw" maxlength="10" class="form-control @error('rtrw') is-invalid @enderror" value="{{ old('rtrw') }}" placeholder="rtrw ..." required>
                                    @error('rtrw')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="alamat" class="col-sm-3 col-form-label">alamat</label>
                                <div class="col-sm-9">
                                    <textarea name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="alamat ..." required></textarea>
                                    @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kode_pos" class="col-sm-3 col-form-label">Kode Pos</label>
                                <div class="col-sm-9">
                                    <input name="kode_pos" type="text" maxlength="6" onkeypress="return hanyaAngka (event)" id="kode_pos" class="form-control @error('kode_pos') is-invalid @enderror" value="{{ old('kode_pos') }}" placeholder="Kode Pos ...">
                                    @error('kode_pos')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="card-header bg-light disabled p-2">
                                <h6 class="text-indigo"><i class="fas fa-mobile-alt mr-2"></i> Kontak Wajib Pajak</h6>
                            </div>
                            <br />
                            <div class="form-group row">
                                <label for="hp" class="col-sm-3 col-form-label">Handphone</label>
                                <div class="col-sm-9">
                                    <input name="hp" type="text" id="hp" maxlength="15" onkeypress="return hanyaAngka (event)" class="form-control @error('hp') is-invalid @enderror" value="{{ old('hp') }}" placeholder="08..." required>
                                    @error('hp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="wa" class="col-sm-3 col-form-label">WhatsApp</label>
                                <div class="col-sm-9">
                                    <input name="wa" type="text" id="wa" maxlength="15" onkeypress="return hanyaAngka (event)" class="form-control @error('wa') is-invalid @enderror" value="{{ old('wa') }}" placeholder="08 (boleh dikosongkan) ">
                                    @error('wa')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tg" class="col-sm-3 col-form-label">Telegram</label>
                                <div class="col-sm-9">
                                    <input name="tg" type="text" id="tg" maxlength="12" onkeypress="return hanyaAngka (event)" class="form-control @error('tg') is-invalid @enderror" value="{{ old('tg') }}" placeholder="ID Telegram (boleh dikosongkan) ">
                                    @error('tg')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input name="email" type="email" id="email" maxlength="50" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="contoh:  razali@gmail.com">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header bg-light p-2">
                                    <h6 class="text-indigo"><i class="fas fa-cloud-upload-alt mr-2"></i> Unggah Foto Wajah</h6>
                                </div>

                                <div class="card-body" style="background-color: #F3F4F6">
                                    <div class="row">
                                        <div class="col-md-4 d-md-flex justify-content-center align-items-center">
                                            <img src="" alt="" class="img-fluid img-thumbnail mb-3 mb-md-0 d-none" width="128" id="berkas_fotoP">
                                            <div class="border py-3 px-4 rounded-lg bg-white mb-3 mb-md-0 d-none" id="berkas_fotoCard" style="width: fit-content;">
                                                <div class="d-flex justify-content-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-indigo" fill="#6610f2" viewBox="0 0 24 24" stroke="currentColor" style="width: 35px;">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                                <span class="text-center">File Gambar</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label for="berkas_foto">Upload Foto Wajah</label>
                                                <div class="custom-file">
                                                    <input type="file" name="berkas_foto" class="custom-file-input @error('berkas_foto') is-invalid @enderror" id="berkas_foto" onchange="loadPreview(this);" class="form-control">
                                                    <label class="custom-file-label" for="berkas_foto">Pilih Foto Maksimal 1
                                                        MB...</label>
                                                    @error('berkas_foto')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <label for="berkas_ktp">Upload Foto KTP</label>
                                                <div class="custom-file">
                                                    <input type="file" name="berkas_ktp" class="custom-file-input @error('berkas_ktp') is-invalid @enderror" id="berkas_ktp" class="form-control">
                                                    <label class="custom-file-label" for="berkas_ktp">Pilih Foto KTP Maksimal 5
                                                        MB...</label>
                                                    @error('berkas_ktp')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <label for="berkas_kk">Upload Foto Kartu Keluarga </label>
                                                <div class="custom-file">
                                                    <input type="file" name="berkas_kk" class="custom-file-input @error('berkas_kk') is-invalid @enderror" id="berkas_kk" class="form-control">
                                                    <label class="custom-file-label" for="berkas_kk">Pilih foto Kartu Keluarga Maksimal 5
                                                        MB</label>
                                                    @error('berkas_kk')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
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

                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-block bg-indigo">
                                <i class="fas fa-save mr-2"></i> Simpan
                            </button>
                            <br />
                        </div>

                        <div class="col-md-3">
                            <a href="{{ route('user') }}" class="btn btn-block btn-warning">
                                <i class="fas fa-undo-alt mr-2"></i> Batal
                            </a>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>


</div>

@endSection

@section('script')
<script>
    function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;
        return true;
    }

    function UpdateKab() {
        let provinsi = $("#prov").val()
        $("#kab").children().remove()
        $("#kab").val('');
        $("#kab").append('<option value="">Pilih Kabupaten</option>');
        $("#kab").prop('disabled', true)
        UpdateKec()
        UpdateDesa()
        if (provinsi != '' && provinsi != null) {
            $.ajax({
                url: "{{url('')}}/alamat/pilih/kab/" + provinsi,
                success: function(res) {
                    $("#kab").prop('disabled', false)
                    $.each(res, function(index, element) {
                        $("#kab").append('<option value=' + element.kode_kab + '>' + element.nama_kab + '</option>');
                    })
                }
            });
        }
    }

    function UpdateKec() {
        let kabupaten = $("#kab").val()
        $("#kec").children().remove()
        $("#kec").val('');
        $("#kec").append('<option value="">Pilih Kecamatan</option>');
        $("#kec").prop('disabled', true)
        UpdateDesa()
        if (kabupaten != '' && kabupaten != null) {
            $.ajax({
                url: "{{url('')}}/alamat/pilih/kec/" + kabupaten,
                success: function(res) {
                    $("#kec").prop('disabled', false)
                    $.each(res, function(index, element) {
                        $("#kec").append('<option value=' + element.kode_kec + '>' + element.nama_kec + '</option>');
                    })
                }
            });
        }
    }

    function UpdateDesa() {
        let kecamatan = $("#kec").val()
        $("#desa").children().remove()
        $("#desa").val('');
        $("#desa").append('<option value="">Pilih Desa</option>');
        $("#desa").prop('disabled', true)

        if (kecamatan != '' && kecamatan != null) {
            $.ajax({
                url: "{{url('')}}/alamat/pilih/desa/" + kecamatan,
                success: function(res) {
                    $("#desa").prop('disabled', false)
                    $.each(res, function(index, element) {
                        $("#desa").append('<option value=' + element.kode_desa + '>' + element.nama_desa + '</option>');
                    })
                }
            });
        }
    }
</script>

<script>
    // disable form's submit button after clicking on submit
    $(document).on('submit', 'form', function() {
        $('button').attr('disabled', 'disabled');
    });
    $(document).ready(function() {
        $('#email').on({
            keydown: function(e) {
                if (e.which === 32) return false
            },
            keyup: function() {
                this.value = this.value.toLowerCase();
            },
            change: function() {
                this.value = this.value.replace(/\s/g, "");
            }
        });

    });

    function loadPreview(input, id) {
        id = id || '#preview_img';
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $(id)
                    .attr('src', e.target.result)
                    .width(160)
                    .height(160);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection