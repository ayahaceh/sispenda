@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title"><i class="fas fa-envelope mr-2"></i>My Activity</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover table-sm">
                    <thead class="bg-gray-light">
                        <tr class="text-primary">
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Aktivitas</th>
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
                                {{ date('d/m/Y', strtotime($index->tgl_proses)) }}
                            </td>
                            <td>
                                {{ date('h:i', strtotime($index->tgl_proses)) }}
                            </td>
                            <td>
                                @isset($index->refProses->nama_proses)
                                {{ $index->refProses->nama_proses }}
                                @endisset
                                @isset($index->spm->no_spm)
                                atas SPM No. {{ $index->spm->no_spm }}
                                Tgl. {{ date('d/m/Y', strtotime($index->spm->tgl_spm)) }}
                                @endisset
                                @isset($index->spm->no_sp2d)
                                | SP2D No. {{ $index->spm->no_sp2d }}
                                Tgl. {{date('d/m/Y', strtotime($index->spm->tgl_sp2d)) }}
                                @endisset
                                @isset($index->spm->skpd->nama_skpd)
                                | SKPD : {{ $index->spm->skpd->nama_skpd_singkat }}
                                @endisset
                                {{ $index->ket_proses }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- /.card-body -->
            <div class="card-footer bg-primary">
                <div class="float-right bg-primary">
                    {{ $logs->links('templates.bootstrap-4') }}
                </div>
            </div>
        </div><!-- /.card -->
    </div> <!-- /.col -->
</div><!-- /.row -->

@endSection