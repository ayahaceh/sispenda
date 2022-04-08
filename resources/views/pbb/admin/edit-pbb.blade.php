@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')
<div class="pb-2">
    <button data-url=" {{route('pbb')}}" class="btn-refresh btn btn-secondary  ">Kembali</button>
</div>
<div class="card card-default card-outline">
    <div class="card-header text-indigo">
        <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#wajib_pajak" data-toggle="tab">Wajib Pajak</a></li>
            <li class="nav-item"><a class="nav-link" href="#objek_pajak" data-toggle="tab">Objek Pajak</a></li>
            <li class="nav-item"><a class="nav-link" href="#pbb" data-toggle="tab">Pajak Bumi dan Bangunan</a></li>

        </ul>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane active" id="wajib_pajak">
                <form action="{{route('pbb.update',$pbb->id)}}" method="post">
                    @csrf
                    @method("put")
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nik">NIK</label>
                                <input type="text" name="nik" id="nik" class="form-control" value="{{ $pbb->nik}}">
                                <x-validation-message name="nik" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nama_wp">Nama Wajib Pajak</label>
                                <input type="text" name="nama_wp" id="nama_wp" class="form-control" value="{{ $pbb->nama_wp}}">
                                <x-validation-message name="nama_wp" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alamat_wp">Alamat Wajib Pajak</label>
                        <textarea name="alamat_wp" id="alamat_wp" class="form-control" rows="3">{{ $pbb->alamat_wp}}</textarea>
                        <x-validation-message name="alamat_wp" />
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="kode_prov_wp" class="d-block">Provinsi Wajib Pajak</label>
                                <select name="kode_prov_wp" id="kode_prov_wp" class="form-control select2">
                                    <option value="" selected disabled> Pilih Provinsi </option>
                                    @if ($pbb->provinsiWp)
                                    <option value="{{$pbb->provinsiWp->kode_prov}}" selected>{{$pbb->provinsiWp->nama_prov}}</option>
                                    @endif
                                </select>
                                <x-validation-message name="kode_prov_wp" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="kode_kab_wp">Kabupaten Wajib Pajak</label>
                                <select name="kode_kab_wp" id="kode_kab_wp" class="form-control select2">
                                    @if ($pbb->kabupatenWp)
                                    <option value="{{$pbb->kabupatenWp->kode_kab}}" selected>{{$pbb->kabupatenWp->nama_kab}}</option>
                                    @endif
                                </select>
                                <x-validation-message name="kode_kab_wp" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="kode_kec_wp" class="d-block">Kecamatan Wajib Pajak</label>
                                <select name="kode_kec_wp" id="kode_kec_wp" class="form-control select2">
                                    @if ($pbb->kecamatanWp)
                                    <option value="{{$pbb->kecamatanWp->kode_kec}}" selected>{{$pbb->kecamatanWp->nama_kec}}</option>
                                    @endif
                                </select>
                                <x-validation-message name="kode_kec_wp" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="kode_desa_wp">Desa Wajib Pajak</label>
                                <select name="kode_desa_wp" id="kode_desa_wp" class="form-control select2">
                                    @if ($pbb->desaWp)
                                    <option value="{{$pbb->desaWp->kode_desa}}" selected>{{$pbb->desaWp->nama_desa}}</option>
                                    @endif
                                </select>
                                <x-validation-message name="kode_desa_wp" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="rtrw_wp">RT/RW (Wajib Pajak)</label>
                                <input type="text" name="rtrw_wp" id="rtrw_wp" value="{{$pbb->rtrw_wp}}" class="form-control">
                                <x-validation-message name="rtrw_wp" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="kode_pos_wp">Kode Pos Wajib Pajak</label>
                                <input type="text" name="kode_pos_wp" id="kode_pos_wp" class="form-control" value="{{$pbb->kode_pos_wp}}">
                                <x-validation-message name="kode_pos_wp" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="button_wp" value="">Update Wajib Pajak</button>
                    </div>
                </form>
                <!-- /.post -->
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="objek_pajak">
                <form action="{{ route('pbb.update',$pbb->id)}}" method="post">
                    @csrf
                    @method("put")
                    <div class="form-group">
                        <label for="letak_nop">Letak NOP</label>
                        <textarea name="letak_nop" id="letak_nop" class="form-control" rows="3">{{$pbb->letak_nop}}</textarea>
                        <x-validation-message name="letak_nop" />
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="kode_prov_nop" class="d-block">Provinsi OP</label>
                                <select name="kode_prov_nop" id="kode_prov_nop" class="form-control select2">
                                    <option value="" selected disabled> Pilih Provinsi </option>
                                    @if ($pbb->provinsiOp)
                                    <option value="{{$pbb->provinsiOp->kode_prov}}" selected>{{$pbb->provinsiOp->nama_prov}}</option>
                                    @endif
                                </select>
                                <x-validation-message name="kode_prov_nop" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="kode_kab_nop">Kabupaten OP</label>
                                <select name="kode_kab_nop" id="kode_kab_nop" class="form-control select2">
                                    @if ($pbb->kabupatenNop)
                                    <option value="{{$pbb->kabupatenNop->kode_kab}}" selected>{{$pbb->kabupatenNop->nama_kab}}</option>
                                    @endif
                                </select>
                                <x-validation-message name="kode_kab_nop" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="kode_kec_nop" class="d-block">Kecamatan OP</label>
                                <select name="kode_kec_nop" id="kode_kec_nop" class="form-control select2">
                                    @if ($pbb->kecamatanNop)
                                    <option value="{{$pbb->kecamatanNop->kode_kec}}" selected>{{$pbb->kecamatanNop->nama_kec}}</option>
                                    @endif
                                </select>
                                <x-validation-message name="kode_kec_nop" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="kode_desa_nop">Desa OP</label>
                                <select name="kode_desa_nop" id="kode_desa_nop" class="form-control select2">
                                    @if ($pbb->desaNop)
                                    <option value="{{$pbb->desaNop->kode_desa}}" selected>{{$pbb->desaNop->nama_desa}}</option>
                                    @endif
                                </select>
                                <x-validation-message name="kode_desa_nop" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="rtrw_nop">RT/RW (Objek Pajak)</label>
                                <input type="text" name="rtrw_nop" id="rtrw_nop" class="form-control" value="{{$pbb->rtrw_nop}}">
                                <x-validation-message name="rtrw_nop" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="kode_pos_nop">Kode Pos OP</label>
                                <input type="text" name="kode_pos_nop" id="kode_pos_nop" class="form-control" value="{{$pbb->kode_pos_nop}}">
                                <x-validation-message name="kode_pos_nop" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="button_op" value="">Update Objek Pajak</button>
                    </div>
                </form>
            </div>
            <div class="tab-pane" id="pbb">
                <form action="{{ route('pbb.update',$pbb->id)}}" method="post">
                    @csrf
                    @method("put")
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nop">NOP</label>
                                <input type="text" readonly name="nop" id="nop" class="form-control" value="{{$pbb->format_nop}}">
                                <x-validation-message name="nop" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="tgl_pbb">Tanggal Pbb</label>
                                <input type="text" readonly name="tgl_pbb" id="tgl_pbb" class="form-control" value="{{$pbb->tgl_pbb->format('d-m-Y')}}">
                                <x-validation-message name="tgl_pbb" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="luas_tanah">Luas Tanah (Objek Pajak)</label>
                                <input type="text" name="luas_tanah" id="luas_tanah" class="form-control" readonly value="{{$pbb->luas_tanah}}">
                                <x-validation-message name="luas_tanah" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="njop_tanah">NJOP Tanah</label>
                                <input type="text" id="njop_tanah" value="{{$pbb->njop_tanah}}" class="form-control text-right">
                                <input type="text" name="njop_tanah" hidden value="{{$pbb->njop_tanah}}">
                                <x-validation-message name="njop_tanah" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="luas_bangunan">Luas Bangunan (Objek Pajak)</label>
                                <input type="text" name="luas_bangunan" readonly id="luas_bangunan" class="form-control" value="{{$pbb->luas_bangunan}}">
                                <x-validation-message name="luas_bangunan" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="njop_bangunan">NJOP Bangunan</label>
                                <input type="text" id="njop_bangunan" value="{{$pbb->njop_bangunan}}" class="form-control text-right">
                                <input type="text" name="njop_bangunan" hidden value="{{$pbb->njop_bangunan}}">
                                <x-validation-message name="njop_bangunan" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_njop">Jumlah Nilai Jual Objek Pajak</label>
                        <input type="text" disabled id="jumlah_njop" value="{{$pbb->jumlah_njop}}" class="form-control text-right">
                        <input type="text" name="jumlah_njop" hidden value="{{$pbb->jumlah_njop}}">
                        <x-validation-message name="jumlah_njop" />
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="percentace_pajak">Percent Kena Pajak (Default 0.1%)</label>
                                <input type="text" id="percentace_pajak" value="0.1" class="form-control text-right">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="jumlah_njoptkp">Jumlah Nilai Jual Tidak Kena Pajak</label>
                                <input type="text" id="jumlah_njoptkp" value="{{$pbb->jumlah_njoptkp}}" class="form-control border-danger text-right">
                                <input type="text" name="jumlah_njoptkp" value="{{$pbb->jumlah_njoptkp}}" hidden>
                                <x-validation-message name="jumlah_njoptkp" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="jumlah_njop_pbb">Jumlah Nilai Jual Objek Pajak Bumi dan Bangunan (Nilai Jual PBB)</label>
                                <input type="text" id="jumlah_njop_pbb" value="{{$pbb->jumlah_njop_pbb}}" disabled class="form-control text-right border-primary">
                                <input type="text" name="jumlah_njop_pbb" hidden value="{{$pbb->jumlah_njop_pbb}}">
                                <x-validation-message name="jumlah_njop_pbb" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="jumlah_terhutang">Pajak Terhutang </label>
                                <input type="text" id="jumlah_terhutang" disabled value="{{$pbb->jumlah_terhutang}}" class="form-control text-right border-success">
                                <input type="text" name="jumlah_terhutang" class="form-control border-danger" value="{{$pbb->jumlah_terhutang}}" hidden>
                                <x-validation-message name="jumlah_terhutang" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="pbb" class="btn btn-primary" value="Submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.card-body -->
