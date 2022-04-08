@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')
<!-- Lihat Transaksi  -->
<!-- Main content -->
<section class="invoice p-3 mb-3">
    <!-- title row -->
    <div class="row">
        <div class="col-12">
            <div class="card-widget widget-user-2 widget-user-header">
                <div class="widget-user-image">
                    <img src="/upload/app/logos/default.png" alt="BPHTB Online" style="width:60px;height:60px;" style="opacity: .9">
                </div>
                <!-- /.widget-user-image -->
                <div class="float-right">
                    <label>{{ date('d/m/Y', strtotime($data->tgl_bphtb)) }}</label>
                    <a href="#" rel="noopener" target="_blank" class="btn btn-default btn-sm ml-2 d-print-none" onclick="printFunction()">
                        <i class="fas fa-print"></i> Print
                    </a>
                </div>
                <h3 class="widget-user-username">BPKK Aceh Singkil</h3>
                <h5 class="widget-user-desc">BPHTB Online</h5>
            </div>
        </div>
    </div>
    <hr />
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-5 invoice-col">
            <strong class="text-indigo">Wajib Pajak : </strong>
            <address>
                <strong>@isset($data->nama_wp){{ $data->nama_wp }}@endisset</strong><br>
                <strong>NIK : {{ $data->format_nik }} </strong><br>
                <i>Alamat : </i><br />
                @isset($data->alamat_wp){{ $data->alamat_wp }}@endisset<br>
                RT/RW. @isset($data->rtrw_wp){{ $data->rtrw_wp }}@endisset<br>
                Desa
                @isset($data->joinDesaWp->nama_desa){{ $data->joinDesaWp->nama_desa }}@endisset<br>
                Kec.
                @isset($data->joinKecWp->nama_kec){{ $data->joinKecWp->nama_kec }}@endisset<br>
                @isset($data->joinKabWp->nama_kab){{ $data->joinKabWp->nama_kab }}@endisset
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-5 invoice-col">
            <strong class="text-indigo">Nomor Objek Pajak : </strong>
            <address>
                <strong>{{ $data->format_nop }}</strong><br>
                <b>Sertifikat : {{ $data->no_sertifikat }}</b><br>
                <i>Letak : </i><br />
                @isset($data->letak_nop){{ $data->letak_nop }}@endisset<br>
                RT/RW. @isset($data->rtrw_nop){{ $data->rtrw_nop }}@endisset<br>
                Desa
                @isset($data->joinDesaNop->nama_desa){{ $data->joinDesaNop->nama_desa }}@endisset<br>
                Kec. @isset($data->joinKecNop->nama_kec){{ $data->joinKecNop->nama_kec }}@endisset<br>
                @isset($data->joinKabNop->nama_kab){{ $data->joinKabNop->nama_kab }}@endisset
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-2 invoice-col">
            <b class="text-indigo">PPAT :</b>
            <address>
                <b> @isset($data->joinPPAT->nama){{ $data->joinPPAT->nama }}@endisset</b><br>
                Kode PPAT : <b>{{ $data->kode_ppat }}</b><br>
            </address>
        </div>
        <!-- /.col -->
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
                        <td class="text-right">{{ $data->jl_luas_tanah }}</td>
                        <td>M<sup>2</sup></td>
                        <td class="text-right">Rp. </td>
                        <td class="text-right">{{ $data->jl_njop_tanah }}</td>
                        <td class="text-right">Rp. </td>
                        <td class="text-right">{{ $data->jl_tanah }}</td>
                    </tr>
                    <tr>
                        <td>Bangunan</td>
                        <td class="text-right">{{ $data->jl_luas_bangunan }}</td>
                        <td>M<sup>2</sup></td>
                        <td class="text-right">Rp. </td>
                        <td class="text-right">{{ $data->jl_njop_bangunan }}</td>
                        <td class="text-right">Rp. </td>
                        <td class="text-right">{{ $data->jl_bangunan }}</td>
                    </tr>
                    <tr class="table-secondary">
                        <td colspan="5" class="text-right"><b>NJOP PBB</b></td>
                        <td class="text-right"><b>Rp. </b></td>
                        <td class="text-right"><b>{{ $data->jl_total }}</b></td>
                    </tr>
                    <tr class="table-secondary">
                        <td colspan="5" class="text-right"><b>Hak Transaksi / Nilai Pasar</b></td>
                        <td class="text-right"><b>Rp. </b></td>
                        <td class="text-right"><b>{{ $data->format_hak_nilai_pasar }}</b></td>
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
            <div class="callout callout-default p-2">
                <div class="row">
                    <div class="col-sm-6">
                        Status Pembayaran :
                        <h5>
                            <b>
                                @if ($data->status_pembayaran == STATUS_PEMBAYARAN_LUNAS)
                                {{ strtoupper($data->status_pembayaran) }}
                                @else
                                @if ($data->berkas_bukti_pembayaran !== null)
                                SUDAH BAYAR (pending)
                                @else
                                {{ strtoupper($data->status_pembayaran) }}
                                @endif
                                @endif
                            </b>
                        </h5>
                        <h4>
                            <input type="text" class="form-control text-indigo" id="total_final" name="total_final" value="{{ 'Rp.  ' . $data->jl_setor }}" disabled>
                        </h4>
                        <label class="text-indigo" id="no-rek-bank">{{ 'Nomor Rek. # : ' . $data->no_rekening_bank }} </label>
                        <label class="text-indigo" id="nama-rek-bank"> @isset($data->joinRekening->nama_rekening)
                            {{ $data->joinRekening->nama_rekening }} @endisset </label>
                    </div>
                    <div class="col-sm-6">
                        @isset($data->joinRekening->file_qris)

                        <img src="{{ $data->joinRekening->file_qris }}" id="gambar-qris-bank" alt="QRIS" style="width:120px;height:120px;" style="opacity: .9" class="float-right">
                        @endisset
                    </div>
                </div>
            </div>

            <div class="card-footer d-print-none">
                <a href="#" rel="noopener" target="_blank" class="btn bg-indigo btn-sm" onclick="printFunction()">
                    <i class="fas fa-print mr-1"></i> Print
                </a>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-6">
            <p class="lead">PENGHITUNGAN BPHTB</p>

            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <td style="width:50%" class="text-right">NPOP</td>
                        <td>Rp. </td>
                        <td class="text-right">{{ $data->format_npop }}</td>
                    </tr>
                    <tr>
                        <td class="text-right">NPOPTKP</td>
                        <td>Rp. </td>
                        <td class="text-right">{{ $data->format_npoptkp }}</td>
                    </tr>
                    <tr>
                        <td class="text-right">NPOPKP</td>
                        <td>Rp. </td>
                        <td class="text-right">{{ $data->format_npopkp }}</td>
                    </tr>
                    <tr class="table-secondary">
                        <td class="text-right"><b>BPHTB (5%)</b></td>
                        <td><b>Rp. </b></td>
                        <td class="text-right"><b>{{ $data->format_jumlah }}</b></td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <hr />
</section>
<!-- /.content -->


@endsection


@section('script')
<!-- Scrip Transaksi  -->
<script>
    // Print 
    function printFunction() {
        window.print();
    }
</script>
@endsection