@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

@php

@endphp

<div class="row pb-4">
    <div class="col-12">
        <div class="card p-2 mb-0">
            <div class="card-header bg-warning">
                <div class="d-md-flex justify-content-md-between align-items-center">
                    <div class="card-title">
                        <p>
                            <small>
                                * Berikut merupakan fitur untuk melakukan pembatalan
                                terhadap BPHTB yang telah disetujui sebelumnya!
                            </small> <br />
                            Silahkan masukkan NOP dan NTPD BPHTB yang akan dilakukan pembatalan!
                        </p>
                    </div>
                </div>
            </div>
            <form action="{{route('bphtb.pembatalan.post')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-header border-0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="nop_mask" class="col-sm-2 col-form-label text-right">
                                    Nomor Objek Pajak
                                </label>
                                <div class="col-sm-3">
                                    <input type="number" min="100000000000000000" max="999999999999999999" class="form-control" name="nop" id="nop" value="{{old('nop')}}" placeholder="{{ $placeholderNop }}" required>
                                    @error('nop')
                                    <div class="invalid-feedback">
                                        $message
                                    </div>
                                    @enderror
                                </div>
                                <label for="ntpd_mask" class="col-sm-2 col-form-label text-right">
                                    Nomor NTPD
                                </label>
                                <div class="col-sm-3">
                                    <input type="number" min="2100000000000" max="10900000000000" class="form-control" name="no_b" id="no_b" value="{{old('no_b')}}" placeholder="{{ $placeholderNoB }}" required>
                                    @error('no_b')
                                    <div class="invalid-feedback">
                                        $message
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-2">
                                    <button type="submit" class="btn btn-block btn-warning mr-2">
                                        <i class="fas fa-search mr-1"></i> Cari
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@if($data != "KOSONG")
<section class="invoice p-3 mb-3 bg-light">
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-5 invoice-col">
            <strong class="text-indigo">Wajib Pajak : </strong>
            <address>
                <strong> {{strtoupper($data->nama_wp)}} </strong><br>
                <strong>NIK : {{$data->format_nik}} </strong><br>
                <i>Alamat : </i><br />
                {{$data->alamat_wp}} <br>
                RT/RW. {{$data->rtrw_wp}} <br>
                Desa
                @isset($data->joinDesaWp->nama_desa) {{$data->joinDesaWp->nama_desa}} @endisset<br>
                Kec.
                @isset($data->joinKecWp->nama_kec) {{$data->joinKecWp->nama_kec}} @endisset<br>
                @isset($data->joinKabWp->nama_kab) {{$data->joinKabWp->nama_kab}} @endisset
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-5 invoice-col">
            <strong class="text-indigo">Nomor Objek Pajak : </strong>
            <address>
                <strong> {{$data->format_nop}} </strong><br>
                <b>Sertifikat : {{$data->no_sertifikat}} </b><br>
                <i>Letak : </i><br />
                {{$data->letak_nop}} <br>
                RT/RW. {{$data->rtrw_nop}} <br>
                Desa
                @isset($data->joinDesaNop->nama_desa) {{$data->joinDesaNop->nama_desa}} @endisset<br>
                Kec. @isset($data->joinKecNop->nama_kec) {{$data->joinKecNop->nama_kec}} @endisset<br>
                @isset($data->joinKabNop->nama_kab) {{$data->joinKabNop->nama_kab}} @endisset
            </address>
        </div>
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table">
                <thead>
                    <tr class="table-secondary">
                        <th>Uraian</th>
                        <th colspan="2" class="text-center">Luas M<sup>2</sup></th>
                        <th colspan="2" class="text-center">NJOP PBB / M<sup>2 </sup> </th>
                        <th colspan="2" class="text-center">Luas x NJOP / M<sup>2 </sup></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tanah</td>
                        <td class="text-right"> {{$data->jl_luas_tanah}} </td>
                        <td>M<sup>2</sup></td>
                        <td class="text-right">Rp. </td>
                        <td class="text-right"> {{$data->jl_njop_tanah}} </td>
                        <td class="text-right">Rp. </td>
                        <td class="text-right">{{ $data->jl_tanah}} </td>
                    </tr>
                    <tr>
                        <td>Bangunan</td>
                        <td class="text-right"> {{$data->jl_luas_bangunan}} </td>
                        <td>M<sup>2</sup></td>
                        <td class="text-right">Rp. </td>
                        <td class="text-right"> {{$data->jl_njop_bangunan}} </td>
                        <td class="text-right">Rp. </td>
                        <td class="text-right"> {{$data->jl_bangunan}} </td>
                    </tr>
                    <tr class="table-secondary">
                        <!-- <td></td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <td></td> -->
                        <td colspan="5" class="text-right"><b>NJOP PBB</b></td>
                        <td class="text-right"><b>Rp. </b></td>
                        <td class="text-right"><b> {{$data->jl_total}} </b></td>
                    </tr>
                    <tr class="table-secondary">
                        <!-- <td></td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <td></td> -->
                        <td colspan="5" class="text-right"><b>Hak Transaksi / Nilai Pasar</b></td>
                        <td class="text-right"><b>Rp. </b></td>
                        <td class="text-right"><b> {{$data->format_hak_nilai_pasar}} </b></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <!-- accepted payments column -->
        <div class="col-6">
        </div>
        <!-- /.col -->
        <div class="col-6">
            <p class="lead">PENGHITUNGAN BPHTB</p>

            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <td style="width:50%" class="text-right">NPOP</td>
                        <td>Rp. </td>
                        <td class="text-right"> {{$data->format_npop}} </td>
                    </tr>
                    <tr>
                        <td class="text-right">NPOPTKP</td>
                        <td>Rp. </td>
                        <td class="text-right"> {{$data->format_npoptkp}} </td>
                    </tr>
                    <tr>
                        <td class="text-right">NPOPKP</td>
                        <td>Rp. </td>
                        <td class="text-right"> {{$data->format_npopkp}} </td>
                    </tr>
                    <tr class="table-secondary">
                        <td class="text-right"><b>BPHTB (5%)</b></td>
                        <td><b>Rp. </b></td>
                        <td class="text-right"><b> {{$data->format_jumlah}} </b></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-batal">
                <i class="fas fa-save mr-1"></i> Batalkan BPHTB
            </button>
        </div>
    </div>

</section>

<!-- Modal Konfirmasi -->
<!-- Modal Ini berisi input password dan ambil id bphtb yang akan dibatalkan -->
<div class="modal fade" id="modal-batal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title">Warning Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Apakah anda yakin akan melakukan pembatalan BPHTB yang telah disetujui
                    atas nama : {{$data->nama_wp}} NOP : {{$data->format_nop}} <br />
                    dengan Nilai BPHTB Sebesar Rp. {{$data->format_jumlah}}

                </p>
                <p>Anda akan melakukan pembatalan BPHTB atas Nama &hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-outline-dark">OK</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<form action=" route('bphtb.pembatalan.update') " method="post" enctype="multipart/form-data">
    @csrf
    <div class="card-footer p-0 float-right">
        <button type="submit" class="btn btn-danger btn-lg">
            <i class="fas fa-save mr-1"></i> Batalkan BPHTB
        </button>
    </div>
</form>



@endif


@endsection

@section('script')

@endsection