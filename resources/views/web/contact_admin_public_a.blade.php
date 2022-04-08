@extends('templates.public_template')
@section('tittle', $tittle)
@section('bread', $bread)

@section('container')

<div class="row d-flex justify-content-center">

    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-indigo">
                <h2 class="card-title"><i class="fas fa-comments mr-2"></i>
                    Tulis Pesan / Laporan anda!
                </h2>
            </div>
            <div class="card-body">
                <form action="{{ route('storeContactAdminPublic') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group text-indigo">
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{ old('nama') }}" placeholder="Nama Lengkap ..." required>
                        @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group text-indigo">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" placeholder="Email ..." required>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group text-indigo">
                        <input type="text" name="hp" class="form-control @error('hp') is-invalid @enderror" id="hp" value="{{ old('hp') }}" placeholder="hp ..." required>
                        @error('hp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group text-indigo">
                        <label for="message">Pesan</label>
                        <br />
                        <small class="text-indigo">Sertakan No HP/WA yang dapat dihubungi pada bagian pesan dibawah ini!</small>
                        <textarea name="message" id="message" class="form-control" placeholder="Silahkan tulis pertanyaan anda..." rows="5" required></textarea>
                    </div>
                    <div class="form-group row d-flex justify-content-center">
                        <div class="captcha">
                            <figure class="about-img animate" data-animate="pulse">
                                <span>{!! captcha_img() !!}</span>
                                <button class="scroll-down" id="refresh-captcha">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                                <input id="captcha" type="text" class="form-control" placeholder="Masukkan Captcha" name="captcha" required>
                            </figure>
                        </div>
                    </div>
                    <button type="submit" class="btn bg-indigo float-right">
                        <i class="fab fa-telegram-plane mr-2"></i> Kirim
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- End your project here-->
</div><!-- /.card -->
@endSection

@section('script')
<script type="text/javascript">
    $(document).on('submit', 'form', function() {
        $('button').attr('disabled', 'disabled');
    });
</script>
@endsection