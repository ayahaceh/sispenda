@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

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
                                <form action="{{ route('bpn.publik.bulan-ini') }}" method="GET">
                                    <div class="input-group input-group-sm">
                                        <input type="text" name="cari" class="form-control float-right" @if($keyword !="" ) ? value="{{$keyword}}" : @endif placeholder="Search">
                                        <div class="input-group-append">
                                            @if($clearButton == true)
                                            <a href="{{ route('bpn.publik.bulan-ini') }}" class="btn btn-default">
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
                            <th>Tgl BPHTB</th>
                            <th>Dari</th>
                            <th>Kepada</th>
                            <th>NOP</th>
                            <th>Letak NOP</th>
                            <th>Jumlah</th>
                            <!-- <th>Status</th> -->
                            <!-- <th>Aksi</th> -->
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
                        ?>
                        <tr>
                            <td>
                                <a href="{{ route('transaksi.peralihan.edit', $value->id) }}" class="text-indigo">
                                    {{ date('j F, Y', strtotime($value->tgl_peralihan))}}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('bpn.publik.lihat', $value->id) }}" class="text-indigo">
                                    {!! $value->dari_nik !!}
                                    @isset($value->joinProfilDari->nama)
                                    <br />
                                    {!! $value->joinProfilDari->nama !!}
                                    @endisset
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('bpn.publik.lihat', $value->id) }}" class="text-indigo">
                                    {!! $value->kepada_nik !!}
                                    @isset($value->joinProfilKepada->nama)
                                    <br />
                                    {!! $value->joinProfilKepada->nama !!}
                                    @endisset
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('bpn.publik.lihat', $value->id) }}" class="text-indigo">
                                    {{ $value->nop }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('bpn.publik.lihat', $value->id) }}" class="text-indigo">
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
                                {{ formatRupiah($value->jumlah) }}
                                <br />
                                <small class="badge bg-{{$warnaStatus}}">
                                    {{ $value->status_transaksi .' ['.date('d-M-y', strtotime($value->tgl_setor)).']'}}
                                </small>
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

</script>

@endSection