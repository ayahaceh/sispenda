@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

    @include('dashboard.panel.panel_ppat')

    <div class="row">
        <div class="col-12">
            <div class="card card-default card-outline">
                <div class="card-header text-indigo">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <h3 class="card-title">
                                <i class="fas fa-file-invoice-dollar mr-2"></i>
                                Daftar Transaksi BPHTB
                                </a>
                            </h3>
                        </div>
                        <div class="col-md-9 mt-2 mt-md-0">
                            <div class="d-md-flex justify-content-end">
                                <div class="mr-2">
                                    <form action="" method="GET">
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="cari" class="form-control float-right"
                                                value="{{ request()->has('cari') ? request()->cari : '' }}"
                                                placeholder="Search" autocomplete="off">
                                            <div class="input-group-append">
                                                @if (request()->has('cari'))
                                                    <a href="{{ route('ppat.bphtb') }}" class="btn btn-default">
                                                        <i class="fas fa-times text-danger"></i>
                                                    </a>
                                                @endif
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search text-indigo"></i>
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
                    <table class="table table-sm table-hover">
                        <thead class="bg-indigo">
                            <tr>
                                <th>TGL / Nama WP / NIK</th>
                                <th>NOP / NTPD</th>
                                <th>Letak NOP</th>
                                <th class="text-right pr-4">Jml. Setor</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody class="text-dark">
                            @forelse ($data as $key => $value)
                                <?php
                                // warna pelunasan
                                if ($value->status_pembayaran == STATUS_PEMBAYARAN_BELUM_BAYAR) {
                                    $warnaStatus = 'danger';
                                } elseif ($value->status_pembayaran == STATUS_PEMBAYARAN_LUNAS) {
                                    $warnaStatus = 'success';
                                } elseif ($value->status_pembayaran == STATUS_PEMBAYARAN_SEDANG_VERIFIKASI) {
                                    $warnaStatus = 'warning';
                                }
                                
                                // warna BPHTB
                                if ($value->status_bphtb == STATUS_BPHTB_SUDAH_VERIFIKASI || $value->status_bphtb == STATUS_BPHTB_SUDAH_DISETUJUI) {
                                    $warnaBphtb = 'success';
                                } elseif ($value->status_bphtb == STATUS_BPHTB_BELUM_VERIFIKASI || $value->status_bphtb == STATUS_BPHTB_BELUM_DISETUJUI) {
                                    $warnaBphtb = 'danger';
                                } else {
                                    $warnaBphtb = 'dark';
                                }
                                ?>
                                <tr>
                                    <td class="align-middle">
                                        <a href="{{ route('ppat.bphtb.show', $value->id) }}" class="text-indigo">
                                            {{ date('j F, Y', strtotime($value->tgl_bphtb)) }} <br />
                                            {!! strtoupper($value->nama_wp) !!} <br />
                                            {!! $value->format_nik !!}
                                        </a>
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('ppat.bphtb.show', $value->id) }}" class="text-indigo">
                                            NOP. {{ $value->format_nop }} <br>
                                            @if ($value->no_b)
                                                NTPD. {{ $value->format_no_b }}
                                            @endif
                                        </a>
                                    </td>
                                    <td class="align-middle text-uppercase">
                                        <a href="{{ route('ppat.bphtb.show', $value->id) }}" class="text-indigo">
                                            @isset($value->letak_nop)
                                                {{ $value->letak_nop }}
                                                <br />
                                            @endisset
                                            @isset($value->joinKecNop->nama_kec)
                                                {{ $value->joinKecNop->nama_kec }},
                                            @endisset
                                            @isset($value->joinDesaNop->nama_desa)
                                                {{ $value->joinDesaNop->nama_desa }}
                                            @endisset
                                        </a>
                                    </td>
                                    <td class="text-right align-middle pr-4">
                                        <a href="{{ route('ppat.bphtb.show', $value->id) }}" class="text-indigo">
                                            {{ number_format($value->jumlah_setor, 0, ',', '.') }}
                                        </a>
                                    </td>
                                    <td class="align-middle">
                                        @if ($value->berkas_bukti_pembayaran != '' || $value->berkas_bukti_pembayaran != null)
                                            <a href="{{ $value->file_berkas_bukti_pembayaran }}"
                                                class="btn btn-xs bg-indigo" target="_blank">
                                                <i class="fas fa-file-invoice-dollar mr-2"></i>Bukti Lunas
                                            </a>
                                            <br />
                                        @endif
                                        <small class="badge bg-{{ $warnaStatus }}">
                                            @if ($value->status_pembayaran == STATUS_PEMBAYARAN_LUNAS)
                                                @php
                                                    $x = $value->tgl_setor ? ' [' . date('d-M-y', strtotime($value->tgl_setor)) . ']' : '';
                                                @endphp
                                                {{ $value->status_pembayaran . $x }}
                                            @else
                                                @if ($value->berkas_bukti_pembayaran !== null)
                                                    Sudah Bayar (pending)
                                                @else
                                                    {{ $value->status_pembayaran }}
                                                @endif
                                            @endif
                                        </small>
                                        <br />
                                        <small class="badge bg-{{ $warnaBphtb }}">
                                            @if ($value->status_bphtb == STATUS_BPHTB_SUDAH_DISETUJUI)
                                                @php
                                                    $y = $value->tgl_persetujuan ? ' [' . $value->tgl_persetujuan . ']' : '';
                                                @endphp
                                                {{ $value->status_bphtb . $y }}
                                            @else
                                                {{ $value->status_bphtb }}
                                            @endif
                                        </small>
                                    </td>
                                    <td class="align-middle">
                                        @if ($value->status_bphtb == STATUS_BPHTB_SUDAH_VERIFIKASI || ($value->status_bphtb == STATUS_BPHTB_BELUM_DISETUJUI && $value->berkas_bukti_pembayaran == null && $value->status_pembayaran == STATUS_PEMBAYARAN_BELUM_BAYAR))
                                            <a href="{{ route('ppat.bphtb.pembayaran.show', ['id' => $value->id]) }}"
                                                class="btn btn-sm btn-success">
                                                <i class="fas fa-hand-holding-usd mr-1"></i>
                                                Pembayaran
                                            </a>
                                        @endif

                                        @if ($value->berkas_bukti_pembayaran !== null || $value->status_bphtb == STATUS_BPHTB_SUDAH_DISETUJUI)
                                            <a href="{{ route('ppat.bphtb.pembayaran.show', ['id' => $value->id]) }}"
                                                class="btn btn-sm bg-indigo">
                                                <i class="fas fa-info mr-1"></i>
                                                Ringkasan
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-3">Data tidak ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div><!-- /.card-body -->
                @if ($data->total() > $data->perPage())
                    <div class="card-footer">
                        <div class="float-right">
                            {{ $data->links('templates.bootstrap-4') }}
                        </div>
                    </div>
                @endif
            </div><!-- /.card -->
        </div> <!-- /.col -->
    </div><!-- /.row -->

    {{-- <div class="modal fade" id="modalUploadButkiBayar" tabindex="-1" aria-labelledby="modalUploadButkiBayarLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form id="form-upload" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalUploadButkiBayarLabel">Upload Bukti pembayaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nama Rekening</th>
                                    <td id="modal_nama_rekening">...</td>
                                </tr>
                                <tr>
                                    <th>No. Rek</th>
                                    <td id="modal_rekening">...</td>
                                </tr>
                                <tr>
                                    <th>Jumlah Setor</th>
                                    <td id="modal_jumlah_setor">...</td>
                                </tr>
                            </table>
                        </div>
                        <div class="form-group row">
                            <label for="berkas_bukti_pembayaran" class="col-sm-3 col-form-label">Upload Berkas</label>
                            <div class="col-sm-9">
                                <div class="custom-file">
                                    <input type="file" name="berkas_bukti_pembayaran"
                                        class="custom-file-input @error('berkas_bukti_pembayaran') is-invalid @enderror"
                                        id="berkas_bukti_pembayaran" onchange="loadPreviewGambar(this);"
                                        class="form-control">
                                    <label class="custom-file-label" for="berkas_bukti_pembayaran">Maks. 1
                                        MB
                                        (png, jpg atau jpeg)
                                    </label>
                                    @error('berkas_bukti_pembayaran')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group row d-none preview">
                            <label class="col-sm-3 col-form-label">Preview</label>
                            <div class="col-sm-9">
                                <img id="preview_img" src="" class="img-fluid img-thumbnail" width="150" height="150" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default text-indigo" data-toggle="modal"
                            data-target="#modalUploadButkiBayar">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-default bg-indigo">
                            Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
@endSection


{{-- @section('script')
    @error('berkas_bukti_pembayaran')
        <script>
            $('#modalUploadButkiBayar').modal('show');
            $('#form-upload').attr('action', "{{ Session::get('route') }}");
        </script>
    @enderror
    <script>
        $('.upload-bukti').click(function() {
            const route = $(this).attr('data-route');
            $('#form-upload').attr('action', route);
            $('#form-upload #modal_nama_rekening').text($(this).attr('data-nama_rekening'));
            $('#form-upload #modal_rekening').text($(this).attr('data-rekening'));
            $('#form-upload #modal_jumlah_setor').text($(this).attr('data-jumlah_setor'));
        });


        $(document).on('submit', 'form', function() {
            $('button').attr('disabled', 'disabled');
        });

        function loadPreviewGambar(input, id) {
            id = id || '#preview_img';
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(id)
                        .attr('src', e.target.result)
                        .width(150)
                };

                $('.preview').removeClass('d-none');
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection --}}
