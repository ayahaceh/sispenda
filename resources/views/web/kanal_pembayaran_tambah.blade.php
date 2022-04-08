@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')
<div class="row d-flex justify-content-center">
    <div class="col-md-12 col-lg-6">
        <div class="card">
            <div class="card-header bg-light">
                <h3 class="card-title text-indigo">
                    <i class="fas fa-landmark mr-2"></i>
                    Tambah Kanal Pembayaran
                </h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm">
                        <li class="page-item">
                            <a href="{{ url()->previous() }}" class="page-link bg-indigo">
                                <i class="fas fa-angle-double-left mr-2"></i>
                                Kembali
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <form action="{{ route('web.public.kanal-pembayaran.tambah') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body table-responsive text-indigo">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="nama_kanal" class="col-sm-3 col-form-label">Nama Kanal</label>
                                <div class="col-md-9">
                                    <input name="nama_kanal" type="text" id="nama_kanal" class="form-control @error('nama_kanal') is-invalid @enderror" value="{{ old('nama_kanal') }}">
                                    @error('nama_kanal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="uraian_kanal" class="col-sm-3 col-form-label">Uraian Kanal</label>
                                <div class="col-md-9">
                                    <textarea name="uraian_kanal" id="uraian_kanal" class="form-control @error('uraian_kanal') is-invalid @enderror">{{ old('uraian_kanal') }}</textarea>
                                    @error('uraian_kanal')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="berkas_kanal" class="col-sm-3 col-form-label">Foto Kanal</label>
                                <div class="col-md-9">
                                    <img id="preview_img" src="" class="d-none img-thumbnail mb-2" width="100" />
                                    <div class="custom-file">
                                        <input type="file" name="berkas_kanal" class="custom-file-input @error('berkas_kanal') is-invalid @enderror" id="berkas_kanal" onchange="loadPreviewGambar(this);" class="form-control">
                                        <label class="custom-file-label" for="berkas_kanal">Pilih Foto Maksimal 1 MB
                                            (png, jpg atau jpeg)
                                        </label>
                                        @error('berkas_kanal')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('web.public.kanal-pembayaran') }}" class="btn btn-block btn-warning">
                                <i class="fas fa-undo mr-2"></i> Batal
                            </a>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-block bg-indigo">
                                <i class="fas fa-save mr-2"></i> Simpan
                            </button>
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
    $(document).on('submit', 'form', function() {
        $('button').attr('disabled', 'disabled');
    });

    function loadPreviewGambar(input, id) {
        id = id || '#preview_img';
        $(id).removeClass('d-none');
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $(id)
                    .attr('src', e.target.result)
                    .width(150)
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection