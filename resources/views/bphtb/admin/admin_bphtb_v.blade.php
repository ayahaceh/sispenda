@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

    <div class="row">
        <div class="col-12">
            <div class="card card-default card-outline">
                <div class="text-indigo">
                    <div class="card-header bg-indigo">
                        <h3 class="card-title">
                            <i class="fas fa-user-alt mr-2"></i>Profil Wajib Pajak
                        </h3>
                        <div class="card-tools">
                            <ul class="pagination pagination-sm">
                                <li class="page-item">
                                    <a href="{{ route('bphtb') }}" class="page-link text-indigo">
                                        <i class="fas fa-angle-double-left text-indigo mr-2"></i>
                                        Kembali
                                    </a>
                                </li>
                                @if ($is_deleted)
                                    <li class="page-item">
                                        <a href="javascript:void(0)" class="page-link text-indigo"
                                            onclick="restore('{{ route('bphtb.restore', ['id' => $data->id]) }}')">
                                            <i class="fa fa-recycle mr-1"></i>
                                            Restore
                                        </a>
                                    </li>
                                @endif
                                @if (!$is_deleted)
                                    @if (Auth::user()->user_group <= USER_ADMIN)
                                        <li class="page-item">
                                            <a href="javascript:void(0)" class="page-link text-indigo"
                                                onclick="modeEdit('{{ route('bphtb.edit', ['id' => $data->id]) }}')">
                                                <i class="fas fa-edit mr-1"></i>
                                                Edit Transaksi
                                            </a>
                                        </li>
                                        <li class="page-item">
                                            <a href="javascript:void(0)" class="page-link text-indigo"
                                                onclick="hapus('{{ route('bphtb.delete', ['id' => $data->id]) }}')">
                                                <i class="fas fa-trash mr-1"></i>
                                                Hapus
                                            </a>
                                        </li>
                                    @elseif (Auth::user()->user_group == USER_OPERATOR && $data->status_bphtb == STATUS_BPHTB_BELUM_DISETUJUI)
                                        <li class="page-item">
                                            <a href="javascript:void(0)" class="page-link text-indigo"
                                                onclick="modeEdit('{{ route('bphtb.edit', ['id' => $data->id]) }}')">
                                                <i class="fas fa-edit mr-1"></i>
                                                Edit Transaksi
                                            </a>
                                        </li>
                                        <li class="page-item">
                                            <a href="javascript:void(0)" class="page-link text-indigo"
                                                onclick="hapus('{{ route('bphtb.delete', ['id' => $data->id]) }}')">
                                                <i class="fas fa-trash mr-1"></i>
                                                Hapus
                                            </a>
                                        </li>
                                    @endif
                                    
                                        <li class="page-item">
                                            <div class="dropdown">
                                                <button class="page-link text-indigo cetak dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    <i class="fas fa-print text-indigo mr-2"></i>
                                                    Cetak
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                    aria-labelledby="dropdownMenuButton">
                                                    @if ($data->status_pembayaran == STATUS_PEMBAYARAN_LUNAS && $data->status_bphtb == STATUS_BPHTB_SUDAH_DISETUJUI)
                                                    <a class="dropdown-item" target="_blank"
                                                        href="{{ route('bphtb.laporan', ['id' => $data->id]) }}">
                                                        Cetak Semua
                                                    </a>
                                                    <a class="dropdown-item" target="_blank"
                                                        href="{{ route('bphtb.laporan', ['id' => $data->id]) }}?only_one=true">
                                                        Cetak Kustom
                                                    </a>
                                                     @endif
                                                     <a class="dropdown-item text-indigo" target="_blank" href="{{ route('bphtb.verifikasi.show', ['id' => $data->id]) }}">
                                                        Ringkasan
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="row">
                                    {{-- <div class="col-sm-3">
                                        <img id="preview_img" src="{{ $data->file_foto }}" style="margin-bottom: 15px"
                                class="" width="160" height="160" />
                            </div> --}}
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>NIK (KTP)</label>
                                            <input name="nik_profil" id="nik_profil" type="text" class="form-control"
                                                value="{{ $data->nik }}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_wp">Nama</label>
                                            <input id="nama_wp" name="nama_wp" class="form-control"
                                                value="{{ $data->nama_wp }}" required disabled />
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <input name="alamat_profil" id="alamat_profil" type="text"
                                                class="form-control" value="{{ $data->alamat_wp }}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Provinsi</label>
                                            <input name="kab_profil" id="kab_profil" type="text" class="form-control"
                                                value="{{ $data->joinProvWp->nama_prov }}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Kabupaten</label>
                                            <input name="kab_profil" id="kab_profil" type="text" class="form-control"
                                                value="{{ $data->joinKabWp->nama_kab }}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-1"></div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <input name="kec_profil" id="kec_profil" type="text" class="form-control"
                                        value="{{ $data->joinKecWp->nama_kec }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Desa</label>
                                    <input name="desa_profil" id="desa_profil" type="text" class="form-control"
                                        value="{{ $data->joinDesaWp->nama_desa }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="rtrw_wp">RT / RW</label>
                                    <input id="rtrw_wp" name="rtrw_wp" class="form-control"
                                        value="{{ $data->rtrw_wp }}" required disabled />
                                </div>
                                <div class="form-group">
                                    <label for="kode_pos_wp">Kode POS</label>
                                    <input id="kode_pos_wp" name="kode_pos_wp" class="form-control"
                                        value="{{ $data->kode_pos_wp }}" required disabled />
                                </div>
                            </div> <!-- .col-sm-6 -->
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
                                    <label for="nop" class="col-sm-4 col-form-label">
                                        NOP
                                        <small>Nomor Objek Pajak</small>
                                    </label>
                                    <div class="col-sm-8">
                                        <input name="nop" type="text" id="nop" class="form-control"
                                            placeholder="Ketik No Objek Pajak" value="{{ $data->nop }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="letak_nop" class="col-sm-4 col-form-label">Letak
                                        <small>(Tanah/Bangunan)</small>
                                    </label>
                                    <div class="col-sm-8">
                                        <input name="letak_nop" type="text" id="letak_nop" class="form-control "
                                            placeholder="Letak Lokasi Tanah / Bangunan" value="{{ $data->letak_nop }}"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kode_kab_nop" class="col-sm-4 col-form-label">Kabupaten</label>
                                    <div class="col-sm-8">
                                        <select id="kode_kab_nop" name="kode_kab_nop" class="form-control" required>
                                            <option value="">
                                                {{ $data->joinKabNop->nama_kab }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kode_kec_nop" class="col-sm-4 col-form-label">Kecamatan</label>
                                    <div class="col-sm-8">
                                        <select id="kode_kec_nop" name="kode_kec_nop" class="form-control " required>
                                            <option value="">
                                                {{ $data->joinKecNop->nama_kec }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kode_desa_nop" class="col-sm-4 col-form-label">Desa</label>
                                    <div class="col-sm-8">
                                        <select id="kode_desa_nop" name="kode_desa_nop" class="form-control" required>
                                            <option value="">
                                                {{ $data->joinDesaNop->nama_desa }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="rtrw_nop" class="col-sm-4 col-form-label">RT / RW </label>
                                    <div class="col-sm-8">
                                        <input name="rtrw_nop" type="text" id="rtrw_nop" maxlength="10"
                                            class="form-control " value="{{ $data->rtrw_nop }}" placeholder="RT / RW"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kode_jenis_perolehan" class="col-sm-4 col-form-label">Jenis Perolehan
                                        <small>(atas Tanah/Bangunan)</small></label>
                                    <div class="col-sm-8">
                                        <select id="kode_jenis_perolehan" name="kode_jenis_perolehan" class="form-control "
                                            required>
                                            <option value="">
                                                {{ $data->joinKodeJenisPerolehan->nama_jenis_perolehan }}
                                            </option>
                                        </select>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="no_sertifikat" class="col-sm-4 col-form-label">Nomor Sertifikat</label>
                                    <div class="col-sm-8">
                                        <input name="no_sertifikat" type="text" id="no_sertifikat" class="form-control"
                                            placeholder="Nomor Sertifikat" value="{{ $data->no_sertifikat }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-sm-5">
                                <div class="form-group row">
                                    <label for="luas_tanah" class="col-sm-4 col-form-label">Luas Tanah</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input name="luas_tanah" type="text" id="luas_tanah"
                                                class="form-control decimal" laceholder="Luas Tanah"
                                                value="{{ $data->getJlLuasTanahAttribute() }}" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">M<sup>2</sup></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="luas_bangunan" class="col-sm-4 col-form-label">Luas Bangunan</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input name="luas_bangunan" type="text" id="luas_bangunan"
                                                class="form-control decimal " placeholder="Luas Bangunan"
                                                value="{{ $data->getJlLuasBangunanAttribute() }}" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text">M<sup>2</sup></span>
                                            </div>
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
                                                class="form-control integer" maxlength="12" placeholder="NJOP Bangunan"
                                                value="{{ number_format($data->njop_tanah, 0, ',', '.') }}" required>
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
                                                class="form-control integer " placeholder="NJOP Bangunan"
                                                value="{{ number_format($data->njop_bangunan, 0, ',', '.') }}" required>
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
                                            <input name="njop_pbb" type="text" id="njop_pbb" class="form-control integer"
                                                placeholder="NJOP PBB" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="hak_nilai_pasar" class="col-sm-4 col-form-label">Hak
                                        <small>(Transaksi/Nilai Pasar)</small></label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp.</span>
                                            </div>
                                            <input name="hak_nilai_pasar" type="text" id="hak_nilai_pasar"
                                                class="form-control integer" placeholder="Hak Transaksi / Nilai Pasar"
                                                value="{{ number_format($data->hak_nilai_pasar, 0, ',', '.') }}"
                                                required>
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
                                            value="{{ number_format($data->npop, 0, ',', '.') }}" placeholder="NPOP"
                                            readonly>
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
                                            value="{{ number_format($data->npoptkp, 0, ',', '.') }}"
                                            placeholder="NPOPTKP" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-1"></div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="npopkp" class="col-form-label">Nilai Perolehan Objek Pajak Kena Pajak
                                        (NPOPKP)
                                        <br /><small><i>NPOP dikurangi dengan NPOPTKP</i></small>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input name="npopkp" type="text" id="npopkp" class="form-control integer"
                                            value="{{ number_format($data->npopkp, 0, ',', '.') }}" placeholder="NPOPKP"
                                            readonly>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah" class="col-form-label">Bea Perolehan Hak atas Tanah dan
                                        Bangunan yang terutang
                                        <br /><small><i>Memperhatikan nilai pada NJOP dan Nilai Transaksi/Nilai
                                                Pasar.</i></small>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input name="jumlah" type="text" id="jumlah" class="form-control integer"
                                            value="{{ number_format($data->jumlah_bphtb, 0, ',', '.') }}"
                                            placeholder="jumlah terutang" readonly>
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
                                    <label for="npop" class="col-form-label">Jumlah Setoran Berdasarkan : </label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="opsi_a" value="opsi_a"
                                            name="customRadio">
                                        <label for="opsi_a" class="custom-control-label">A. Penghitungan Wajib
                                            Pajak</label>
                                    </div>
                                    <br />
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="opsi_b" value="opsi_b"
                                            name="customRadio" checked>
                                        <label for="opsi_b" class="custom-control-label">B. STPD BPHTB / SKPD Kurang
                                            Bayar / SKPDB Kurang Bayar Tambahan.</label>
                                        <div class="form-group row">
                                            <p for="no_b" class="col-sm-4">Nomor</p>
                                            <div class="col-sm-8">
                                                <input name="no_b" type="text" id="no_b" class="form-control"
                                                    value="{{ $data->no_b }}" disabled>
                                            </div>
                                            <p for="tgl_b" class="col-sm-4">Tanggal</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input name="tgl_b" type="date" id="tgl_b" class="form-control"
                                                        value="{{ $data->tgl_b }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="opsi_c" value="opsi_c"
                                            name="customRadio">
                                        <label for="opsi_c" class="custom-control-label">C. Pengurangan dihitung
                                            sendiri</label>
                                        <div class="form-group row">
                                            <p for="persen_c" class="col-sm-4">Menjadi (Persen)</p>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input name="persen_c" type="text" id="persen_c"
                                                        class="form-control decimal" value="{{ $data->persen_c }}"
                                                        placeholder="Persen" disabled>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <p for="uraian_c" class="col-sm-4">Berdasarkan KHD No. </p>
                                            <div class="col-sm-8">
                                                <input name="uraian_c" type="text" id="uraian_c" class="form-control "
                                                    value="{{ $data->uraian_c }}" placeholder="Peraturan KHD No."
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="opsi_d" value="opsi_d"
                                            name="customRadio">
                                        <label for="opsi_d" class="custom-control-label">D. Lainnya</label>
                                        <input name="uraian_d" type="text" id="uraian_d" class="form-control "
                                            value="{{ $data->uraian_d }}" placeholder="Lainnya." disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-1"></div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="jumlah_setor" class="col-form-label">Jumlah yang disetor
                                        <br /><small><i>(Berdasarkan perhitungan BPHTB terutang dan Opsi Setoran
                                                BPHTB)</i></small>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input name="jumlah_setor" type="text" autocomplete="off" id="jumlah_setor"
                                            class="form-control integer "
                                            value="{{ number_format($data->jumlah_setor, 0, ',', '.') }}"
                                            placeholder="Jumlah yang disetor" required disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="no_rekening_bank" class="col-form-label">Pilih No Rekening Setoran
                                    </label>
                                    <div class="input-group">
                                        <select name="no_rekening_bank" id="no_rekening_bank" class="form-control"
                                            required disabled>
                                            <option value="">
                                                {{ $data->no_rekening_bank }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_setor" class="col-form-label">Tanggal disetor</label>
                                    <div class="input-group">
                                        <input name="tgl_setor" type="date" id="tgl_setor" class="form-control"
                                            value="{{ $data->tgl_setor }}" required disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nama_penyetor" class="col-form-label">Nama Penyetor</label>
                                    <input name="nama_penyetor" type="text" id="nama_penyetor" autocomplete="off"
                                        class="form-control " value="{{ $data->nama_penyetor }}"
                                        placeholder="Nama Penyetor" required disabled>
                                </div>
                                <div class="form-group">
                                    <label for="status_pembayaran" class="col-form-label">Status Pembayaran</label>
                                    <select name="status_pembayaran" id="status_pembayaran" class="form-control"
                                        aria-placeholder="Status Pembayaran" required disabled>
                                        <option>{{ $data->status_pembayaran }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_bphtb" class="col-form-label">Tanggal Peralihan</label>
                                    <input name="tgl_bphtb" type="date" id="tgl_bphtb" autocomplete="off"
                                        class="form-control" value="{{ $data->tgl_bphtb }}" required disabled>
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
                                <div class="form-group">
                                    <label for="diterima_id" class="col-form-label">Diterima oleh</label>
                                    <select name="diterima_id" id="diterima_id"
                                        class="form-control @error('diterima_id') is-invalid @enderror"
                                        aria-placeholder="Diterima oleh" disabled>
                                        <option value="">
                                            {{ $data->nip_diterima }} -
                                            {{ $data->diterima_oleh }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_diterima" class="col-form-label">Tanggal diterima</label>
                                    <div class="input-group">
                                        <input name="tgl_diterima" type="date" id="tgl_diterima"
                                            class="form-control @error('tgl_diterima') is-invalid @enderror"
                                            value="{{ $data->tgl_diterima }}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-1"></div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="diverifikasi_id" class="col-form-label">Diverifikasi oleh</label>
                                    <select name="diverifikasi_id" id="diverifikasi_id"
                                        class="form-control @error('diverifikasi_id') is-invalid @enderror"
                                        aria-placeholder="Telah diverifikasi oleh" disabled>
                                        <option value="">
                                            {{ $data->nip_verifikator }} -
                                            {{ $data->nama_verifikator }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_diverifikasi" class="col-form-label">Tanggal Verifikasi</label>
                                    <div class="input-group">
                                        <input name="tgl_diverifikasi" type="date" id="tgl_diverifikasi"
                                            class="form-control @error('tgl_diverifikasi') is-invalid @enderror"
                                            value="{{ $data->tgl_verifikasi }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- .card body -->
                </div>

            </div><!-- /.card -->
        </div> <!-- /.col -->
    </div><!-- /.row -->


@endSection

@section('script')
    <script>
        UpdateNjopPbb();

        function UpdateNjopPbb() {
            let luasTanah = ($('#luas_tanah').val() != '' ? $('#luas_tanah').val() : '0')
            let luasBangunan = ($('#luas_bangunan').val() != '' ? $('#luas_bangunan').val() : '0')
            let njopTanah = ($('#njop_tanah').val() != '' ? num_sys($('#njop_tanah').val()) : '0')
            let njopBangunan = ($('#njop_bangunan').val() != '' ? num_sys($('#njop_bangunan').val()) : '0')
            let jumlahNjopTanah = parseFloat(luasTanah) * parseFloat(njopTanah);
            let jumlahNjopBangunan = parseFloat(luasBangunan) * parseFloat(njopBangunan);

            let njob_pbb = parseFloat(jumlahNjopTanah) + parseFloat(jumlahNjopBangunan);
            $("#njop_pbb").val(num_id(njob_pbb));
        }

        disableNopPbb();

        function disableNopPbb() {
            $('#nop').attr('disabled', 'disabled');
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

        function modeEdit(route) {
            swal({
                title: "Yakin edit data ini ?",
                text: "setelah tombol edit di klik, maka form akan aktif dan bisa untuk di edit",
                icon: "warning",
                buttons: true
            }).then((confirm) => {
                if (confirm) {
                    window.location.href = route;
                }
            });
        }

        function hapus(route) {
            swal({
                title: "Yakin menghapus data ini ?",
                text: "Data akan dipindahkan ke tong sampah",
                icon: "warning",
                buttons: true
            }).then((willDelete) => {
                if (willDelete) {

                    window.location = route;

                } else {
                    swal("Cancel", "Data anda masih aman :)", "error");
                }
            });
        }

        function restore(route) {
            swal({
                title: "Yakin memulihkan data ini ?",
                text: "Data akan dipulihkan dari tong sampah?",
                icon: "warning",
                buttons: true
            }).then((willDelete) => {
                if (willDelete) {

                    window.location = route;

                } else {
                    swal("Cancel", "Data anda masih di tong sampah :)", "error");
                }
            });
        }
    </script>
@endsection
