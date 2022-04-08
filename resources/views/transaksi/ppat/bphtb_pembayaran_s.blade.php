@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')
    <!-- Main content -->
    <section class="invoice p-3 mb-3">
        <!-- title row -->
        <div class="row">
            <div class="col-12">
                <div class="card-widget widget-user-2 widget-user-header">
                    <div class="widget-user-image">
                        <img src="/upload/app/logos/default.png" alt="BPHTB Online" style="width:60px;height:60px;"
                            style="opacity: .9">
                    </div>
                    <!-- /.widget-user-image -->
                    <div class="float-right">
                        <label>{{ date('d/m/Y', strtotime($data->tgl_bphtb)) }}</label>
                        <a href="#" rel="noopener" target="_blank" class="btn btn-default btn-sm ml-2 d-print-none"
                            onclick="printFunction()">
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
                                                            <input type="text" class="form-control text-indigo" id="total_final" name="total_final"
                                                                value="{{ 'Rp.  ' . $data->jl_setor }}" disabled>
                                                        </h4>
                                                        <label class="text-indigo"
                                                            id="no-rek-bank">{{ 'Nomor Rek. # : ' . $data->no_rekening_bank }} </label>
                                                        <label class="text-indigo" id="nama-rek-bank"> @isset($data->joinRekening->nama_rekening)
                                                            {{ $data->joinRekening->nama_rekening }} @endisset </label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        @isset($data->joinRekening->file_qris)
                                                            <img src="{{ $data->joinRekening->file_qris }}" id="gambar-qris-bank" alt="QRIS"
                                                                style="width:120px;height:120px;" style="opacity: .9" class="float-right">
                                                        @endisset
                                                    </div>
                                                </div>
                                            </div>

                                            @if ($data->status_pembayaran != STATUS_PEMBAYARAN_LUNAS && $data->berkas_bukti_pembayaran == null)
                                                <div class="card-footer d-print-none">
                                                    <button type="button" class="btn bg-indigo " data-toggle="modal"
                                                        data-target="#modalUploadButkiBayar">
                                                        <i class="fas fa-cloud-upload-alt mr-1"></i> Upload Bukti Pelunasan
                                                    </button>
                                                </div>
                                            @endif
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
                                    </div>
                                    <hr />
                                </section>


                                <div class="modal fade" id="modalUploadButkiBayar" tabindex="-1" aria-labelledby="modalUploadButkiBayarLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <form id="form-upload" action="{{ route('ppat.bphtb.pembayaran.store', ['id' => $data->id]) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalUploadButkiBayarLabel">Upload Bukti pembayaran</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <tr>
                                                                <th>Nama Rekening</th>
                                                                <td>
                                                                    {{ $data->joinRekening->nama_rekening }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>No. Rek</th>
                                                                <td>
                                                                    {{ $data->no_rekening_bank }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Jumlah Setor</th>
                                                                <td class="text-indigo text-lg">
                                                                    Rp {{ $data->jl_setor }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Terbilang</th>
                                                                <td class="text-gray">
                                                                    <i>{{ kekata($data->jumlah_setor) }} rupiah</i>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                    <div class="form-group row d-none preview">
                                                        <label class="col-sm-3 col-form-label">Preview</label>
                                                        <div class="col-sm-9">
                                                            <img id="preview_img" src="" class="img-fluid img-thumbnail" width="150" height="150" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="berkas_bukti_pembayaran" class="col-sm-3 col-form-label">Upload Berkas</label>
                                                        <div class="col-sm-9">
                                                            <div class="custom-file">
                                                                <input type="file" name="berkas_bukti_pembayaran"
                                                                    class="custom-file-input @error('berkas_bukti_pembayaran') is-invalid @enderror"
                                                                    id="berkas_bukti_pembayaran" onchange="loadPreviewGambar(this);"
                                                                    class="form-control">
                                                                <label class="custom-file-label" for="berkas_bukti_pembayaran">Choose file</label>
                                                                <span class="text-xs text-gray">Berkas maksimal 1 MB (png, jpg atau jpeg)</span>
                                                                @error('berkas_bukti_pembayaran')
                                                                    <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-toggle="modal"
                                                        data-target="#modalUploadButkiBayar">
                                                        Batal
                                                    </button>
                                                    <button type="submit" class="btn btn-default bg-indigo">
                                                        <i class="fas fa-cloud-upload-alt mr-1"></i>
                                                        Kirim Bukti
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endsection

                            @section('script')
                                <script>
                                    @error('berkas_bukti_pembayaran')
                                        $('#modalUploadButkiBayar').modal('show');
                                    @enderror

                                    $(document).on('submit', 'form', function() {
                                        $('button').attr('disabled', 'disabled');
                                    });

                                    function loadPreviewGambar(input, id) {
                                        id = id || '#preview_img';
                                        if (input.files && input.files[0]) {
                                            var reader = new FileReader();

                                            reader.onload = function(e) {
                                                $(id)
                                                    .attr('src', e.target.result)
                                                    .width(150)
                                            };

                                            $('.preview').removeClass('d-none');
                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    }
                                </script>
                            @endsection
