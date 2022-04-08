@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-default">
            <form action="{{ route('ppat.peralihan',['id' => $id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="card-header bg-indigo">
                    <h3 class="card-title">
                        <i class="fas fa-user-alt mr-2"></i>Profil Wajib Pajak
                        @if($data->status_transaksi == STATUS_TRANSAKSI_LUNAS)
                        <span class="badge badge-warning mr-2 ml-2"> <i class="fas fa-check-square mr-2"></i> {{$data->status_transaksi}}</span>
                        @else
                        <span class="badge badge-danger mr-2 ml-2"> <i class="fas fa-exclamation-triangle mr-2"></i> {{$data->status_transaksi}}</span>
                        @endif
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
                                <a href="{{ route('transaksi.peralihan.laporan',['id' => $id]) }}" target="_blank" class="page-link text-indigo">
                                    <i class="fas fa-print text-indigo mr-2"></i>
                                    Cetak
                                </a>
                            </li>
                            {{--
                            <li class="page-item">
                                @if ($data->berkas_bukti_pembayaran != null && $data->berkas_bukti_pembayaran != '')
                                <a href="javascript:void(0)" class="page-link text-success" onclick="add()">
                                    <i class="fas fa-receipt text-success mr-2"></i>
                                    Upload Ulang Bukti Pelunasan
                                </a>
                                @else
                                <a href="javascript:void(0)" class="page-link text-indigo" onclick="add()">
                                    <i class="fas fa-receipt text-indigo mr-2"></i>
                                    Upload Bukti Pelunasan
                                </a>
                                @endif
                            </li>
                            --}}
                        </ul>
                    </div>
                </div>
                <div class="card-header bg-light">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="row">
                                <div class="col-sm-3">
                                    <img id="preview_img" src="{{ asset('/upload/users/comp/default.jpg') }}" class="img-thumbnail">
                                </div>
                                <div class="col-sm-9">
                                    <div class="form-group row">
                                        <label for="foto" class="col-sm-4">Nama Wajib Pajak</label>
                                        <input type="text" class="form-control col-sm-8" value="@isset($data->joinProfilKepada->nama){{$data->joinProfilKepada->nama}}@endisset" disabled>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4">NIK (KTP)</label>
                                        <input type="text" class="form-control col-sm-8" value="{{$data->kepada_nik}}" disabled>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4">Alamat</label>
                                        <input type="text" class="form-control col-sm-8" value="@isset($data->joinProfilKepada->alamat){{$data->joinProfilKepada->alamat}}@endisset" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-5">
                            <div class="form-group row">
                                <label class="col-sm-4">Desa</label>
                                <input name="desa_profil" id="desa_profil" type="text" class="form-control col-sm-8" value="@isset($data->joinProfilKepada->joinDesa->nama_desa){{$data->joinProfilKepada->joinDesa->nama_desa}}@endisset" disabled>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4">Kecamatan</label>
                                <input name="kec_profil" id="kec_profil" type="text" class="form-control col-sm-8" value="@isset($data->joinProfilKepada->joinKec->nama_kec){{$data->joinProfilKepada->joinKec->nama_kec}}@endisset" disabled>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4">Kabupaten</label>
                                <input name="kab_profil" id="kab_profil" type="text" class="form-control col-sm-8" value="@isset($data->joinProfilKepada->joinKab->nama_kab){{$data->joinProfilKepada->joinKab->nama_kab}}@endisset" disabled>
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
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="nop" class="col-sm-4 col-form-label">No Objek Pajak (NOP)</label>
                                <div class="col-sm-8">
                                    <!-- <select id="nop" name="nop" class="form-control" onchange="changeNop()" required> </select> -->
                                    <input name="nop" id="nop" type="text" class="form-control" value="{{$data->nop}}" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="letak_nop" class="col-sm-4 col-form-label">Letak / Lokasi</label>
                                <div class="col-sm-8">
                                    <input name="letak_nop" type="text" id="letak_nop" class="form-control" value="@isset($data->joinNop->letak){{$data->joinNop->letak}}@endisset" placeholder="Letak Lokasi Tanah / Bangunan" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="desa_nop" class="col-sm-4 col-form-label">Desa</label>
                                <div class="col-sm-8">
                                    <input name="desa_nop" type="text" id="desa_nop" class="form-control" value="@isset($data->joinNop->joinDesa->nama_desa){{$data->joinNop->joinDesa->nama_desa}}@endisset" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="rtrw_nop" class="col-sm-4 col-form-label">RT / RW </label>
                                <div class="col-sm-8">
                                    <input name="rtrw_nop" type="text" id="rtrw_nop" class="form-control" value="@isset($data->joinNop->rtrw){{$data->joinNop->rtrw}}@endisset" placeholder="RT / RW ..." disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kec_nop" class="col-sm-4 col-form-label">Kecamatan</label>
                                <div class="col-sm-8">
                                    <input name="kec_nop" type="text" id="kec_nop" class="form-control" value="@isset($data->joinNop->joinKec->nama_kec){{$data->joinNop->joinKec->nama_kec}}@endisset" placeholder="Kecamatan" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kab_nop" class="col-sm-4 col-form-label">Kabupaten</label>
                                <div class="col-sm-8">
                                    <input name="kab_nop" type="text" id="kab_nop" class="form-control" value="@isset($data->joinNop->joinKab->nama_kab){{$data->joinNop->joinKab->nama_kab}}@endisset" placeholder="Kabupaten" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kode_jenis_perolehan" class="col-sm-4 col-form-label">Jenis Perolehan <small>(atas Tanah/Bangunan)</small></label>
                                <div class="col-sm-8">
                                    <input name="kode_jenis_perolehan" type="text" id="kode_jenis_perolehan" class="form-control" value="@isset($data->joinJenisPerolehan->nama_jenis_perolehan){{$data->joinJenisPerolehan->nama_jenis_perolehan}}@endisset" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="no_sertifikat" class="col-sm-4 col-form-label">Nomor Sertifikat</label>
                                <div class="col-sm-8">
                                    <input name="no_sertifikat" type="text" id="no_sertifikat" class="form-control" value="@isset($data->joinNop->no_sertifikat){{$data->joinNop->no_sertifikat}}@endisset" placeholder="Nomor Sertifikat..." disabled>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-1"></div> -->
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="luas_tanah" class="col-sm-4 col-form-label">Luas Tanah</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <input name="luas_tanah" type="text" id="luas_tanah" class="form-control decimal" value="@isset($data->joinNop->luas_tanah){{$data->joinNop->luas_tanah}}@endisset" placeholder="Luas Tanah" disabled>
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
                                        <input name="luas_bangunan" type="text" id="luas_bangunan" class="form-control decimal" value="@isset($data->joinNop->luas_bangunan){{$data->joinNop->luas_bangunan}}@endisset" placeholder="Luas Bangunan" disabled>
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
                                        <input name="njop_tanah" type="text" id="njop_tanah" class="form-control integer" value="@isset($data->joinNop->njop_tanah){{$data->joinNop->njop_tanah}}@endisset" disabled>
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
                                        <input name="njop_bangunan" type="text" id="njop_bangunan" class="form-control integer" value="@isset($data->joinNop->njop_bangunan){{$data->joinNop->njop_bangunan}}@endisset" disabled>
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
                                        <input name="njop_pbb" type="text" id="njop_pbb" class="form-control integer" value="@isset($data->joinNop->njop_bangunan){{$data->joinNop->njop_bangunan}}@endisset" disabled>
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
                                        <input name="hak_nilai_pasar" type="text" id="hak_nilai_pasar" class="form-control integer" value="@isset($data->joinNop->hak_nilai_pasar){{$data->joinNop->hak_nilai_pasar}}@endisset" disabled>
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
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="npop" class="col-form-label">Nilai Perolehan Objek Pajak (NPOP)
                                    <br /><small><i>Memperhatikan nilai pada NJOP dan Nilai Transaksi/Nilai Pasar.</i></small>
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input name="npop" type="text" id="npop" class="form-control integer" value="{{ $data->npop }}" placeholder="NPOP" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="npoptkp" class="col-form-label">Nilai Perolehan Objek Pajak Tidak Kena Pajak (NPOPTKP)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input name="npoptkp" type="text" id="npoptkp" class="form-control integer" value="{{ $data->npoptkp }}" placeholder="NPOPTKP" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="col-sm-1"></div> -->

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="npopkp" class="col-form-label">Nilai Perolehan Objek Pajak Kena Pajak (NPOPKP)
                                    <br /><small><i>NPOP dikurangi dengan NPOPTKP</i></small>
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input name="npopkp" type="text" id="npopkp" class="form-control integer" value="{{ $data->npopkp }}" placeholder="NPOPKP" readonly>
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
                                    <input name="jumlah" type="text" id="jumlah" class="form-control integer" value="{{ $data->jumlah }}" placeholder="jumlah terutang" readonly>
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
                                    <input class="custom-control-input" type="radio" id="opsi_a" value="opsi_a" name="customRadio" @if ($data->opsi_a == 'Y'){{ 'checked' }}@endif>
                                    <label for="opsi_a" class="custom-control-label">A. Penghitungan Wajib Pajak</label>
                                </div>
                                <br />
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="opsi_b" value="opsi_b" name="customRadio" @if ($data->opsi_b == 'Y'){{ 'checked' }}@endif>
                                    <label for="opsi_b" class="custom-control-label">B. STPD BPHTB / SKPD Kurang Bayar / SKPDB Kurang Bayar Tambahan.</label>
                                    <div class="form-group row">
                                        <p for="no_b" class="col-sm-4">Nomor</p>
                                        <div class="col-sm-8">
                                            <input name="no_b" type="text" id="no_b" class="form-control" value="@isset ($data->no_b){{ $data->no_b }}@endisset" readonly>
                                        </div>
                                        <p for="tgl_b" class="col-sm-4">Tanggal</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input name="tgl_b" type="date" id="tgl_b" class="form-control" value="@isset ($data->tgl_b){{ $data->tgl_b }}@endisset" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="opsi_c" value="opsi_c" name="customRadio" @if ($data->opsi_c == 'Y'){{ 'checked' }}@endif>
                                    <label for="opsi_c" class="custom-control-label">C. Pengurangan dihitung sendiri</label>
                                    <div class="form-group row">
                                        <p for="persen_c" class="col-sm-4">Menjadi (Persen)</p>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input name="persen_c" type="text" id="persen_c" class="form-control decimal" value="@isset ($data->persen_c){{ $data->persen_c }}@endisset" placeholder="Persen..." readonly>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>
                                        </div>
                                        <p for="uraian_c" class="col-sm-4">Berdasarkan KHD No. </p>
                                        <div class="col-sm-8">
                                            <input name="uraian_c" type="text" id="uraian_c" class="form-control" value="@isset ($data->uraian_c){{ $data->uraian_c }}@endisset" placeholder="Peraturan KHD No...." readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input class="custom-control-input" type="radio" id="opsi_d" value="opsi_d" name="customRadio" @if ($data->opsi_d == 'Y'){{ 'checked' }}@endif>
                                    <label for="opsi_d" class="custom-control-label">D. Lainnya</label>
                                    <input name="uraian_d" type="text" id="uraian_d" class="form-control" value="@isset ($data->uraian_d){{ $data->uraian_d }}@endisset" placeholder="Lainnya...." readonly>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-5">
                            <div class="form-group row">
                                <label for="jumlah_setor" class="col-form-label col-md-4">Jumlah </label>
                                <div class="input-group col-md-8">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp.</span>
                                    </div>
                                    <input name="jumlah_setor" type="text" autocomplete="off" id="jumlah_setor" class="form-control integer" value="@isset($data->jumlah_setor) {{ $data->jumlah_setor }}@endisset" placeholder="Jumlah yang disetor" readonly>
                                </div>
                                <br /><small><i>(Berdasarkan perhitungan BPHTB terutang dan Opsi Setoran BPHTB)</i></small>
                            </div>
                            @if($data->status_transaksi == STATUS_TRANSAKSI_LUNAS)
                            <div class="form-group row">
                                <label for="no_rekening_bank" class="col-form-label col-md-4">No Rekening
                                </label>
                                <div class="input-group col-md-8">
                                    <input name="no_rekening_bank" type="text" id="no_rekening_bank" class="form-control" value="{{ $data->no_rekening_bank }}" readonly>
                                </div>
                            </div>
                            @endif
                            <div class="form-group row">
                                <label for="tgl_setor" class="col-form-label col-md-4">Tanggal Setor</label>
                                <div class="input-group col-md-8">
                                    <input name="tgl_setor" type="date" id="tgl_setor" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama_penyetor" class="col-form-label col-md-4">Nama Penyetor</label>
                                <input name="nama_penyetor" type="text" id="nama_penyetor" autocomplete="off" class="form-control col-md-8" value="@isset($data->nama_penyetor) {{ $data->nama_penyetor }}@endisset" placeholder="Nama Penyetor" readonly>
                            </div>
                            <div class="form-group row">
                                <label for="status_transaksi" class="col-form-label col-md-4">Status</label>
                                <select name="status_transaksi" id="status_transaksi" class="form-control col-md-8" aria-placeholder="Status Transaksi" readonly>
                                    <!-- <option value=""></option> -->
                                    <option value="{{ STATUS_TRANSAKSI_LUNAS }}" {{ STATUS_TRANSAKSI_LUNAS == $data->status_transaksi ? 'selected' : ''}}>{{ STATUS_TRANSAKSI_LUNAS }}</option>
                                    <option value="{{ STATUS_TRANSAKSI_BELUM_LUNAS }}" {{ STATUS_TRANSAKSI_BELUM_LUNAS == $data->status_transaksi ? 'selected' : ''}}>{{ STATUS_TRANSAKSI_BELUM_LUNAS }}</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="tgl_peralihan" class="col-form-label col-md-4">Tgl BPHTB</label>
                                <input name="tgl_peralihan" type="date" id="tgl_peralihan" autocomplete="off" class="form-control col-md-8" readonly>
                            </div>
                        </div>

                    </div>
                </div> <!-- .card body -->


                <div class="card-footer">

                    <div class="row">
                        <div class="col-md-6">
                            @isset($data->joinPPAT->nama)
                            <div class="form-group row">
                                <label class="col-sm-4">Nama PPAT</label>
                                <input name="nama_ppat" id="nama_ppat" type="text" class="form-control col-sm-8" value="{{'('.$data->kode_ppat. ') - '.$data->joinPPAT->nama}}" disabled>
                            </div>
                            @endisset
                            @if($data->status_transaksi != STATUS_TRANSAKSI_LUNAS)
                            <div class="form-group row">
                                <label class="col-sm-4 text-danger">Status Transaksi</label>
                                <input name="status_transaksi" id="status_transaksi" type="text" class="form-control col-sm-8 bg-danger" value="{{$data->status_transaksi . ' ['.$data->tgl_pelunasan .']'}}" disabled>
                            </div>
                            @else
                            <div class="form-group row">
                                <label class="col-sm-4 text-success">Status Transaksi</label>
                                <input name="status_transaksi" id="status_transaksi" type="text" class="form-control col-sm-8 bg-success" value="{{$data->status_transaksi . ' ['.$data->tgl_pelunasan .']'}}" disabled>
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="no_rekening_bank" class="col-form-label">Pilih Rekening Pembayaran
                                </label>
                                <div class="input-group">
                                    @if($data->status_transaksi != STATUS_TRANSAKSI_LUNAS)
                                    <select name="get_rekening" id="get_rekening" class="form-control" aria-placeholder="Status Transaksi" readonly>
                                        <!-- <option value=""></option> -->
                                    </select>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <img id="preview_img_pembayaran" src="{{$data->file_berkas_bukti_pembayaran}}" class="img-thumbnail">
                        </div>
                        <div class="col-md-3">
                            @if($data->status_transaksi != STATUS_TRANSAKSI_LUNAS)
                            @if ($data->berkas_bukti_pembayaran != null || $data->berkas_bukti_pembayaran != '')
                            <a href="javascript:void(0)" class="btn btn-success btn-xl float-right" onclick="add()">
                                <i class="fas fa-receipt mr-2"></i>
                                Upload Ulang <br /> Bukti Pelunasan
                            </a>
                            @else
                            <a href="javascript:void(0)" class="btn btn-warning btn-xl float-right" onclick="add()">
                                <i class="fas fa-receipt mr-2"></i>
                                Upload Bukti <br /> Pelunasan
                            </a>
                            @endif
                            @endif

                            @if($data->status_transaksi != STATUS_TRANSAKSI_LUNAS)
                            @if ($data->berkas_bukti_pembayaran != null || $data->berkas_bukti_pembayaran != '')
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-upload">
                                Upload Bukti <br /> Pelunasan
                            </button>
                            @else
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-upload">
                                Upload Bukti <br /> Pelunasan
                            </button>
                            @endif
                            @endif
                        </div>
                    </div>

                </div> <!-- .card footer -->
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLongTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" class="form-horizontal" id="form_upload_bukti_pembayaran">

                    <div class="form-group">
                        <select name="get_rekening_update" id="get_rekening_update" class="form-control" aria-placeholder="Status Transaksi" readonly>
                            <!-- <option value=""></option> -->
                        </select>
                    </div>
                    <div class="form-group">
                        <p class="text-indigo">Silahkan upload bukti pelunasan / Pembayaran BPHTB!
                            <br /><small>File berbentuk foto/gambar, maksimal 3 MB</small>
                        </p>
                        <div class="custom-file">
                            <input type="file" name="berkas_bukti_pembayaran" class="custom-file-input form-control" id="berkas_bukti_pembayaran" onchange="loadPreview(this)" required>
                            <label class="custom-file-label" for="berkas_bukti_pembayaran">Pilih File Maksimal 3
                                MB...</label>
                        </div>
                    </div>

                    <div class="form-group">
                        @if ($data->berkas_bukti_pembayaran != null && $data->berkas_bukti_pembayaran != '')
                        <img src="{{ url('upload/berkas_bukti_pembayaran/'.$data->berkas_bukti_pembayaran) }}" alt="" class="img-fluid img-thumbnail" width="160" height="160" id="preview_bukti_pembayaran">
                        @else
                        <img src="" alt="" class="img-fluid img-thumbnail d-none" id="preview_bukti_pembayaran">
                        @endif
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-block bg-indigo" onclick="save()" id="btnSave">Simpan</button>
            </div>
        </div>
        </form>
    </div>
