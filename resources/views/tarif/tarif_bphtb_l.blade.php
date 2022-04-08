@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

    <div class="row">
        <div class="col-12">
            <div class="card card-default card-outline">
                <div class="card-header bg-indigo">
                    <div class="row">
                        <div class="col-md-3">
                            <h3 class="card-title">
                                <i class="fas fa-file-invoice-dollar mr-2"></i>
                                Tarif BPHTB
                                </a>
                            </h3>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">

                    <table class="table table-hover">
                        <thead class="bg-indigo">
                            <tr>
                                <th>Kode Tarif</th>
                                <th>Uraian</th>
                                <th>Besaran Tarif</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="text-dark">
                            @foreach ($data as $key => $BPHTB)
                                <tr>
                                    <td>
                                        <a href="#">
                                            {{ $BPHTB->kode_tarif_bphtb }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#">
                                            {{ $BPHTB->ket_tarif_bphtb }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#">
                                            <strong> {{ $BPHTB->format_tarif_bphtb }} % </strong>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('tarif.bphtb.edit', ['id' => $BPHTB->id]) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                        </div>
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
