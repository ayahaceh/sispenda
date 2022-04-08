@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

<div class="row">
    <div class="col-12">
        <div class="card card-default card-outline">
            <div class="card-header bg-light">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title text-indigo">
                            <i class="fas fa-user-friends mr-2"></i>Profil Wajib Pajak <small class="badge bg-danger">(Belum di approve)</small>
                        </h3>
                    </div>
                    <div class="col-md-4 mt-2 mt-md-0">
                        <div class="d-md-flex justify-content-end">
                            <div class="mr-2">
                                <form action="{{ route('ppat.profil.user') }}" method="GET">
                                    <div class="input-group input-group-sm">
                                        <input type="text" name="cari" class="form-control float-right" placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn bg-indigo">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="btn-group mt-2 mt-md-0" role="group" aria-label="Basic example">
                                <a href="{{ route('ppat.profil.user.tambah') }}" class="btn btn-sm bg-indigo">
                                    <i class="fas fa-user-plus mr-2 ml-2"></i> Tambah Profil
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover table-sm">
                    <thead>
                        <tr class="text-indigo">
                            <th>#</i></th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Desa</th>
                            <th>Kecamatan</th>
                            <th>Kabupaten</th>
                            <th>Status</th>
                            <th>NOP</th>
                        </tr>
                    </thead>

                    <tbody class="text-dark">
                        @forelse ($data as $key => $profil)
                        <?php
                        $status_profil = $profil->status_profil;

                        switch ($status_profil) {
                            case STATUS_PROFIL_TIDAK_AKTIF:
                                $warna = 'danger';
                                break;
                            case STATUS_PROFIL_BELUM_VERIFIKASI:
                                $warna = 'warning';
                                break;
                            case STATUS_PROFIL_VALID:
                                $warna = 'success';
                                break;
                            case STATUS_PROFIL_TIDAK_VALID:
                                $warna = 'danger';
                                break;
                            default:
                                $warna = 'secondary';
                        }

                        ?>
                        <tr>
                            <td class="text-indigo">
                                {{ $key + 1 }}
                            </td>
                            <td>
                                <a href="{{ route('ppat.profil.user.lihat', $profil->id) }}" class="text-indigo">
                                    {{ $profil->nama }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('ppat.profil.user.lihat', $profil->id) }}" class="text-indigo">
                                    {{ $profil->nik }}
                                </a>
                            </td>
                            <td>
                                @isset($profil->joinDesa->nama_desa)
                                {{ $profil->joinDesa->nama_desa }}
                                @endisset
                            </td>
                            <td>
                                @isset($profil->joinKec->nama_kec)
                                {{ $profil->joinKec->nama_kec }}
                                @endisset
                            </td>
                            <td>
                                @isset($profil->joinKab->nama_kab)
                                {{ $profil->joinKab->nama_kab }}
                                @endisset
                            </td>
                            <td>
                                <a href="{{ route('ppat.profil.user.lihat', $profil->id) }}" class="text-dark">
                                    <small class="badge badge-{{$warna}}">{{ $profil->status_profil }}</small>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('ppat.profil.user.lihat', $profil->id) }}">
                                    <label class="text-indigo">
                                        @isset($profil->jumlahNop)
                                        {{ $profil->jumlahNop->count() }}
                                        @endisset
                                    </label>
                                </a>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-3">Data tidak ditemukan</td>
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