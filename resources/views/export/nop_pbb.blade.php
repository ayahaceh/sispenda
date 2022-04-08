<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>NIK</th>
            <th>NOP</th>
            <th>Provinsi</th>
            <th>Kabupaten</th>
            <th>Kecamatan</th>
            <th>Desa</th>
            <th>RT / RW</th>
            <th>Letak</th>
            <th>Jenis Perolehan</th>
            <th>No. Sertifikat</th>
            <th>Kode PPAT</th>
            <th>Luas Tanah (m<sup>2</sup>)</th>
            <th>NJOP Tanah</th>
            <th>Total Tanah</th>
            <th>Luas Bangunan (m<sup>2</sup>)</th>
            <th>NJOP Bangunan</th>
            <th>Total Bangunan</th>
            <th>Total NJOP PBB</th>
            <th>Hak Nilai Pasar</th>

            <th>Status</th>
            <th>Dibuat Oleh</th>
            <th>Dibuat Pada</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $key => $data)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $data->joinProfil->nama }}</td>
                <td>{{ $data->joinProfil->email }}</td>
                <td>{{ $data->nik }}</td>
                <td>{{ $data->nop }}</td>
                <td>{{ $data->joinProv->nama_prov }}</td>
                <td>{{ $data->joinKab->nama_kab }}</td>
                <td>{{ $data->joinKec->nama_kec }}</td>
                <td>{{ $data->joinDesa->nama_desa }}</td>
                <td>{{ $data->rtrw }}</td>
                <td>{{ $data->letak }}</td>
                <td>{{ $data->joinJenisPerolehan->kode_jenis_perolehan }} -
                    {{ $data->joinJenisPerolehan->nama_jenis_perolehan }}</td>
                <td>{{ $data->no_sertifikat }}</td>
                <td>{{ $data->kode_ppat }}</td>
                <td>{{ $data->luas_tanah_rm_dec }}</td>
                <td>{{ $data->njop_tanah }}</td>
                <td>{{ str_replace('.', '', $data->jl_tanah) }}</td>
                <td>{{ $data->luas_bangunan_rm_dec }}</td>
                <td>{{ $data->njop_bangunan }}</td>
                <td>{{ str_replace('.', '', $data->jl_bangunan) }}</td>
                <td>{{ $data->jl_total }}</td>
                <td>{{ $data->jl_hak_nilai_pasar }}</td>

                <td>
                    @if ($data->status_nop_pbb == STATUS_NOP_AKTIF)
                        Aktif
                    @elseif ($data->status_nop_pbb == STATUS_NOP_TIDAK_AKTIF)
                        Tidak Aktif
                    @elseif ($data->status_nop_pbb == STATUS_NOP_TIDAK_VALID)
                        Tidak Valid
                    @elseif ($data->status_nop_pbb == STATUS_NOP_DIAJUKAN)
                        Diajukan
                    @endif
                </td>
                <td>{{ $data->created_by }}</td>
                <td>{{ $data->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
