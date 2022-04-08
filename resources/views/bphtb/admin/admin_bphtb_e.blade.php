@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

    <div class="row">
        <div class="col-12">
            <div class="card card-default card-outline">
                <div class="text-indigo">
                    <form action="{{ route('bphtb.update', ['id' => $data->id]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-header bg-indigo">
                            <h3 class="card-title">
                                <i class="fas fa-user-alt mr-2"></i>Profil Wajib Pajak
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row">
                                        {{-- <div class="col-sm-3">
                                            <img id="preview_img" src="{{ asset('upload/users/comp/default.jpg') }}"
                                    style="margin-bottom: 15px" class="" width="160"
                                    height="160" />
                                </div> --}}
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <label for="nik" class="col-md-3">NIK (KTP)</label>
                                                <div class="col-md-8">
                                                    <input type="text" id="nik_mask"
                                                        class="form-control @error('nik') is-invalid @enderror"
                                                        data-inputmask='"mask": "99 99 99 999999 9999"' data-mask
                                                        inputmode="numeric" value="{{ $data->nik }}" required
                                                        onkeyup="enableFormNop()">
                                                    <input type="hidden" name="nik" id="nik" value="{{ $data->nik }}"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="nama_wp" class="col-md-3">Nama</label>
                                                <div class="col-md-8">
                                                    <input name="nama_wp" id="nama_wp" type="text"
                                                        class="form-control @error('nama_wp') is-invalid @enderror"
                                                        value="{{ $data->nama_wp }}" required>
                                                    @error('nama_wp')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="alamat_wp" class="col-md-3">Alamat</label>
                                                <div class="col-md-8">
                                                    <input name="alamat_wp" id="alamat_wp" type="text"
                                                        class="form-control @error('alamat_wp') is-invalid @enderror"
                                                        value="{{ $data->alamat_wp }}" placeholder="Jl. Mawar" required>
                                                    @error('alamat_wp')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="kode_prov_wp" class="col-md-3">Provinsi</label>
                                                <div class="col-md-8">
                                                    <select id="kode_prov_wp" name="kode_prov_wp"
                                                        class="form-control @error('kode_prov_wp') is-invalid @enderror"
                                                        onchange="UpdateKab('#kode_prov_wp', '#kode_kab_wp', '#kode_kec_wp', '#kode_desa_wp')"
                                                        required>
                                                        <option value="">Pilih Provinsi</option>
                                                        @foreach ($dataProv as $item)
                                                            <option value="{{ $item->kode_prov }}"
                                                                {{ $item->kode_prov == $data->kode_prov_wp ? 'selected' : '' }}>
                                                                {{ $item->nama_prov }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('kode_prov_wp')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="kode_kab_wp" class="col-md-3">Kabupaten</label>
                                                <div class="col-md-8">
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
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label for="kode_kec_wp" class="col-md-3">Kecamatan</label>
                                        <div class="col-md-9">
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
                                    </div>

                                    <div class="form-group row">
                                        <label for="kode_desa_wp" class="col-md-3">Desa</label>
                                        <div class="col-md-9">
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
                                    </div>

                                    <div class="form-group row">
                                        <label for="rtrw_wp" class="col-md-3">RT / RW</label>
                                        <div class="col-md-9">
                                            <input name="rtrw_wp" id="rtrw_wp" type="text" maxlength="10"
                                                class="form-control @error('rtrw_wp') is-invalid @enderror"
                                                value="{{ $data->rtrw_nop }}" placeholder="01/02">
                                            @error('rtrw_wp')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="kode_pos_wp" class="col-md-3">Kode POS</label>
                                        <div class="col-md-9">
                                            <input name="kode_pos_wp" id="kode_pos_wp" type="text" maxlength="5"
                                                class="form-control @error('kode_pos_wp') is-invalid @enderror"
                                                value="{{ $data->kode_pos_wp }}">
                                            @error('kode_pos_wp')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
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
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label for="nop" class="col-sm-4 col-form-label">
                                            NOP
                                            <small>Nomor Objek Pajak</small>
                                        </label>
                                        <div class="col-sm-7">
                                            <input type="text" name="nop_mask" id="nop_mask"
                                                class="form-control @error('nop') is-invalid @enderror" required
                                                value="{{ $data->getFormatNopAttribute() }}" readonly>
                                            <input type="hidden" name="nop" id="nop" value="{{ $data->nop }}">
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
                                        <div class="col-sm-7">
                                            <input name="letak_nop" type="text" id="letak_nop"
                                                class="form-control @error('letak_nop') is-invalid @enderror"
                                                value="{{ $data->letak_nop }}" placeholder="Jl. Melati" required>
                                            @error('letak_nop')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="kode_kab_nop" class="col-sm-4 col-form-label">Kabupaten</label>
                                        <div class="col-sm-7">
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
                                        <div class="col-sm-7">
                                            <select id="kode_kec_nop" name="kode_kec_nop"
                                                onchange="UpdateDesa('#kode_kec_nop', '#kode_desa_nop', true)"
                                                class="form-control @error('kode_kec_nop') is-invalid @enderror" required>
                                                <option value="">Pilih Kecamatan</option>
                                                @foreach ($dataKec as $dKec)
                                                    <option value="{{ $dKec->kode_kec }}"
                                                        {{ $data->kode_kec_nop == $dKec->kode_kec ? 'selected' : '' }}>
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
                                        <div class="col-sm-7">
                                            <select id="kode_desa_nop" name="kode_desa_nop"
                                                class="form-control @error('kode_desa_nop') is-invalid @enderror"
                                                onchange="kalkulasiBphtb()" required>
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
                                        <div class="col-sm-7">
                                            <input name="rtrw_nop" type="text" id="rtrw_nop" maxlength="10"
                                                class="form-control @error('rtrw_nop') is-invalid @enderror"
                                                value="{{ $data->rtrw_nop }}" placeholder="01/02">
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
                                        <div class="col-sm-7">
                                            <select id="kode_jenis_perolehan" name="kode_jenis_perolehan"
                                                onchange="kalkulasiBphtb()"
                                                class="form-control @error('kode_jenis_perolehan') is-invalid @enderror"
                                                required>
                                                <option value="">Pilih Jenis Perolehan</option>
                                                @foreach ($dataJenisPerolehan as $dJP)
                                                    <option value="{{ $dJP->kode_jenis_perolehan }}"
                                                        {{ $data->kode_jenis_perolehan == $dJP->kode_jenis_perolehan ? 'selected' : '' }}>
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
                                        <div class="col-sm-7">
                                            <input name="no_sertifikat" type="text" id="no_sertifikat"
                                                class="form-control @error('no_sertifikat') is-invalid @enderror"
                                                value="{{ $data->no_sertifikat }}" required>
                                            @error('no_sertifikat')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-sm-1"></div> -->
                                <div class="col-sm-5">
                                    <div class="form-group row">
                                        <label for="luas_tanah" class="col-sm-4 col-form-label">Luas Tanah</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input name="luas_tanah" type="number" id="luas_tanah"
                                                    class="form-control decimal @error('luas_tanah') is-invalid @enderror"
                                                    value="{{ $data->luas_tanah }}" maxlength="12"
                                                    onchange="UpdateNjopPbb()" required>
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
                                                    value="{{ $data->luas_bangunan }}" maxlength="12"
                                                    onchange="UpdateNjopPbb()" required>
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
                                                <input name="njop_tanah" type="text" id="njop_tanah"
                                                    class="form-control integer @error('njop_tanah') is-invalid @enderror"
                                                    value="{{ $data->getJlNjopTanahAttribute() }}" maxlength="12"
                                                    onchange="UpdateNjopPbb()" required>
                                                @error('njop_tanah')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
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
                                                    class="form-control integer @error('njop_bangunan') is-invalid @enderror"
                                                    value="{{ $data->getJlNjopBangunanAttribute() }}" maxlength="12"
                                                    onchange="UpdateNjopPbb()" required>
                                                @error('njop_bangunan')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
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
                                                    class="form-control integer"
                                                    value="{{ $data->getJlTotalAttribute() }}" placeholder="Otomatis"
                                                    disabled>
                                            </div>
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
                                                    value="{{ $data->getFormatHakNilaiPasarAttribute() }}"
                                                    onchange="kalkulasiBphtb()" required>
                                                @error('hak_nilai_pasar')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .card Header -->

                        <div class="card-header bg-indigo">
                            <h3 class="card-title">
                                <i class="fas fa-calculator mr-2"></i> Penghitungan BPHTP <small>(Hanya diisi berdasarkan
                                    penghitungan Wajib Pajak)</small>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="npop" class="col-form-label">Nilai Perolehan Objek Pajak (NPOP)
                                            <br /><small><i>Memperhatikan nilai pada NJOP dan Nilai Transaksi/Nilai
                                                    Pasar.</i></small>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input name="npop" type="text" id="npop" class="form-control integer"
                                                value="{{ $data->getJlNpopAttribute() }}" placeholder="NPOP" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="npoptkp" class="col-form-label">Nilai Perolehan Objek Pajak Tidak Kena
                                            Pajak (NPOPTKP)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input name="npoptkp" type="text" id="npoptkp" class="form-control integer"
                                                value="{{ $data->getJlNpoptkpAttribute() }}" placeholder="NPOPTKP"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="npopkp" class="col-form-label">
                                            Nilai Perolehan Objek Pajak Kena Pajak (NPOPKP)
                                            <br />
                                            <small><i>NPOP dikurangi dengan NPOPTKP</i></small>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input name="npopkp" type="text" id="npopkp" class="form-control integer"
                                                value="{{ $data->getJlNpoptpAttribute() }}" placeholder="NPOPKP"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah" class="col-form-label">
                                            BPHTB Terutang
                                            <br />
                                            <small>
                                                <i>Memperhatikan nilai pada NJOP dan Nilai
                                                    Transaksi/Nilai Pasar.</i>
                                            </small>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input name="jumlah" type="text" id="jumlah" class="form-control integer"
                                                value="{{ $data->getJlBphtbAttribute() }}" placeholder="Jumlah Terutang"
                                                readonly>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div> <!-- .card body -->

                        <div class="card-header bg-indigo">
                            <h3 class="card-title">
                                <i class="fas fa-certificate mr-2"></i> Setoran BPHTB
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="npop" class="col-form-label">
                                            Jumlah Setoran Berdasarkan:
                                        </label>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="opsi_a" value="opsi_a"
                                                name="customRadio">
                                            <label for="opsi_a" class="custom-control-label">
                                                A. Penghitungan Wajib Pajak</label>
                                        </div>
                                        <br />
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="opsi_b" value="opsi_b"
                                                name="customRadio" checked>
                                            <label for="opsi_b" class="custom-control-label">
                                                B. STPD BPHTB / SKPD Kurang Bayar / SKPDB Kurang Bayar Tambahan.</label>
                                            <div class="form-group row">
                                                <p for="no_b" class="col-sm-4">Nomor</p>
                                                <div class="col-sm-8">
                                                    <input name="no_b" type="text" id="no_b"
                                                        class="form-control @error('no_b') is-invalid @enderror"
                                                        value="{{ $data->no_b }}" readonly>
                                                </div>
                                                <p for="tgl_b" class="col-sm-4">Tanggal</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <input name="tgl_b" type="date" id="tgl_b"
                                                            class="form-control @error('tgl_b') is-invalid @enderror"
                                                            min="{{ $data->tgl_b }}" value="{{ $data->tgl_b }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="opsi_c" value="opsi_c"
                                                name="customRadio">
                                            <label for="opsi_c" class="custom-control-label">
                                                C. Pengurangan dihitung sendiri
                                            </label>
                                            <div class="form-group row">
                                                <p for="persen_c" class="col-sm-4">Menjadi (Persen)</p>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <input name="persen_c" type="text" id="persen_c"
                                                            class="form-control decimal @error('persen_c') is-invalid @enderror"
                                                            value="{{ old('persen_c') }}" placeholder="Persen">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p for="uraian_c" class="col-sm-4">Berdasarkan KHD No. </p>
                                                <div class="col-sm-8">
                                                    <input name="uraian_c" type="text" id="uraian_c"
                                                        class="form-control @error('uraian_c') is-invalid @enderror"
                                                        value="{{ old('uraian_c') }}" placeholder="Peraturan KHD No.">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="opsi_d" value="opsi_d"
                                                name="customRadio">
                                            <label for="opsi_d" class="custom-control-label">D. Lainnya</label>
                                            <input name="uraian_d" type="text" id="uraian_d"
                                                class="form-control @error('uraian_c') is-invalid @enderror"
                                                value="{{ old('uraian_d') }}" placeholder="Lainnya.">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-1"></div>
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label for="jumlah_setor" class="col-form-label col-md-4">
                                            Jumlah Disetor
                                        </label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input name="jumlah_setor" type="text" id="jumlah_setor"
                                                    class="form-control integer @error('jumlah_setor') is-invalid @enderror"
                                                    value="{{ $data->getJlSetorAttribute() }}" placeholder="Otomatis"
                                                    required>
                                            </div>
                                            @error('jumlah_setor')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <small>
                                                <i>(Berdasarkan perhitungan BPHTB terutang
                                                    dan Opsi Setoran
                                                    BPHTB)</i>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="no_rekening_bank" class="col-form-label col-md-4">Rekening Setoran
                                        </label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <select name="no_rekening_bank" id="no_rekening_bank"
                                                    class="form-control @error('no_rekening_bank') is-invalid @enderror"
                                                    required>
                                                    <option value="">Pilih No Rekening</option>
                                                    @foreach ($ref_rekening as $item)
                                                        <option value="{{ $item->no_rekening }}"
                                                            {{ $data->no_rekening_bank == $item->no_rekening ? 'selected' : '' }}>
                                                            {{ $item->no_rekening }} - {{ $item->nama_rekening }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('no_rekening_bank')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nama_penyetor" class="col-form-label col-md-4">Nama Penyetor</label>
                                        <div class="col-md-6">
                                            <input name="nama_penyetor" type="text" id="nama_penyetor"
                                                class="form-control @error('nama_penyetor') is-invalid @enderror"
                                                value="{{ $data->nama_penyetor }}" required>
                                            @error('nama_penyetor')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tgl_setor" class="col-form-label col-md-4">Tanggal Setor</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <input name="tgl_setor" type="date" id="tgl_setor" class="form-control "
                                                    value="{{ $data->tgl_setor }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- TANGGAL BPHTB DI NONANTIFKAN KARNA RAWAN ERROR --}}
                                    {{-- TANGGAL BPHTB BERFUNSI UNTUK MENENTUKAN KENA NPOPTK ATAU TIDAK --}}
                                    <div class="form-group row">
                                        <label for="tgl_bphtb" class="col-form-label col-md-4">Tanggal BPHTB</label>
                                        <div class="col-md-6">
                                            <input name="tgl_bphtb" type="date" id="tgl_bphtb" class="form-control"
                                                value="{{ $data->tgl_bphtb }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .card body -->

                        <div class="card-header bg-indigo">
                            <h3 class="card-title">
                                <i class="fas fa-certificate mr-2"></i> Otorisasi
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group row">
                                        <label for="diterima_id" class="col-form-label col-md-4">Diterima oleh</label>
                                        <div class="col-md-8">
                                            <select name="diterima_id" id="diterima_id"
                                                class="form-control @error('diterima_id') is-invalid @enderror"
                                                aria-placeholder="Diterima oleh">
                                                <option value="">Diterima oleh (boleh dikosongkan)</option>
                                                @foreach ($penandatangan_diterima as $diterima)
                                                    <option value="{{ $diterima->id }}"
                                                        {{ $data->nip_diterima == $diterima->nip_penandatangan ? 'selected' : '' }}>
                                                        {{ $diterima->nip_penandatangan }} -
                                                        {{ $diterima->nama_penandatangan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tgl_diterima" class="col-form-label col-md-4">Tanggal diterima</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <input name="tgl_diterima" type="date" id="tgl_diterima"
                                                    class="form-control @error('tgl_diterima') is-invalid @enderror"
                                                    value="{{ old('tgl_diterima') ? old('tgl_diterima') : $data->tgl_diterima }}">
                                                @error('tgl_diterima')
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
                                    <div class="form-group row">
                                        <label for="diverifikasi_id" class="col-form-label col-md-4">Diverifikasi
                                            oleh</label>
                                        <div class="col-md-8">
                                            <select name="diverifikasi_id" id="diverifikasi_id"
                                                class="form-control @error('diverifikasi_id') is-invalid @enderror"
                                                aria-placeholder="Telah diverifikasi oleh">
                                                <option value="">Diverifikasi oleh (boleh dikosongkan)</option>
                                                @foreach ($penandatangan_diverifikasi as $diverifikasi)
                                                    <option value="{{ $diverifikasi->id }}"
                                                        {{ $data->nip_verifikator == $diverifikasi->nip_penandatangan ? 'selected' : '' }}>
                                                        {{ $diverifikasi->nip_penandatangan }} -
                                                        {{ $diverifikasi->nama_penandatangan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tgl_diverifikasi" class="col-form-label col-md-4">Tanggal
                                            diverifikasi</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <input name="tgl_diverifikasi" type="date" id="tgl_diverifikasi"
                                                    class="form-control @error('tgl_diverifikasi') is-invalid @enderror"
                                                    value="{{ old('tgl_diverifikasi') ? old('tgl_diverifikasi') : $data->tgl_verifikasi }}">
                                                @error('tgl_diverifikasi')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- .card body -->

                        <div class="card-footer">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn bg-indigo mr-2 px-md-5">
                                    <i class="fas fa-save mr-1"></i> Simpan
                                </button>
                                <a href="{{ route('bphtb.show', ['id' => $data->id]) }}"
                                    class="btn btn-warning px-md-5">
                                    <i class="fas fa-undo-alt mr-1"></i> Batal
                                </a>
                            </div>
                        </div>
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

                                $('#nama_wp').val(data.nama_wp);
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
                                emptyFormWp();
                            }
                        }
                    },
                });
            }
        });

        $('#nop').keyup(function() {
            const val = $(this).val();

            if (val.length >= 18) {
                $.ajax({
                    method: 'get',
                    url: "{{ route('bphtb.search-nop') }}" + '?nop=' + val + '&nik=' + $('#nik')
                        .val(),
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
                                $('#njop_tanah').val(num_id(data.njop_tanah));
                                $('#njop_bangunan').val(num_id(data.njop_bangunan));
                                $('#hak_nilai_pasar').val(num_id(data.hak_nilai_pasar));
                                UpdateDesa('#kode_kec_nop', '#kode_desa_nop', data.kode_desa_nop, true);
                                UpdateNjopPbb();
                            } else {
                                emptyFormNop();
                            }
                        }
                    },
                });
            } else {
                emptyFormNop();
            }
        });

        UpdateKab('#kode_prov_wp', '#kode_kab_wp', '#kode_kec_wp',
            '#kode_desa_wp', "{{ $data->kode_kab_wp }}", "{{ $data->kode_kec_wp }}",
            "{{ $data->kode_desa_wp }}");

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

        UpdateDesa('#kode_kec_nop', '#kode_desa_nop', "{{ $data->kode_desa_nop }}", true);

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

                            if (run_kalkukasi_bphtb) {
                                kalkulasiBphtb();
                            }
                        }

                    }
                });
            }
        }

        function UpdateNjopPbb() {
            let luasTanah = ($('#luas_tanah').val() != '' ? num_sys($('#luas_tanah').val()) : '0')
            let luasBangunan = ($('#luas_bangunan').val() != '' ? num_sys($('#luas_bangunan').val()) : '0')
            let njopTanah = ($('#njop_tanah').val() != '' ? num_sys($('#njop_tanah').val()) : '0')
            let njopBangunan = ($('#njop_bangunan').val() != '' ? num_sys($('#njop_bangunan').val()) : '0')
            let jumlahNjopTanah = parseFloat(luasTanah) * parseFloat(njopTanah);
            let jumlahNjopBangunan = parseFloat(luasBangunan) * parseFloat(njopBangunan);

            let njob_pbb = parseFloat(jumlahNjopTanah) + parseFloat(jumlahNjopBangunan);
            $("#njop_pbb").val(num_id(njob_pbb));
            kalkulasiBphtb();
        }

        function kalkulasiBphtb() {
            const nilai_pasar = $("#hak_nilai_pasar").val()
            const njop_pbb = $("#njop_pbb").val();

            if (parseInt(num_sys(nilai_pasar)) > parseInt(num_sys(njop_pbb))) {
                $("#npop").val(nilai_pasar);
            } else {
                $("#npop").val(njop_pbb);
            }

            const kepada = $('#nik').val();
            const nop = $("#nop").val();
            const npop = $("#npop").val();
            const kode_jp = $('#kode_jenis_perolehan').val();
            const kode_desa = $('#kode_desa_nop').val();
            const no_b = "{{ $data->no_b }}";
            const tgl_setor = "{{ $data->tgl_setor }}";
            const tgl_bphtb = "{{ $data->tgl_bphtb }}";

            $.ajax({
                method: 'get',
                url: "{{ route('bphtb.kalkulasi-bphtb') }}" + '?kepada=' + kepada + '&nop=' + nop + '&kode_jp=' +
                    kode_jp + '&kode_desa=' + kode_desa + '&no_b=' + no_b + '&tgl_setor=' +
                    tgl_setor + '&tgl_bphtb=' + tgl_bphtb + '&edit=' + "{{ $data->npoptkp }}",
                success: function(response) {
                    if (response.status == 'OK') {
                        const npoptkp = response.npoptkp;
                        const tarif_bphtb = response.tarif_bphtb[0].persen_tarif_bphtb;
                        let jml_nop = num_sys(npop) - npoptkp;
                        jml_nop = jml_nop > 0 ? jml_nop : 0;
                        const no_urut = response.no_urut;

                        $('#npopkp').val(num_id(jml_nop));
                        // $('#npoptkp').val(num_id(npoptkp));
                        $('#jumlah, #jumlah_setor').val(num_id(jml_nop * tarif_bphtb));
                        $('#no_b').val(no_urut);
                    }
                }
            });
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
        var njop_tanah = document.getElementById('njop_tanah');
        njop_tanah.addEventListener('keyup', function(e) {
            njop_tanah.value = formatRupiah(this.value);
        });

        var njop_bangunan = document.getElementById('njop_bangunan');
        njop_bangunan.addEventListener('keyup', function(e) {
            njop_bangunan.value = formatRupiah(this.value);
        });

        var hak_nilai_pasar = document.getElementById('hak_nilai_pasar');
        hak_nilai_pasar.addEventListener('keyup', function(e) {
            hak_nilai_pasar.value = formatRupiah(this.value);
        });

        var jumlah_setor = document.getElementById('jumlah_setor');
        jumlah_setor.addEventListener('keyup', function(e) {
            jumlah_setor.value = formatRupiah(this.value);
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

        function disableFormNop() {
            $('#letak_nop').attr('disabled', 'disabled');
            $('#kode_kab_nop').attr('disabled', 'disabled');
            $('#kode_kec_nop').attr('disabled', 'disabled');
            $('#kode_desa_nop').attr('disabled', 'disabled');
            $('#rtrw_nop').attr('disabled', 'disabled');
            $('#kode_jenis_perolehan').attr('disabled', 'disabled');
            $('#no_sertifikat').attr('disabled', 'disabled');
            $('#luas_tanah').attr('disabled', 'disabled');
            $('#luas_bangunan').attr('disabled', 'disabled');
            $('#njop_tanah').attr('disabled', 'disabled');
            $('#njop_bangunan').attr('disabled', 'disabled');
            $('#hak_nilai_pasar').attr('disabled', 'disabled');
            $('#njop_pbb').attr('disabled', 'disabled');
        }

        function enableFormNop() {
            var nik = extractMaskToIntOnly($('#nik_mask').val().toString());
            $('#nik').val(nik);
            if ($('#nik').val().length >= 16) {
                $('#letak_nop').removeAttr('disabled', 'disabled');
                $('#kode_kab_nop').removeAttr('disabled', 'disabled');
                $('#kode_kec_nop').removeAttr('disabled', 'disabled');
                $('#kode_desa_nop').removeAttr('disabled', 'disabled');
                $('#rtrw_nop').removeAttr('disabled', 'disabled');
                $('#kode_jenis_perolehan').removeAttr('disabled', 'disabled');
                $('#no_sertifikat').removeAttr('disabled', 'disabled');
                $('#luas_tanah').removeAttr('disabled', 'disabled');
                $('#luas_bangunan').removeAttr('disabled', 'disabled');
                $('#njop_tanah').removeAttr('disabled', 'disabled');
                $('#njop_bangunan').removeAttr('disabled', 'disabled');
                $('#hak_nilai_pasar').removeAttr('disabled', 'disabled');
            } else {
                disableFormNop();
            }
        }

        function emptyFormWp() {
            $('#nama_wp').val('');
            $('#alamat_wp').val('');
            $('#kode_prov_wp').val('');
            $('#kode_kab_wp').val('');
            $('#kode_kec_wp').val('');
            $('#kode_desa_wp').val('');
            $('#rtrw_wp').val('');
            $('#kode_pos_wp').val('');

            $('#kode_prov_wp').val('');
            $('#kode_prov_wp').append('<option value="">Pilih Provinsi</option>');

            $('#kode_kab_wp').children().remove();
            $('#kode_kab_wp').val('');
            $('#kode_kab_wp').append('<option value="">Pilih Kabupaten</option>');
            $('#kode_kab_wp').prop('disabled', true);

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
            $('#njop_tanah').val('');
            $('#njop_bangunan').val('');
            $('#hak_nilai_pasar').val('');
            $('#njop_pbb').val('');
        }

        $('#kode_pos_wp, #nop, #luas_tanah, #luas_bangunan').keypress(function(e) {
            var charCode = (e.which) ? e.which : event.keyCode
            if (String.fromCharCode(charCode).match(/[^0-9]/g))
                return false;
        });

        $(document).on('submit', 'form', function() {
            $('button').attr('disabled', 'disabled');

        });
    </script>
@endsection
