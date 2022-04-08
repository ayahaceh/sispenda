@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')
<?php
$sesiUser = session()->get('datauser')->user_group;
?>
<div class="row">
    <div class="col-12">
        <div class="card card-default card-outline">
            <div class="card-header">
                <h3 class="card-title text-indigo"><i class="fas fa-user-clock mr-2"></i>Logs</h3>
                <div class="card-tools">
                    <form action="{{ route('my.logs') }}" method="GET">
                        <div class="input-group input-group-sm">
                            <input type="text" name="cari" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default"><i class="fas fa-search text-indigo"></i></button>
                                @if($sesiUser == USER_SUPER_ADMIN)
                                <a href="{{route('logs.hapus.all')}}" class="btn btn-danger btn-xs">
                                    <i class="fas fa-trash mr-1"></i>Kosongkan
                                </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover table-sm">
                    <thead class="bg-gray-light">
                        <tr class="text-indigo">
                            <!-- <th>#</th> -->
                            <th>User</th>
                            <th>Kegiatan</th>
                            @if ($sesiUser == USER_SUPER_ADMIN)
                            <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>

                    <tbody class="text-dark">
                        @foreach ($data as $lg => $index)
                        <tr>
                            <td style="width: 20%">
                                @isset($index->joinUser->nama)
                                {{ $index->joinUser->nama }}
                                @endisset
                                <small class="text-indigo">
                                    <br />
                                    {{ date('d/m/Y', strtotime($index->waktu)) .' - '. date('h:i', strtotime($index->waktu)) }}
                                </small>
                            </td>
                            <td>
                                {{$index->kegiatan}}
                            </td>
                            @if ($sesiUser == USER_SUPER_ADMIN)
                            <td>
                                <div>
                                    <form action="{{ route('logs.hapus', $index->id) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-xs btn-default text-danger">
                                            <i class="fas fa-times mr-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                            @endif
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