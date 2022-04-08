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
                <strong>{{ strtoupper($data->nama_wp) }}</strong><br>
                <strong>NIK : {{ $data->format_nik }} </strong><br>
                <i>Alamat : </i><br />
                {{ $data->alamat_wp }}<br>
                RT/RW. {{ $data->rtrw_wp }}<br>
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
                {{ $data->letak_nop }}<br>
                RT/RW. {{ $data->rtrw_nop }}<br>
                Desa
                @isset($data->joinDesaNop->nama_desa){{ $data->joinDesaNop->nama_desa }}@endisset<br>
                Kec. @isset($data->joinKecNop->nama_kec){{ $data->joinKecNop->nama_kec }}@endisset<br>
                @isset($data->joinKabNop->nama_kab){{ $data->joinKabNop->nama_kab }}@endisset
            </address>
        </div>
        <!-- /.col -->
        @if ($data->kode_ppat != null || $data->kode_ppat != '')
        <div class="col-sm-2 invoice-col">
            <b class="text-indigo">PPAT :</b>
            <address>
                <b> @isset($data->joinPPAT->nama){{ $data->joinPPAT->nama }}@endisset</b><br>
                Kode PPAT : <b>{{ $data->kode_ppat }}</b><br>
            </address>
        </div>
        @endif
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
                        <!-- <td></td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               <td></td> -->
                        <td colspan="5" class="text-right"><b>NJOP PBB</b></td>
                        <td class="text-right"><b>Rp. </b></td>
                        <td class="text-right"><b>{{ $data->jl_total }}</b></td>
                    </tr>
                    <tr class="table-secondary">
                        <!-- <td></td>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          <td></td> -->
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
                        Status BPHTB :
                        <h5>
                            <b> {{ strtoupper($data->status_bphtb) }}</b>
                        </h5>
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


                    <!-- Untuk menampilkan Qris
                    Disable dulu karena fiturnya belum ready -->
                    {{--
                        @isset($data->joinRekening->file_qris)
                    <div class="col-sm-6">
                        <img src="{{ $data->joinRekening->file_qris }}" id="gambar-qris-bank" alt="QRIS" style="width:120px;height:120px;" style="opacity: .9" class="float-right">
                </div>
                @endisset
                --}}

            </div>
        </div>

        <div class="card-footer d-print-none">
            <a href="#" rel="noopener" target="_blank" class="btn bg-indigo btn-sm" onclick="printFunction()">
                <i class="fas fa-print mr-1"></i> Print
            </a>
            @if (Auth()->user()->user_group >= USER_KABAN)
            <!-- Jika user PPAT dan WP -->
            @if ($data->status_transaksi != STATUS_TRANSAKSI_LUNAS)
            <button type="button" class="btn btn-sm bg-indigo float-right" data-toggle="modal" data-target="#modal-upload">
                <i class="fas fa-cloud-upload-alt mr-2"></i> Upload Bukti Pelunasan
            </button>
            @endif
            @endif

            @if (Auth()->user()->user_group <= USER_ADMIN || Auth()->user()->user_group == USER_KABID)
                <!-- JIKA USERNYA ADMIN ATAU KABID-->
                @if ($data->status_bphtb == STATUS_BPHTB_BELUM_VERIFIKASI)
                <a href="{{ route('bphtb.verifikasi.edit', ['id' => $data->id]) }}" type="button" class="btn btn-sm bg-indigo float-right">
                    <i class="fas fa-user-check mr-2"></i> Verifikasi
                </a>
                @endif
                @endif
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


<!-- Modal  -->

<div class="modal fade" id="modal-upload">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <h5 class="modal-title" id="modalLongTitle">Upload Bukti Pelunasan BPHTB </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('ppat.pembayaran.upload', $data->id) }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id_bphtb" class="form-control" value="{{ $data->id }}">
                    <div class="form-group">
                        Silahkan pilih Nomor Rekening Bank !
                        <select name="get_rekening_update" id="get_rekening_update" class="form-control" aria-placeholder="Pilih Rekening">
                            <!-- <option value=""></option> -->
                        </select>
                    </div>
                    <div class="form-group">
                        <p class="text-indigo">Silahkan upload bukti pelunasan / Pembayaran BPHTB!
                            <br /><small>File berbentuk foto/gambar, maksimal 3 MB</small>
                        </p>
                        <div class="custom-file">
                            <input type="file" name="berkas_bukti" accept=".jpg, .jpeg, .png|image/*" class="custom-file-input form-control" id="berkas_bukti" onchange="loadPreview(this)" required>
                            <label class="custom-file-label" for="berkas_bukti">Pilih File Maksimal 3
                                MB...</label>
                        </div>
                    </div>
                    <div class="form-group">
                        @if ($data->berkas_bukti_pembayaran != null && $data->berkas_bukti_pembayaran != '')
                        <img src="{{ url('upload/berkas_bukti_pembayaran/' . $data->berkas_bukti_pembayaran) }}" alt="" class="img-fluid img-thumbnail" width="160" height="160" id="preview_bukti_pembayaran">
                        @else
                        <img src="" alt="" class="img-fluid img-thumbnail d-none" id="preview_bukti_pembayaran">
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-block bg-indigo"><i class="fas fa-cloud-upload-alt mr-2"></i>
                        Upload</button>
                </div>
            </form>
        </div>
        </form>
    </div>
