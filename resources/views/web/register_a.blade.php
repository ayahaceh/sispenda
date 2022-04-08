@extends('templates.public_template')
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')
<div class="col-12 col-md-10 col-lg-8 col-xl-6 my-5">
    <form id="formReg" action="{{ route('register.simpan') }}" method="POST" enctype="multipart/form-data">

        <div class="card" style="border-radius: 12px !important;">
            <div id="wizardContent">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3>
                                Daftar BPHTB Online
                            </h3>
                        </div>
                        <div>
                            <h6>
                                Step <span id="nowStep"></span> dari <span id="lengthStep"></span>
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert alert-success d-none" id="mVerified">
                        Data sudah terdaftar pada database, silahkan cek data Anda jika benar dan lanjutkan pendaftaran!
                    </div>
                    <div id="step1">
                        <div class="text-center mb-4">
                            <h3>Autentikasi</h3>
                            <div class="row d-flex justify-content-center">
                                <p class="col-12 col-md-6">
                                    Data ini akan digunakan pada form login. Harap mengingat username dan password
                                    Anda!
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">Alamat email</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" id="email" class="form-control" placeholder="example@gmail.com">
                                <div class="invalid-feedback" id="emailV"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" readonly>
                                <div class="invalid-feedback" id="usernameV"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" id="password" class="form-control" placeholder="*******">
                                <div class="invalid-feedback" id="passwordV"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password_confirmation" class="col-sm-3 col-form-label">Ulangi Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="*******">
                                <div class="invalid-feedback" id="password_confirmationV"></div>
                            </div>
                        </div>
                        <div class="alert alert-info mt-4">
                            Syarat mengisi formulir:
                            <ul>
                                <li>Alamat email harus aktif.</li>
                                <li>Username harus unik atau belum terdaftar.</li>
                                <li>Password minimal 8 karakter.</li>
                            </ul>
                        </div>
                    </div>
                    <div id="step2">
                        <div class="text-center mb-4">
                            <h3>Data Diri Wajib Pajak</h3>
                            <div class="row d-flex justify-content-center">
                                <p class="col-12 col-md-6">
                                    Harap isi data Anda sesuai data KTP atau Kartu Keluarga!
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input type="text" name="nama" id="nama" class="form-control" placeholder="Sesuai KTP">
                                <div class="invalid-feedback" id="namaV"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nik" class="col-sm-3 col-form-label">NIK</label>
                            <div class="col-sm-9">
                                <input type="text" name="nik" onkeypress="return hanyaAngka (event)" id="nik" class="form-control" placeholder="NIK sesuai KTP" maxlength="16">
                                <div class="invalid-feedback" id="nikV"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kk" class="col-sm-3 col-form-label">No. KK</label>
                            <div class="col-sm-9">
                                <input type="text" name="kk" onkeypress="return hanyaAngka (event)" id="kk" class="form-control" placeholder="No. Kartu Keluarga" maxlength="16">
                                <div class="invalid-feedback" id="kkV"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jk" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                            <div class="col-sm-9">
                                <div class="d-flex">
                                    <div class="form-check form-check-inline mr-4">
                                        <input class="form-check-input" type="radio" name="jk" id="jkl" value="Laki-laki" checked>
                                        <label class="form-check-label" for="jkl">Laki-laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jk" id="jkp" value="Perempuan">
                                        <label class="form-check-label" for="jkp">Perempuan</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-info mt-4">
                            Syarat mengisi formulir:
                            <ul>
                                <li>Nama lengkap sesuai KTP.</li>
                                <li>NIK sesuai KTP.</li>
                                <li>Nomor Kartu Keluarga.</li>
                            </ul>
                        </div>
                    </div>
                    <div id="step3">
                        <div class="text-center mb-4">
                            <h3>Kontak Wajib Pajak</h3>
                            <div class="row d-flex justify-content-center">
                                <p class="col-12 col-md-6">
                                    Harap lengkapi formulir dibawah!
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hp" class="col-sm-3 col-form-label">No. Telpon</label>
                            <div class="col-sm-9">
                                <input type="text" name="hp" id="hp" onkeypress="return hanyaAngka (event)" class="form-control" placeholder="08..." maxlength="16">
                                <div class="invalid-feedback" id="hpV"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="wa" class="col-sm-3 col-form-label">WhatsApp</label>
                            <div class="col-sm-9">
                                <input type="text" name="wa" id="wa" onkeypress="return hanyaAngka (event)" class="form-control" placeholder="08 (boleh dikosongkan)" maxlength="16">
                                <div class="invalid-feedback" id="waV"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tg" class="col-sm-3 col-form-label">Telegram</label>
                            <div class="col-sm-9">
                                <input type="text" name="tg" id="tg" onkeypress="return hanyaAngka (event)" class="form-control" placeholder="ID Telegram (boleh dikosongkan)" maxlength="16">
                                <div class="invalid-feedback" id="tgV"></div>
                            </div>
                        </div>
                        <div class="alert alert-info mt-4">
                            Syarat mengisi formulir:
                            <ul>
                                <li>Nomor Telpon harus aktif.</li>
                            </ul>
                        </div>
                    </div>
                    <div id="step4">
                        <div class="text-center mb-4">
                            <h3>Tempat Tinggal</h3>
                            <div class="row d-flex justify-content-center">
                                <p class="col-12 col-md-6">
                                    Data ini akan digunakan pada form login. Harap mengingat username dan password
                                    Anda!
                                </p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="prov" class="col-sm-3 col-form-label">Provinsi</label>
                            <div class="col-sm-9">
                                <select name="kode_prov" id="kode_prov" onchange="UpdateKab()" class="form-control">
                                    <option value="">Pilih Provinsi</option>
                                    @foreach ($dataProv as $dProv)
                                    <option value="{{ $dProv->kode_prov }}">{{ $dProv->nama_prov }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback" id="kode_provV"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kode_kab" class="col-sm-3 col-form-label">Kabupaten</label>
                            <div class="col-sm-9">
                                <select name="kode_kab" id="kode_kab" onchange="UpdateKec()" class="form-control" disabled>
                                    <option value="">Pilih Kabupaten</option>
                                </select>
                                <div class="invalid-feedback" id="kode_kabV"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kode_kec" class="col-sm-3 col-form-label">Kecamatan</label>
                            <div class="col-sm-9">
                                <select name="kode_kec" id="kode_kec" onchange="UpdateDesa()" class="form-control" disabled>
                                    <option value="">Pilih Kecamatan</option>
                                </select>
                                <div class="invalid-feedback" id="kode_kecV"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kode_desa" class="col-sm-3 col-form-label">Desa</label>
                            <div class="col-sm-9">
                                <select name="kode_desa" id="kode_desa" class="form-control" disabled>
                                    <option value="">Pilih Desa</option>
                                </select>
                                <div class="invalid-feedback" id="kode_desaV"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rtrw" class="col-sm-3 col-form-label">RT / RW </label>
                            <div class="col-sm-9">
                                <input type="text" name="rtrw" id="rtrw" class="form-control">
                                <div class="invalid-feedback" id="rtrwV"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <textarea name="alamat" id="alamat" class="form-control"></textarea>
                                <div class="invalid-feedback" id="alamatV"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="kode_pos" class="col-sm-3 col-form-label">Kode Pos</label>
                            <div class="col-sm-9">
                                <input type="text" name="kode_pos" maxlength="6" onkeypress="return hanyaAngka (event)" id="kode_pos" class="form-control">
                                <div class="invalid-feedback" id="kode_posV"></div>
                            </div>
                        </div>
                    </div>
                    <div id="step5">
                        <div class="text-center mb-4">
                            <h3>Unggah Berkas</h3>
                        </div>
                        <div class="form-group mb-4 rounded-lg px-md-2 px-4 py-4" style="background-color: #F3F4F6">
                            <div class="row">
                                <div class="col-md-3 d-md-flex justify-content-center align-items-center">
                                    <img src="" alt="" class="img-fluid img-thumbnail mb-3 mb-md-0 d-none" width="128" id="berkas_fotoP">
                                    <div class="border py-3 px-4 rounded-lg bg-white mb-3 mb-md-0 d-none" id="berkas_fotoCard" style="width: fit-content;">
                                        <div class="d-flex justify-content-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-indigo" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 35px;">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <span class="text-center">File Gambar</span>
                                    </div>
                                </div>
                                <div class="col-md-8 d-flex align-items-center">
                                    <div style="width: 100%">
                                        <label for="foto">Upload Foto Wajah</label>
                                        <div class="custom-file">
                                            <input type="file" name="berkas_foto" class="custom-file-input" id="berkas_foto" onchange="loadPreviewGambar(this, '#berkas_foto', '.custom-file-label-berkas_foto');">
                                            <label class="custom-file-label custom-file-label-berkas_foto" for="berkas_foto">
                                                Tidak file dipilih
                                            </label>
                                            <div class="invalid-feedback" id="berkas_fotoV"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-4 rounded-lg px-md-2 px-4 py-4" style="background-color: #F3F4F6">
                            <div class="row">
                                <div class="col-md-3 d-md-flex justify-content-center align-items-center">
                                    <img src="" alt="" class="img-fluid img-thumbnail mb-3 mb-md-0 d-none" width="128" id="berkas_ktpP">
                                    <div class="border py-3 px-4 rounded-lg bg-white mb-3 mb-md-0 d-none" id="berkas_ktpCard" style="width: fit-content;">
                                        <div class="d-flex justify-content-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-indigo" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 35px;">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <span class="text-center">File Gambar</span>
                                    </div>
                                </div>
                                <div class="col-md-8 d-flex align-items-center">
                                    <div style="width: 100%">
                                        <label for="berkas_ktp">Upload Foto KTP</label>
                                        <div class="custom-file">
                                            <input type="file" name="berkas_ktp" class="custom-file-input" id="berkas_ktp" onchange="loadPreviewGambar(this, '#berkas_ktp', '.custom-file-label-berkas_ktp');">
                                            <label class="custom-file-label custom-file-label-berkas_ktp" for="berkas_ktp">
                                                Tidak file dipilih
                                            </label>
                                            <div class="invalid-feedback" id="berkas_ktpV"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group rounded-lg px-md-2 px-4 py-4" style="background-color: #F3F4F6">
                            <div class="row">
                                <div class="col-md-3 d-md-flex justify-content-center align-items-center">
                                    <div class="border py-3 px-4 rounded-lg bg-white mb-3 mb-md-0 d-none" id="berkas_kkP" style="cursor: pointer; width: fit-content;" data-target="#openFileKK" data-toggle="modal">
                                        <div class="d-flex justify-content-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-indigo" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 35px;">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <span class="text-center">Buka File PDF</span>
                                    </div>
                                    <div class="border py-3 px-4 rounded-lg bg-white mb-3 mb-md-0 d-none" id="berkas_kkCard" style="width: fit-content;">
                                        <div class="d-flex justify-content-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-indigo" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 35px;">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <span class="text-center">File PDF</span>
                                    </div>
                                </div>
                                <div class="col-md-8 d-flex align-items-center">
                                    <div style="width: 100%">
                                        <label for="berkas_kk">Upload Foto KK</label>
                                        <div class="custom-file">
                                            <input type="file" name="berkas_kk" class="custom-file-input" id="berkas_kk" onchange="loadPreviewFile(this, '.custom-file-label-berkas_kk')">
                                            <label class="custom-file-label custom-file-label-berkas_kk" for="berkas_kk">
                                                Tidak file dipilih
                                            </label>
                                            <div class="invalid-feedback" id="berkas_kkV"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-info mt-4">
                            Syarat mengisi formulir:
                            <ul>
                                <li>Foto wajah ukuran maks. 1MB dan format harus png, jpg atau jpeg.</li>
                                <li>Foto KTP ukuran maks. 1MB dan format harus png, jpg atau jpeg.</li>
                                <li>Foto KK ukuran maks. 1MB dan format harus pdf.</li>
                            </ul>
                        </div>
                        <div class="my-4">
                            <div class="input-group">
                                <input type="text" name="captcha" id="captcha" onkeypress="return hanyaAngka(event)" class="form-control" placeholder="Masukkan hasil" required>
                                <div class="captcha">
                                    <span>{!! captcha_img() !!}</span>
                                    <button type="button" class="btn btn-info" class="refresh-captcha" id="refresh-captcha">
                                        &#x21bb;
                                    </button>
                                </div>
                            </div>
                            <div class="mt-1">
                                <p class="text-danger d-none" id="captchaV">
                                    Captcha tidak valid!
                                </p>
                            </div>
                        </div>
                        <div class="icheck-indigo">
                            <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                            <label for="agreeTerms" style="font-weight: 500">
                                <span class="ml-2">
                                    Segala macam dokumen yang di unggah merupakan dokumen yang sah, dan dapat
                                    dipertanggung
                                    jawabkan secara hukum.
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <button type="button" id="btnPrevious" class="btn btn-dark mr-4">Kembali</button>
                        <button type="button" id="btnNext" class="btn btn-primary bg-indigo ml-4">Selanjutnya</button>
                    </div>
                </div>
            </div>

            <div id="wizardMessage" class="d-none">
                <div class="card-body py-5">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="p-3" style="background-color: #D1FAE5; width: 100px; height: 100px; border-radius: 100%;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: #047857">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <h3>Pendaftaran Berhasil</h3>
                        <p id="wizardMessageMessage"></p>
                        <p class="text-indigo">
                            Terimakasih telah melakukan pendaftaran! <br />
                            Silahkan menunggu, data anda akan dilakukan Verifikasi oleh Petugas BPHTB.
                            Jika data anda dinyatakan valid, Anda akan menerima konfirmasi
                            pada nomor Hp / Email yang anda daftarkan. <br />
                            Anda tidak dapat melakukan Login kedalam Portal BPHTB sebelum data anda dinyatakan Valid.
                        </p>
                        <br />
                        <a href="{{ route('login') }}" class="text-indigo">Halaman Login</a>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

@endSection

@section('modal')
<div class="modal fade" id="openFileKK" tabindex="-1" aria-labelledby="openFileKKLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="openFileKKLabel">
                    Preview File
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <embed src="" height="768px" style="width: 100%; object-fit: fill; " id="berkas_kkEmbed" />
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    let s = 1; // awal step
    let ls = 5; // jumlah step

    for (let i = 1; i <= ls; i++) {
        if (s == i) {
            $('#step' + i).show();
        } else {
            $('#step' + i).hide();
        }
    }

    step(s);

    $('#btnNext').click(function() {

        // step 1 submit
        if (s == 1) {

            $('#btnNext').attr('disabled', 'disabled');
            $('#btnNext').text('Loading...');

            const email = $('#email').val();
            const username = $('#username').val();
            const password = $('#password').val();
            const password_confirmation = $('#password_confirmation').val();

            $('#email, #username, #password, #password_confirmation').removeClass('is-invalid');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('register.validator', ['step' => 1]) }}",
                data: {
                    email: email,
                    username: username,
                    password: password,
                    password_confirmation: password_confirmation
                },
                cache: false,
                dataType: 'json',
                success: function(data) {
                    if (data.message == 'success') {

                        const obj = {
                            email: email,
                            username: username,
                            password: password,
                            password_confirmation: password_confirmation
                        }

                        localStorage.setItem('reg-step' + s, JSON.stringify(obj));

                        s += 1;
                        step(s);
                    }

                    $('#btnNext').removeAttr('disabled', 'disabled');
                    $('#btnNext').text('Selanjutnya');
                },
                error: function(data) {
                    if (data.status == 422) {

                        const obj = data.responseJSON;

                        for (var key in obj) {
                            if (obj.hasOwnProperty(key)) {
                                $('#' + key).addClass('is-invalid');
                                $('#' + key + 'V').text(obj[key])
                            }
                        }

                    } else {
                        console.log(data);
                    }

                    $('#btnNext').removeAttr('disabled', 'disabled');
                    $('#btnNext').text('Selanjutnya');
                }
            });

        } else if (s == 2) { // step 2 submit

            $('#btnNext').attr('disabled', 'disabled');
            $('#btnNext').text('Loading...');

            const nama = $('#nama').val();
            const nik = $('#nik').val();
            const kk = $('#kk').val();
            let jk = null;

            if ($('#jkl').is(':checked')) {
                jk = 'Laki-laki';
            } else if ($('#jkp').is(':checked')) {
                jk = 'Perempuan';
            }

            $('#nama, #nik, #kk').removeClass('is-invalid');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('register.validator', ['step' => 2]) }}",
                data: {
                    nama: nama,
                    nik: nik,
                    kk: kk,
                },
                cache: false,
                dataType: 'json',
                success: function(data) {
                    if (data.message == 'success') {

                        const obj = {
                            nama: nama,
                            nik: nik,
                            kk: kk,
                            jk: jk
                        }

                        localStorage.setItem('reg-step' + s, JSON.stringify(obj));

                        if (data.profil == 1) {
                            $('#mVerified').removeClass('d-none');

                            // set step 3
                            const step3 = data.withStep3;
                            $('#hp').val(step3.hp);
                            $('#wa').val(step3.wa);
                            $('#tg').val(step3.tg);

                            // set step 4
                            const step4 = data.withStep4;
                            $("#kode_prov").val(step4.kode_prov);

                            // update provinsi
                            let provinsi = $("#kode_prov").val()
                            $("#kode_kab").children().remove()
                            $("#kode_kab").val('');
                            $("#kode_kab").append('<option value="">Pilih Kabupaten</option>');
                            $("#kode_kab").prop('disabled', true)
                            if (provinsi != '' && provinsi != null) {
                                $.ajax({
                                    url: "{{ url('') }}/alamat/pilih/kab/" + provinsi,
                                    success: function(res) {
                                        $("#kode_kab").prop('disabled', false)
                                        $.each(res, function(index, element) {
                                            $("#kode_kab").append(
                                                '<option value=' + element
                                                .kode_kab + '>' + element
                                                .nama_kab + '</option>');
                                        });

                                        $("#kode_kab").val(step4.kode_kab);

                                        // update kecamatan
                                        let kabupaten = $("#kode_kab").val()
                                        $("#kode_kec").children().remove()
                                        $("#kode_kec").val('');
                                        $("#kode_kec").append(
                                            '<option value="">Pilih Kecamatan</option>'
                                        );
                                        $("#kode_kec").prop('disabled', true)
                                        UpdateDesa()
                                        if (kabupaten != '' && kabupaten != null) {
                                            $.ajax({
                                                url: "{{ url('') }}/alamat/pilih/kec/" +
                                                    kabupaten,
                                                success: function(res) {
                                                    $("#kode_kec").prop(
                                                        'disabled',
                                                        false)
                                                    $.each(res, function(
                                                        index,
                                                        element) {
                                                        $("#kode_kec")
                                                            .append(
                                                                '<option value=' +
                                                                element
                                                                .kode_kec +
                                                                '>' +
                                                                element
                                                                .nama_kec +
                                                                '</option>'
                                                            );
                                                    });

                                                    $("#kode_kec").val(step4
                                                        .kode_kec);

                                                    // update desa
                                                    let kecamatan = $(
                                                            "#kode_kec")
                                                        .val()
                                                    $("#kode_desa")
                                                        .children().remove()
                                                    $("#kode_desa").val('');
                                                    $("#kode_desa").append(
                                                        '<option value="">Pilih Desa</option>'
                                                    );
                                                    $("#kode_desa").prop(
                                                        'disabled', true
                                                    )

                                                    if (kecamatan != '' &&
                                                        kecamatan != null) {
                                                        $.ajax({
                                                            url: "{{ url('') }}/alamat/pilih/desa/" +
                                                                kecamatan,
                                                            success: function(
                                                                res
                                                            ) {
                                                                $("#kode_desa")
                                                                    .prop(
                                                                        'disabled',
                                                                        false
                                                                    )
                                                                $.each(res,
                                                                    function(
                                                                        index,
                                                                        element
                                                                    ) {
                                                                        $("#kode_desa")
                                                                            .append(
                                                                                '<option value=' +
                                                                                element
                                                                                .kode_desa +
                                                                                '>' +
                                                                                element
                                                                                .nama_desa +
                                                                                '</option>'
                                                                            );
                                                                    }
                                                                );

                                                                $("#kode_desa")
                                                                    .val(
                                                                        step4
                                                                        .kode_desa
                                                                    );
                                                            }
                                                        });
                                                    }
                                                }
                                            });
                                        }
                                    }
                                });
                            }

                            $('#rtrw').val(step4.rtrw);
                            $('#alamat').val(step4.alamat);
                            $('#kode_pos').val(step4.kode_pos);

                            // set step 5
                            const step5 = data.withStep5;
                            $('#berkas_fotoP').removeClass('d-none');
                            $('#berkas_fotoP').attr('src', step5.berkas_foto);
                            $('#berkas_ktpP').removeClass('d-none');
                            $('#berkas_ktpP').attr('src', step5.berkas_ktp);
                            $('#berkas_kkP').removeClass('d-none');
                            $('#berkas_kkEmbed').attr('src', step5.berkas_kk);

                            $('#berkas_fotoCard').addClass('d-none');
                            $('#berkas_ktpCard').addClass('d-none');
                            $('#berkas_kkCard').addClass('d-none');

                            $('.custom-file-label-berkas_foto').text('Sudah dipilih');
                            $('.custom-file-label-berkas_ktp').text('Sudah dipilih');
                            $('.custom-file-label-berkas_kk').text('Sudah dipilih');

                        } else if (data.profil == 0) {
                            $('#mVerified').addClass('d-none');

                            // reset step 3
                            const obj3 = JSON.parse(localStorage.getItem('reg-step3'));
                            if (obj3) {
                                for (var key in obj3) {
                                    if (obj3.hasOwnProperty(key)) {
                                        $('#' + key).val(obj3[key]);
                                    }
                                }
                            } else {
                                $('#hp').val('');
                                $('#wa').val('');
                                $('#tg').val('');
                            }

                            // reset step 4
                            const obj4 = JSON.parse(localStorage.getItem('reg-step4'));
                            if (obj4) {
                                $('#rtrw').val(obj4.rtrw);
                                $('#alamat').val(obj4.alamat);
                                $('#kode_pos').val(obj4.kode_pos);
                                $('#kode_prov').val(obj4.kode_prov);

                                let provinsi = $("#kode_prov").val()
                                $("#kode_kab").children().remove()
                                $("#kode_kab").val('');
                                $("#kode_kab").append('<option value="">Pilih Kabupaten</option>');
                                $("#kode_kab").prop('disabled', true)
                                if (provinsi != '' && provinsi != null) {
                                    $.ajax({
                                        url: "{{ url('') }}/alamat/pilih/kab/" +
                                            provinsi,
                                        success: function(res) {
                                            $("#kode_kab").prop('disabled', false)
                                            $.each(res, function(index, element) {
                                                $("#kode_kab").append(
                                                    '<option value=' +
                                                    element
                                                    .kode_kab + '>' +
                                                    element
                                                    .nama_kab + '</option>');
                                            });

                                            $("#kode_kab").val(obj4.kode_kab);

                                            // update kecamatan
                                            let kabupaten = $("#kode_kab").val()
                                            $("#kode_kec").children().remove()
                                            $("#kode_kec").val('');
                                            $("#kode_kec").append(
                                                '<option value="">Pilih Kecamatan</option>'
                                            );
                                            $("#kode_kec").prop('disabled', true)
                                            if (kabupaten != '' && kabupaten != null) {
                                                $.ajax({
                                                    url: "{{ url('') }}/alamat/pilih/kec/" +
                                                        kabupaten,
                                                    success: function(res) {
                                                        $("#kode_kec").prop(
                                                            'disabled',
                                                            false)
                                                        $.each(res,
                                                            function(
                                                                index,
                                                                element
                                                            ) {
                                                                $("#kode_kec")
                                                                    .append(
                                                                        '<option value=' +
                                                                        element
                                                                        .kode_kec +
                                                                        '>' +
                                                                        element
                                                                        .nama_kec +
                                                                        '</option>'
                                                                    );
                                                            });

                                                        $("#kode_kec").val(
                                                            obj4
                                                            .kode_kec);

                                                        // update desa
                                                        let kecamatan = $(
                                                                "#kode_kec")
                                                            .val()
                                                        $("#kode_desa")
                                                            .children()
                                                            .remove()
                                                        $("#kode_desa").val(
                                                            '');
                                                        $("#kode_desa")
                                                            .append(
                                                                '<option value="">Pilih Desa</option>'
                                                            );
                                                        $("#kode_desa")
                                                            .prop(
                                                                'disabled',
                                                                true
                                                            )

                                                        if (kecamatan !=
                                                            '' &&
                                                            kecamatan !=
                                                            null) {
                                                            $.ajax({
                                                                url: "{{ url('') }}/alamat/pilih/desa/" +
                                                                    kecamatan,
                                                                success: function(
                                                                    res
                                                                ) {
                                                                    $("#kode_desa")
                                                                        .prop(
                                                                            'disabled',
                                                                            false
                                                                        )
                                                                    $.each(res,
                                                                        function(
                                                                            index,
                                                                            element
                                                                        ) {
                                                                            $("#kode_desa")
                                                                                .append(
                                                                                    '<option value=' +
                                                                                    element
                                                                                    .kode_desa +
                                                                                    '>' +
                                                                                    element
                                                                                    .nama_desa +
                                                                                    '</option>'
                                                                                );
                                                                        }
                                                                    );

                                                                    $("#kode_desa")
                                                                        .val(
                                                                            obj4
                                                                            .kode_desa
                                                                        );
                                                                }
                                                            });
                                                        }
                                                    }
                                                });
                                            }
                                        }
                                    });
                                }



                            } else {
                                $("#kode_prov").val('');

                                $("#kode_kab").children().remove();
                                $("#kode_kab").val('');
                                $("#kode_kab").append('<option value="">Pilih Kabupaten</option>');
                                $("#kode_kab").prop('disabled', true);

                                $("#kode_kec").children().remove();
                                $("#kode_kec").val('');
                                $("#kode_kec").append('<option value="">Pilih Kecamatan</option>');
                                $("#kode_kec").prop('disabled', true);

                                $("#kode_desa").children().remove();
                                $("#kode_desa").val('');
                                $("#kode_desa").append('<option value="">Pilih Desa</option>');
                                $("#kode_desa").prop('disabled', true);

                                $('#rtrw').val('');
                                $('#alamat').val('');
                                $('#kode_pos').val('');
                            }

                            // reset step 5
                            // $('#berkas_fotoP').addClass('d-none');
                            // $('#berkas_ktpP').addClass('d-none');
                            // $('#berkas_kkP').addClass('d-none');

                            if ($('#berkas_foto').val() == '') {
                                $('#berkas_fotoCard').removeClass('d-none');
                            }
                            if ($('#berkas_ktp').val() == '') {
                                $('#berkas_ktpCard').removeClass('d-none');
                            }
                            if ($('#berkas_kk').val() == '') {
                                $('#berkas_kkCard').removeClass('d-none');
                            }


                            // $('#berkas_foto').val('');
                            // $('#berkas_ktp').val('');
                            // $('#berkas_kk').val('');

                            // $('.custom-file-label-berkas_foto').text('Tidak ada file dipilih');
                            // $('.custom-file-label-berkas_ktp').text('Tidak ada file dipilih');
                            // $('.custom-file-label-berkas_kk').text('Tidak ada file dipilih');
                        }

                        s += 1;
                        step(s);
                    }

                    $('#btnNext').removeAttr('disabled', 'disabled');
                    $('#btnNext').text('Selanjutnya');
                },
                error: function(data) {
                    if (data.status == 422) {

                        const obj = data.responseJSON;

                        for (var key in obj) {
                            if (obj.hasOwnProperty(key)) {
                                $('#' + key).addClass('is-invalid');
                                $('#' + key + 'V').text(obj[key])
                            }
                        }

                    } else {
                        console.log(data);
                    }

                    $('#btnNext').removeAttr('disabled', 'disabled');
                    $('#btnNext').text('Selanjutnya');
                }
            });
        } else if (s == 3) { // step 3 submit

            $('#btnNext').attr('disabled', 'disabled');
            $('#btnNext').text('Loading...');

            const hp = $('#hp').val();
            const wa = $('#wa').val();
            const tg = $('#tg').val();

            $('#hp, #wa, #tg').removeClass('is-invalid');
            $('#kode_prov, #kode_kab, #kode_kec, #kode_desa, #rtrw, #alamat, #kode_pos').removeClass(
                'is-invalid');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('register.validator', ['step' => 3]) }}",
                data: {
                    hp: hp,
                    wa: wa !== '' ? wa : 0,
                    tg: tg !== '' ? tg : 0,
                },
                cache: false,
                dataType: 'json',
                success: function(data) {
                    if (data.message == 'success') {
                        const obj = {
                            hp: hp,
                            wa: wa !== '' ? wa : 0,
                            tg: tg !== '' ? tg : 0,
                        }

                        localStorage.setItem('reg-step' + s, JSON.stringify(obj));

                        s += 1;
                        step(s);

                        $('#btnNext').removeAttr('disabled', 'disabled');
                        $('#btnNext').text('Selanjutnya');
                    }
                },
                error: function(data) {
                    if (data.status == 422) {

                        const obj = data.responseJSON;

                        for (var key in obj) {
                            if (obj.hasOwnProperty(key)) {
                                $('#' + key).addClass('is-invalid');
                                $('#' + key + 'V').text(obj[key])
                            }
                        }

                    } else {
                        console.log(data);
                    }

                    $('#btnNext').removeAttr('disabled', 'disabled');
                    $('#btnNext').text('Selanjutnya');
                }
            });
        } else if (s == 4) { // step 4 submit

            $('#btnNext').attr('disabled', 'disabled');
            $('#btnNext').text('Loading...');

            const kode_prov = $('#kode_prov').val();
            const kode_kab = $('#kode_kab').val();
            const kode_kec = $('#kode_kec').val();
            const kode_desa = $('#kode_desa').val();
            const rtrw = $('#rtrw').val();
            const alamat = $('#alamat').val();
            const kode_pos = $('#kode_pos').val();

            $('#kode_prov, #kode_kab, #kode_kec, #kode_desa, #rtrw, #alamat, #kode_pos').removeClass(
                'is-invalid');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('register.validator', ['step' => 4]) }}",
                data: {
                    kode_prov: kode_prov,
                    kode_kab: kode_kab,
                    kode_kec: kode_kec,
                    kode_desa: kode_desa,
                    rtrw: rtrw,
                    alamat: alamat,
                    kode_pos: kode_pos,
                },
                cache: false,
                dataType: 'json',
                success: function(data) {
                    if (data.message == 'success') {

                        const obj = {
                            kode_prov: kode_prov,
                            kode_kab: kode_kab,
                            kode_kec: kode_kec,
                            kode_desa: kode_desa,
                            rtrw: rtrw,
                            alamat: alamat,
                            kode_pos: kode_pos,
                        }

                        localStorage.setItem('reg-step' + s, JSON.stringify(obj));

                        s += 1;
                        step(s);


                        $('#btnNext').removeAttr('disabled', 'disabled');
                        $('#btnNext').attr('type', 'submit');
                        $('#btnNext').text('Submit');
                    }
                },
                error: function(data) {
                    if (data.status == 422) {

                        const obj = data.responseJSON;

                        for (var key in obj) {
                            if (obj.hasOwnProperty(key)) {
                                $('#' + key).addClass('is-invalid');
                                $('#' + key + 'V').text(obj[key])
                            }
                        }

                    } else {
                        console.log(data);
                    }

                    $('#btnNext').removeAttr('disabled', 'disabled');
                    $('#btnNext').text('Selanjutnya');
                }
            });
        }
    });

    $('#btnPrevious').click(function() {
        if (s > 1) {
            s -= 1;
            step(s);

            $('#btnNext').text('Selanjutnya');
        }
    });

    $('#lengthStep').text(ls);

    function step(step) {

        $('#nowStep').text(s);

        if (step == 1) {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
            const obj = JSON.parse(localStorage.getItem('reg-step' + step));
            if (obj) {
                for (var key in obj) {
                    if (obj.hasOwnProperty(key)) {
                        $('#' + key).val(obj[key]);
                    }
                }
            }
        } else if (step == 2) {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
            const obj = JSON.parse(localStorage.getItem('reg-step' + step));
            if (obj) {
                for (var key in obj) {
                    if (obj.hasOwnProperty(key)) {
                        $('#' + key).val(obj[key]);

                        if (obj.jk == 'Perempuan') {
                            $('#jkp').attr('checked', 'checked');
                        }
                    }
                }
            }
        } else if (step == 3) {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        } else if (step == 4) {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        } else if (step == 5) {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
            $('#berkas_foto, #berkas_ktp, #berkas_kk').removeClass('is-invalid');

            getCaptcha();
            $('#captcha').val('');
            $('#captchaV').addClass('d-none');
        }

        for (let i = 1; i <= ls; i++) {
            if (step == i) {
                $('#step' + i).show();

                if (step == 1) {
                    $('#btnPrevious').attr('disabled', 'disabled');
                } else {
                    $('#btnPrevious').removeAttr('disabled', 'disabled');
                }
            } else {
                $('#step' + i).hide();
            }
        }
    }

    $('#email').keyup(function() {
        const username = $(this).val().split('@')[0].toLowerCase();
        $('#username').val(username);
    });

    $('#formReg').submit(function(e) {
        e.preventDefault();

        $('#btnNext').attr('disabled', 'disabled');
        $('#btnNext').text('Loading...');

        if ($('#wa').val() == '') {
            $('#wa').val(0);
        }

        if ($('#tg').val() == '') {
            $('#tg').val(0);
        }

        $('#berkas_foto, #berkas_ktp, #berkas_kk').removeClass('is-invalid');

        $('#captchaV').addClass('d-none');

        const route = $(this).attr('action');

        // ajax here
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: route,
            data: new FormData(this),
            contentType: false,
            processData: false,
            cache: false,
            success: function(data) {
                if (data.message == 'success') {
                    localStorage.removeItem('reg-step1');
                    localStorage.removeItem('reg-step2');

                    const message = data.status_message;
                    $('#wizardContent').addClass('d-none');
                    $('#wizardMessage').removeClass('d-none');
                    $('#wizardMessageMessage').text(message);
                }
            },
            error: function(data) {
                if (data.status == 422) {
                    // validation
                    const obj = data.responseJSON;

                    if (obj.berkas_foto) {
                        $('#berkas_foto').addClass('is-invalid');
                        $('#berkas_fotoV').text(obj.berkas_foto);
                    }

                    if (obj.berkas_ktp) {
                        $('#berkas_ktp').addClass('is-invalid');
                        $('#berkas_ktpV').text(obj.berkas_ktp);
                    }

                    if (obj.berkas_kk) {
                        $('#berkas_kk').addClass('is-invalid');
                        $('#berkas_kkV').text(obj.berkas_kk);
                    }

                    if (obj.captcha) {
                        $('#captchaV').removeClass('d-none');
                    }

                    getCaptcha();

                    $('#captcha').val('');

                } else {
                    console.log(data);
                }

                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;

                $('#btnNext').removeAttr('disabled', 'disabled');
                $('#btnNext').text('Submit');
            }
        });
    });

    // ------------------------------------------------------------------------------

    function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;
        return true;
    }

    function UpdateKab() {
        let provinsi = $("#kode_prov").val()
        $("#kode_kab").children().remove()
        $("#kode_kab").val('');
        $("#kode_kab").append('<option value="">Pilih Kabupaten</option>');
        $("#kode_kab").prop('disabled', true)
        UpdateKec()
        UpdateDesa()
        if (provinsi != '' && provinsi != null) {
            $.ajax({
                url: "{{ url('') }}/alamat/pilih/kab/" + provinsi,
                success: function(res) {
                    $("#kode_kab").prop('disabled', false)
                    $.each(res, function(index, element) {
                        $("#kode_kab").append('<option value=' + element.kode_kab + '>' + element
                            .nama_kab + '</option>');
                    })
                }
            });
        }
    }

    function UpdateKec() {
        let kabupaten = $("#kode_kab").val()
        $("#kode_kec").children().remove()
        $("#kode_kec").val('');
        $("#kode_kec").append('<option value="">Pilih Kecamatan</option>');
        $("#kode_kec").prop('disabled', true)
        UpdateDesa()
        if (kabupaten != '' && kabupaten != null) {
            $.ajax({
                url: "{{ url('') }}/alamat/pilih/kec/" + kabupaten,
                success: function(res) {
                    $("#kode_kec").prop('disabled', false)
                    $.each(res, function(index, element) {
                        $("#kode_kec").append('<option value=' + element.kode_kec + '>' + element
                            .nama_kec + '</option>');
                    })
                }
            });
        }
    }

    function UpdateDesa() {
        let kecamatan = $("#kode_kec").val()
        $("#kode_desa").children().remove()
        $("#kode_desa").val('');
        $("#kode_desa").append('<option value="">Pilih Desa</option>');
        $("#kode_desa").prop('disabled', true)

        if (kecamatan != '' && kecamatan != null) {
            $.ajax({
                url: "{{ url('') }}/alamat/pilih/desa/" + kecamatan,
                success: function(res) {
                    $("#kode_desa").prop('disabled', false)
                    $.each(res, function(index, element) {
                        $("#kode_desa").append('<option value=' + element.kode_desa + '>' + element
                            .nama_desa + '</option>');
                    })
                }
            });
        }
    }

    function loadPreviewGambar(input, id = null, label) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            $(label).text(input.files[0].name);
            $(id + 'P').removeClass('d-none');
            $(id + 'Card').addClass('d-none');

            reader.onload = function(e) {
                $(id + 'P')
                    .attr('src', e.target.result)
                    .width(128)
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function loadPreviewFile(input, label) {
        if (input.files && input.files[0]) {
            $(label).text(input.files[0].name);
        }
    }

    $('#refresh-captcha').click(function() {
        getCaptcha();
    });

    function getCaptcha() {
        $.ajax({
            type: "GET",
            url: "{{ route('captcha.refresh') }}",
            success: function(data) {
                $(".captcha span").html(data.captcha);
            }
        });
    }
</script>

<script>
    //     // disable form's submit button after clicking on submit
    //     $(document).on('submit', 'form', function() {
    //         $('button').attr('disabled', 'disabled');
    //     });
    //     $(document).ready(function() {
    //         $('#email').on({
    //             keydown: function(e) {
    //                 if (e.which === 32) return false
    //             },
    //             keyup: function() {
    //                 this.value = this.value.toLowerCase();
    //             },
    //             change: function() {
    //                 this.value = this.value.replace(/\s/g, "");
    //             }
    //         });
    //         $('#password').on({
    //             keydown: function(e) {
    //                 if (e.which === 32) return false
    //             },
    //             keyup: function() {
    //                 this.value = this.value.toLowerCase();
    //             },
    //             change: function() {
    //                 this.value = this.value.replace(/\s/g, "");
    //             }
    //         });
    //         $('#ulangi_password').on({
    //             keydown: function(e) {
    //                 if (e.which === 32) return false
    //             },
    //             keyup: function() {
    //                 this.value = this.value.toLowerCase();
    //             },
    //             change: function() {
    //                 this.value = this.value.replace(/\s/g, "");
    //             }
    //         });

    //     });

    //     function loadPreview(input, id) {
    //         id = id || '#preview_img';
    //         if (input.files && input.files[0]) {
    //             var reader = new FileReader();

    //             reader.onload = function(e) {
    //                 $(id)
    //                     .attr('src', e.target.result)
    //                     .width(160)
    //                     .height(160);
    //             };

    //             reader.readAsDataURL(input.files[0]);
    //         }
    //     }
</script>
@endsection