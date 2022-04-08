@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')
    <div class="row d-flex justify-content-center">
        <div class="col-md-12 col-lg-6">
            <div class="card card-default card-outline">
                <div class="card-header bg-light">
                    <h3 class="card-title text-indigo">
                        <i class="fas fa-file-invoice-dollar mr-2"></i>
                        Edit Tarif BPHTB
                    </h3>
                    <div class="card-tools">
                        <ul class="pagination pagination-sm">
                            <li class="page-item">
                                <a href="{{ route('tarif.bphtb') }}" class="page-link bg-indigo">
                                    <i class="fas fa-angle-double-left mr-2"></i>
                                    Kembali
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /.card-header -->
                <form action="{{ route('tarif.bphtb.update', ['id' => $data->id]) }}" method="POST">
                    @csrf
                    <div class="card-body table-responsive text-indigo">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="kode_tarif_bphtb" maxlength="200" class="col-sm-3 col-form-label">Kode
                                        Tarif</label>
                                    <div class="col-md-9">
                                        <input name="kode_tarif_bphtb" type="text" id="kode_tarif_bphtb"
                                            class="form-control @error('kode_tarif_bphtb') is-invalid @enderror"
                                            value="{{ old('kode_tarif_bphtb') ? old('kode_tarif_bphtb') : $data->kode_tarif_bphtb }}"
                                            placeholder="Kode tarif">
                                        @error('kode_tarif_bphtb')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="persen_tarif_bphtb" maxlength="200" class="col-sm-3 col-form-label">Besaran
                                        Tarif</label>
                                    <div class="col-md-9">
                                        <input name="persen_tarif_bphtb" type="text" id="persen_tarif_bphtb"
                                            class="form-control @error('persen_tarif_bphtb') is-invalid @enderror"
                                            value="{{ old('persen_tarif_bphtb') ? old('persen_tarif_bphtb') : $data->persen_tarif_bphtb }}"
                                            placeholder="%">
                                        @error('persen_tarif_bphtb')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ket_tarif_bphtb" maxlength="200"
                                        class="col-sm-3 col-form-label">Uraian</label>
                                    <div class="col-md-9">
                                        <input name="ket_tarif_bphtb" type="text" id="ket_tarif_bphtb"
                                            class="form-control @error('ket_tarif_bphtb') is-invalid @enderror"
                                            value="{{ old('ket_tarif_bphtb') ? old('ket_tarif_bphtb') : $data->ket_tarif_bphtb }}"
                                            placeholder="Uraian">
                                        @error('ket_tarif_bphtb')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
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
                                <a href="{{ route('tarif.bphtb') }}" class="btn btn-block btn-warning">
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
