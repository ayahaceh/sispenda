@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-default">
            <div class="card-header bg-indigo">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">
                        <i class="fas fa-user-alt mr-2"></i>Profil Wajib Pajak
                        <small class="badge bg-success">(Valid)</small>
                    </h3 class="card-title">
                    <div class="row">
                        <a href="{{ url()->previous() }}" class="btn btn-default text-indigo ml-2">
                            <i class="fas fa-angle-double-left text-indigo mr-2"></i>
                            Kembali
                        </a>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-2">
                        <img id="preview_img" src="{{ asset('/upload/users/comp/default.jpg') }}" style="margin-bottom: 15px" class="" width="160" height="160" />
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input name="nama" id="nama" type="text" class="form-control" value="{{ $data->joinProfil->nama }}" disabled>
                        </div>
                        <div class="form-group">
                            <label>NIK (KTP)</label>
                            <input name="nik" id="nik" type="text" class="form-control" value="{{$data->nik  }}" disabled>
                        </div>
                    </div> <!-- .col-sm-4 -->

                    <div class="col-sm-6">
                        <div class="form-group row">
                            <label class="col-sm-3">Alamat</label>
                            <input name="alamat_profil" id="alamat_profil" type="text" class="col-sm-9 form-control" value="{{ $data->joinProfil->alamat }}" disabled>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3">Desa</label>
                            <input name="desa_profil" id="desa_profil" type="text" class="col-sm-9 form-control" value="{{ $data->joinDesa->nama_desa }}" disabled>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3">Kecamatan</label>
                            <input name="kec_profil" id="kec_profil" type="text" class="col-sm-9 form-control" value="{{ $data->joinKec->nama_kec }}" disabled>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3">Jumlah NOP</label>
                            <input name="jumlah_nop" id="jumlah_nop" type="text" class="col-sm-9 form-control" value="{{ @$data->joinProfil->jumlahNop->count() }}" disabled>
                        </div>
                    </div> <!-- .col-sm-6 -->

                </div>
            </div> <!-- .card Header -->
            <div class="card-header bg-light">
                <h3 class="card-title text-indigo">
                    <i class="fas fa-id-card mr-2"></i> Data NOP PBB
                </h3>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group row">
                            <input type="hidden" id="nik_profile" name="nik_profile">
                            <input type="hidden" id="kode_prov" name="kode_prov">
                            <label for="nop" class="col-sm-4 col-form-label">No Objek Pajak (NOP)</label>
                            <div class="col-sm-8">
                                <input name="nop" type="text" id="nop" maxlength="50" onkeypress="return hanyaAngka (event)" class="form-control @error('nop') is-invalid @enderror" value="{{ $data->nop }}" placeholder="Nomor Objek Pajak PBB" disabled>
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
                                <input name="letak" type="text" id="letak" maxlength="50" class="form-control @error('letak') is-invalid @enderror" value="{{ $data->letak }}" placeholder="Letak Lokasi Tanah / Bangunan" disabled>
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
                                <select id="kab" name="kode_kab" class="form-control" disabled>
                                    <option value="{{$data->kode_kab}}">{{$data->joinKab->nama_kab}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kode_kec" class="col-sm-4 col-form-label">Kecamatan</label>
                            <div class="col-sm-8">
                                <select id="kec" name="kode_kec" onchange="UpdateDesa()" class="form-control" disabled>
                                    <option value="{{$data->joinKec->kode_kec}}">{{$data->joinKec->nama_kec}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="kode_desa" class="col-sm-4 col-form-label">Desa</label>
                            <div class="col-sm-8">
                                <select id="desa" name="kode_desa" class="form-control" disabled>
                                    <option value="{{$data->joinDesa->kode_desa}}">{{$data->joinDesa->nama_desa}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rtrw" class="col-sm-4 col-form-label">RT / RW </label>
                            <div class="col-sm-8">
                                <input name="rtrw" type="text" id="rtrw" maxlength="10" class="form-control @error('rtrw') is-invalid @enderror" value="{{ $data->rtrw }}" placeholder="RT / RW ..." disabled>
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
                                <select id="kode_jenis_perolehan" name="kode_jenis_perolehan" class="form-control" disabled>
                                    <option value="{{$data->joinJenisPerolehan->kode_jenis_perolehan}}">{{$data->joinJenisPerolehan->kode_jenis_perolehan .' - '.$data->joinJenisPerolehan->nama_jenis_perolehan}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_sertifikat" class="col-sm-4 col-form-label">Nomor Sertifikat</label>
                            <div class="col-sm-8">
                                <input name="no_sertifikat" type="text" id="no_sertifikat" maxlength="20" class="form-control @error('no_sertifikat') is-invalid @enderror" value="{{ $data->no_sertifikat }}" placeholder="Nomor Sertifikat..." disabled>
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
                                    <input name="luas_tanah" type="text" id="luas_tanah" onchange="UpdateNjopPbb()" class="form-control decimal @error('luas_tanah') is-invalid @enderror" value="{{ $data->luas_tanah }}" placeholder="Luas Tanah" disabled>
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
                                    <input name="njop_tanah" type="text" id="njop_tanah" maxlength="12" class="form-control integer @error('njop_tanah') is-invalid @enderror" value="{{ $data->njop_tanah }}" placeholder="NJOP Tanah" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="luas_bangunan" class="col-sm-4 col-form-label">Luas Bangunan</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <input name="luas_bangunan" type="text" id="luas_bangunan" maxlength="12" onchange="UpdateNjopPbb()" class="form-control decimal @error('luas_bangunan') is-invalid @enderror" value="{{ $data->luas_bangunan }}" placeholder="Luas Bangunan" disabled>
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
                                    <input name="njop_bangunan" type="text" id="njop_bangunan" maxlength="12" onchange="UpdateNjopPbb()" class="form-control integer @error('njop_bangunan') is-invalid @enderror" value="{{ $data->njop_bangunan }}" placeholder="NJOP Bangunan" disabled>
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
                                    @php
                                    $jumlahNjopTanah = $data->luas_tanah * $data->njopTanah;
                                    $jumlahNjopBangunan = $data->luas_bangunan * $data->njop_bangunan;
                                    @endphp
                                    <input name="njop_pbb" type="text" id="njop_pbb" class="form-control integer @error('njop_pbb') is-invalid @enderror" value="{{ ($jumlahNjopTanah+$jumlahNjopBangunan) }}" placeholder="NJOP PBB" disabled>
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
                                    <input name="hak_nilai_pasar" type="text" id="hak_nilai_pasar" maxlength="12" class="form-control integer @error('hak_nilai_pasar') is-invalid @enderror" value="{{ $data->hak_nilai_pasar }}" placeholder="Hak Transaksi / Nilai Pasar" disabled>
                                    @error('hak_nilai_pasar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status_nop_pbb" class="col-sm-4 col-form-label">Status NOP PBB</label>
                            <div class="col-sm-8">
                                <select id="status_nop_pbb" name="status_nop_pbb" class="form-control" disabled>
                                    <option value="1" {{ ($data->status_nop_pbb == 1) ? 'selected' : '' }}>Aktif</option>
                                    <option value="2" {{ ($data->status_nop_pbb == 2) ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>

                    </div>

                </div>
            </div> <!-- .card body -->
        </div>
    </div>
</div>


@endSection

@section('script')
<script type="text/javascript" src="{{ asset('lte/plugins/auto-numeric-4.5.4/AutoNumeric.js') }}"></script>

<script>
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

    $(document).ready(function() {

        setAutoNumeric();
    });

    function setAutoNumeric() {

        [luasTanah, luasBangunan] = new AutoNumeric.multiple('.decimal', {
            currencySymbol: '',
            decimalCharacter: ',',
            digitGroupSeparator: '.',
        });

        [njopTanah, njopBangunan, njopPbb, hakNilaiPasar] = new AutoNumeric.multiple('.integer', {
            currencySymbol: '',
            decimalCharacter: ',',
            allowDecimalPadding: false,
            digitGroupSeparator: '.',
        });
    }

    // $('body').on('click', '.editFunction', function(event) {

    //     event.preventDefault();
    //     event.stopImmediatePropagation();

    //     var url = $(this).attr("href");

    //     console.log(url);
    //     swal({
    //         title: "Yakin ingin mengubah data ini ?",
    //         text: "Pastikan anda benar-benar ingin mengubah data ini!",
    //         icon: "warning",
    //         buttons: true
    //     }).then((willDelete) => {
    //         if (willDelete) {

    //             window.location.href = url;
    //         } else {
    //             swal("Cancel", "Aksi dibatalkan!", "error");
    //         }
    //     })
    // });

    $('body').on('click', '.deleteFunction', function(event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        var form = event.target.form;
        // var url = $(this).attr("href");
        console.log(form);
        // console.log(url);
        swal({
            title: "Yakin menghapus akun data ini ?",
            text: "Anda tidak dapat mengembalikan lagi data yang telah dihapus!",
            icon: "warning",
            buttons: true
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
                // window.location.href = url;
            } else {
                swal("Cancel", "Aksi dibatalkan!", "error");
            }
        })

    });
</script>
@endsection