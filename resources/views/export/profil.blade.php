<table>
    <thead>
        <tr>
            <th>No</th>
            <th>NIK</th>
            <th>No. KK</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jenis Kelamin</th>
            <th>Provinsi</th>
            <th>Kabupaten</th>
            <th>Kecamatan</th>
            <th>Desa</th>
            <th>RT/RW</th>
            <th>Kode Pos</th>
            <th>Alamat</th>
            <th>No. Telpon</th>
            <th>No. Whatsapp</th>
            <th>ID Telegram</th>
            <th>Jumlah NOP</th>
            <th>Kode PPAT</th>
            <th>Status</th>
            <th>Berkas Foto</th>
            <th>Berkas KTP</th>
            <th>Berkas KK</th>
            <th>Dibuat Oleh</th>
            <th>Dibuat Pada</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $key => $data)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $data->nik }}</td>
                <td>{{ $data->kk }}</td>
                <td>{{ $data->nama }}</td>
                <td>{{ $data->email }}</td>
                <td>{{ $data->jk }}</td>
                <td>{{ $data->joinProv->nama_prov }}</td>
                <td>{{ $data->joinKab->nama_kab }}</td>
                <td>{{ $data->joinKec->nama_kec }}</td>
                <td>{{ $data->joinDesa->nama_desa }}</td>
                <td>{{ $data->rtrw }}</td>
                <td>{{ $data->kode_pos }}</td>
                <td>{{ $data->alamat }}</td>
                <td>{{ $data->hp }}</td>
                <td>{{ $data->wa }}</td>
                <td>{{ $data->tg }}</td>
                <td>{{ $data->jumlahNop->count() }}</td>
                <td>{{ $data->kode_ppat }}</td>
                <td>{{ $data->status_profil }}</td>
                <td>
                    <a href="{{ $data->file_foto }}">{{ $data->file_foto }}</a>
                </td>
                <td>
                    <a href="{{ $data->file_ktp }}">{{ $data->file_ktp }}</a>
                </td>
                <td>
                    <a href="{{ $data->file_kk }}">{{ $data->file_kk }}</a>
                </td>
                <td>{{ $data->created_by }}</td>
                <td>{{ $data->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
