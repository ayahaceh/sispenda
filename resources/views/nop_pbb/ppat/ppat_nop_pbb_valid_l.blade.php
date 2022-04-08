@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

<div class="row">
    <div class="col-12">
        <div class="card card-default card-outline">
            <div class="card-header bg-light">
                <div class="row">
                    <div class="col-md-3">
                        <h3 class="card-title text-indigo">
                            <i class="fas fa-map-marked-alt mr-2"></i>Data NOP <small class="badge bg-success">(Valid)</small>
                        </h3>
                    </div>
                    <div class="col-md-9 mt-2 mt-md-0">
                        <div class="d-md-flex justify-content-end">
                            <div class="mr-2">
                                <form action="{{ route('ppat.nop.pbb.valid') }}" method="GET">
                                    <div class="input-group input-group-sm">
                                        <input type="text" name="cari" class="form-control float-right" placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search text-indigo"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="btn-group mt-2 mt-md-0" role="group" aria-label="Basic example">
                                <a href="{{ route('ppat.nop.pbb.tambah') }}" class="btn btn-default btn-sm text-indigo">
                                    <i class="fas fa-plus-circle mr-2 ml-2"></i> Tambah
                                </a>
                                <a href="{{ route('nop.pbb.export') }}" class="btn btn-default btn-sm text-indigo">
                                    <i class="fas fa-file-excel mr-2 ml-2"></i> Export
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover table-sm">
                    <thead class="bg-gray-light">
                        <tr class="text-muted">
                            <th>#</i></th>
                            <th>NOP</th>
                            <th>Nama</th>
                            <th>Desa</th>
                            <th>Kecamatan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="text-dark">
                        @foreach ($data as $key => $dt)
                        <tr>
                            <td>
                                {{ $key + 1 }}
                            </td>
                            <td>
                                <a href="{{ route('ppat.nop.pbb.valid.lihat', $dt->id) }}" class="text-indigo">
                                    {{ $dt->nop }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('ppat.nop.pbb.valid.lihat', $dt->id) }}" class="text-indigo">
                                    @isset($dt->joinProfil->nama) {{ $dt->joinProfil->nama }} @endisset
                                </a>
                            </td>
                            <td>
                                {{ $dt->joinDesa->nama_desa }}
                            </td>
                            <td>
                                {{ $dt->joinKec->nama_kec }}
                            </td>
                            <td>
                                @if ($dt->status_nop_pbb == STATUS_NOP_AKTIF)
                                <small class="badge badge-success">Aktif</small>
                                @elseif($dt->status_nop_pbb == STATUS_NOP_TIDAK_AKTIF)
                                <small class="badge badge-danger">Tidak Aktif</small>
                                @elseif ($dt->status_nop_pbb == STATUS_NOP_TIDAK_VALID)
                                <small class="badge badge-danger">Tidak Valid</small>
                                @elseif ($dt->status_nop_pbb == STATUS_NOP_DIAJUKAN)
                                <small class="badge badge-warning">Diajukan</small>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('ppat.nop.pbb.valid.lihat', $dt->id) }}" class="text-indigo">
                                    <i class="fas fa-eye mr-1"></i> Lihat
                                </a>
                            </td>
                        </tr>
                        @endforeach
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