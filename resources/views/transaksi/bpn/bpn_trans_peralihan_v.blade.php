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
                    <label>{{date('d/m/Y', strtotime($data->tgl_peralihan))}}</label>
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
                <strong>@isset($data->joinProfilKepada->nama){{$data->joinProfilKepada->nama}}@endisset</strong><br>
                <strong>NIK : {{$data->formatNikKepada}} </strong><br>
                <i>Alamat : </i><br />
                @isset($data->joinProfilKepada->alamat){{$data->joinProfilKepada->alamat}}@endisset<br>
                RT/RW. @isset($data->joinProfilKepada->rtrw){{$data->joinProfilKepada->rtrw}}@endisset<br>
                Desa @isset($data->joinProfilKepada->joinDesa->nama_desa){{$data->joinProfilKepada->joinDesa->nama_desa}}@endisset<br>
                Kec. @isset($data->joinProfilKepada->joinKec->nama_kec){{$data->joinProfilKepada->joinKec->nama_kec}}@endisset<br>
                @isset($data->joinProfilKepada->joinKab->nama_kab){{$data->joinProfilKepada->joinKab->nama_kab}}@endisset
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-5 invoice-col">
            <strong class="text-indigo">Nomor Objek Pajak : </strong>
            <address>
                <strong>{{$data->format_nop}}</strong><br>
                <b>Sertifikat : {{$data->joinNop->no_sertifikat}}</b><br>
                <i>Letak : </i><br />
                @isset($data->joinNop->letak){{$data->joinNop->letak}}@endisset<br>
                RT/RW. @isset($data->joinNop->rtrw){{$data->joinNop->rtrw}}@endisset<br>
                Desa @isset($data->joinNop->joinDesa->nama_desa){{$data->joinNop->joinDesa->nama_desa}}@endisset<br>
                Kec. @isset($data->joinNop->joinKec->nama_kec){{$data->joinNop->joinKec->nama_kec}}@endisset<br>
                @isset($data->joinNop->joinKab->nama_kab){{$data->joinNop->joinKab->nama_kab}}@endisset
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-2 invoice-col">
            <b class="text-indigo">PPAT :</b>
            <address>
                <b> @isset($data->joinPPAT->nama){{$data->joinPPAT->nama}}@endisset</b><br>
                Kode PPAT : <b>{{$data->kode_ppat}}</b><br>
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
                        <!-- <th></th> -->
                        <!-- <th></th> -->
                        <th colspan="2" class="text-center">NJOP PBB / M<sup>2 </sup> </th>
                        <!-- <th></th> -->
                        <th colspan="2" class="text-center">Luas x NJOP / M<sup>2 </sup></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tanah</td>
                        <td class="text-right">{{$data->joinNop->jl_luas_tanah}}</td>
                        <td>M<sup>2</sup></td>
                        <td class="text-right">Rp. </td>
                        <td class="text-right">{{$data->joinNop->jl_njop_tanah}}</td>
                        <td class="text-right">Rp. </td>
                        <td class="text-right">{{$data->joinNop->jl_tanah}}</td>
                    </tr>
                    <tr>
                        <td>Bangunan</td>
                        <td class="text-right">{{$data->joinNop->jl_luas_bangunan}}</td>
                        <td>M<sup>2</sup></td>
                        <td class="text-right">Rp. </td>
                        <td class="text-right">{{$data->joinNop->jl_njop_bangunan}}</td>
                        <td class="text-right">Rp. </td>
                        <td class="text-right">{{$data->joinNop->jl_bangunan}}</td>
                    </tr>
                    <tr class="table-secondary">
                        <!-- <td></td>
                        <td></td>
                        <td></td>
                        <td></td> -->
                        <td colspan="5" class="text-right"><b>NJOP PBB</b></td>
                        <td class="text-right"><b>Rp. </b></td>
                        <td class="text-right"><b>{{$data->joinNop->jl_total}}</b></td>
                    </tr>
                    <tr class="table-secondary">
                        <!-- <td></td>
                        <td></td>
                        <td></td>
                        <td></td> -->
                        <td colspan="5" class="text-right"><b>Hak Transaksi / Nilai Pasar</b></td>
                        <td class="text-right"><b>Rp. </b></td>
                        <td class="text-right"><b>{{$data->joinNop->format_hak_nilai_pasar}}</b></td>
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
                        Status Transaksi :
                        <h5>
                            <b> {{strtoupper($data->status_transaksi)}}</b>
                        </h5>
                        <h4>
                            <input type="text" class="form-control text-indigo" id="total_final" name="total_final" value="{{'Rp.  '. $data->format_jumlah}}" disabled>
                        </h4>
                        <label class="text-indigo" id="no-rek-bank">{{'Nomor Rek. # : ' . $data->no_rekening_bank}} </label>
                        <label class="text-indigo" id="nama-rek-bank"> @isset($data->joinRekening->nama_rekening) {{$data->joinRekening->nama_rekening}} @endisset </label>
                    </div>
                    <div class="col-sm-6">
                        <img src="{{$data->joinRekening->file_qris}}" id="gambar-qris-bank" alt="QRIS" style="width:120px;height:120px;" style="opacity: .9" class="float-right">
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
                        <td class="text-right">{{$data->format_npop}}</td>
                    </tr>
                    <tr>
                        <td class="text-right">NPOPTKP</td>
                        <td>Rp. </td>
                        <td class="text-right">{{$data->format_npoptkp}}</td>
                    </tr>
                    <tr>
                        <td class="text-right">NPOPKP</td>
                        <td>Rp. </td>
                        <td class="text-right">{{$data->format_npopkp}}</td>
                    </tr>
                    <tr class="table-secondary">
                        <td class="text-right"><b>BPHTB (5%)</b></td>
                        <td><b>Rp. </b></td>
                        <td class="text-right"><b>{{$data->format_jumlah}}</b></td>
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