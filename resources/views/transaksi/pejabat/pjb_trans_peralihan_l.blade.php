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
                                <form action="" method="GET">
                                    <div class="input-group input-group-sm">
                                        <input type="text" name="cari" class="form-control float-right" value="{{ request()->has('cari') ? request()->cari : '' }}" placeholder="Search" autocomplete="off">
                                        <div class="input-group-append">
                                            @if (request()->has('cari'))
                                            <a href="{{ url()->current() }}" class="btn btn-default">
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
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead class="bg-indigo">
                        <tr>
                            <th>NOP</th>
                            <th>Kepada</th>
                            <th>Letak NOP</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            @isset($menu_bphtb_belum)
                            @if ($userGroup == USER_KABID || $userGroup == USER_KABAN || $userGroup == USER_ADMIN)
                            <th>Aksi</th>
                            @endif
                            @endisset
                        </tr>
                    </thead>

                    <tbody class="text-dark">

                        @forelse ($data as $key => $value)
                        <?php
                        // warna pelunasan
                        if ($value->status_pembayaran == STATUS_PEMBAYARAN_BELUM_BAYAR) {
                            $warnaStatus = 'danger';
                        } elseif ($value->status_pembayaran == STATUS_PEMBAYARAN_LUNAS) {
                            $warnaStatus = 'success';
                        } elseif ($value->status_pembayaran == STATUS_PEMBAYARAN_SEDANG_VERIFIKASI) {
                            $warnaStatus = 'warning';
                        }

                        // warna BPHTB
                        if ($value->status_bphtb == STATUS_BPHTB_SUDAH_VERIFIKASI || $value->status_bphtb == STATUS_BPHTB_SUDAH_DISETUJUI) {
                            $warnaBphtb = 'success';
                        } elseif ($value->status_bphtb == STATUS_BPHTB_BELUM_VERIFIKASI || $value->status_bphtb == STATUS_BPHTB_BELUM_DISETUJUI) {
                            $warnaBphtb = 'danger';
                        } else {
                            $warnaBphtb = 'dark';
                        }
                        ?>
                        <tr>
                            <td>
                                <a href="{{ route('pejabat.bphtb.lihat', $value->id) }}" class="text-indigo">
                                    {{ date('j F, Y', strtotime($value->tgl_bphtb)) }}
                                    <br>
                                    {{ $value->nop }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('pejabat.bphtb.lihat', $value->id) }}" class="text-indigo">
                                    {!! $value->nik !!}
                                    @isset($value->nama_wp)
                                    <br />
                                    {!! $value->nama_wp !!}
                                    @endisset
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('pejabat.bphtb.lihat', $value->id) }}" class="text-indigo">
                                    @isset($value->letak_nop)
                                    {{ $value->letak_nop }}
                                    <br />
                                    @endisset
                                    @isset($value->joinKecNop->nama_kec)
                                    {{ $value->joinKecNop->nama_kec }},
                                    @endisset
                                    @isset($value->joinDesaNop->nama_desa)
                                    {{ $value->joinDesaNop->nama_desa }}
                                    @endisset
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('pejabat.bphtb.lihat', $value->id) }}" class="text-indigo">
                                    {{ formatRupiah($value->jumlah_bphtb) }}
                                </a>
                            </td>
                            <td>
                                @if ($value->berkas_bukti_pembayaran != '' || $value->berkas_bukti_pembayaran != null)
                                <a href="{{ $value->file_berkas_bukti_pembayaran }}" class="btn btn-xs bg-indigo" target="_blank">
                                    <i class="fas fa-file-invoice-dollar mr-2"></i>Bukti Lunas
                                </a>
                                <br />
                                @endif
                                <small class="badge bg-{{ $warnaStatus }}">
                                    @if ($value->status_pembayaran == STATUS_PEMBAYARAN_LUNAS)
                                    {{ $value->status_pembayaran . ' [' . date('d-M-y', strtotime($value->tgl_setor)) . ']' }}
                                    @else
                                    @if ($value->berkas_bukti_pembayaran !== null)
                                    Sudah Bayar (pending)
                                    @else
                                    {{ $value->status_pembayaran }}
                                    @endif
                                    @endif
                                </small>
                                <br />
                                <small class="badge bg-{{ $warnaBphtb }}">
                                    @if ($value->status_bphtb == STATUS_BPHTB_SUDAH_DISETUJUI)
                                    {{ $value->status_bphtb }}
                                    @else
                                    {{ $value->status_bphtb }}
                                    @endif
                                </small>
                            </td>
                            @isset($menu_bphtb_belum)
                            @if ($userGroup == USER_KABID || $userGroup == USER_KABAN || $userGroup == USER_ADMIN)
                            <td>
                                @if ($value->status_bphtb == STATUS_BPHTB_BELUM_DISETUJUI)
                                <button type="button" data-route="{{ route('pejabat.bphtb.approve', ['id' => $value->id]) }}" class="btn btn-sm btn-success approve">
                                    <i class="fas fa-check-square mr-2"></i>Setujui
                                </button>
                                @endif
                            </td>
                            @endif
                            @endisset
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

@endSection
@section('script')
<script>
    $('.approve').click(function(e) {
        e.preventDefault();
        const route = $(this).attr('data-route');

        swal({
            title: "Anda akan menyetujui BPHTB ini ?",
            text: "Data BPHTB belum dapat dilihat pihak lain sebelum anda menyetujui!",
            icon: "warning",
            buttons: true
        }).then((willDelete) => {
            if (willDelete) {
                window.location.href = route;
            } else {
                swal("Cancel", "BPHTB belum disetujui!", "error");
            }
        });
    });
</script>
@endSection