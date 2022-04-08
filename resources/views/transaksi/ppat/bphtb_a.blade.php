@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

    @include('dashboard.panel.panel_ppat')

    <div class="row">
        <div class="col-12">
            <div class="card card-default card-outline">
                <div class="text-indigo">
                    <form action="{{ route('ppat.bphtb.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header bg-indigo">
                            <h3 class="card-title">
                                <i class="fas fa-user-alt mr-2"></i>Profil Wajib Pajak
                            </h3>
                        </div>
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="row">
                                        {{-- <div class="col-sm-3">
                                            <img id="preview_img" src="{{ asset('upload/users/comp/default.jpg') }}"
                                                style="margin-bottom: 15px" class="" width="160"
                                                height="160" />
                                        </div> --}}
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="nik_mask">NIK (KTP)</label>
                                                <input type="text" name="nik_mask" id="nik_mask"
                                                    class="form-control @error('nik') is-invalid @enderror"
                                                    data-inputmask='"mask": "99 99 99 999999 9999"' data-mask
                                                    inputmode="numeric" value="{{ old('nik') }}" required
                                                    onkeyup="enableFormNop()">
                                                <input type="hidden" name="nik" id="nik" value="{{ old('nik') }}"
                                                    required>
                                                @error('nik')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_wp">Nama</label>
                                                <input name="nama_wp" id="nama_wp" type="text"
                                                    class="form-control @error('nama_wp') is-invalid @enderror"
                                                    value="{{ old('nama_wp') }}" required>
                                                @error('nama_wp')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat_wp">Alamat</label>
                                                <input name="alamat_wp" id="alamat_wp" type="text"
                                                    class="form-control @error('alamat_wp') is-invalid @enderror"
                                                    value="{{ old('alamat_wp') }}" placeholder="Jl. Mawar" required>
                                                @error('alamat_wp')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="kode_prov_wp">Provinsi</label>
                                                <select id="kode_prov_wp" name="kode_prov_wp"
                                                    class="form-control @error('kode_prov_wp') is-invalid @enderror"
                                                    onchange="UpdateKab('#kode_prov_wp', '#kode_kab_wp', '#kode_kec_wp', '#kode_desa_wp')"
                                                    required>
                                                    <option value="">Pilih Provinsi</option>
                                                    @foreach ($dataProv as $data)
                                                        <option value="{{ $data->kode_prov }}"
                                                            {{ old('kode_prov_wp') == $data->kode_prov ? 'selected' : '' }}>
                                                            {{ $data->nama_prov }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('kode_prov_wp')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="kode_kab_wp">Kabupaten</label>
                                                <select id="kode_kab_wp" name="kode_kab_wp"
                                                    class="form-control @error('kode_kab_wp') is-invalid @enderror"
                                                    onchange="UpdateKec('#kode_kab_wp', '#kode_kec_wp', '#kode_desa_wp')"
                                                    required disabled>
                                                    <option value="">Pilih Kabupaten</option>
                                                </select>
                                                @error('kode_kab_wp')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-1"></div>
                                <div class="col-sm-5">

                                    <div class="form-group">
                                        <label for="kode_kec_wp">Kecamatan</label>
                                        <select id="kode_kec_wp" name="kode_kec_wp"
                                            class="form-control @error('kode_kec_wp') is-invalid @enderror"
                                            onchange="UpdateDesa('#kode_kec_wp', '#kode_desa_wp')" required disabled>
                                            <option value="">Pilih Kecamatan</option>
                                        </select>
                                        @error('kode_kec_wp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="kode_desa_wp">Desa</label>
                                        <select id="kode_desa_wp" name="kode_desa_wp"
                                            class="form-control @error('kode_desa_wp') is-invalid @enderror" required
                                            disabled>
                                            <option value="">Pilih Desa</option>
                                        </select>
                                        @error('kode_desa_wp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="rtrw_wp">RT / RW</label>
                                        <input name="rtrw_wp" id="rtrw_wp" type="text" maxlength="10"
                                            class="form-control @error('rtrw_wp') is-invalid @enderror"
                                            value="{{ old('rtrw_wp') }}" placeholder="01/02">
                                        <span class="text-xs text-gray">Boleh dikosongkan</span>
                                        @error('rtrw_wp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="kode_pos_wp">Kode POS</label>
                                        <input name="kode_pos_wp" id="kode_pos_wp" type="text" maxlength="5"
                                            class="form-control @error('kode_pos_wp') is-invalid @enderror"
                                            value="{{ old('kode_pos_wp') }}">
                                        <span class="text-xs text-gray">Boleh dikosongkan</span>
                                        @error('kode_pos_wp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .card Header -->

                        <div class="card-header bg-indigo">
                            <h3 class="card-title">
                                <i class="fas fa-map-marked-alt mr-2"></i>Data Objek Pajak PBB
                            </h3>
                        </div>
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group row">
                                        <label for="nop_mask" class="col-sm-4 col-form-label">
                                            NOP <small>Nomor Objek Pajak</small>
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="nop_mask" id="nop_mask"
                                                class="form-control @error('nop') is-invalid @enderror"
                                                data-inputmask='"mask": "99 99 999 999 999 9999 9"' data-mask
                                                inputmode="numeric" required onkeyup="toNop()" value="{{ old('nop') }}">
                                            <input type="hidden" name="nop" id="nop" value="{{ old('nop') }}" required>
                                            @error('nop')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="letak_nop" class="col-sm-4 col-form-label">Letak
                                            <small>(Tanah/Bangunan)</small>
                                        </label>
                                        <div class="col-sm-8">
                                            <input name="letak_nop" type="text" id="letak_nop"
                                                class="form-control @error('letak_nop') is-invalid @enderror"
                                                placeholder="Jl. Melati" value="{{ old('letak_nop') }}" required>
                                            @error('letak_nop')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="kode_kab_nop" class="col-sm-4 col-form-label">Kabupaten</label>
                                        <div class="col-sm-8">
                                            <select id="kode_kab_nop" name="kode_kab_nop"
                                                class="form-control @error('kode_kab_nop') is-invalid @enderror" required>
                                                <option value="{{ $dataKabDefault->kode_kab }}">
                                                    {{ $dataKabDefault->nama_kab }}
                                                </option>
                                            </select>
                                            @error('kode_kab_nop')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="kode_kec_nop" class="col-sm-4 col-form-label">Kecamatan</label>
                                        <div class="col-sm-8">
                                            <select id="kode_kec_nop" name="kode_kec_nop"
                                                onchange="UpdateDesa('#kode_kec_nop', '#kode_desa_nop', true)"
                                                class="form-control @error('kode_kec_nop') is-invalid @enderror" required>
                                                <option value="">Pilih Kecamatan</option>
                                                @foreach ($dataKec as $dKec)
                                                    <option value="{{ $dKec->kode_kec }}"
                                                        {{ old('kode_kec_nop') == $dKec->kode_kec ? 'selected' : '' }}>
                                                        {{ $dKec->nama_kec }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('kode_kec_nop')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="kode_desa_nop" class="col-sm-4 col-form-label">Desa</label>
                                        <div class="col-sm-8">
                                            <select id="kode_desa_nop" name="kode_desa_nop"
                                                class="form-control @error('kode_desa_nop') is-invalid @enderror" required>
                                                <option value="">Pilih Desa</option>
                                            </select>
                                            @error('kode_desa_nop')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="rtrw_nop" class="col-sm-4 col-form-label">RT / RW </label>
                                        <div class="col-sm-8">
                                            <input name="rtrw_nop" type="text" id="rtrw_nop" maxlength="10"
                                                class="form-control @error('rtrw_nop') is-invalid @enderror"
                                                value="{{ old('rtrw_nop') }}" placeholder="01/02">
                                            <span class="text-xs text-gray">Boleh dikosongkan</span>
                                            @error('rtrw_nop')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="kode_jenis_perolehan" class="col-sm-4 col-form-label">Jenis Perolehan
                                            <small>(atas Tanah/Bangunan)</small></label>
                                        <div class="col-sm-8">
                                            <select id="kode_jenis_perolehan" name="kode_jenis_perolehan"
                                                class="form-control @error('kode_jenis_perolehan') is-invalid @enderror"
                                                required>
                                                <option value="">Pilih Jenis Perolehan</option>
                                                @foreach ($dataJenisPerolehan as $dJP)
                                                    <option value="{{ $dJP->kode_jenis_perolehan }}"
                                                        {{ old('kode_jenis_perolehan') == $dJP->kode_jenis_perolehan ? 'selected' : '' }}>
                                                        {{ $dJP->nama_jenis_perolehan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('kode_jenis_perolehan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="no_sertifikat" class="col-sm-4 col-form-label">Nomor Sertifikat</label>
                                        <div class="col-sm-8">
                                            <input name="no_sertifikat" type="text" id="no_sertifikat"
                                                class="form-control @error('no_sertifikat') is-invalid @enderror"
                                                value="{{ old('no_sertifikat') }}" required>
                                            @error('no_sertifikat')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-1"></div>
                                <div class="col-sm-5">
                                    <div class="form-group row">
                                        <label for="luas_tanah" class="col-sm-4 col-form-label">Luas Tanah</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input name="luas_tanah" type="number" id="luas_tanah"
                                                    class="form-control decimal @error('luas_tanah') is-invalid @enderror"
                                                    maxlength="12" value="{{ old('luas_tanah') }}" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">M<sup>2</sup></span>
                                                </div>
                                                @error('luas_tanah')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="luas_bangunan" class="col-sm-4 col-form-label">Luas Bangunan</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input name="luas_bangunan" type="number" id="luas_bangunan"
                                                    class="form-control decimal @error('luas_bangunan') is-invalid @enderror"
                                                    maxlength="12" value="{{ old('luas_bangunan') }}" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">M<sup>2</sup></span>
                                                </div>
                                                @error('luas_bangunan')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="njop_tanah" class="col-sm-4 col-form-label">NJOP Tanah</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input name="njop_tanah" type="text" id="njop_tanah" class="form-control"
                                                    maxlength="12" value="0" disabled>
                                            </div>
                                            <span class="text-xs text-gray">Diisi oleh admin</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="njop_bangunan" class="col-sm-4 col-form-label">NJOP Bangunan</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input name="njop_bangunan" type="text" id="njop_bangunan"
                                                    class="form-control" maxlength="12" value="0" disabled>
                                            </div>
                                            <span class="text-xs text-gray">Diisi oleh admin</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="njop_pbb" class="col-sm-4 col-form-label">NJOP PBB</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input name="njop_pbb" type="text" id="njop_pbb"
                                                    class="form-control integer" value="0" disabled>
                                            </div>
                                            <span class="text-xs text-gray">Diisi oleh admin</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="hak_nilai_pasar" class="col-sm-4 col-form-label">Hak
                                            <small>(Transaksi/Nilai Pasar)</small>
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input name="hak_nilai_pasar" type="text" id="hak_nilai_pasar"
                                                    class="form-control integer @error('hak_nilai_pasar') is-invalid @enderror"
                                                    value="{{ old('hak_nilai_pasar') }}" required>
                                                @error('hak_nilai_pasar')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">
                                            NIK Wajib Pajak
                                            <small>(Sebelumnya)</small>
                                        </label>
                                        <div class="col-sm-8">
                                            <input name="nik_sebelumnya" id="nik_sebelumnya" type="text"
                                                class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">
                                            Nama Wajib Pajak
                                            <small>(Sebelumnya)</small>
                                        </label>
                                        <div class="col-sm-8">
                                            <input name="nama_wp_sebelumnya" id="nama_wp_sebelumnya" type="text"
                                                class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .card Header -->

                        <div class="card-header bg-indigo">
                            <h3 class="card-title">
                                <i class="fas fa-upload mr-2"></i>Upload Berkas
                            </h3>
                        </div>

                        <div class="card-body">
                            <div class="form-group row">
                                <label for="berkas_ktp" class="col-sm-4 col-form-label">Berkas
                                    KTP</label>
                                <div class="col-sm-8">
                                    <img id="preview_img_ktp" src="" class="img-fluid img-thumbnail d-none mb-3"
                                        width="150" height="150" />
                                    <div class="custom-file">
                                        <input type="file" name="berkas_ktp"
                                            class="custom-file-input @error('berkas_ktp') is-invalid @enderror"
                                            id="berkas_ktp" onchange="loadPreviewGambar(this, '#preview_img_ktp');"
                                            class="form-control">
                                        <label class="custom-file-label" for="berkas_ktp">Choose file</label>
                                        <span class="text-xs text-gray">Berkas maksimal 1 MB (png, jpg atau jpeg)</span>
                                        @error('berkas_ktp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="berkas_sertifikat" class="col-sm-4 col-form-label">Berkas
                                    Sertifikat</label>
                                <div class="col-sm-8">
                                    <img id="preview_img_serti" src="" class="img-fluid img-thumbnail d-none mb-3"
                                        width="150" height="150" />
                                    <div class="custom-file">
                                        <input type="file" name="berkas_sertifikat"
                                            class="custom-file-input @error('berkas_sertifikat') is-invalid @enderror"
                                            id="berkas_sertifikat" onchange="loadPreviewGambar(this, '#preview_img_serti');"
                                            class="form-control">
                                        <label class="custom-file-label" for="berkas_sertifikat">Choose file</label>
                                        <span class="text-xs text-gray">Berkas maksimal 1 MB (png, jpg atau jpeg)</span>
                                        @error('berkas_sertifikat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="berkas_ajb" class="col-sm-4 col-form-label">Berkas Akta Jual
                                    Beli</label>
                                <div class="col-sm-8">
                                    <img id="preview_img" src="" class="img-fluid img-thumbnail d-none mb-3" width="150"
                                        height="150" />
                                    <div class="custom-file">
                                        <input type="file" name="berkas_ajb"
                                            class="custom-file-input @error('berkas_ajb') is-invalid @enderror"
                                            id="berkas_ajb" onchange="loadPreviewGambar(this);" class="form-control">
                                        <label class="custom-file-label" for="berkas_ajb">Choose file</label>
                                        <span class="text-xs text-gray">Berkas maksimal 1 MB (png, jpg atau jpeg)</span>
                                        @error('berkas_ajb')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn bg-indigo mr-2 px-md-5">
                                    <i class="fas fa-save mr-1"></i> Simpan
                                </button>
                                <a href="{{ url()->previous() }}" class="btn btn-warning px-md-5">
                                    <i class="fas fa-undo-alt mr-1"></i> Batal
                                </a>
                            </div>
                        </div> <!-- .card footer -->
                    </form>
                </div>
            </div><!-- /.card -->
        </div> <!-- /.col -->
    </div><!-- /.row -->
@endSection

@section('script')
    <!-- InputMask -->
    <script src="{{ asset('lte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script>
        @if (old('kode_kab_wp') && old('kode_kec_wp') && old('kode_desa_wp'))
            UpdateKab('#kode_prov_wp', '#kode_kab_wp', '#kode_kec_wp',
            '#kode_desa_wp', "{{ old('kode_kab_wp') }}", "{{ old('kode_kec_wp') }}",
            "{{ old('kode_desa_wp') }}");
        @endif

        @if (old('kode_desa_nop'))
            UpdateDesa('#kode_kec_nop', '#kode_desa_nop', "{{ old('kode_desa_nop') }}", true);
        @endif

        $('[data-mask]').inputmask();

        function extractMaskToIntOnly(str) {
            var cnvrt = str.toString();
            cnvrt = cnvrt.split('_').join('');
            cnvrt = cnvrt.split(' ').join('');
            return cnvrt;
        }

        $('#nik_mask').keyup(function() {
            const val = $('#nik').val();

            if (val.length >= 16) {
                $.ajax({
                    method: 'get',
                    url: "{{ route('bphtb.search-wp') }}" + '?nik=' + val,
                    success: function(response) {
                        if (response.status == 'OK') {
                            const data = response.data;

                            if (data !== null) {

                                $('#nama_wp, #nama_penyetor').val(data.nama_wp);
                                $('#alamat_wp').val(data.alamat_wp);
                                $('#kode_prov_wp').val(data.kode_prov_wp);
                                $('#kode_prov_wp option[value="' + data.kode_prov_wp + '"]').attr(
                                    'selected', 'selected'
                                );
                                UpdateKab('#kode_prov_wp', '#kode_kab_wp', '#kode_kec_wp',
                                    '#kode_desa_wp', data.kode_kab_wp, data
                                    .kode_kec_wp, data.kode_desa_wp);
                                $('#rtrw_wp').val(data.rtrw_wp);
                                $('#kode_pos_wp').val(data.kode_pos_wp);

                                enableFormNop();
                            } else {
                                // emptyFormWp();
                            }
                        }
                    },
                });
            }
        });

        $('#nop_mask').keyup(function() {
            const val = $('#nop').val();

            if (val.length >= 18) {
                $.ajax({
                    method: 'get',
                    url: "{{ route('bphtb.search-nop') }}" + '?nop=' + val + '&nik=' + $('#nik').val(),
                    success: function(response) {
                        if (response.status == 'OK') {
                            const data = response.data;

                            if (data !== null) {
                                $('#nik_sebelumnya').val(data.nik);
                                $('#nama_wp_sebelumnya').val(data.nama_wp);
                                $('#letak_nop').val(data.letak_nop);
                                $('#kode_kec_nop').val(data.kode_kec_nop);
                                $('#kode_kec_nop option[value="' + data.kode_kec_nop + '"]').attr(
                                    'selected', 'selected'
                                );
                                $('#rtrw_nop').val(data.rtrw_nop);
                                $('#kode_jenis_perolehan').val(data.kode_jenis_perolehan);
                                $('#kode_jenis_perolehan option[value="' + data.kode_jenis_perolehan +
                                        '"]')
                                    .attr('selected', 'selected');
                                $('#no_sertifikat').val(data.no_sertifikat);
                                $('#luas_tanah').val(data.luas_tanah);
                                $('#luas_bangunan').val(data.luas_bangunan);
                                // $('#njop_tanah').val(num_id(data.njop_tanah));
                                // $('#njop_bangunan').val(num_id(data.njop_bangunan));
                                $('#hak_nilai_pasar').val(num_id(data.hak_nilai_pasar));
                                UpdateDesa('#kode_kec_nop', '#kode_desa_nop', data.kode_desa_nop, true);
                            } else {
                                // emptyFormNop();
                            }
                        }
                    },
                });
            } else {
                emptyFormNop();
            }
        });

        function UpdateKab(id_prov, id_kab, id_kec, id_desa, kab_val, kec_val, desa_val) {
            let provinsi = $(id_prov).val()
            $(id_kab).children().remove()
            $(id_kab).val('');
            $(id_kab).append('<option value="">Pilih Kabupaten</option>');
            $(id_kab).prop('disabled', true)
            UpdateKec(id_kab, id_kec, id_desa)
            UpdateDesa(id_kec, id_desa)
            if (provinsi != '' && provinsi != null) {
                $.ajax({
                    url: "{{ url('') }}/alamat/pilih/kab/" + provinsi,
                    success: function(res) {
                        $(id_kab).prop('disabled', false)
                        $.each(res, function(index, element) {
                            $(id_kab).append('<option value=' + element.kode_kab + '>' + element
                                .nama_kab + '</option>');
                        })

                        if (kab_val !== undefined) {
                            $(id_kab + ' option[value="' + kab_val + '"]').attr(
                                'selected', 'selected'
                            );

                            UpdateKec('#kode_kab_wp', '#kode_kec_wp', '#kode_desa_wp', kec_val, desa_val);
                        }
                    }
                });
            }
        }

        function UpdateKec(id_kab, id_kec, id_desa, kec_val, desa_val) {
            let kabupaten = $(id_kab).val()
            $(id_kec).children().remove()
            $(id_kec).val('');
            $(id_kec).append('<option value="">Pilih Kecamatan</option>');
            $(id_kec).prop('disabled', true)
            UpdateDesa(id_kec, id_desa)
            if (kabupaten != '' && kabupaten != null) {
                $.ajax({
                    url: "{{ url('') }}/alamat/pilih/kec/" + kabupaten,
                    success: function(res) {
                        $(id_kec).prop('disabled', false)
                        $.each(res, function(index, element) {
                            $(id_kec).append(
                                '<option value=' + element.kode_kec + '>' + element.nama_kec +
                                '</option>'
                            );
                        });

                        if (kec_val !== undefined) {
                            $(id_kec + ' option[value="' + kec_val + '"]').attr(
                                'selected', 'selected'
                            );

                            UpdateDesa('#kode_kec_wp', '#kode_desa_wp', desa_val);
                        }
                    }
                });
            }
        }

        function UpdateDesa(id_kec, id_desa, desa_val, run_kalkukasi_bphtb = false) {
            let kecamatan = $(id_kec).val()
            $(id_desa).children().remove()
            $(id_desa).val('');
            $(id_desa).append('<option value="">Pilih Desa</option>');
            $(id_desa).prop('disabled', true)
            if (kecamatan != '' && kecamatan != null) {
                $.ajax({
                    url: "{{ url('') }}/alamat/pilih/desa/" + kecamatan,
                    success: function(res) {
                        $(id_desa).prop('disabled', false)
                        $.each(res, function(index, element) {
                            $(id_desa).append(
                                '<option value=' + element.kode_desa + '>' +
                                element.nama_desa +
                                '</option>');
                        });

                        if (desa_val !== undefined) {
                            $(id_desa + ' option[value="' + desa_val + '"]').attr(
                                'selected', 'selected'
                            );
                        }

                    }
                });
            }
        }

        function num_sys(x) {
            if (x === null || x == "" || x === undefined) {
                return 0;
            } else {
                x = x.replace(/\./g, "");
                x = x.replace(",", ".");
                return x;
            }
        }

        function num_id(bilangan) {
            if (bilangan === null) {
                return 0;
            } else {
                var negativ = false;

                if (bilangan < 0) {
                    bilangan = bilangan * -1;
                    negativ = true;
                }

                var number_string = bilangan.toString(),
                    split = number_string.split("."),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{1,3}/gi);

                if (ribuan) {
                    separator = sisa ? "." : "";
                    rupiah += separator + ribuan.join(".");
                }

                rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;

                // Cetak hasil
                if (negativ == true) {
                    rupiah = "-" + rupiah;
                }
                return rupiah;
            }
        }

        // keyup number format
        var hak_nilai_pasar = document.getElementById('hak_nilai_pasar');
        hak_nilai_pasar.addEventListener('keyup', function(e) {
            hak_nilai_pasar.value = formatRupiah(this.value);
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

        function toNop() {
            var nop = extractMaskToIntOnly($('#nop_mask').val().toString());
            $('#nop').val(nop);
        }

        disableFormNop();

        function disableFormNop() {
            $('#nop_mask').attr('disabled', 'disabled');
            $('#letak_nop').attr('disabled', 'disabled');
            $('#kode_kab_nop').attr('disabled', 'disabled');
            $('#kode_kec_nop').attr('disabled', 'disabled');
            $('#kode_desa_nop').attr('disabled', 'disabled');
            $('#rtrw_nop').attr('disabled', 'disabled');
            $('#kode_jenis_perolehan').attr('disabled', 'disabled');
            $('#no_sertifikat').attr('disabled', 'disabled');
            $('#luas_tanah').attr('disabled', 'disabled');
            $('#luas_bangunan').attr('disabled', 'disabled');
            $('#hak_nilai_pasar').attr('disabled', 'disabled');
            $('#njop_pbb').attr('disabled', 'disabled');
        }

        enableFormNop();

        function enableFormNop() {
            var nik = extractMaskToIntOnly($('#nik_mask').val().toString());
            $('#nik').val(nik);
            if (nik.length >= 16) {
                $('#nop_mask').removeAttr('disabled', 'disabled');
                $('#letak_nop').removeAttr('disabled', 'disabled');
                $('#kode_kab_nop').removeAttr('disabled', 'disabled');
                $('#kode_kec_nop').removeAttr('disabled', 'disabled');
                $('#kode_desa_nop').removeAttr('disabled', 'disabled');
                $('#rtrw_nop').removeAttr('disabled', 'disabled');
                $('#kode_jenis_perolehan').removeAttr('disabled', 'disabled');
                $('#no_sertifikat').removeAttr('disabled', 'disabled');
                $('#luas_tanah').removeAttr('disabled', 'disabled');
                $('#luas_bangunan').removeAttr('disabled', 'disabled');
                $('#hak_nilai_pasar').removeAttr('disabled', 'disabled');
            } else {
                disableFormNop();
            }
        }

        function emptyFormWp() {
            $('#nama_wp').val('');
            $('#nama_penyetor').val('');
            $('#alamat_wp').val('');
            $('#kode_kab_wp').val('');
            $('#kode_kec_wp').val('');
            $('#kode_desa_wp').val('');
            $('#rtrw_wp').val('');
            $('#kode_pos_wp').val('');

            $('#kode_kec_wp').children().remove();
            $('#kode_kec_wp').val('');
            $('#kode_kec_wp').append('<option value="">Pilih Kecamatan</option>');
            $('#kode_kec_wp').prop('disabled', true);

            $('#kode_desa_wp').children().remove();
            $('#kode_desa_wp').val('');
            $('#kode_desa_wp').append('<option value="">Pilih Desa</option>');
            $('#kode_desa_wp').prop('disabled', true);
        }

        function emptyFormNop() {
            $('#nik_sebelumnya').val('');
            $('#nama_wp_sebelumnya').val('');
            $('#letak_nop').val('');
            $('#kode_kec_nop').val('');
            $('#kode_desa_nop').val('');
            $('#rtrw_nop').val('');
            $('#kode_jenis_perolehan').val('');
            $('#no_sertifikat').val('');
            $('#luas_tanah').val('');
            $('#luas_bangunan').val('');
            $('#hak_nilai_pasar').val('');
        }

        $('#kode_pos_wp, #luas_tanah, #luas_bangunan').keypress(function(e) {
            var charCode = (e.which) ? e.which : event.keyCode
            if (String.fromCharCode(charCode).match(/[^0-9]/g))
                return false;
        });

        $('#nama_wp').keyup(function() {
            $('#nama_penyetor').val($(this).val());
        });

        $(document).on('submit', 'form', function() {
            $('button').attr('disabled', 'disabled');

        });

        function loadPreviewGambar(input, id) {
            id = id || '#preview_img';
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                $(id).removeClass('d-none');
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
