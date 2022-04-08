@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

<div class="row">
    <div class="col-12">
        <div class="card card-default card-outline">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-3">
                        <h3 class="card-title text-indigo">
                            <i class="fas fa-users-cog mr-2"></i>
                            Pengaturan Role
                        </h3>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('user-groups') }}" method="GET">
                            <div class="input-group input-group-sm">
                                <input type="text" name="cari" class="form-control float-right" placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-sm bg-indigo">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('user-groups.tambah') }}" class="btn btn-sm btn-block bg-indigo">
                            <i class="fas fa-clone mr-2 ml-2"></i> Tambah Role
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive table-sm p-0">
                <table class="table table-hover">
                    <thead>
                        <tr class="text-indigo">
                            <th>Id Role</th>
                            <th>Nama Role</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="text-dark">
                        @foreach ($usersGroup as $userGroup)
                        <tr>
                            <td>{{ $userGroup->id }}</td>
                            <td>{{ ucwords($userGroup->nama_group) }}</td>
                            <td>{{ ucwords($userGroup->deskripsi_group) }}</td>
                            <td>
                                <div class="form-group row">
                                    <a href="{{ route('user-groups.edit', $userGroup->id) }}" class="btn btn-sm btn-flat bg-indigo">
                                        <i class="fas fa-edit mr-2"></i> Edit
                                    </a>
                                    @if(session()->get('datauser')->user_group == USER_SUPER_ADMIN)
                                    <form action="{{ route('user-groups.hapus', $userGroup->id) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-sm btn-flat btn-danger">
                                            <i class="fas fa-trash mr-2"></i> Delete
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- /.card-body -->
            <div class="card-footer">
                {{ $usersGroup->links('templates.bootstrap-4') }}
            </div>
        </div><!-- /.card -->
    </div> <!-- /.col -->
</div><!-- /.row -->

@endSection