</div>

{{-- <div class="modal fade" id="modal-verifikasi">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-indigo">
                <h5 class="modal-title" id="modalLongTitle">Verifikasi dan Validasi BPHTB </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('bphtb.verifikasi.update',$data->id)}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
@csrf
<div class="modal-body">
    <input type="hidden" name="id_bphtb" class="form-control" value="{{$data->id}}">
    <div class="form-group text-indigo">
        Status Pelunasan
        <select name="get_status_pelunasan_update" id="get_status_pelunasan_update" class="form-control" aria-placeholder="Status Pelunasan">
            <option value="{{STATUS_PEMBAYARAN_LUNAS}}">{{STATUS_PEMBAYARAN_LUNAS}}</option>
            <option value="{{STATUS_PEMBAYARAN_BELUM_BAYAR}}">{{STATUS_PEMBAYARAN_BELUM_BAYAR}}</option>
        </select>
    </div>
    <div class="form-group text-indigo">
        Diterima Oleh
        <select name="get_bendahara_update" id="get_bendahara_update" class="form-control" aria-placeholder="Diterima Oleh">
        </select>
    </div>
    <div class="form-group text-indigo">
        Tanggal Diterima
        <input name="get_tgl_diterima_update" type="date" id="get_tgl_diterima_update" class="form-control @error('get_tgl_diterima_update') is-invalid @enderror" value="{{ old('get_tgl_diterima_update') ? old('get_tgl_diterima_update') : date('Y-m-d') }}">
    </div>
    <div class="form-group text-indigo">
        Status BPHTB
        <select name="get_status_bphtb_update" id="get_status_bphtb_update" class="form-control" aria-placeholder="Status BPHTB">
            <option value="{{STATUS_BPHTB_SUDAH_DISETUJUI}}">{{STATUS_BPHTB_SUDAH_DISETUJUI}}</option>
            <option value="{{STATUS_BPHTB_BELUM_DISETUJUI}}">{{STATUS_BPHTB_BELUM_DISETUJUI}}</option>
        </select>
    </div>
    <div class="form-group text-indigo">
        Disetujui / Verifikasi Oleh
        <select name="get_verifikator_update" id="get_verifikator_update" class="form-control" aria-placeholder="Pilih nama">
        </select>
    </div>
    <div class="form-group text-indigo">
        Tanggal Persetujuan BPHTB
        <input name="get_tgl_verifikasi_update" type="date" id="get_tgl_verifikasi_update" class="form-control @error('get_tgl_verifikasi_update') is-invalid @enderror" value="{{ old('get_tgl_verifikasi_update') ? old('get_tgl_verifikasi_update') : date('Y-m-d') }}">
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
    <button type="submit" class="btn btn-block bg-indigo"><i class="fas fa-save mr-2"></i> Simpan</button>
</div>
</form>
</div>
</form>
</div>
</div> --}}


@endsection


@section('script')
<!-- Scrip Transaksi  -->
<script>
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

    $(document).ready(function() {
        // Ambil select Rekening
        $.ajax({
            url: "{{ url('') }}/rekening/get",
            dataType: "JSON",
            success: function(res) {
                // console.log(res);
                $.each(res, function(index, element) {
                    $("#get_rekening").append('<option value=' + element.no_rekening + '>' +
                        element.nama_rekening + '</option>');
                    $("#get_rekening_update").append('<option value=' + element
                        .no_rekening + '>' + element.nama_rekening + '</option>');
                })
            }
        });

        // Ambil Diterima Oleh 
        $.ajax({
            url: "{{ url('') }}/bendahara/get",
            dataType: "JSON",
            success: function(res) {
                console.log(res);
                $.each(res, function(index, element) {
                    $("#get_bendahara_update").append('<option value=' + element.id + '>' +
                        element.nama_penandatangan + '</option>');
                })
            }
        });

        // Ambil Diverifikasi Oleh 
        $.ajax({
            url: "{{ url('') }}/verifikator/get",
            dataType: "JSON",
            success: function(res) {
                console.log(res);
                $.each(res, function(index, element) {
                    $("#get_verifikator_update").append('<option value=' + element.id +
                        '>' + element.nama_penandatangan + '</option>');
                })
            }
        });

    });

    function updateRekening() {
        let rekening_bank = $("#get_rekening").val()
        // $("#no-rek-bank").html('');
        $("#no-rek-bank").text('');
        $("#nama-rek-bank").text('');
        $("#gambar-qris-bank").attr('src', '')

        if (rekening_bank != '' && rekening_bank != null) {
            $.ajax({
                url: "{{ url('') }}/rekening/get/" + rekening_bank,
                success: function(res) {
                    console.log(res);
                    $.each(res, function(index, element) {
                        $("#no-rek-bank").text('Nomor Rek.  : # ' + element.no_rekening);
                        $("#nama-rek-bank").text(element.nama_rekening);
                        $("#gambar-qris-bank").attr('src', element.file_qris)
                    })
                }
            });
        }
    }
    // Print 
    function printFunction() {
        window.print();
    }
</script>
@endsection