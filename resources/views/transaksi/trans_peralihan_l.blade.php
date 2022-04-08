@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')
<?php
$userGroup = Auth::user()->user_group;
?>
<div class="row">
    <div class="col-12">
        <div class="card card-default card-outline">
            <div class="card-header text-indigo">
                <div class="row">
                    <div class="col-md-3">
                        <h3 class="card-title">
                            <i class="fas fa-file-invoice-dollar mr-2"></i>
                            Daftar Transaksi BPHTB
                            </a>
                        </h3>
                    </div>
                    <div class="col-md-9 mt-2 mt-md-0">
                        <div class="d-md-flex justify-content-end">
                            <div class="mr-2">
                                <form action="{{ route('transaksi.peralihan') }}" method="GET">
                                    <div class="input-group input-group-sm">
                                        <select name="aktif" id="aktif" class="form-control">
                                            <option value="Y" {{ $aktif == 'Y' ? 'selected' : '' }}>Data Aktif</option>
                                            <option value="N" {{ $aktif == 'N' ? 'selected' : '' }}>Data Terhapus</option>
                                        </select>
                                        <input type="text" name="cari" class="form-control float-right" @if($keyword !="" ) ? value="{{$keyword}}" : @endif placeholder="Search">
                                        <div class="input-group-append">
                                            @if($clearButton == true)
                                            <a href="{{ route('transaksi.peralihan') }}" class="btn btn-default">
                                                <i class="fas fa-times text-danger"></i>
                                            </a>
                                            @endif
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search text-indigo"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="btn-group mt-2 mt-md-0" role="group" aria-label="Basic example">
                                <a href="{{ route('transaksi.peralihan.tambah') }}" class="btn btn-default btn-sm text-indigo">
                                    <i class="fas fa-plus-circle mr-2 ml-2"></i> Input Transaksi
                                </a>
                                <button type="button" class="btn btn-default btn-sm text-indigo" data-toggle="modal" data-target="#filterExportModal">
                                    <i class="fas fa-file-excel mr-2 ml-2"></i> Export
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead class="bg-indigo">
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama WP</th>
                            <th>Dari</th>
                            <th>NOP</th>
                            <th>Letak NOP</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            @if($userGroup == USER_KABID || $userGroup == USER_KABAN)
                            @if($value->status_bphtb != STATUS_BPHTB_SUDAH_DISETUJUI && $value->status_transaksi == STATUS_TRANSAKSI_LUNAS)
                            <th>Aksi</th>
                            @endif
                            @endif
                        </tr>
                    </thead>

                    <tbody class="text-dark">

                        @forelse ($data as $key => $value)
                        <?php
                        // warna pelunasan
                        if ($value->status_transaksi == STATUS_TRANSAKSI_BELUM_LUNAS) {
                            $warnaStatus = 'danger';
                        } elseif ($value->status_transaksi == STATUS_TRANSAKSI_LUNAS) {
                            $warnaStatus = 'success';
                        } else {
                            $warnaStatus = 'dark';
                        }
                        // warna Approved
                        if ($value->status_bphtb == STATUS_BPHTB_SUDAH_DISETUJUI) {
                            $warnaApproved = 'success';
                        } elseif ($value->status_bphtb == STATUS_BPHTB_BELUM_DISETUJUI) {
                            $warnaApproved = 'danger';
                        } else {
                            $warnaApproved = 'dark';
                        }
                        ?>
                        <tr>
                            <td>
                                <a href="{{ route('transaksi.peralihan.edit', $value->id) }}" class="text-indigo">
                                    {{ date('j F, Y', strtotime($value->tgl_peralihan))}}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('transaksi.peralihan.edit', $value->id) }}" class="text-indigo">
                                    {!! $value->dari_nik !!}
                                    @isset($value->joinProfilDari->nama)
                                    <br />
                                    {!! $value->joinProfilDari->nama !!}
                                    @endisset
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('transaksi.peralihan.edit', $value->id) }}" class="text-indigo">
                                    {!! $value->kepada_nik !!}
                                    @isset($value->joinProfilKepada->nama)
                                    <br />
                                    {!! $value->joinProfilKepada->nama !!}
                                    @endisset
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('transaksi.peralihan.edit', $value->id) }}" class="text-indigo">
                                    {{ $value->nop }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('transaksi.peralihan.edit', $value->id) }}" class="text-indigo">
                                    @isset($value->joinNop->joinKec->nama_kec)
                                    {{ $value->joinNop->joinKec->nama_kec }}
                                    @endisset
                                    <br />
                                    @isset($value->joinNop->joinDesa->nama_desa)
                                    {{ $value->joinNop->joinDesa->nama_desa }}
                                    @endisset
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('transaksi.peralihan.edit', $value->id) }}" class="text-indigo">
                                    {{ formatRupiah($value->jumlah) }}
                                </a>
                            </td>
                            <td>
                                @if($value->berkas_bukti_pembayaran !=""||$value->berkas_bukti_pembayaran !=NULL)
                                <a href="{{$value->file_berkas_bukti_pembayaran}}" class="btn btn-xs bg-indigo" target="_blank">
                                    <i class="fas fa-file-invoice-dollar mr-2"></i>Bukti Lunas
                                </a>
                                <br />
                                @endif
                                <small class="badge bg-{{$warnaStatus}}">
                                    @if($value->status_transaksi == STATUS_TRANSAKSI_LUNAS)
                                    {{ $value->status_transaksi .' ['.date('d-M-y', strtotime($value->tgl_setor)).']'}}
                                    @else
                                    {{ $value->status_transaksi}}
                                    @endif
                                </small>
                                <br />
                                <small class="badge bg-{{$warnaApproved}}">
                                    @if($value->status_bphtb == STATUS_BPHTB_SUDAH_DISETUJUI)
                                    {{ $value->status_bphtb  . '['.$value->tgl_persetujuan .']'}}
                                    @else
                                    {{ $value->status_bphtb}}
                                    @endif
                                </small>
                            </td>
                            @if($userGroup == USER_KABID || $userGroup == USER_KABAN)
                            @if($value->status_bphtb != STATUS_BPHTB_SUDAH_DISETUJUI && $value->status_transaksi == STATUS_TRANSAKSI_LUNAS)
                            <td>
                                <br />
                                <form action="{{route('pejabat.bphtb.approve',$value->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id_approve" value="{{$value->id}}" class="form-control">
                                    <button type="submit" class="btn btn-sm btn-success" onclick="approveFunction()">
                                        <i class="fas fa-check-square mr-2"></i>Setujui
                                    </button>
                                </form>
                            </td>
                            @endif
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-3">Data tidak ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div><!-- /.card-body -->
            <div class="card-footer">
                <div class="float-right">
                    {{ $data->links('templates.bootstrap-4') }}
                </div>
            </div>
        </div><!-- /.card -->
    </div> <!-- /.col -->
