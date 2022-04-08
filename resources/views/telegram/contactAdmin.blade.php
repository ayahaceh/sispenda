@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

<div class="row">
    <!--flash massage-->
    @include('templates.flash_message')
    <!--flash massage-->
    <div class="col-md-4">
        <div class="callout callout-info">
            <h5 class="text-teal"><i class="fas fa-info mr-2"></i> Note:</h5>
            <p class="text-teal">
                Jika ditemuka kesalahan / Error terkait aplikasi E-Arsip,
                Silahkan gunakan Form ini untuk menghubungi Admin / Developer Aplikasi
                untuk membuat pelaporan terkait permasalahan / Error aplikasi.
            </p>
            <p class="text-teal">
                <br> # Gunakan Lampiran untuk melampirkan gambar/foto layar bagian error (jika diperlukan).
            </p>
        </div>
    </div>

    <!-- <div class="col-8 offset-2"> -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-teal">
                <h2 class="card-title"><i class="fas fa-envelope mr-2"></i> Tulis Pesan / Laporan kepada Admin/Developer
                    Aplikasi</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('storeContactAdmin') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                    <input type="hidden" name="nama" value="{{ Auth::user()->nama }}">
                    <div class="form-group">
                        <label for="message">Pesan</label>
                        <textarea name="message" id="message" class="form-control" placeholder="Enter your query" rows="6" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="file">Lampiran <small>Gambar/Foto</small></label>
                        <div class="custom-file">
                            <input type="file" id="file" name="file" class="custom-file-input">
                            <label class="custom-file-label" for="file">Pilih file gambar/foto</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn bg-teal float-right">
                            <i class="far fa-envelope mr-2"></i>
                            Kirim
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <!-- End your project here-->
</div><!-- /.card -->
</div> <!-- /.col -->
</div><!-- /.row -->


@endSection

@section('script')
<script>
    $(document).on('submit', 'form', function() {
        $('button').attr('disabled', 'disabled');
    });
</script>

@endsection