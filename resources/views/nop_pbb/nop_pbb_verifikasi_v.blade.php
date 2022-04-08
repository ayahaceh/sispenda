@extends(setTemplate())
@section('tittle', $tittle)
@section('bread', $bread)
@section('container')


<div class="row d-flex justify-content-center">
    <div class="col-md-12 col-lg-8 col-xl-6">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-4">
                        <h3 class="card-title text-indigo">
                            <i class="fas fa-map-marked-alt mr-2"></i>Verifikasi Data NOP</a>
                        </h3>
                    </div>
                    <div class="col-md-8 mt-2 mt-md-0">
                        <div class="d-md-flex justify-content-end">
                            <div class="mr-2">
                                <form action="{{ route('nop.pbb.verifikasi.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="nop" value="{{ $data->nop }}">
                                    <div class="input-group input-group-sm">
                                        <select name="status" id="status" class="form-control" required>
                                            <option value="">Pilih Status</option>
                                            <option value="1">Aktif</option>
                                            <option value="2">Tidak Aktif</option>
                                            <option value="3">Tidak Valid</option>
                                        </select>
                                        <div class="input-group-append">
                                            <button type="submit" class="btn bg-indigo">
                                                Verifikasi
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm">
                    <tr>
                        <th width="40%">NOP</th>
                        <td>: {{ $data->nop }}</td>
                    </tr>
                    <tr>
                        <th width="40%">Letak Tanah / Bangunan</th>
                        <td>: {{ $data->letak }}</td>
                    </tr>
                    <tr>
                        <th width="40%">Provinss asi</th>
                        <td>: {{ $data->joinProv->nama_prov }}</td>
                    </tr>
                    <tr>
                        <th width="40%">Kabupaten</th>
                        <td>: {{ $data->joinKab->nama_kab }}</td>
                    </tr>
                    <tr>
                        <th width="40%">Kecamatan</th>
                        <td>: {{ $data->joinKec->nama_kec }}</td>
                    </tr>
                    <tr>
                        <th width="40%">Desa</th>
                        <td>: {{ $data->joinDesa->nama_desa }}</td>
                    </tr>
                    <tr>
                        <th width="40%">RT / RW</th>
                        <td>: {{ $data->rtrw }}</td>
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
                        <td>: {{ $data->jl_luas_tanah }} M<sup>2</sup></td>
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
                        <td>: {{ $data->jl_luas_bangunan }} M<sup>2</sup></td>
                    </tr>
                    <tr>
                        <th width="40%">NJOP Bangunan</th>
                        <td>: Rp {{ $data->jl_njop_bangunan }}</td>
                    </tr>
                    <tr>
                        <th width="40%">Total Bangunan</th>
                        <td>: Rp {{ $data->jl_bangunan }}</td>
                    </tr>
                    <tr class="bg-indigo">
                        <th width="40%">Total NJOP PBB</th>
                        <td>: <strong> Rp {{ $data->jl_total }}</strong></td>
                    </tr>
                    <tr class="bg-indigo">
                        <th width="40%">Hak Transaksi / Nilai Pasar</th>
                        <td>: <strong> Rp {{ $data->jl_hak_nilai_pasar }}</strong></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection