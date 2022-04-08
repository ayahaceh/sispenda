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
                            <i class="fas fa-user-friends mr-2"></i>Data Profil Baru</a>
                        </h3>
                    </div>
                    <div class="col-md-9 mt-2 mt-md-0">
                        <div class="d-md-flex justify-content-end">
                            <div class="mr-2">
                                <form action="{{ route('ppat.profil.user.baru') }}" method="GET">
                                    <div class="input-group input-group-sm">
                                        <input type="text" name="cari" class="form-control float-right" placeholder="Search" value="{{ request('cari') }}" autocomplete="off">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn bg-indigo">
                                                <i class="fas fa-search"></i>
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
                    <thead>
                        <tr class="text-indigo">
                            <th>#</i></th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>Desa</th>
                            <th>Kecamatan</th>
                            <th>Kabupaten</th>
                        </tr>
                    </thead>
                    <tbody class="text-dark">
                        @forelse ($data as $key => $profil)
                        <tr>
                            <td class="text-indigo">
                                {{ $key + 1 }}
                            </td>
                            <!-- <td>
                                <img src="{{ asset('/upload/users/comp/' . $profil->berkas_foto) }}" style="width: 50px; height: 50px;" class="user-image img-circle elevation-2" alt="User Image">
                            </td> -->
                            <td>
                                <a href="{{ route('profil.user.verifikasi', $profil->id) }}" class="text-indigo">
                                    {{ $profil->nama }}
                                </a>
                            </td>
                            <td>
                                {{ $profil->nik }}
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
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-3">Data tidak ditemukan</td>
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