@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)

@section('container')

    @if (Auth::user()->user_group == USER_WAJIB_PAJAK)
        @include('dashboard.panel.panel_wp')
    @elseif (Auth::user()->user_group == USER_PPAT)
        @include('dashboard.panel.panel_ppat')
    @endif

    <div class="row d-flex justify-content-center">

        <div class="col-md-12 col-lg-6">
            <div class="card">
                <div class="card-header bg-indigo">
                    <h2 class="card-title"><i class="fas fa-comments mr-2"></i>
                        Tulis Pesan / Laporan anda!
                    </h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('storeContactAdmin') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                    <input type="hidden" name="nama" value="{{ Auth::user()->nama }}"> --}}
                        <div class="form-group text-indigo">
                            <label for="message">Pesan</label>
                            <br />
                            <small class="text-indigo">Sertakan No HP/WA yang dapat dihubungi pada bagian pesan dibawah
                                ini!</small>
                            <textarea name="message" id="message" class="form-control" placeholder="Pesan / Laporan ..."
                                rows="6" required></textarea>
                        </div>
                        <div class="form-group text-indigo">
                            <label for="file">Lampiran <small>Gambar / Foto</small></label>
                            <div class="custom-file">
                                <input type="file" id="file" name="file" class="custom-file-input">
                                <label class="custom-file-label" for="file">Pilih file gambar/foto</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn bg-indigo float-right">
                                <i class="fab fa-telegram-plane mr-2"></i>
                                Kirim
                            </button>
                        </div>
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
