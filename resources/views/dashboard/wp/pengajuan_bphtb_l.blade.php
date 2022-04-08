@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

    @include('dashboard.panel.panel_wp')

    <div class="card">
        <div class="card-header bg-light">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="card-title text-indigo">
                        <i class="fas fa-file-invoice-dollar mr-2"></i> Data BPHTB</a>
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
                    <tr class="text-muted">
                        <th>Tgl BPHTB</th>
                        <th>Dari</th>
                        <th>Kepada</th>
                        <th>NOP</th>
                        <th>Letak NOP</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-dark">
                    @forelse ($datas as $key => $data)
                        <?php
                        // warna pelunasan
                        if ($data->status_transaksi == STATUS_TRANSAKSI_BELUM_LUNAS) {
                            $warnaStatus = 'danger';
                        } elseif ($data->status_transaksi == STATUS_TRANSAKSI_LUNAS) {
                            $warnaStatus = 'success';
                        } else {
                            $warnaStatus = 'dark';
                        }
                        // warna Approved
                        if ($data->approved_status == STATUS_BPHTB_APPROVED) {
                            $warnaApproved = 'success';
                        } elseif ($data->approved_status == STATUS_BPHTB_BELUM_APPROVE) {
                            $warnaApproved = 'danger';
                        } else {
                            $warnaApproved = 'dark';
                        }
                        ?>
                        <tr>
                            <td>
                                {{ date('j F, Y', strtotime($data->tgl_peralihan)) }}
                            </td>
                            <td>
                                {!! $data->dari_nik !!}
                                @isset($data->joinProfilDari->nama)
                                    <br />
                                    {!! $data->joinProfilDari->nama !!}
                                @endisset
                            </td>
                            <td>
                                {!! $data->kepada_nik !!}
                                @isset($data->joinProfilKepada->nama)
                                    <br />
                                    {!! $data->joinProfilKepada->nama !!}
                                @endisset
                            </td>
                            <td>
                                {{ $data->nop }}
                            </td>
                            <td>
                                @isset($data->joinNop->joinKec->nama_kec)
                                    {{ $data->joinNop->joinKec->nama_kec }}
                                @endisset
                                <br />
                                @isset($data->joinNop->joinDesa->nama_desa)
                                    {{ $data->joinNop->joinDesa->nama_desa }}
                                @endisset
                            </td>
                            <td>
                                @if ($data->berkas_bukti_pembayaran != '' || $data->berkas_bukti_pembayaran != null)
                                    <a href="{{ $data->file_berkas_bukti_pembayaran }}" class="btn btn-xs bg-indigo"
                                        target="_blank">
                                        <i class="fas fa-file-invoice-dollar mr-2"></i>Bukti Lunas
                                    </a>
                                    <br />
                                @endif
                                {{ formatRupiah($data->jumlah) }}
                                <br />
                                <small class="badge bg-{{ $warnaStatus }}">
                                    {{ $data->status_transaksi . ' [' . date('d-M-y', strtotime($data->tgl_setor)) . ']' }}
                                </small>
                            </td>
                            <td>
                                <small class="badge bg-{{ $warnaApproved }}">
                                    {{ $data->approved_status }}
                                </small>
                            </td>
                            <td>
                                <a href="{{ route('wp.pengajuan-bphtb.lihat', $data->id) }}" class="text-indigo">
                                    <i class="fas fa-eye mr-1"></i> Lihat
                                </a>
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

@endsection
