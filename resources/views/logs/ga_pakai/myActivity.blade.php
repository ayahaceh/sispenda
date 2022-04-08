@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-teal">
                    <h3 class="card-title"><i class="fas fa-envelope mr-2"></i>My Activity</h3>
                    <div class="card-tools">
                        <form action="{{ route('myActivity') }}" method="GET">
                            <div class="input-group input-group-sm" style="width: 200px;">
                                <input type="text" name="cari" class="form-control float-right" placeholder="Search">
                            </div>
                        </form>
                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead class="bg-gray-light">
                            <tr class="text-teal">
                                <th>#</th>
                                <th width="15%">User</th>
                                <th>Kegiatan</th>
                                <th>Waktu</th>
                                @if (session()->get('datauser')->user_group <= 3)
                                    <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>

                        <tbody class="text-dark">
                            @foreach ($logs as $lg => $index)
                                <?php if ($index->id_log == 1) {
                                $badge = 'badge-success';
                                } elseif ($index->id_log == 2) {
                                $badge = 'bg-teal';
                                } elseif ($index->id_log == 3) {
                                $badge = 'badge-warning';
                                } elseif ($index->id_log == 4) {
                                $badge = 'badge-danger';
                                } elseif ($index->id_log == 5) {
                                $badge = 'badge-primary';
                                } else {
                                $badge = 'badge-info';
                                } ?>
                                <tr>
                                    <td>
                                        <div class="icheck-greensea">
                                            <input type="checkbox" value="" id="check{{ $lg }}">
                                            <label for="check{{ $lg }}"></label>
                                        </div>
                                    </td>
                                    <td>
                                        @isset($index->User->nama)
                                            {{ $index->User->nama }}
                                        @endisset
                                    </td>
                                    <td>
                                        <span class="badge {{ $badge }}">
                                            @isset($index->Ref_Logs->nama_log)
                                                {{ $index->Ref_Logs->nama_log }}
                                            @endisset
                                        </span>
                                        {{ $index->kegiatan }}
                                    </td>
                                    <td>
                                        {{ date('d/m/Y h:i', strtotime($index->waktu)) }}
                                    </td>
                                    @if (session()->get('datauser')->user_group <= 3)
                                        <td>
                                            <div>
                                                <form action="{{ route('logs.del', $index->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit"
                                                        onclick="return confirm('Yakin ingin menghapus data?')"
                                                        class="btn btn-sm btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.card-body -->
                <div class="card-footer bg-teal">
                    <div class="float-right bg-teal">
                        {{ $logs->links('templates.bootstrap-4') }}
                    </div>
                </div>
            </div><!-- /.card -->
        </div> <!-- /.col -->
    </div><!-- /.row -->

@endSection