</div>

<!-- Modal Biasa  -->

<div class="modal fade" id="modal-upload">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLongTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('ppat.pembayaran.upload',$data->id)}}" class="form-horizontal" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <select name="get_rekening_update_dua" id="get_rekening_update_dua" class="form-control" aria-placeholder="Status Transaksi" readonly>
                            <!-- <option value=""></option> -->
                        </select>
                    </div>
                    <div class="form-group">
                        <p class="text-indigo">Silahkan upload bukti pelunasan / Pembayaran BPHTB!
                            <br /><small>File berbentuk foto/gambar, maksimal 3 MB</small>
                        </p>
                        <div class="custom-file">
                            <input type="file" name="berkas_bukti_pembayaran_dua" class="custom-file-input form-control" id="berkas_bukti_pembayaran_dua" onchange="loadPreview(this)" required>
                            <label class="custom-file-label" for="berkas_bukti_pembayaran">Pilih File Maksimal 3
                                MB...</label>
                        </div>
                    </div>

                    <div class="form-group">
                        @if ($data->berkas_bukti_pembayaran != null && $data->berkas_bukti_pembayaran != '')
                        <img src="{{ url('upload/berkas_bukti_pembayaran/'.$data->berkas_bukti_pembayaran) }}" alt="" class="img-fluid img-thumbnail" width="160" height="160" id="preview_bukti_pembayaran">
                        @else
                        <img src="" alt="" class="img-fluid img-thumbnail d-none" id="preview_bukti_pembayaran">
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-block bg-indigo">Simpan</button>
                </div>
            </form>
        </div>
        </form>
    </div>
