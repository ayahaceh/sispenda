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
                            <i class="fas fa-map-marked-alt mr-2"></i>Verifikasi Data NOP</a>
                        </h3>
                    </div>
                    <div class="col-md-9 mt-2 mt-md-0">
                        <div class="d-md-flex justify-content-end">
                            <div class="mr-2">
                                <form action="{{ route('nop.pbb.verifikasi') }}" method="GET">
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
                            <th>Kabupaten</th>
                        </tr>
                    </thead>

                    <tbody class="text-dark">
                        @forelse ($data as $key => $dt)
                        <tr>
                            <td>
                                {{ $key + 1 }}
                            </td>
                            <td>
                                <a href="{{ route('nop.pbb.verifikasi.show', $dt->id) }}">
                                    {{ $dt->nop }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('nop.pbb.verifikasi.show', $dt->id) }}">
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
                                {{ $dt->joinKab->nama_kab }}
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