@extends('templates.public_template')
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

<style>
    li b {
        color: #4B5563;
    }
</style>

<div class="col-12 col-md-10 col-lg-8 col-xl-8 d-flex justify-content-center align-items-center my-5 my-md-0" style="min-height: 100vh;">
    <div class="card" style="border-radius: 12px !important;">
        <div class="card-header text-center">
            <a href="{{ route('home') }}" class="h1 text-indigo">Pendaftaran</a>
        </div>
        <div class="card-body py-4 px-md-5">
            <h4 class="login-box-msg text-indigo">Persetujuan Pendaftaran BPHTB Online BPKK Aceh Singkil</h4>
            <div class="row">
                <div class="col-md-12 col-xl-8">
                    <p>Sebelum melakukan pendaftaran, agar menyiapkan berkas-berkas sebagai berikut : </p>
                    <ol>
                        <li>Foto wajah ukuran maksimal 1MB <b>(format png, jpg atau jpeg)</b>.</li>
                        <li>Foto KTP ukuran maksimal 1MB <b>(format png, jpg atau jpeg)</b>.</li>
                        <li>Foto Kartu Keluarga (KK) ukuran maksimal 1MB <b>(format pdf)</b>.</li>
                        <li>Scan Dokumen Akta Jual Beli <b>(format pdf)</b> dicompress kedalam <b>(format .zip)</b>
                            ukuran
                            maksimal
                            5MB.
                        </li>
                        <li>Scan Dokumen Bukti Pelunasan Pajak Bumi dan Bangunan 5 tahun terakhir <b>(format pdf)</b>
                            dicompress kedalam <b>(format .zip)</b> ukuran maksimal 5MB.
                        </li>
                    </ol>
                </div>
                <div class="col-xl-4 d-flex align-items-center">
                    <!-- <img src="{{ asset('/web/images/bg15-1.png') }}" class="img-responsive" alt="Responsive Bootstrap Image" /> -->
                    <img id="preview_img" src="{{ asset('/web/images/bg15-1.png') }}" class="img-fluid d-none d-xl-block" />
                </div>
            </div>

            <form action="{{ route('register.tambah') }}" method="GET">
                @csrf
                <div class="col-md-10">
                    <div class="form-check form-check-inline">
                        <div class="icheck-indigo">
                            <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                            <label for="agreeTerms" style="font-weight: 500">
                                Segala macam dokumen yang di unggah merupakan dokumen yang sah, dan dapat
                                dipertanggung jawabkan secara hukum.
                            </label>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="d-md-flex justify-content-between text-center">
                        <button type="submit" class="btn bg-indigo">Lanjut Pendaftaran</button>
                        <div class="mt-4 mt-md-0">
                            Sudah punya akun?
                            <a href="{{ route('login') }}" class="text-indigo">
                                Masuk sekarang!
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div><!-- /.card -->
</div>

@endSection

@section('script')
<script>
    $(function() {
        localStorage.removeItem('reg-step1');
        localStorage.removeItem('reg-step2');
        localStorage.removeItem('reg-step3');
        localStorage.removeItem('reg-step4');
    });
</script>
@endsection