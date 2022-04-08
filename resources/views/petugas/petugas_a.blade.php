@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

<!-- /.row -->
<div class="row d-flex justify-content-center">
    <div class="col-md-8">
        <div class="card card-default p-0">
            <div class="card-header bg-indigo">
                <h3 class="card-title">
                    <i class="fas fa-building mr-2"></i>
                    Tambah Petugas
                </h3>
                <div class="card-tools">
                    <div class="btn-group d-inline">
                        <a href="{{ url()->previous() }}" class="btn btn-default btn-sm text-indigo">
                            <i class="fas fa-angle-double-left text-indigo mr-2"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div><!-- /.card-header -->
            <form action="{{ route('rekening.simpan') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body table-responsive">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row text-indigo">
                                <label for="no_rekening" class="col-sm-4 col-form-label">Nomor Rekening</label>
                                <div class="col-sm-8">
                                    <input type="text" name="no_rekening" class="form-control @error('no_rekening') is-invalid @enderror" id="no_rekening" value="{{ old('no_rekening') }}" placeholder="Nomor Rekening ..." autofocus>
                                    @error('no_rekening')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row text-indigo">
                                <label for="nama_rekening" class="col-sm-4 col-form-label">Nama Rekening</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nama_rekening" class="form-control @error('nama_rekening') is-invalid @enderror" id="nama_rekening" value="{{ old('nama_rekening') }}" placeholder="Nama Rekening ..." autofocus>
                                    @error('nama_rekening')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row text-indigo">
                                <label for="gambar_qris" class="col-sm-4">Gambar QR Rekening</label>
                                <div class="custom-file col-sm-8">
                                    <input type="file" name="gambar_qris" class="custom-file-input @error('gambar_qris') is-invalid @enderror" id="gambar_qris" onchange="loadPreviewQris(this);" class="form-control">
                                    <label class="custom-file-label" for="gambar_qris">Pilih gambar Maksimal 1 MB...</label>
                                    @error('gambar_qris')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row text-indigo">
                                <label for="gambar_logo_bank" class="col-sm-4">Gambar Logo Bank</label>
                                <div class="custom-file col-sm-8">
                                    <input type="file" name="gambar_logo_bank" class="custom-file-input @error('gambar_logo_bank') is-invalid @enderror" id="gambar_logo_bank" onchange="loadPreviewLogo(this);" class="form-control">
                                    <label class="custom-file-label" for="gambar_logo_bank">Pilih gambar Maksimal 1 MB...</label>
                                    @error('gambar_logo_bank')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row text-indigo">
                                <img src="" alt="" class="img-fluid img-thumbnail d-none" id="preview_qris">
                                <img src="" alt="" class="img-fluid img-thumbnail d-none" id="preview_logo_bank">
                            </div>

                        </div>
                    </div>

                </div><!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-md bg-indigo float-right">
                        <i class="fas fa-save mr-2"></i> Simpan
                    </button>
                </div>
            </form>
        </div><!-- /.card -->
    </div>
</div>
<!-- /.row -->

@endSection
@section('script')
<script>
    function loadPreviewQris(input) {
        //console.log(input.name);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview_qris').removeClass('d-none');
                $('#preview_qris')
                    .attr('src', e.target.result)
                    .width(160)
                    .height(160);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function loadPreviewLogo(input) {
        //console.log(input.name);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview_logo_bank').removeClass('d-none');
                $('#preview_logo_bank')
                    .attr('src', e.target.result)
                    .width(160)
                    .height(160);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endSection