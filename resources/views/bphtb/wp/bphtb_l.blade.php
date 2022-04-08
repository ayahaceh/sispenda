@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

    <style>
        .whitespace-nowrap {
            white-space: nowrap;
        }

    </style>

    @include('dashboard.panel.panel_wp')

    {{-- <div class="d-flex justify-content-end">
        <a href="{{ route('wp.bphtb.create') }}" class="btn bg-indigo mb-3">Ajukan BPHTB</a>
    </div> --}}

    <div class="alert alert-warning">
        Jika status NOP sudah diverifikasi oleh admin, Anda tidak bisa lagi mengedit data NOP PBB.
    </div>

    <div class="card">
        <div class="card-header bg-light">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="card-title text-indigo">
                        <i class="fas fa-map-marked-alt mr-2"></i>Data NOP Diajukan</a>
                    </h3>
                </div>
                <div class="col-md-4 mt-2 mt-md-0">
                    <form action="" method="GET">
                        <div class="input-group input-group-sm">
                            <input type="text" name="search_temps" class="form-control float-right" placeholder="Search"
                                value="{{ request('search_temps') }}" autocomplete="off">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search text-indigo"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover table-sm">
                <thead class="bg-gray-light">
                    <tr class="text-indigo">
                        <th>No</th>
                        <th class="whitespace-nowrap">NIK / Nama</th>
                        <th class="whitespace-nowrap">Tgl / NOP</th>
                        <th class="whitespace-nowrap">Letak NOP</th>
                        <th class="whitespace-nowrap">No. Sertifikat</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="text-dark">
                    @forelse ($data_temps as $key => $data)
                        <tr>
                            <td class="whitespace-nowrap py-3 align-middle">
                                <a href="{{ route('wp.bphtb-temp.show', ['id' => $data->id]) }}" class="text-indigo">
                                    {{ $key + 1 }}
                                </a>
                            </td>
                            <td class="whitespace-nowrap py-3 align-middle text-uppercase">
                                <a href="{{ route('wp.bphtb-temp.show', ['id' => $data->id]) }}" class="text-indigo">
                                    {!! $data->format_nik !!}
                                    @isset($data->nama_wp)
                                        <br />
                                        {!! $data->nama_wp !!}
                                    @endisset
                                </a>
                            </td>
                            <td class="whitespace-nowrap py-3 align-middle">
                                <a href="{{ route('wp.bphtb-temp.show', ['id' => $data->id]) }}" class="text-indigo">
                                    {{ date('j F, Y', strtotime($data->tgl_bphtb)) }}
                                    <br>
                                    {{ $data->format_nop }}
                                </a>
                            </td>
                            <td class="whitespace-nowrap py-3 align-middle text-uppercase">
                                <a href="{{ route('wp.bphtb-temp.show', ['id' => $data->id]) }}" class="text-indigo">
                                    {{ $data->letak_nop }}
                                    @isset($data->joinKecNop->nama_kec)
                                        <br />
                                        {{ $data->joinKecNop->nama_kec }},
                                    @endisset
                                    @isset($data->joinDesaNop->nama_desa)
                                        {{ $data->joinDesaNop->nama_desa }}
                                    @endisset
                                </a>
                            </td>
                            <td class="whitespace-nowrap py-3 align-middle">
                                <a href="{{ route('wp.bphtb-temp.show', ['id' => $data->id]) }}" class="text-indigo">
                                    {{ $data->no_sertifikat }}
                                </a>
                            </td>
                            <td class="align-middle">
                                <small class="badge bg-warning">
                                    Diajukan
                                </small>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center py-3" colspan="7">Data tidak ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-light">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="card-title text-indigo">
                        <i class="fas fa-map-marked-alt mr-2"></i>Data NOP Diverifikasi</a>
                    </h3>
                </div>
                <div class="col-md-4 mt-2 mt-md-0">
                    <form action="" method="GET">
                        <div class="input-group input-group-sm">
                            <input type="text" name="search" class="form-control float-right" placeholder="Search"
                                value="{{ request('search') }}" autocomplete="off">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search text-indigo"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover table-sm">
                <thead class="bg-gray-light">
                    <tr class="text-indigo">
                        <th>#</th>
                        <th class="whitespace-nowrap">NIK / Nama</th>
                        <th class="whitespace-nowrap">Tgl / NOP</th>
                        <th class="whitespace-nowrap">Letak NOP</th>
                        <th class="whitespace-nowrap">Jml. Setor</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-dark">
                    @forelse ($datas as $key => $data)
                        <?php
                        // warna pelunasan
                        if ($data->status_pembayaran == STATUS_PEMBAYARAN_BELUM_BAYAR) {
                            $warnaStatus = 'danger';
                        } elseif ($data->status_pembayaran == STATUS_PEMBAYARAN_LUNAS) {
                            $warnaStatus = 'success';
                        } elseif ($data->status_pembayaran == STATUS_PEMBAYARAN_SEDANG_VERIFIKASI) {
                            $warnaStatus = 'warning';
                        }
                        
                        // warna BPHTB
                        if ($data->status_bphtb == STATUS_BPHTB_SUDAH_VERIFIKASI || $data->status_bphtb == STATUS_BPHTB_SUDAH_DISETUJUI) {
                            $warnaBphtb = 'success';
                        } elseif ($data->status_bphtb == STATUS_BPHTB_BELUM_VERIFIKASI || $data->status_bphtb == STATUS_BPHTB_BELUM_DISETUJUI) {
                            $warnaBphtb = 'danger';
                        } else {
                            $warnaBphtb = 'dark';
                        }
                        ?>
                        <tr>
                            <td class="whitespace-nowrap py-3 align-middle">
                                <a href="{{ route('wp.bphtb.show', ['id' => $data->id]) }}" class="text-indigo">
                                    {{ $key + 1 }}
                                </a>
                            </td>
                            <td class="whitespace-nowrap py-3 align-middle text-uppercase">
                                <a href="{{ route('wp.bphtb.show', ['id' => $data->id]) }}" class="text-indigo">
                                    {!! $data->format_nik !!}
                                    @isset($data->nama_wp)
                                        <br />
                                        {!! $data->nama_wp !!}
                                    @endisset
                                </a>
                            </td>
                            <td class="whitespace-nowrap py-3 align-middle">
                                <a href="{{ route('wp.bphtb.show', ['id' => $data->id]) }}" class="text-indigo">
                                    {{ date('j F, Y', strtotime($data->tgl_bphtb)) }}
                                    <br>
                                    {{ $data->format_nop }}
                                </a>
                            </td>
                            <td class="whitespace-nowrap py-3 align-middle text-uppercase">
                                <a href="{{ route('wp.bphtb.show', ['id' => $data->id]) }}" class="text-indigo">
                                    {{ $data->letak_nop }}
                                    @isset($data->joinKecNop->nama_kec)
                                        <br />
                                        {{ $data->joinKecNop->nama_kec }},
                                    @endisset
                                    @isset($data->joinDesaNop->nama_desa)
                                        {{ $data->joinDesaNop->nama_desa }}
                                    @endisset
                                </a>
                            </td>
                            <td class="whitespace-nowrap py-3 align-middle">
                                <a href="{{ route('wp.bphtb.show', ['id' => $data->id]) }}"
                                    class="text-indigo text-right">
                                    {{ $data->jl_setor }}
                                </a>
                            </td>
                            <td class="py-3 align-middle">
                                @if ($data->berkas_bukti_pembayaran != '' || $data->berkas_bukti_pembayaran != null)
                                    <a href="{{ $data->file_berkas_bukti_pembayaran }}" class="btn btn-xs bg-indigo"
                                        target="_blank">
                                        <i class="fas fa-file-invoice-dollar mr-2"></i>Bukti Lunas
                                    </a>
                                    <br />
                                @endif
                                <small class="badge bg-{{ $warnaStatus }}">
                                    @if ($data->status_pembayaran == STATUS_PEMBAYARAN_LUNAS)
                                        @php
                                            $x = $data->status_pembayaran ? ' [' . date('d-M-y', strtotime($data->tgl_setor)) . ']' : '';
                                        @endphp
                                        {{ $data->status_pembayaran . $x }}
                                    @else
                                        @if ($data->berkas_bukti_pembayaran !== null)
                                            Sudah Bayar (pending)
                                        @else
                                            {{ $data->status_pembayaran }}
                                        @endif
                                    @endif
                                </small>
                                <br />
                                <small class="badge bg-{{ $warnaBphtb }}">
                                    @if ($data->status_bphtb == STATUS_BPHTB_SUDAH_DISETUJUI)
                                        @php
                                            $y = $data->tgl_persetujui ? ' [' . $data->tgl_persetujuan . ']' : '';
                                        @endphp
                                        {{ $data->status_bphtb . $y }}
                                    @else
                                        {{ $data->status_bphtb }}
                                    @endif
                                </small>
                            </td>
                            <td class="py-3 align-middle">
                                @if ($data->status_bphtb == STATUS_BPHTB_SUDAH_VERIFIKASI || ($data->status_bphtb == STATUS_BPHTB_BELUM_DISETUJUI && $data->berkas_bukti_pembayaran == null && $data->status_pembayaran == STATUS_PEMBAYARAN_BELUM_BAYAR))
                                    <a href="{{ route('wp.bphtb.pembayaran.show', ['id' => $data->id]) }}"
                                        class="btn btn-sm btn-success">
                                        <i class="fas fa-hand-holding-usd mr-1"></i>
                                        Pembayaran
                                    </a>
                                @endif

                                @if ($data->berkas_bukti_pembayaran !== null || $data->status_bphtb == STATUS_BPHTB_SUDAH_DISETUJUI)
                                    <a href="{{ route('wp.bphtb.pembayaran.show', ['id' => $data->id]) }}"
                                        class="btn btn-sm bg-indigo">
                                        <i class="fas fa-info mr-1"></i>
                                        Ringkasan
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center py-3" colspan="7">Data tidak ditemukan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endSection
