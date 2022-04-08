@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-default">
            <form action="{{ route('ppat.peralihan.update',['id' => $id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="card-header bg-indigo">
                    <h3 class="card-title">
                        <i class="fas fa-user-alt mr-2"></i>Profil Wajib Pajak
                    </h3>
                    <div class="card-tools">
                        <ul class="pagination pagination-sm">
                            <li class="page-item">
                                <a href="{{ url()->previous() }}" class="page-link text-indigo">
                                    <i class="fas fa-angle-double-left text-indigo mr-2"></i>
                                    Kembali
                                </a>
                            </li>
                            <li class="page-item">
                                <a href="{{ route('ppat.peralihan.laporan',['id' => $id]) }}" class="page-link text-indigo">
                                    <i class="fas fa-print text-indigo mr-2"></i>
                                    Cetak
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-header bg-light">
                    <div class="row">
                        <div class="col-sm-7 row">
                            <div class="col-sm-3">
                                <img id="preview_img" src="{{ asset('/upload/users/comp/default.jpg') }}" style="margin-bottom: 15px" class="" width="160" height="160" />
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group row">
                                    <label for="foto" class="col-sm-4">Nama Wajib Pajak</label>
                                    <input type="hidden" id="profil_id" name="profil_id" onchange="UpdateProfil()" class="form-control col-sm-8" value="" required>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4">NIK (KTP)</label>
                                    <input name="nik_profil" id="nik_profil" type="text" class="form-control col-sm-8" value="" disabled>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4">Alamat</label>
                                    <input name="alamat_profil" id="alamat_profil" type="text" class="form-control col-sm-8" value="" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-5">
                            <div class="form-group row">
                                <label class="col-sm-4">Desa</label>
                                <input name="desa_profil" id="desa_profil" type="text" class="form-control col-sm-8" value="" disabled>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4">Kecamatan</label>
                                <input name="kec_profil" id="kec_profil" type="text" class="form-control col-sm-8" value="" disabled>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4">Kabupaten</label>
                                <input name="kab_profil" id="kab_profil" type="text" class="form-control col-sm-8" value="" disabled>
                            </div>
                        </div> <!-- .col-sm-6 -->
                    </div>
                </div> <!-- .card Header -->

                <div class="card-header bg-indigo">
                    <h3 class="card-title">
                        <i class="fas fa-map-marked-alt mr-2"></i>Data Objek Pajak PBB
                    </h3>
                </div>
                <div class="card-header bg-light">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group row">
                                <label for="nop" class="col-sm-4 col-form-label">No Objek Pajak (NOP)</label>
                                <div class="col-sm-8">
                                    <select id="nop" name="nop" class="form-control" onchange="changeNop()" required> </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="letak_nop" class="col-sm-4 col-form-label">Letak / Lokasi</label>
                                <div class="col-sm-8">
                                    <input name="letak_nop" type="text" id="letak_nop" class="form-control" value="" placeholder="Letak Lokasi Tanah / Bangunan" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="desa_nop" class="col-sm-4 col-form-label">Desa</label>
                                <div class="col-sm-8">
                                    <input name="desa_nop" type="text" id="desa_nop" class="form-control" value="" placeholder="Desa" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="rtrw_nop" class="col-sm-4 col-form-label">RT / RW </label>
                                <div class="col-sm-8">
                                    <input name="rtrw_nop" type="text" id="rtrw_nop" class="form-control" value="" placeholder="RT / RW ..." disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kec_nop" class="col-sm-4 col-form-label">Kecamatan</label>
                                <div class="col-sm-8">
                                    <input name="kec_nop" type="text" id="kec_nop" class="form-control" value="" placeholder="Kecamatan" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kab_nop" class="col-sm-4 col-form-label">Kabupaten</label>
                                <div class="col-sm-8">
                                    <input name="kab_nop" type="text" id="kab_nop" class="form-control" value="" placeholder="Kabupaten" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kode_jenis_perolehan" class="col-sm-4 col-form-label">Jenis Perolehan <small>(atas Tanah/Bangunan)</small></label>
                                <div class="col-sm-8">
                                    <input name="kode_jenis_perolehan" type="text" id="kode_jenis_perolehan" class="form-control" value="" placeholder="Desa" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="no_sertifikat" class="col-sm-4 col-form-label">Nomor Sertifikat</label>
                                <div class="col-sm-8">
                                    <input name="no_sertifikat" type="text" id="no_sertifikat" class="form-control" value="" placeholder="Nomor Sertifikat..." disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-sm-5">
                            <div class="form-group row">
                                <label for="luas_tanah" class="col-sm-4 col-form-label">Luas Tanah</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input name="luas_tanah" type="text" id="luas_tanah" class="form-control decimal" value="" placeholder="Luas Tanah" disabled>
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
                                        <input name="luas_bangunan" type="text" id="luas_bangunan" class="form-control decimal" value="" placeholder="Luas Bangunan" disabled>
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
                                        <input name="njop_tanah" type="text" id="njop_tanah" class="form-control integer" value="" placeholder="NJOP Bangunan" disabled>
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
                                        <input name="njop_bangunan" type="text" id="njop_bangunan" class="form-control integer" value="" placeholder="NJOP Bangunan" disabled>
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
                                        <input name="njop_pbb" type="text" id="njop_pbb" class="form-control integer" value="" placeholder="NJOP PBB" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="hak_nilai_pasar" class="col-sm-4 col-form-label">Hak Transaksi / Nilai Pasar</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input name="hak_nilai_pasar" type="text" id="hak_nilai_pasar" class="form-control integer" value="" placeholder="Hak Transaksi / Nilai Pasar" disabled>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div> <!-- .card Header -->




                <div class="card-header bg-indigo">
                    <h3 class="card-title">
                        <i class="fas fa-calculator mr-2"></i> Penghitungan BPHTP <small>(Hanya diisi berdasarkan penghitungan Wajib Pajak)</small>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="npop" class="col-form-label">Nilai Perolehan Objek Pajak (NPOP)
                                    <br /><small><i>Memperhatikan nilai pada NJOP dan Nilai Transaksi/Nilai Pasar.</i></small>
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input name="npop" type="text" id="npop" class="form-control integer" value="" placeholder="NPOP" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="npoptkp" class="col-form-label">Nilai Perolehan Objek Pajak Tidak Kena Pajak (NPOPTKP)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input name="npoptkp" type="text" id="npoptkp" class="form-control integer" value="" placeholder="NPOPTKP" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="npopkp" class="col-form-label">Nilai Perolehan Objek Pajak Kena Pajak (NPOPKP)
                                    <br /><small><i>NPOP dikurangi dengan NPOPTKP</i></small>
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input name="npopkp" type="text" id="npopkp" class="form-control integer" value="" placeholder="NPOPKP" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jumlah" class="col-form-label">Bea Perolehan Hak atas Tanah dan Bangunan yang terutang
                                    <br /><small><i>Memperhatikan nilai pada NJOP dan Nilai Transaksi/Nilai Pasar.</i></small>
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input name="jumlah" type="text" id="jumlah" class="form-control integer" value="" placeholder="jumlah terutang" readonly>
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
                                    <input class="custom-control-input" type="radio" id="opsi_a" value="opsi_a" name="customRadio">
                                    <label for="opsi_a" class="custom-control-label">A. Penghitungan Wajib Pajak</label>
                                </div>
                                <br />
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="opsi_b" value="opsi_b" name="customRadio">
                                    <label for="opsi_b" class="custom-control-label">B. STPD BPHTB / SKPD Kurang Bayar / SKPDB Kurang Bayar Tambahan.</label>
                                    <div class="form-group row">
                                        <p for="no_b" class="col-sm-4">Nomor</p>
                                        <div class="col-sm-8">
                                            <input name="no_b" type="text" id="no_b" class="form-control @error('no_b') is-invalid @enderror" readonly>
                                        </div>
                                        <p for="tgl_b" class="col-sm-4">Tanggal</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input name="tgl_b" type="date" id="tgl_b" class="form-control @error('tgl_b') is-invalid @enderror" value="{{ old('tgl_b') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="opsi_c" value="opsi_c" name="customRadio">
                                    <label for="opsi_c" class="custom-control-label">C. Pengurangan dihitung sendiri</label>
                                    <div class="form-group row">
                                        <p for="persen_c" class="col-sm-4">Menjadi (Persen)</p>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input name="persen_c" type="text" id="persen_c" class="form-control decimal @error('persen_c') is-invalid @enderror" value="{{ old('persen_c') }}" placeholder="Persen...">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                        </div>
                                        <p for="uraian_c" class="col-sm-4">Berdasarkan KHD No. </p>
                                        <div class="col-sm-8">
                                            <input name="uraian_c" type="text" id="uraian_c" class="form-control @error('uraian_c') is-invalid @enderror" value="{{ old('uraian_c') }}" placeholder="Peraturan KHD No....">
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="opsi_d" value="opsi_d" name="customRadio">
                                    <label for="opsi_d" class="custom-control-label">D. Lainnya</label>
                                    <input name="uraian_d" type="text" id="uraian_d" class="form-control @error('uraian_c') is-invalid @enderror" value="{{ old('uraian_d') }}" placeholder="Lainnya....">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="jumlah_setor" class="col-form-label">Jumlah yang disetor
                                    <br /><small><i>(Berdasarkan perhitungan BPHTB terutang dan Opsi Setoran BPHTB)</i></small>
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input name="jumlah_setor" type="text" autocomplete="off" id="jumlah_setor" class="form-control integer @error('jumlah_setor') is-invalid @enderror" value="{{ old('jumlah_setor') }}" placeholder="Jumlah yang disetor">
                                </div>
                                @error('jumlah_setor')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tgl_setor" class="col-form-label">Tanggal disetor</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input name="tgl_setor" type="date" id="tgl_setor" class="form-control @error('tgl_setor') is-invalid @enderror" value="{{ old('tgl_setor') }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama_penyetor" class="col-form-label">Nama Penyetor</label>
                                <input name="nama_penyetor" type="text" id="nama_penyetor" autocomplete="off" class="form-control @error('nama_penyetor') is-invalid @enderror" value="{{ old('nama_penyetor') }}" placeholder="Nama Penyetor">
                                @error('nama_penyetor')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="status_transaksi" class="col-form-label">Status Transaksi</label>
                                <select name="status_transaksi" id="status_transaksi" class="form-control" aria-placeholder="Status Transaksi" required>
                                    <option value=""></option>
                                    <option value="{{ STATUS_TRANSAKSI_LUNAS }}">{{ STATUS_TRANSAKSI_LUNAS }}</option>
                                    <option value="{{ STATUS_TRANSAKSI_BELUM_LUNAS }}">{{ STATUS_TRANSAKSI_BELUM_LUNAS }}</option>
                                    <option value="{{ STATUS_TRANSAKSI_TIDAK_VALID }}">{{ STATUS_TRANSAKSI_TIDAK_VALID }}</option>
                                    <option value="{{ STATUS_TRANSAKSI_DIAJUKAN }}">{{ STATUS_TRANSAKSI_DIAJUKAN }}</option>
                                </select>
                                @error('status_transaksi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tgl_peralihan" class="col-form-label">Tgl Peralihan</label>
                                <input name="tgl_peralihan" type="date" id="tgl_peralihan" autocomplete="off" class="form-control @error('tgl_peralihan') is-invalid @enderror" value="{{ old('tgl_peralihan') }}" required>
                                @error('tgl_peralihan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div> <!-- .card body -->


                <div class="card-footer">
                    <div class="row btn-edit">
                        {{-- <div class="col-md-6">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-block bg-indigo">
                                <i class="fas fa-save mr-2"></i> Simpan
                            </button>
                        </div>
                        <div class="col-md-3">
                            <a href="#" class="btn btn-block btn-warning">
                                <i class="fas fa-undo-alt mr-2"></i> Batal
                            </a>
                        </div> --}}

                    </div>
                </div> <!-- .card footer -->
            </form>
        </div>
    </div>
</div>


@endSection

@section('script')
<script type="text/javascript" src="{{ asset('lte/plugins/auto-numeric-4.5.4/AutoNumeric.js') }}"></script>

<script>
    var idPeralihan = "{{ $id }}";

    let luasTanah, luasBangunan, persen_c;
    let njopTanah, njopBangunan, njopPBB, nilaiPasar, npop, npoptkp, npopkp, jumlah, jumlahSetor;

    $(document).ready(function() {
        setAutoNumeric();
        initLoad();
    });

    function setAutoNumeric() {
        [luasTanah, luasBangunan, persen_c] = new AutoNumeric.multiple('.decimal', {
            currencySymbol: '',
            decimalCharacter: ',',
            digitGroupSeparator: '.',
        });


        [njopTanah, njopBangunan, njopPBB, nilaiPasar, npop, npoptkp, npopkp, jumlah, jumlahSetor] = new AutoNumeric.multiple('.integer', {
            currencySymbol: '',
            decimalCharacter: ',',
            allowDecimalPadding: false,
            digitGroupSeparator: '.',
        });
    }

    function initLoad() {
        $("#profil_id").prop('disabled', true);
        $("#nop").prop('disabled', true);
        $("#tgl_b").attr('readonly', true);
        $("#jumlah_setor").attr('readonly', true);
        $("#tgl_setor").attr('readonly', true);
        $("#nama_penyetor").attr('readonly', true);
        $("#tgl_peralihan").attr('readonly', true);
        $("#status_transaksi").attr('readonly', true);

        $.ajax({
            url: "{{url('')}}/transaksi/peralihan/find/" + idPeralihan,
            dataType: "JSON",
            success: function(res) {
                $("#profil_id").append("<option value='" + res.kepada_nik + "'>" + res.nama_kepada_nik + "<option>");
                $("#profil_id").val(res.kepada_nik);

                $("#nik_profil").val(res.kepada_nik);
                $("#alamat_profil").val(res.alamat_kepada_nik);
                $("#desa_profil").val(res.desa_kepada_nik);
                $("#kec_profil").val(res.kec_kepada_nik);
                $("#kab_profil").val(res.kab_kepada_nik);

                $("#nop").append("<option value='" + res.nop + "'>" + res.nop + "|" + res.nama_dari_nik + "<option>");
                $("#nop").val(res.nop).trigger('change');

                if (res.opsi_a == 'Y') {
                    $("#opsi_a").prop("checked", true);
                } else if (res.opsi_b == 'Y') {
                    $("#opsi_b").prop("checked", true);
                    $("#no_b").val(res.no_b);
                    $("#tgl_b").val(res.tgl_b);
                } else if (res.opsi_c == 'Y') {
                    $("#opsi_c").prop("checked", true);
                    $("#persen_c").val(res.persen_c);
                    $("#uraian_c").val(res.uraian_c);
                } else if (res.opsi_d == 'Y') {
                    $("#opsi_d").prop("checked", true);
                    $("#uraian_d").val(res.uraian_d);
                }

                jumlahSetor.set(res.jumlah_setor);
                $("#tgl_setor").val(res.tgl_setor);
                $("#nama_penyetor").val(res.nama_penyetor);

                $("#status_transaksi").val(res.status_transaksi);
                $("#tgl_peralihan").val(res.tgl_peralihan);
            }
        });
    }

    function modeEdit() {
        $("#profil_id").prop('disabled', false);
        $("#nop").prop('disabled', false);
        $("#tgl_b").attr('readonly', false);
        $("#jumlah_setor").attr('readonly', false);
        $("#tgl_setor").attr('readonly', false);
        $("#nama_penyetor").attr('readonly', false);
        $("#status_transaksi").attr('readonly', false);
        $("#tgl_peralihan").attr('readonly', false);

        var component = "<div class='col-md-6'></div>";
        component += "<div class='col-md-3'>";
        component += "<button type='submit' class='btn btn-block bg-indigo'>";
        component += "<i class='fas fa-save mr-2'></i> Update";
        component += "</button>";
        component += "</div>";
        component += "<div class='col-md-3'>";
        component += "<a href='javascript:void(0)' onclick='batalEdit()' class='btn btn-block btn-warning'>";
        component += "<i class='fas fa-undo-alt mr-2'></i> Batal";
        component += "</a>";
        component += "</div>";

        $(".btn-edit").html(component);
    }

    function batalEdit() {
        $(".btn-edit").html("");
        initLoad();
    }

    $('#profil_id').select2({
        placeholder: 'Pilih Profil',
        width: null,
        // dropdownParent: $('.modal'),
        minimumInputLength: 3,
        ajax: {
            url: "{{route('getProfilAutoComplete')}}/",
            dataType: 'json',
            delay: 250,
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.nama,
                            id: item.nik
                        }

                    })
                };
            },
            cache: true
        }
    });


    function UpdateProfil() {
        let profil_dipilih = $("#profil_id").val()
        $("#nama").val('');
        $("#nik_profil").val('');
        $("#alamat_profil").val('');
        $("#desa_profil").val('');
        $("#kec_profil").val('');
        $('#preview_img').attr('src', '');

        if (profil_dipilih != '' && profil_dipilih != null) {
            $.ajax({
                url: "{{url('')}}/profil/pilih/" + profil_dipilih,
                success: function(res) {

                    $("#nama").val(res.nama);
                    $("#nik_profil").val(res.nik);
                    $("#alamat_profil").val(res.alamat);
                    $("#desa_profil").val(res.nama_desa);
                    $("#kec_profil").val(res.nama_kec);
                    $("#kab_profil").val(res.nama_kab);
                    $('#preview_img').attr('src', res.file_foto);

                    //$("#nop").prop('disabled', false);
                    KosongkanTampilanNoNop()
                }
            });
        }
    }

    $('#nop').select2({
        placeholder: 'Ketik NOP/NIK/NAMA',
        width: null,
        // dropdownParent: $('.modal'),
        minimumInputLength: 3,
        ajax: {
            url: "{{ url('') }}/nop/autocomplete/" + $("#profil_id").val(),
            dataType: 'json',
            delay: 200,
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.nop + "|" + item.nama,
                            id: item.nop
                        }
                    })
                };
            },
            cache: true
        }
    });


    function changeNop() {
        let no_nop = $("#nop").val();
        let nik = $("#nik_profil").val();
        // let url = '';
        // if(nik == ''){
        //     url = "{{url('')}}/nop/pbb/tampilan/" + no_nop+'/-';
        // }else{
        //     url = "{{url('')}}/nop/pbb/tampilan/" + no_nop+'/'+nik;
        // }
        if (no_nop != '' && no_nop != null) {
            $.ajax({
                url: "{{url('')}}/nop/pbb/tampilan/" + no_nop + '/' + nik,
                dataType: 'JSON',
                success: function(res) {
                    $("#letak_nop").val(res.letak);
                    $("#desa_nop").val(res.nama_desa);
                    $("#rtrw_nop").val(res.rtrw);
                    $("#kec_nop").val(res.nama_kec);
                    $("#kab_nop").val(res.nama_kab);
                    $("#kode_jenis_perolehan").val(res.kode_jenis_perolehan);
                    $("#no_sertifikat").val(res.no_sertifikat);
                    luasTanah.set(res.luas_tanah);
                    luasBangunan.set(res.luas_bangunan);
                    njopTanah.set(res.njop_tanah);

                    njopBangunan.set(res.njop_bangunan);
                    nilaiPasar.set(res.hak_nilai_pasar);
                    njopPBB.set(res.njop_pbb);

                    npop.set(res.npop);
                    npoptkp.set(res.npoptkp);
                    npopkp.set(res.npopkp);
                    jumlah.set(res.bea_perolehan);

                }
            });
        }
    }


    function KosongkanTampilanNoNop() {
        // Kosongkan Tampilan
        $('#nop').val('').trigger('change');
        $("#letak_nop").val('');
        $("#desa_nop").val('');
        $("#rtrw_nop").val('');
        $("#kec_nop").val('');
        $("#kab_nop").val('');
        $("#kode_jenis_perolehan").val('');
        $("#no_sertifikat").val('');
        luasTanah.set('');
        luasBangunan.set('');
        njopTanah.set('');
        njopBangunan.set('');
        nilaiPasar.set('');
        njopPBB.set('');
        npop.set('');
        npoptkp.set('');
        npopkp.set('');
        jumlah.set('');
        //jumlahSetor.set('');

    }

    $(document).on('submit', 'form', function() {
        $('button').attr('disabled', 'disabled');

    });
</script>

@endsection