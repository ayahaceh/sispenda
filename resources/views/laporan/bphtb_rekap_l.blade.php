@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@push('styles')
    <style type="text/css" media="print">
        @page {
            size: auto;
            size: A4;
            margin: 1.9cm;
        }

    </style>
@endpush
@section('container')

    <div class="card bg-light">
        <div class="card-header border-0 text-indigo p-2">
            <div class="form-group">
                <h4 class="text-center text-indigo">DAFTAR PENERIMAAN DARI BPHTB</h4>
                <h5 class="text-center text-indigo">
                    @if ($isFilter == 'NO')
                        DARI TANGGAL 01 JAN {{ date('Y', strtotime($tglAwal)) }}
                    @else
                        DARI TANGGAL {{ strtoupper(date('d M Y', strtotime($tglAwal))) }}
                    @endif
                    S/D {{ strtoupper(date('d M Y', strtotime($tglAkhir))) }} <br />
                    <small>
                        <strong>
                            @if ($namaDesa)
                                @if ($namaDesa == 'Semua Desa')
                                    (Desa : {{ $namaDesa }})
                                @else
                                    (Desa : {{ $namaDesa->nama_desa }})
                                @endif
                            @elseif ($namaKec)
                                @if ($namaKec == 'Semua Kecamatan')
                                    (Kecamatan : {{ $namaKec }})
                                @else
                                    (Kecamatan : {{ $namaKec->nama_kec }})
                                @endif
                            @endif
                        </strong>
                    </small>
                </h5>
            </div>
            <div class="button-group no-print">
                <a href="#" class="btn btn-flat btn-sm bg-indigo float-right" onclick="printFunction()">
                    <i class="fas fa-print mr-2"></i> Print
                </a>
                <div class="dropdown">
                    <button class="btn btn-flat btn-sm bg-indigo float-right dropdown-toggle" type="button"
                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-filter mr-2"></i> Filter
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item text-indigo" href="#" data-toggle="modal" data-target="#filterbyKecModal">
                            Filter by Kecamatan
                        </a>
                        <a class="dropdown-item text-indigo" href="#" data-toggle="modal" data-target="#filterModal">
                            Filter by Desa
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-bordered table-sm">
                <tr class="text-indigo text-center">
                    <th>Tanggal</th>
                    <th>Wajib Pajak</th>
                    <th>NOP / NTPD</th>
                    <th>Letak</th>
                    <th width="14%">Jumlah (Rp)</th>
                </tr>
                @forelse ($data as $key => $value)
                    <tr>
                        <td>{{ date('d/m/Y', strtotime($value->tgl_setor)) }}</td>
                        <td>{{ $value->nama_wp }} <br /> NIK. {{ $value->format_nik }}</td>
                        <td>NOP. {{ $value->format_nop }} <br /> NTPD. {{ $value->format_no_b }}</td>
                        <td>
                            {{ $value->joinDesaNop->nama_desa ?? '' }}, Kec.
                            {{ $value->joinKecNop->nama_kec ?? '' }}
                        </td>
                        <td class="text-right">{{ $value->jl_setor }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-3">Data tidak ditemukan</td>
                    </tr>
                @endforelse
                <tr class="text-indigo">
                    <td colspan="4" class="text-center"><strong>TOTAL</strong></td>
                    <td class="text-right">
                        <strong> {{ number_format($data->sum('jumlah_setor'), 0, ',', '.') }}</strong>
                    </td>
                </tr>
            </table>
        </div>
        {{-- <div class="card-footer no-print">
            <div class="float-right">
                $data->links('templates.bootstrap-4')
            </div>
        </div> --}}
    </div>


@endSection

@section('modal')
    <div class="modal fade" id="filterModal" aria-labelledby="filterExportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('laporan.bphtb.rekap.kas') }}" method="GET">
                    <div class="modal-header text-indigo">
                        <h5 class="modal-title" id="filterExportModalLabel">
                            <i class="fas fa-filter mr-2"></i> Filter Transaksi BPHTB
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-indigo">
                        @php
                            $hari_ini = date('Y-m-d');
                            $tgl_pertama = date('Y-m-01', strtotime($hari_ini));
                            $tgl_terakhir = date('Y-m-t', strtotime($hari_ini));
                        @endphp
                        <input type="hidden" name="filter" class="form-control" value="filter">
                        <div class="form-group row">
                            <label for="tgl_awal" class="col-md-4">Dari Tanggal</label>
                            <div class="col-md-8">
                                <input type="date" name="tgl_awal" class="form-control"
                                    value="{{ request('tgl_awal') ?? $tgl_pertama }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl_akhir" class="col-md-4">Sampai Tanggal</label>
                            <div class="col-md-8">
                                <input type="date" name="tgl_akhir" class="form-control"
                                    value="{{ request('tgl_akhir') ?? $tgl_terakhir }}" required>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pilih_desa" class="col-md-4">Desa</label>
                            <div class="col-md-8">
                                <select id="kode_desa_nop" name="kode_desa_nop" class="form-control"
                                    style="width: 100% !important;" required>
                                    <option value="semua"> - Semua Desa - </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default btn-sm text-indigo">
                            <i class="fas fa-filter mr-1 ml-2"></i> Lihat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="filterbyKecModal" aria-labelledby="filterbyKecModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('laporan.bphtb.rekap.kas') }}" method="GET">
                    <div class="modal-header text-indigo">
                        <h5 class="modal-title" id="filterbyKecModalLabel">
                            <i class="fas fa-filter mr-2"></i> Filter Transaksi BPHTB
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-indigo">
                        @php
                            $hari_ini = date('Y-m-d');
                            $tgl_pertama = date('Y-m-01', strtotime($hari_ini));
                            $tgl_terakhir = date('Y-m-t', strtotime($hari_ini));
                        @endphp
                        <input type="hidden" name="filter" class="form-control" value="filter">
                        <div class="form-group row">
                            <label for="tgl_awal" class="col-md-4">Dari Tanggal</label>
                            <div class="col-md-8">
                                <input type="date" name="tgl_awal" class="form-control"
                                    value="{{ request('tgl_awal') ?? $tgl_pertama }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl_akhir" class="col-md-4">Sampai Tanggal</label>
                            <div class="col-md-8">
                                <input type="date" name="tgl_akhir" class="form-control"
                                    value="{{ request('tgl_akhir') ?? $tgl_terakhir }}" required>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pilih_kec" class="col-md-4">Kecamatan</label>
                            <div class="col-md-8">
                                <select id="kode_kec_nop" name="kode_kec_nop" class="form-control"
                                    style="width: 100% !important;" required>
                                    <option value="semua"> - Semua Kecamatan - </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default btn-sm text-indigo">
                            <i class="fas fa-filter mr-1 ml-2"></i> Lihat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Print
        function printFunction() {
            window.print();
        }
    </script>
@endSection

@push('scripts')
    <script>
        $.get("{{ route('select2.get-kec') }}", function(data) {
            $('#kode_kec_nop').select2({
                allowClear: true
            });

            $.each(data, function(index, element) {
                const old = "{{ request('kode_kec_nop') }}";
                const selected = old == element.kode_kec ? 'selected' : '';
                $('#kode_kec_nop').append(
                    '<option value="' + element.kode_kec + '"' + selected + '>' + element.nama_kec +
                    '</option>');
            });
        });

        $.get("{{ route('select2.get-desa') }}", function(data) {
            $('#kode_desa_nop').select2({
                allowClear: true
            });

            $.each(data, function(index, element) {
                const old = "{{ request('kode_desa_nop') }}";
                const selected = old == element.kode_desa ? 'selected' : '';
                $('#kode_desa_nop').append(
                    '<option value="' + element.kode_desa + '"' + selected + '>' + element.nama_desa +
                    '</option>');
            });
        });
    </script>
@endpush
