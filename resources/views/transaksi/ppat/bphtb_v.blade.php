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
                                    <a href="{{ route('ppat.bphtb') }}" class="page-link text-indigo">
                                        <i class="fas fa-angle-double-left text-indigo mr-2"></i>
                                        Kembali
                                    </a>
                                </li>
                                @if ($data->status_bphtb == STATUS_BPHTB_BELUM_VERIFIKASI)
                                    <li class="page-item">
                                        <a href="javascript:void(0)" class="page-link text-indigo"
                                            onclick="modeEdit('{{ route('ppat.bphtb.edit', ['id' => $data->id]) }}')">
                                            <i class="fas fa-edit mr-1"></i>
                                            Edit Transaksi
                                        </a>
                                    </li>
                                    <li class="page-item">
                                        <a href="javascript:void(0)" class="page-link text-indigo"
                                            onclick="hapus('{{ route('ppat.bphtb.delete', ['id' => $data->id]) }}')">
                                            <i class="fas fa-trash mr-1"></i>
                                            Hapus
                                        </a>
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
                                            <option value="">Pilih Kecamatan</option>
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
                                            class="form-control " value="{{ $data->rtrw_nop }}" placeholder="" required>
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
                                                placeholder="NJOP PBB" value="{{ $data->jl_total }}" disabled>
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
                            <i class="fas fa-upload mr-2"></i>Upload Berkas
                        </h3>
                    </div>

                    <div class="card-body">
                        @if ($data->berkas_ktp)
                            <div class="form-group row">
                                <label for="berkas_sertifikat" class="col-sm-4 col-form-label">Berkas
                                    KTP</label>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <a href="{{ $data->file_ktp }}" target="_blank">
                                            <img src="{{ $data->file_ktp }}" class="img-fluid img-thumbnail"
                                                style="height: 150px" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($data->berkas_sertifikat)
                            <div class="form-group row">
                                <label for="berkas_sertifikat" class="col-sm-4 col-form-label">Berkas
                                    Sertifikat</label>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <a href="{{ $data->file_sertifikat }}" target="_blank">
                                            <img src="{{ $data->file_sertifikat }}" class="img-fluid img-thumbnail"
                                                style="height: 150px" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($data->berkas_ajb)
                            <div class="form-group row">
                                <label for="berkas_ajb" class="col-sm-4 col-form-label">Berkas Akta Jual
                                    Beli</label>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <a href="{{ $data->file_ajb }}" target="_blank">
                                            <img src="{{ $data->file_ajb }}" class="img-fluid img-thumbnail"
                                                style="height: 150px" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div><!-- /.card -->
        </div> <!-- /.col -->
    </div><!-- /.row -->


@endSection

@section('script')
    <script>
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
    </script>
@endsection
