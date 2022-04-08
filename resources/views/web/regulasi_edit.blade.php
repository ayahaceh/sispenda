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
                    Edit Regulasi
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
            <form action="{{ route('web.public.regulasi.update', ['id' => $data->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body table-responsive text-indigo">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="nama_regulasi" class="col-sm-3 col-form-label">Nama Regulasi</label>
                                <div class="col-md-9">
                                    <input name="nama_regulasi" type="text" id="nama_regulasi" class="form-control @error('nama_regulasi') is-invalid @enderror" value="{{ old('nama_regulasi') ? old('nama_regulasi') : $data->nama_regulasi }}">
                                    @error('nama_regulasi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="berkas_regulasi" class="col-sm-3 col-form-label">Berkas Regulasi</label>
                                <div class="col-sm-9">
                                    <div class="border py-2 px-5 rounded mb-2" style="cursor: pointer; width: fit-content;" data-target="#openFileRegulasi" data-source="{{ $data->berkas_regulasi }}">
                                        <div class="d-flex justify-content-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="text-indigo" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 50px;">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <span class="text-center">Buka File</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" name="berkas_regulasi" class="custom-file-input @error('berkas_regulasi') is-invalid @enderror" id="berkas_regulasi" onchange="loadPreviewGambar(this);" class="form-control">
                                        <label class="custom-file-label" for="berkas_regulasi">Pilih Foto Maksimal 5
                                            MB
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

@section('modal')
<div class="modal fade" id="openFileRegulasi" tabindex="-1" aria-labelledby="openFileRegulasiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="openFileRegulasiLabel">Preview File</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <embed src="../../../files/{{ $data->berkas_regulasi }}" height="768px" style="width: 100%; object-fit: fill; " />
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).on('submit', 'form', function() {
        $('button').attr('disabled', 'disabled');
    });

    $("[data-target='#openFileRegulasi']").click(function() {
        const file = $(this).attr('data-source').split('.').pop();
        // console.log(file.split('.').pop());
        if (file == 'zip') {
            window.location.href = '../../../files/' + $(this).attr('data-source');
        } else if (file == 'pdf') {
            $('#openFileRegulasi').modal('show');
        }
    });
</script>
@endsection