</div>




@endSection

@section('script')
<script type="text/javascript" src="{{ asset('lte/plugins/auto-numeric-4.5.4/AutoNumeric.js') }}"></script>
<script>
    var idPeralihan = '{{ $id }}';

    let luasTanah, luasBangunan, persen_c;
    let njopTanah, njopBangunan, njopPBB, nilaiPasar, npop, npoptkp, npopkp, jumlah, jumlahSetor;

    $(document).ready(function() {
        setAutoNumeric();
        $("#tgl_setor").val("{{ $data->tgl_setor }}");
        $("#tgl_peralihan").val("{{ $data->tgl_peralihan }}");
    });

    // Ambil select
    $.ajax({
        url: "{{url('')}}/rekening/get",
        dataType: "JSON",
        success: function(res) {
            console.log(res);
            $.each(res, function(index, element) {
                $("#get_rekening").append('<option value=' + element.no_rekening + '>' + element.no_rekening + " - " + element.nama_rekening + '</option>');
                $("#get_rekening_update").append('<option value=' + element.no_rekening + '>' + element.no_rekening + " - " + element.nama_rekening + '</option>');
                // $("#get_rekening_dua").append('<option value=' + element.no_rekening + '>' + element.no_rekening + " - " + element.nama_rekening + '</option>');
                $("#get_rekening_update_dua").append('<option value=' + element.no_rekening + '>' + element.no_rekening + " - " + element.nama_rekening + '</option>');
            })
            // $("#get_rekening").append("<option value='" + res.no_rekening + "'>" + res.no_rekening + ' - ' + res.nama_rekening + "<option>");
        }
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
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

    function add() {
        actionModal = 'add';


        $('#modal').modal('show');
        $('.modal-title').text('Upload Bukti Pembayaran');
    }

    function save() {

        $('#btnSave').text('Menyimpan...');
        $('#btnSave').attr('disabled', true);


        var formData = new FormData($('#form_upload_bukti_pembayaran')[0]);
        formData.append('_method', 'PUT');

        var url = "{{ route('ppat.peralihan.update_bukti_pembayaran', $id) }}";

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data) {
                if (data.result) {
                    $('#modal').modal('hide');

                    $('#btnSave').text('Simpan');
                    $('#btnSave').attr('disabled', false);

                    window.location = "{{ route('ppat.peralihan') }}";

                } else if (data.result == false) {
                    toastr.error('ada kesalahan');
                }

            }
        });

    }

    function loadPreview(input) {
        //console.log(input.name);
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {

                $('#preview_bukti_pembayaran').removeClass('d-none');

                $('#preview_bukti_pembayaran')
                    .attr('src', e.target.result)
                    .width(160)
                    .height(160);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection