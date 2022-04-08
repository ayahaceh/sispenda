@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')
    <div class="row d-flex justify-content-center">
        <div class="col-md-12 col-lg-6">
            <div class="card card-default card-outline">
                <div class="card-header bg-light">
                    <h3 class="card-title text-indigo">
                        <i class="fas fa-file-invoice-dollar mr-2"></i>Edit Tarif NPOPTKP
                    </h3>
                    <div class="card-tools">
                        <ul class="pagination pagination-sm">
                            <li class="page-item">
                                <a href="{{ route('tarif.npoptkp') }}" class="page-link bg-indigo">
                                    <i class="fas fa-angle-double-left mr-2"></i>
                                    Kembali
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /.card-header -->
                <form action="{{ route('tarif.npoptkp.update', ['id' => $data->id]) }}" method="POST">
                    <div class="card-body table-responsive text-indigo">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                @if ($data->default == 1)
                                    <input type="hidden" name="default" id="default" value="1">
                                @else
                                    <input type="hidden" name="default" id="default" value="0">
                                @endif
                                <div class="form-group row">
                                    <label for="kode_npop_tkp" class="col-sm-3 col-form-label">Kode Tarif</label>
                                    <div class="col-md-9">
                                        <input name="kode_npop_tkp" type="text" id="kode_npop_tkp"
                                            class="form-control @error('kode_npop_tkp') is-invalid @enderror"
                                            value="{{ old('kode_npop_tkp') ? old('kode_npop_tkp') : $data->kode_npop_tkp }}"
                                            placeholder="Kode tarif">
                                        @error('kode_npop_tkp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="tarif_npop_tkp" class="col-sm-3 col-form-label">Jumlah Tarif</label>
                                    <div class="col-md-9">
                                        <input name="tarif_npop_tkp" type="text" id="tarif_npop_tkp"
                                            class="form-control @error('tarif_npop_tkp') is-invalid @enderror"
                                            value="{{ old('tarif_npop_tkp') ? old('tarif_npop_tkp') : $data->tarif_npop_tkp }}"
                                            placeholder="Kode tarif" autocomplete="off">
                                        @error('tarif_npop_tkp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <p id="preview_rp" class="mt-1 mb-0">Rp {{ $data->tarif }}</p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ket_npop_tkp" class="col-sm-3 col-form-label">Keterangan</label>
                                    <div class="col-md-9">
                                        <textarea name="ket_npop_tkp" id="ket_npop_tkp"
                                            class="form-control @error('ket_npop_tkp') is-invalid @enderror">{{ old('ket_npop_tkp') ? old('ket_npop_tkp') : $data->ket_npop_tkp }}</textarea>
                                        @error('ket_npop_tkp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        @if ($data->default == 1)
                                            <input class="form-check-input" type="checkbox" id="checkboxDefault"
                                                checked="true">
                                        @else
                                            <input class="form-check-input" type="checkbox" id="checkboxDefault">
                                        @endif
                                        <label class="form-check-label" for="checkboxDefault">
                                            Atur ke default
                                        </label>
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
                                <a href="{{ route('tarif.npoptkp') }}" class="btn btn-block btn-warning">
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
        $('#checkboxDefault').click(function() {
            if ($(this).prop("checked") == true) {
                $("#default").val(1);
            } else if ($(this).prop("checked") == false) {
                $("#default").val(0);
            }
        });

        $("#tarif_npop_tkp").keypress(function(e) {
            // only number
            const char = String.fromCharCode(e.keyCode);
            return (/^[0-9]+$/.test(char)) ? true : false;

            // tidak boleh dari 10 karakter
            if (this.value.length >= 10) {
                return false;
            }
        });

        $("#tarif_npop_tkp").keyup(function() {

            $("#preview_rp").text(formatRupiah(this.value, "Rp. "));
        });

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
        }

        $(document).on('submit', 'form', function() {
            $('button').attr('disabled', 'disabled');
        });
    </script>
@endsection
