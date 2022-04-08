@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

    <div class="row">
        <div class="col-12">
            <div class="card card-default card-outline">
                <div class="card-header bg-indigo">
                    <h3 class="card-title">
                        <i class="fas fa-file-invoice-dollar mr-2"></i>Daftar Tarif NPOPTKP</a>
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead class="bg-indigo">
                            <tr>
                                <th>Kode Tarif</th>
                                <th>Jumlah Tarif</th>
                                <th>Keterangan</th>
                                <th>Default</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="text-dark">
                            @foreach ($data as $key => $tR)
                                <?php
                                $default = $tR->default;
                                
                                switch ($default) {
                                    case '1':
                                        $warna = 'success';
                                        $text = 'Default';
                                        break;
                                    default:
                                        $warna = 'secondary';
                                        $text = 'No';
                                }
                                
                                ?>
                                <tr>
                                    <td>
                                        <a href="#">
                                            {{ $tR->kode_npop_tkp }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#">
                                            {{ $tR->tarif }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $tR->ket_npop_tkp }}
                                    </td>
                                    <td>
                                        <a href="#" class="text-dark">
                                            <small class="badge badge-{{ $warna }}">{{ $text }}</small>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('tarif.npoptkp.edit', ['id' => $tR->id]) }}"
                                                class="btn btn-warning btn-sm edit">Edit</a>
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