</div><!-- /.row -->

<div class="modal fade" id="filterExportModal" tabindex="-1" aria-labelledby="filterExportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('transaksi.peralihan.export') }}" method="GET">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterExportModalLabel">Filter Export</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @php
                    $hari_ini = date("Y-m-d");
                    $tgl_pertama = date('Y-m-01', strtotime($hari_ini));
                    $tgl_terakhir = date('Y-m-t', strtotime($hari_ini));
                    @endphp
                    <div class="form-group">
                        <label for="start_date">Dari Tanggal</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $tgl_pertama }}" required>
                    </div>
                    <div class="form-group">
                        <label for="end_date">Sampai Tanggal</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $tgl_terakhir }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default btn-sm text-indigo" data-toggle="modal" data-target="#filterExportModal">
                        <i class="fas fa-file-excel mr-2 ml-2"></i> Export
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endSection
@section('script')
<script>
    $('body').on('click', '.approveFunction', function(event) {
        event.preventDefault();
        event.stopImmediatePropagation();
        var form = event.target.form;
        // var url = $(this).attr("href");
        console.log(form);
        // console.log(url);
        swal({
            title: "Anda akan menyetujui BPHTB ini ?",
            text: "Data BPHTB belum dapat dilihat pihak lain sebelum anda menyetujui!",
            icon: "warning",
            buttons: true
        }).then((willDelete) => {
            if (willDelete) {
                form.submit();
                // window.location.href = url;
            } else {
                swal("Cancel", "BPHTB belum disetujui!", "error");
            }
        })
    });
</script>
@endSection