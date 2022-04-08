@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')
<div class="row d-flex justify-content-center">
    <div class="col-md-12 col-lg-6">
        <div class="card">
            <div class="card-header bg-light">
                <h3 class="card-title text-indigo">
                    <i class="fas fa-balance-scale mr-2"></i>
                    Tambah Regulasi
                </h3>
                <div class="card-tools">
                    <ul class="pagination pagination-sm">
                        <li class="page-item">
                            <a href="{{ route('web.public.regulasi') }}" class="page-link bg-indigo">
                                <i class="fas fa-angle-double-left  mr-2"></i>
                                Kembali
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <form action="{{ route('web.public.regulasi.tambah') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body table-responsive text-indigo">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="nama_regulasi" class="col-sm-3 col-form-label">Nama Regulasi</label>
                                <div class="col-md-9">
                                    <input name="nama_regulasi" type="text" id="nama_regulasi" class="form-control @error('nama_regulasi') is-invalid @enderror" value="{{ old('nama_regulasi') }}">
                                    @error('nama_regulasi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="berkas_regulasi" class="col-sm-3 col-form-label">Berkas Regulasi</label>
                                <div class="col-md-9">
                                    <div class="custom-file">
                                        <input type="file" name="berkas_regulasi" class="custom-file-input @error('berkas_regulasi') is-invalid @enderror" id="berkas_regulasi" onchange="loadPreviewGambar(this);" class="form-control">
                                        <label class="custom-file-label" for="berkas_regulasi">Pilih Foto Maksimal 5 MB
                                            (pdf atau zip)
                                        </label>
                                        @error('berkas_regulasi')
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
                            <a href="{{ route('web.public.regulasi') }}" class="btn btn-block btn-warning">
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
</script>
@endsection