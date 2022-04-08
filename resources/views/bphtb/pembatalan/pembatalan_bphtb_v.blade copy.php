@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')

@php
if ($data->status_bphtb == STATUS_BPHTB_SUDAH_VERIFIKASI || $data->status_bphtb == STATUS_BPHTB_SUDAH_DISETUJUI) {
$warnaBphtb = 'success';
} elseif ($data->status_bphtb == STATUS_BPHTB_BELUM_VERIFIKASI || $data->status_bphtb == STATUS_BPHTB_BELUM_DISETUJUI) {
$warnaBphtb = 'danger';
} else {
$warnaBphtb = 'dark';
}
@endphp

<div class="row pb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-indigo">
                <div class="d-md-flex justify-content-md-between align-items-center">

                    <div>
                        Status BPHTB: <span class="badge badge-{{ $warnaBphtb }}">{{ $data->status_bphtb }}</span>
                    </div>
                    <div class="btn-group mt-2 mt-md-0" role="group" aria-label="Basic example">
                        <a href="{{ route('wp.bphtb') }}" class="btn btn-default btn-sm text-indigo">
                            <i class="fas fa-angle-double-left mr-2"></i> Kembali
                        </a>
                        @if ($temp)
                        <a href="{{ route('wp.bphtb.edit', ['id' => $data->id]) }}" class="btn btn-default btn-sm text-indigo">
                            <i class="fa fa-edit mr-1"></i> Edit Transaksi
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="">
                <table class="table">
                    @if ($data->no_b)
                    <tr>
                        <th width="40%">NTPD</th>
                        <td>: {{ $data->format_no_b }}</td>
                    </tr>
                    @endif
                    <tr>
                        <th width="40%">NOP</th>
                        <td>: {{ $data->format_nop }}</td>
                    </tr>
                    <tr>
                        <th width="40%">Letak Tanah / Bangunan</th>
                        <td>: {{ $data->letak_nop }}</td>
                    </tr>
                    <tr>
                        <th width="40%">Provinsi</th>
                        <td>: {{ $data->joinProvNop->nama_prov }}</td>
                    </tr>
                    <tr>
                        <th width="40%">Kabupaten</th>
                        <td>: {{ $data->joinKabNop->nama_kab }}</td>
                    </tr>
                    <tr>
                        <th width="40%">Kecamatan</th>
                        <td>: {{ $data->joinKecNop->nama_kec }}</td>
                    </tr>
                    <tr>
                        <th width="40%">Desa</th>
                        <td>: {{ $data->joinDesaNop->nama_desa }}</td>
                    </tr>
                    <tr>
                        <th width="40%">RT / RW</th>
                        <td>: {{ $data->rtrw_nop ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th width="40%">Jenis Perolehan</th>
                        <td>:
                            {{ $data->kode_jenis_perolehan . ' - ' . $data->joinJenisPerolehan->nama_jenis_perolehan }}
                        </td>
                    </tr>
                    <tr>
                        <th width="40%">Nomor Sertifikat</th>
                        <td>: {{ $data->no_sertifikat }}</td>
                    </tr>
                    <tr>
                        <th width="40%">Luas Tanah</th>
                        <td>: {{ $data->jl_luas_tanah }} m<sup>2</sup></td>
                    </tr>
                    <tr>
                        <th width="40%">NJOP Tanah</th>
                        <td>: <span class="text-indigo">Rp {{ $data->jl_njop_tanah }}</span></td>
                    </tr>
                    <tr>
                        <th width="40%">Total Tanah</th>
                        <td>: <span class="text-indigo">Rp {{ $data->jl_tanah }}</span></td>
                    </tr>
                    <tr>
                        <th width="40%">Luas Bangunan</th>
                        <td>: {{ $data->jl_luas_bangunan }} m<sup>2</sup></td>
                    </tr>
                    <tr>
                        <th width="40%">NJOP Bangunan</th>
                        <td>: <span class="text-indigo">Rp {{ $data->jl_njop_bangunan }}</span></td>
                    </tr>
                    <tr>
                        <th width="40%">Total Bangunan</th>
                        <td>: <span class="text-indigo">Rp {{ $data->jl_bangunan }}</span></td>
                    </tr>
                    <tr>
                        <th width="40%">Total NJOP PBB</th>
                        <td>: <span class="text-indigo">Rp {{ $data->jl_total }}</span></td>
                    </tr>
                    <tr>
                        <th width="40%">Hak Transaksi / Nilai Pasar</th>
                        <td>: <span class="text-indigo">Rp {{ $data->jl_hak_nilai_pasar }}</td>
                    </tr>
                    @if ($data->berkas_ktp !== null)
                    <tr>
                        <th width="40%">Berkas KTP</th>
                        <td>:
                            <a href="{{ $data->file_ktp }}" target="_blank">
                                <img src="{{ $data->file_ktp }}" class="img-fluid img-thumbnail" style="height: 100px" />
                            </a>
                        </td>
                    </tr>
                    @endif
                    @if ($data->berkas_sertifikat !== null)
                    <tr>
                        <th width="40%">Berkas Sertifikat</th>
                        <td>:
                            <a href="{{ $data->file_sertifikat }}" target="_blank">
                                <img src="{{ $data->file_sertifikat }}" class="img-fluid img-thumbnail" style="height: 100px" />
                            </a>
                        </td>
                    </tr>
                    @endif
                    @if ($data->berkas_ajb !== null)
                    <tr>
                        <th width="40%">Berkas Akta Jual Beli</th>
                        <td>:
                            <a href="{{ $data->file_ajb }}" target="_blank">
                                <img src="{{ $data->file_ajb }}" class="img-fluid img-thumbnail" style="height: 100px" />
                            </a>
                        </td>
                    </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    function hapus(route) {
        swal({
            title: "Yakin menghapus data ini ?",
            text: "Data akan dihapus dan tidak dapat dipulihkan!",
            icon: "warning",
            buttons: true
        }).then((willDelete) => {
            if (willDelete) {

                window.location = route;

            } else {
                swal("Cancel", "Data anda masih aman :)", "error");
            }
        });
    }
</script>
@endsection