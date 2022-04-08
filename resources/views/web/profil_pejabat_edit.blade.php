@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')
<div class="row d-flex justify-content-center">
    <div class="col-md-12 col-lg-6">
        <div class="card">
            <div class="card-header bg-light">
                <h3 class="card-title text-indigo">
                    <i class="fas fa-comment mr-2"></i>
                    Edit Ucapan Pejabat
                </h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm">
                        <li class="page-item">
                            <a href="{{ route('web.public.profil-pejabat') }}" class="page-link bg-indigo">
                                <i class="fas fa-angle-double-left mr-2"></i>
                                Kembali
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <form action="{{ route('web.public.profil-pejabat.update', ['id' => $data->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body table-responsive text-indigo">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="nama_pejabat" class="col-sm-3 col-form-label">Nama
                                    Pejabat</label>
                                <div class="col-md-9">
                                    <input name="nama_pejabat" type="text" id="nama_pejabat" class="form-control @error('nama_pejabat') is-invalid @enderror" value="{{ old('nama_pejabat') ? old('nama_pejabat') : $data->nama_pejabat }}">
                                    @error('nama_pejabat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="jabatan_pejabat" class="col-sm-3 col-form-label">Jabatan
                                    Pejabat</label>
                                <div class="col-md-9">
                                    <input name="jabatan_pejabat" type="text" id="jabatan_pejabat" class="form-control @error('jabatan_pejabat') is-invalid @enderror" value="{{ old('jabatan_pejabat') ? old('jabatan_pejabat') : $data->jabatan_pejabat }}">
                                    @error('jabatan_pejabat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="uraian_pejabat" class="col-sm-3 col-form-label">Uraian</label>
                                <div class="col-md-9">
                                    <textarea name="uraian_pejabat" id="uraian_pejabat" class="form-control @error('uraian_pejabat') is-invalid @enderror">{{ old('uraian_pejabat') ? old('uraian_pejabat') : $data->uraian_pejabat }}</textarea>
                                    @error('uraian_pejabat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="berkas_foto" class="col-sm-3 col-form-label">Foto Pejabat</label>
                                <div class="col-md-9">
                                    <img id="preview_img" src="../../../images/{{ $data->berkas_foto }}" width="100" class="img-thumbnail mb-2" />
                                    <div class="custom-file">
                                        <input type="file" name="berkas_foto" class="custom-file-input @error('berkas_foto') is-invalid @enderror" id="berkas_foto" onchange="loadPreviewGambar(this);" class="form-control">
                                        <label class="custom-file-label" for="berkas_foto">Pilih Foto Maksimal 1 MB
                                            (png, jpg atau jpeg)
                                        </label>
                                        @error('berkas_foto')
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
                            <a href="{{ url()->previous() }}" class="btn btn-block btn-warning">
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