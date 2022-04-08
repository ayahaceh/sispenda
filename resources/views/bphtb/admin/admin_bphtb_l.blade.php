@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')
<?php
$userGroup = Auth()->user()->user_group;
?>
<div class="row">
    <div class="col-12">
        <div class="card card-default card-outline">
            <div class="card-header text-indigo">
                <div class="row align-items-center">
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
                                        @if(Auth()->user()->user_group == USER_ADMIN || Auth()->user()->user_group == USER_SUPER_ADMIN)
                                        <select name="aktif" id="aktif" class="form-control">
                                            <option value="Y" {{ request()->aktif == 'Y' ? 'selected' : '' }}>Data
                                                Aktif
                                            </option>
                                            <option value="N" {{ request()->aktif == 'N' ? 'selected' : '' }}>
                                                Data Terhapus
                                            </option>
                                        </select>
                                        @endif
                                        <input type="text" name="cari" class="form-control float-right" value="{{ request()->has('cari') ? request()->cari : '' }}" placeholder="Search" autocomplete="off">
                                        <div class="input-group-append">
                                            @if (request()->has('cari'))
                                            <a href="{{ route('bphtb') }}" class="btn btn-default">
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
                                <a href="{{ route('bphtb.add') }}" class="btn btn-default btn-sm text-indigo">
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
                <table class="table table-hover table-sm">
                    <thead class="bg-indigo">
                        <tr>
                            <th>TGL / NAMA WP / NIK</th>
                            <th>NOP / NTPD</th>
                            <th>Letak NOP</th>
                            <th class="text-right pr-4">Jumlah Setor</th>
                            <th>Status</th>
                            <th>Petugas</th>
                            <th>Aksi</th>
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
                        } else {
                            $warnaStatus = 'secondary';
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
                            <td class="align-middle">
                                <a href="{{ route('bphtb.show', $value->id) }}" class="text-indigo">
                                    {{ date('j F, Y', strtotime($value->tgl_bphtb)) }} <br />
                                    {!! strtoupper($value->nama_wp) !!} <br />
                                    {!! $value->format_nik !!}
                                </a>
                            </td>
                            <td class="align-middle">
                                <a href="{{ route('bphtb.show', $value->id) }}" class="text-indigo">
                                    NOP. {{ $value->format_nop }} <br>
                                    @if ($value->no_b)
                                    NTPD. {{ $value->format_no_b }}
                                    @endif
                                </a>
                            </td>
                            <td class="align-middle">
                                <a href="{{ route('bphtb.show', $value->id) }}" class="text-indigo">
                                    @isset($value->letak_nop)
                                    {{ strtoupper($value->letak_nop) }}
                                    <br />
                                    @endisset
                                    @isset($value->joinKecNop->nama_kec)
                                    {{ strtoupper($value->joinKecNop->nama_kec) }},
                                    @endisset
                                    @isset($value->joinDesaNop->nama_desa)
                                    {{ strtoupper($value->joinDesaNop->nama_desa) }}
                                    @endisset
                                </a>
                            </td>
                            <td class="text-right align-middle pr-4">
                                <a href="{{ route('bphtb.show', $value->id) }}" class="text-indigo">
                                    {{ $value->jl_setor }}
                                </a>
                            </td>
                            <td class="align-middle">
                                @if ($value->berkas_bukti_pembayaran != '' || $value->berkas_bukti_pembayaran != null)
                                <a href="{{ $value->file_berkas_bukti_pembayaran }}" class="btn btn-xs bg-indigo" target="_blank">
                                    <i class="fas fa-file-invoice-dollar mr-2"></i>Bukti Lunas
                                </a>
                                <br />
                                @endif
                                <small class="badge bg-{{ $warnaStatus }}">
                                    {{ $value->status_pembayaran }}
                                </small>
                                <br />
                                <small class="badge bg-{{ $warnaBphtb }}">
                                    {{ $value->status_bphtb }}
                                </small>
                                {{-- @if ($userGroup == USER_KABID || $userGroup == USER_KABAN || $userGroup == USER_ADMIN)
                                            @if ($value->status_bphtb == STATUS_BPHTB_BELUM_DISETUJUI)
                                                </br>
                                                <button type="button"
                                                    data-route="{{ route('pejabat.bphtb.approve', ['id' => $value->id]) }}"
                                class="btn btn-xs btn-warning approve">
                                <i class="fas fa-check-square mr-2"></i>Setujui
                                </button>
                                @endif
                                @endif --}}
                            </td>
                            <td class="align-middle">
                                <small class="text-indigo">
                                    @if ($value->updated_by != null || $value->updated_by != '')
                                    {{ strtoupper(Str::limit($value->updated_by, 10)) }} <br />
                                    @else
                                    {{ strtoupper(Str::limit($value->created_by, 10)) }} <br />
                                    @endif
                                    {{ date('d/m/y', strtotime($value->updated_at)) . '-' . date('h:i', strtotime($value->updated_at)) }}
                                    <br />
                                </small>
                            </td>
                            <td class="align-middle">
                                <div class="btn-group">
                                    <!-- <li class="page-item"> -->
                                    <div class="dropdown">
                                        <button class="page-link text-indigo btn-sm cetak dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-print text-indigo mr-2"></i>
                                            Cetak
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                            @if ($value->status_pembayaran == STATUS_PEMBAYARAN_LUNAS && $value->status_bphtb == STATUS_BPHTB_SUDAH_DISETUJUI)
                                            <a class="dropdown-item text-indigo" target="_blank" href="{{ route('bphtb.laporan', ['id' => $value->id]) }}">
                                                Cetak Semua
                                            </a>
                                            <a class="dropdown-item text-indigo" target="_blank" href="{{ route('bphtb.laporan', ['id' => $value->id]) }}?only_one=true">
                                                Cetak Kustom
                                            </a>
                                            @endif
                                            <a class="dropdown-item text-indigo" target="_blank" href="{{ route('bphtb.verifikasi.show', $value->id) }}">
                                                Ringkasan
                                            </a>
                                        </div>
                                    </div>
                                    <!-- </li> -->
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-3">Data tidak ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div><!-- /.card-body -->
            @if ($data->total() > $data->perPage())
            <div class="card-footer">
                <div class="float-right">
                    {{ $data->links('templates.bootstrap-4') }}
                </div>
            </div>
            @endif
        </div><!-- /.card -->
    </div> <!-- /.col -->
</div><!-- /.row -->

@endSection