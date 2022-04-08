@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

<div class="row">

    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-3">
                        <h3 class="card-title">
                            <i class="fas fa-envelope mr-2"></i>Setting App</a>
                        </h3>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('settingApp.index') }}" method="GET">
                            <div class="input-group input-group-sm">
                                <input type="text" name="cari" class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search text-primary"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- <div class="col-md-3">
                        <a href="{{route('user.tambah')}}" class="btn btn-default btn-sm btn-block text-primary">
                    <i class="fas fa-clone mr-2 ml-2"></i> Tambah User
                    </a>
                </div> --}}
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead class="bg-gray-light">
                    <tr class="text-primary">
                        <th>#</i></th>
                        <th>Nama Setting</th>
                        <th>Nilai Setting</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody class="text-dark">
                    @foreach ($setting as $key => $value)
                    <tr>
                        <td>
                            {{ $key + 1 }}
                        </td>
                        <td>
                            {{ $value->nama_setting }}
                        </td>
                        <td>
                            {{ $value->nilai_setting }}
                        </td>
                        <td>
                            {{ $value->ket_setting }}
                        </td>

                        <td class="btn-group">
                            <button type="button" class="btn btn-default btn-sm text-warning" data-toggle="modal" data-target="#editSettingApp-{{ $value->id }}">
                                <i class="fas fa-edit mr-1"></i>
                                Edit
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!-- /.card-body -->
        <div class="card-footer">
            <div class="float-right">
                {{ $setting->links('templates.bootstrap-4') }}
            </div>
        </div>
    </div><!-- /.card -->
</div> <!-- /.col -->
</div><!-- /.row -->

<!-- Modal Edit -->
@foreach ($setting as $item)
<div class="modal fade" id="editSettingApp-{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editSettingAppLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSettingAppLabel"> Edit Setting App - ID : {{ $item->id }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('settingApp.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nilai_setting">Nilai Setting</label>
                                <input type="text" name="nilai_setting" class="form-control @error('nilai_setting') is-invalid @enderror" id="nilai_setting" value="{{ $item->nilai_setting }}" placeholder="Nilai Setting ..." required>
                                @error('nilai_setting')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="ket_setting">Keterangan</label>
                                <input type="text" name="ket_setting" class="form-control @error('ket_setting') is-invalid @enderror" id="ket_setting" value="{{ $item->ket_setting }}" placeholder="Keterangan ..." required>
                                @error('ket_setting')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-flat">
                    <i class="fas fa-clone mr-2"></i>Update
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endSection


@section('script')
<script type="application/javascript">

</script>
@endsection