</div>
@endSection
@push("styles")
<style>
    .select2 {
        width: 100% !important;
    }
</style>
@endpush
@push("scripts")
<script src="<?= asset("js/autoNumeric.min.js") ?>"></script>
<script>
    var pbb = <?= json_encode($pbb) ?>;

    $('#kode_prov_wp').select2({
        ajax: {
            url: "{{route('provinsi.select2')}}",
            dataType: 'json',
            data: function(params) {
                var query = {
                    cari: params.term,
                    page: params.page || 1
                }
                return query;
            },
            processResults: function(respon, params) {
                return {
                    results: respon.data,
                    pagination: {
                        more: ((params.page || 1) * respon.meta.per_page) < respon.meta.total
                    }
                };
            },
        }
    });
    $('select#kode_prov_wp').on('select2:select', function(e) {
        pbb.provinsi_wp = e.params.data;
    });
    $('#kode_kab_wp').select2({
        ajax: {
            url: function(e) {
                let route = `{{route('kabupaten.select2',"xxx_provinsi")}}`;
                return route.replace("xxx_provinsi", pbb.provinsi_wp.kode_prov);
            },
            dataType: 'json',
            data: function(params) {
                var query = {
                    cari: params.term,
                    page: params.page || 1
                }
                return query;
            },
            processResults: function(respon, params) {
                return {
                    results: respon.data,
                    pagination: {
                        more: ((params.page || 1) * respon.meta.per_page) < respon.meta.total
                    }
                };
            },
        }
    });
    $('select#kode_kab_wp').on('select2:select', function(e) {
        pbb.kabupaten_wp = e.params.data;
    });
    $('#kode_kec_wp').select2({
        ajax: {
            url: function(e) {
                let route = `{{route('kecamatan.select2',"xxx_kabupaten")}}`;
                return route.replace("xxx_kabupaten", pbb.kabupaten_wp.kode_kab);
            },
            dataType: 'json',
            data: function(params) {
                var query = {
                    cari: params.term,
                    page: params.page || 1
                }
                return query;
            },
            processResults: function(respon, params) {
                return {
                    results: respon.data,
                    pagination: {
                        more: ((params.page || 1) * respon.meta.per_page) < respon.meta.total
                    }
                };
            },
        }
    });
    $('select#kode_kec_wp').on('select2:select', function(e) {
        pbb.kecamatan_wp = e.params.data;
    });
    $('#kode_desa_wp').select2({
        ajax: {
            url: function(e) {
                let route = `{{route('desa.select2',"xxx_kecamatan")}}`;
                return route.replace("xxx_kecamatan", pbb.kecamatan_wp.kode_kec);
            },
            dataType: 'json',
            data: function(params) {
                var query = {
                    cari: params.term,
                    page: params.page || 1
                }
                return query;
            },
            processResults: function(respon, params) {
                return {
                    results: respon.data,
                    pagination: {
                        more: ((params.page || 1) * respon.meta.per_page) < respon.meta.total
                    }
                };
            },
        }
    });
    $('select#kode_desa_wp').on('select2:select', function(e) {
        pbb.desa_wp = e.params.data;
    });


    $('#kode_prov_nop').select2({
        ajax: {
            url: "{{route('provinsi.select2')}}",
            dataType: 'json',
            data: function(params) {
                var query = {
                    cari: params.term,
                    page: params.page || 1
                }
                return query;
            },
            processResults: function(respon, params) {
                return {
                    results: respon.data,
                    pagination: {
                        more: ((params.page || 1) * respon.meta.per_page) < respon.meta.total
                    }
                };
            },
        }
    });
    $('select#kode_prov_nop').on('select2:select', function(e) {
        pbb.provinsi_nop = e.params.data;
    });
    $('#kode_kab_nop').select2({
        ajax: {
            url: function(e) {
                let route = `{{route('kabupaten.select2',"xxx_provinsi")}}`;
                return route.replace("xxx_provinsi", pbb.provinsi_nop.kode_prov);
            },
            dataType: 'json',
            data: function(params) {
                var query = {
                    cari: params.term,
                    page: params.page || 1
                }
                return query;
            },
            processResults: function(respon, params) {
                return {
                    results: respon.data,
                    pagination: {
                        more: ((params.page || 1) * respon.meta.per_page) < respon.meta.total
                    }
                };
            },
        }
    });
    $('select#kode_kab_nop').on('select2:select', function(e) {
        pbb.kabupaten_nop = e.params.data;
    });
    $('#kode_kec_nop').select2({
        ajax: {
            url: function(e) {
                let route = `{{route('kecamatan.select2',"xxx_kabupaten")}}`;
                return route.replace("xxx_kabupaten", pbb.kabupaten_nop.kode_kab);
            },
            dataType: 'json',
            data: function(params) {
                var query = {
                    cari: params.term,
                    page: params.page || 1
                }
                return query;
            },
            processResults: function(respon, params) {
                return {
                    results: respon.data,
                    pagination: {
                        more: ((params.page || 1) * respon.meta.per_page) < respon.meta.total
                    }
                };
            },
        }
    });
    $('select#kode_kec_nop').on('select2:select', function(e) {
        pbb.kecamatan_nop = e.params.data;
    });
    $('#kode_desa_nop').select2({
        ajax: {
            url: function(e) {
                let route = `{{route('desa.select2',"xxx_kecamatan")}}`;
                return route.replace("xxx_kecamatan", pbb.kecamatan_nop.kode_kec);
            },
            dataType: 'json',
            data: function(params) {
                var query = {
                    cari: params.term,
                    page: params.page || 1
                }
                return query;
            },
            processResults: function(respon, params) {
                return {
                    results: respon.data,
                    pagination: {
                        more: ((params.page || 1) * respon.meta.per_page) < respon.meta.total
                    }
                };
            },
        }
    });
    $('select#kode_desa_nop').on('select2:select', function(e) {
        pbb.desa_wp = e.params.data;
    });
    let options = {
        currencySymbol: 'Rp ',
        decimalCharacter: ',',
        digitGroupSeparator: '.',
        decimalPlaces: 0
    }
    let options2 = {
        decimalCharacter: ',',
        digitGroupSeparator: '.',
        maximumValue: 100,
        minimumValue: 0,
        suffixText: "%"
    }
    new AutoNumeric("#njop_tanah", options);
    new AutoNumeric("#njop_bangunan", options);
    new AutoNumeric("#jumlah_terhutang", options);
    new AutoNumeric("#jumlah_njoptkp", options);
    new AutoNumeric("#jumlah_njop", options);
    new AutoNumeric("#jumlah_njop_pbb", options);

    new AutoNumeric("#percentace_pajak", options2);
    hitung_pajak();
    $("#jumlah_njoptkp,#percentace_pajak").on("input", function() {
        hitung_pajak();
    })

    $("#njop_bangunan,#njop_tanah").on("input", function() {
        hitung_njop();
    })

    function hitung_njop() {
        let luas_tanah = parseFloat($("[name=luas_tanah]").val());
        let njop_tanah = AutoNumeric.getNumber("#njop_tanah");
        let jumlah_njop_tanah = luas_tanah * njop_tanah;
        $("input[name=njop_tanah]").val(njop_tanah);

        let luas_bangunan = parseFloat($("[name=luas_bangunan]").val());
        let njop_bangunan = AutoNumeric.getNumber("#njop_bangunan");
        let jumlah_njop_bangunan = luas_bangunan * njop_bangunan;
        $("input[name=njop_bangunan]").val(njop_bangunan);

        let jumlah_njop = jumlah_njop_tanah + jumlah_njop_bangunan;
        AutoNumeric.set("#jumlah_njop", jumlah_njop);
        $("input[name=jumlah_njop]").val(jumlah_njop);

        hitung_pajak()
    }

    function hitung_pajak() {
        let njop_tkp = AutoNumeric.getNumber("#jumlah_njoptkp");
        $("input[name=jumlah_njoptkp]").val(njop_tkp);

        let jumlah_njop = $("input[name=jumlah_njop]").val();
        let njop_pbb = jumlah_njop - njop_tkp;
        $("input[name=jumlah_njop_pbb]").val(njop_pbb);
        AutoNumeric.set("#jumlah_njop_pbb", njop_pbb);
        let percent = AutoNumeric.getNumber("#percentace_pajak");
        if (percent == 0)
            percent = 0.1;
        let jumlah_terhutang = (percent / 100) * njop_pbb;
        if (jumlah_terhutang < 10000)
            jumlah_terhutang = 10000;
        $("input[name=jumlah_terhutang]").val(jumlah_terhutang);
        AutoNumeric.set("#jumlah_terhutang", jumlah_terhutang);
    }
</script>
@endpush
