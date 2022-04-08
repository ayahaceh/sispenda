@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')
<?php $group = Auth()->user()->user_group; ?>

<div class="alert alert-warning">
    @php
    if (request()->status == STATUS_BPHTB_BELUM_VERIFIKASI) {
    echo 'Daftar BPHTB yang di input oleh Wajib Pajak atau PPAT yang harus diverifikasi';
    } elseif (request()->status == 'Sudah Bayar (pending)') {
    echo 'Daftar BPHTB yang sudah di bayar oleh Wajib Pajak atau PPAT namun status masih pending';
    } elseif (request()->status == STATUS_BPHTB_BELUM_DISETUJUI) {
    echo 'Daftar BPHTB yang sudah diverifikasi oleh Operator yang harus disetujui';
    } elseif (request()->status == STATUS_PEMBAYARAN_BELUM_BAYAR) {
    echo 'Daftar BPHTB yang belum lunas di pembayaran';
    } else {
    echo 'null';
    }
    @endphp
</div>

<div class="row">
    <div class="col-12">
        <div class="card card-default card-outline">
            <div class="card-header text-indigo">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h3 class="card-title">
                            <i class="fas fa-file-invoice-dollar mr-2"></i>
                            Daftar Transaksi BPHTB {{ request()->status }}
                        </h3>
                    </div>
                    <div class="col-md-6 mt-2 mt-md-0">
                        <div class="d-md-flex justify-content-end">
                            <div class="mr-2">
                                <form id="formFilter" action="" method="GET">
                                    <div class="input-group input-group-sm">
                                        {{-- <select name="status" id="status" class="form-control">
                                                <option value="{{ STATUS_BPHTB_BELUM_VERIFIKASI }}"
                                        {{ request()->status == STATUS_BPHTB_BELUM_VERIFIKASI ? 'selected' : '' }}>
                                        {{ STATUS_BPHTB_BELUM_VERIFIKASI }}
                                        </option>
                                        <option value="Sudah Bayar (pending)" {{ request()->status == 'Sudah Bayar (pending)' ? 'selected' : '' }}>
                                            Sudah Bayar (pending)
                                        </option>
                                        <option value="{{ STATUS_BPHTB_BELUM_DISETUJUI }}" {{ request()->status == STATUS_BPHTB_BELUM_DISETUJUI ? 'selected' : '' }}>
                                            {{ STATUS_BPHTB_BELUM_DISETUJUI }}
                                        </option>
                                        </select> --}}
                                        <input type="hidden" name="status" value="{{ request()->status }}">
                                        <input type="text" name="cari" class="form-control float-right" value="{{ request()->has('cari') ? request()->cari : '' }}" placeholder="Search" autocomplete="off">
                                        <div class="input-group-append">
                                            @if (request()->cari)
                                            <a href="{{ route('bphtb.verifikasi') }}?status={{ request()->status }}" class="btn btn-default">
                                                <i class="fas fa-times text-danger"></i>
                                            </a>
                                            @endif
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search text-indigo"></i>
                                            </button>
                                        </div>

                                    </div>
                            </div>
                            </form>
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
                            @if ($group == USER_ADMIN || $group == USER_SUPER_ADMIN || $group == USER_OPERATOR)
                            <th>Aksi</th>
                            @endif
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
                            <td class="align-middle">
                                <a href="{{ route('bphtb.verifikasi.edit', $value->id) }}?status={{ request()->status }}" class="text-indigo">
                                    {{ date('j F, Y', strtotime($value->tgl_bphtb)) }} <br />
                                    {!! strtoupper($value->nama_wp) !!} <br />
                                    {!! $value->format_nik !!}
                                </a>
                            </td>
                            <td class="align-middle">
                                <a href="{{ route('bphtb.verifikasi.edit', $value->id) }}?status={{ request()->status }}" class="text-indigo">
                                    NOP. {{ $value->format_nop }} <br>
                                    @if ($value->no_b)
                                    NTPD. {{ $value->format_no_b }}
                                    @endif
                                </a>
                            </td>
                            <td class="align-middle">
                                <a href="{{ route('bphtb.verifikasi.edit', $value->id) }}?status={{ request()->status }}" class="text-indigo">
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
                            <td class="text-right align-middle pr-4">
                                <a href="{{ route('bphtb.verifikasi.edit', $value->id) }}?status={{ request()->status }}" class="text-indigo">
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
                                    @if ($value->status_pembayaran == STATUS_PEMBAYARAN_LUNAS)
                                    @php
                                    $x = $value->tgl_setor ? ' [' . date('d-M-y', strtotime($value->tgl_setor)) . ']' : '';
                                    @endphp
                                    {{ $value->status_pembayaran . $x }}
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
                                    @php
                                    $y = $value->tgl_persetujuan ? '[' . $value->tgl_persetujuan . ']' : '';
                                    @endphp
                                    {{ $value->status_bphtb . $y }}
                                    @else
                                    {{ $value->status_bphtb }}
                                    @endif
                                </small>
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
                            @if ($group == USER_ADMIN || $group == USER_SUPER_ADMIN || $group == USER_OPERATOR)
                            <?php
                            if ($value->status_bphtb == STATUS_BPHTB_BELUM_DISETUJUI) {
                                $captionButton = 'Setujui';
                            } else {
                                $captionButton = 'Verifikasi';
                            }
                            ?>
                            <td class="align-middle">
                                <a href="{{ route('bphtb.verifikasi.edit', $value->id) }}?status={{ request()->status }}" class="btn btn-default btn-sm bg-indigo">
                                    <i class="fas fa-sync-alt mr-1"></i> {{$captionButton}}
                                </a>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="20" class="text-center py-3">Data tidak ditemukan</td>
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

@section('script')
<script>
    // $('#status').change(function() {
    //     $("#formFilter").submit();
    // });
</script>
@endsection