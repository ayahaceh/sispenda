@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

<div class="row d-flex justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-indigo">

                <div class="row">
                    <div class="col-md-6">
                        <form action="{{ route('rekening.cari') }}" method="GET">
                            <div class="input-group input-group-sm">
                                <input type="text" name="cari" class="form-control" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-sm btn-default">
                                        <i class="fas fa-search text-indigo"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('rekening.tambah') }}" class="btn btn-default btn-sm text-indigo float-right">
                            <i class="fas fa-clone mr-2 ml-2"></i> Tambah Rekening
                        </a>
                    </div>
                </div>

            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead class="bg-gray-light">
                        <tr class="text-indigo">
                            <th>Nomor Rekening</th>
                            <th>Nama Rekening</th>
                            <th>Default </th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="text-dark">
                        @foreach ($rekening as $s)
                        <tr>
                            <td>
                                <a href="{{ route('rekening.lihat', $s->id) }}" class="text-indigo">
                                    {{ $s->no_rekening }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('rekening.lihat', $s->id) }}" class="text-indigo">
                                    {{ $s->nama_rekening }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('rekening.lihat', $s->id) }}" class="text-indigo">
                                    {{ $s->status_rekening }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('rekening.lihat', $s->id) }}" class="btn btn-sm btn-default text-indigo">
                                    <i class="fas fa-eye mr-1"></i>
                                    Lihat
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- /.card-body -->
            <div class="card-footer">
                <div class="float-right">
                    {{ $rekening->links('templates.bootstrap-4') }}
                </div>
            </div>
        </div><!-- /.card -->
    </div> <!-- /.col -->
</div><!-- /.row -->

@endSection