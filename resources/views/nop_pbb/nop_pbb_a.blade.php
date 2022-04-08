@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-default">
            <form action="{{ route('nop.pbb.simpan') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-header bg-indigo">
                    <h6><i class="fas fa-user-alt mr-2"></i>Profil Wajib Pajak1</h6>
                    <div class="row">
                        <div class="col-sm-2">
                            <img id="preview_img" src="{{ asset('/upload/users/comp/default.jpg') }}" style="margin-bottom: 15px" class="" width="160" height="160" />
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="foto">Pilih Wajib Pajak (Profil)</label>
                                <select id="profil_id" name="profil_id" onchange="UpdateProfil()" class="form-control" required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input name="nama" id="nama" type="text" class="form-control" value="" disabled>
                            </div>
                            <div class="form-group">
                                <label>NIK (KTP)</label>
                                <input name="nik" id="nik" type="text" class="form-control" value="" disabled>
                            </div>
                        </div> <!-- .col-sm-4 -->

                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label class="col-sm-3">Alamat</label>
                                <input name="alamat_profil" id="alamat_profil" type="text" class="col-sm-9 form-control" value="" disabled>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3">Desa</label>
                                <input name="desa_profil" id="desa_profil" type="text" class="col-sm-9 form-control" value="" disabled>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3">Kecamatan</label>
                                <input name="kec_profil" id="kec_profil" type="text" class="col-sm-9 form-control" value="" disabled>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3">Jumlah NOP</label>
                                <input name="jumlah_nop" id="jumlah_nop" type="text" class="col-sm-9 form-control" value="" disabled>
                            </div>

                        </div> <!-- .col-sm-6 -->

                    </div>
                </div> <!-- .card Header -->
                <div class="card-header bg-light">
                    <h3 class="card-title text-indigo">
                        <i class="fas fa-id-card mr-2"></i> Tambah NOP PBB Baru
                    </h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="nop" class="col-sm-4 col-form-label">No Objek Pajak (NOP)</label>
                                <div class="col-sm-8">
                                    <input name="nop" type="number" id="nop" maxlength="50" class="form-control @error('nop') is-invalid @enderror" value="{{ old('nop') }}" placeholder="Nomor Objek Pajak PBB">
                                    @error('nop')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="letak" class="col-sm-4 col-form-label">Letak Tanah/bangunan</label>
                                <div class="col-sm-8">
                                    <input name="letak" type="text" id="letak" maxlength="50" class="form-control @error('letak') is-invalid @enderror" value="{{ old('letak') }}" placeholder="Letak Lokasi Tanah / Bangunan">
                                    @error('letak')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kode_kab" class="col-sm-4 col-form-label">Kabupaten</label>
                                <div class="col-sm-8">
                                    <select id="kab" name="kode_kab" class="form-control" required>
                                        <option value="{{$dataKab->kode_kab}}">{{$dataKab->nama_kab}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kode_kec" class="col-sm-4 col-form-label">Kecamatan</label>
                                <div class="col-sm-8">
                                    <select id="kec" name="kode_kec" onchange="UpdateDesa()" class="form-control" required>
                                        <option value="">Pilih Kecamatan</option>
                                        @foreach($dataKec as $dKec)
                                        <option value="{{$dKec->kode_kec}}">{{$dKec->nama_kec}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kode_desa" class="col-sm-4 col-form-label">Desa</label>
                                <div class="col-sm-8">
                                    <select id="desa" name="kode_desa" class="form-control" disabled required>
                                        <option value="">Pilih Desa</option>
                                    </select>
                                    {{-- <select id="desa" name="kode_desa" onchange="UpdateNjopTanah()" class="form-control" disabled required>
                                        <option value="">Pilih Desa</option>
                                    </select> --}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="rtrw" class="col-sm-4 col-form-label">RT / RW </label>
                                <div class="col-sm-8">
                                    <input name="rtrw" type="text" id="rtrw" maxlength="10" class="form-control @error('rtrw') is-invalid @enderror" value="{{ old('rtrw') }}" placeholder="RT / RW ...">
                                    @error('rtrw')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kode_jenis_perolehan" class="col-sm-4 col-form-label">Jenis Perolehan <small>(atas Tanah/Bangunan)</small></label>
                                <div class="col-sm-8">
                                    <select id="kode_jenis_perolehan" name="kode_jenis_perolehan" class="form-control" required>
                                        <option value="">Pilih</option>
                                        @foreach($dataJenisPerolehan as $dJP)
                                        <option value="{{$dJP->kode_jenis_perolehan}}">{{$dJP->kode_jenis_perolehan .' - '.$dJP->nama_jenis_perolehan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="no_sertifikat" class="col-sm-4 col-form-label">Nomor Sertifikat</label>
                                <div class="col-sm-8">
                                    <input name="no_sertifikat" type="text" id="no_sertifikat" maxlength="20" class="form-control @error('no_sertifikat') is-invalid @enderror" value="{{ old('no_sertifikat') }}" placeholder="Nomor Sertifikat...">
                                    @error('no_sertifikat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">

                            <div class="form-group row">
                                <label for="luas_tanah" class="col-sm-4 col-form-label">Luas Tanah</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input name="luas_tanah" type="text" id="luas_tanah" onchange="UpdateNjopPbb()" maxlength="12" class="form-control decimal @error('luas_tanah') is-invalid @enderror" value="{{ old('luas_tanah') }}" placeholder="Luas Tanah" required>
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
                                <label for="njop_tanah" class="col-sm-4 col-form-label">NJOP Tanah</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input name="njop_tanah" type="text" id="njop_tanah" maxlength="12" onchange="UpdateNjopPbb()" class="form-control integer @error('njop_tanah') is-invalid @enderror" value="{{ old('njop_tanah') }}" placeholder="NJOP Tanah" required>
                                        {{-- <select id="njop_tanah" name="njop_tanah" onchange="UpdateNjopPbb()" class="form-control" disabled required>
                                            <option value="">Pilih NJOP Tanah</option>
                                        </select> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="luas_bangunan" class="col-sm-4 col-form-label">Luas Bangunan</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input name="luas_bangunan" type="text" id="luas_bangunan" maxlength="12" onchange="UpdateNjopPbb()" class="form-control decimal @error('luas_bangunan') is-invalid @enderror" value="{{ old('luas_bangunan') }}" placeholder="Luas Bangunan" required>
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
                                <label for="njop_bangunan" class="col-sm-4 col-form-label">NJOP Bangunan</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input name="njop_bangunan" type="text" id="njop_bangunan" maxlength="12" onchange="UpdateNjopPbb()" class="form-control integer @error('njop_bangunan') is-invalid @enderror" value="{{ old('njop_bangunan') }}" placeholder="NJOP Bangunan" required>
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
                                        <input name="njop_pbb" type="text" id="njop_pbb" class="form-control integer @error('njop_pbb') is-invalid @enderror" value="{{ old('njop_pbb') }}" placeholder="NJOP PBB" required disabled>
                                        @error('njop_pbb')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
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
                                        <input name="hak_nilai_pasar" type="text" id="hak_nilai_pasar" maxlength="12" class="form-control integer @error('hak_nilai_pasar') is-invalid @enderror" value="{{ old('hak_nilai_pasar') }}" placeholder="Hak Transaksi / Nilai Pasar" required>
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
                </div> <!-- .card body -->

                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-block bg-indigo">
                                <i class="fas fa-save mr-2"></i> Simpan
                            </button>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('nop.pbb') }}" class="btn btn-block btn-warning">
                                <i class="fas fa-undo-alt mr-2"></i> Batal
                            </a>
                        </div>

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
    
    let luasTanah,njopTanah,luasBangunan,njopBangunan,njopPbb,hakNilaiPasar;

    $(document).ready(function() {
        
        setAutoNumeric();

        $('#profil_id').select2({
            placeholder: 'Pilih Profil',
            width: null,
            minimumInputLength: 2,
            ajax: {
                url: "{{ route('getProfilAutoComplete') }}",
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

    });

    function setAutoNumeric(){
        
        [luasTanah, luasBangunan] = new AutoNumeric.multiple('.decimal', {
            currencySymbol : '',
            decimalCharacter : ',',
            digitGroupSeparator : '.',
        });

        [njopTanah,njopBangunan,njopPbb,hakNilaiPasar] = new AutoNumeric.multiple('.integer', {
            currencySymbol : '',
            decimalCharacter : ',',
            allowDecimalPadding : false,
            digitGroupSeparator : '.',
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

    function UpdateDesa() {
        let kecamatan = $("#kec").val()
        // Desa
        $("#desa").children().remove()
        $("#desa").val('');
        $("#desa").append('<option value="">Pilih Desa</option>');
        $("#desa").prop('disabled', true)
        // UpdateNjopTanah()
        if (kecamatan != '' && kecamatan != null) {
            $.ajax({
                url: "{{url('')}}/alamat/pilih/desa/" + kecamatan,
                success: function(res) {
                    $("#desa").prop('disabled', false)
                    $.each(res, function(index, element) {
                        $("#desa").append('<option value=' + element.kode_desa + '>' + element.nama_desa + '</option>');
                    })

                }
            });
        }
    }

    function UpdateNjopTanah() {
        let desaDipilih = $("#desa").val()
        // Desa
        $("#njop_tanah").children().remove()
        $("#njop_tanah").val('');
        $("#njop_tanah").append('<option value="">Pilih NJOP Tanah</option>');
        $("#njop_tanah").prop('disabled', true)

        if (desaDipilih != '' && desaDipilih != null) {
            $.ajax({
                url: "{{url('')}}/njop/pilih/njop_tanah/" + desaDipilih,
                success: function(res) {
                    $("#njop_tanah").prop('disabled', false)
                    $.each(res, function(index, element) {
                        $("#njop_tanah").append('<option value=' + element.jumlah_tarif_njop + '>' + element.format_tarif_njop + '</option>');
                    })
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

    }

    function UpdateProfil() {
        let profil_dipilih = $("#profil_id").val()
        $("#nama").val('');
        $("#nik").val('');
        $("#alamat_profil").val('');
        $("#desa_profil").val('');
        $("#kec_profil").val('');
        $("#jumlah_nop").val('');
        $('#preview_img').attr('src', '');

        if (profil_dipilih != '' && profil_dipilih != null) {
            $.ajax({
                url: "{{url('')}}/profil/pilih/" + profil_dipilih,
                success: function(res) {
                    console.log(res);
                    $("#nama").val(res.nama);
                    $("#nik").val(res.nik);
                    $("#alamat_profil").val(res.alamat);
                    $("#desa_profil").val(res.nama_desa);
                    $("#kec_profil").val(res.nama_kec);
                    $("#jumlah_nop").val(res.jumlah_nop);
                    $('#preview_img').attr('src', res.file_foto);
                    //UpdateNamaDesa()
                }
            });
        }
    }

    function UpdateNamaDesa() {
        let kode_nama_desa = $("#desa_profil").val()
        if (kode_nama_desa != '' && kode_nama_desa != null) {
            $.ajax({
                url: "{{url('')}}/alamat/nama/desa/" + kode_nama_desa,
                success: function(res) {
                    $("#desa_profil").val(res.nama_desa);
                    // console.log(res)
                }
            });
        }

        let kode_nama_kec = $("#kec_profil").val()
        if (kode_nama_kec != '' && kode_nama_kec != null) {
            $.ajax({
                url: "{{url('')}}/alamat/nama/kec/" + kode_nama_kec,
                success: function(res) {
                    $("#kec_profil").val(res.nama_kec);
                    // console.log(res)

                }
            });
        }
    }

    // disable form's submit button after clicking on submit
    $(document).on('submit', 'form', function() {
        $('button').attr('disabled', 'disabled');
    });

    function loadPreview(input, id) {
        id = id || '#preview_img';
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $(id)
                    .attr('src', e.target.result)
                    .width(160)
                    .height(160);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection