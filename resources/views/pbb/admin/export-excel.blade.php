<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nomor Formulir</th>
            <th>Tanggal</th>
            <th>NIK</th>
            <th>Nama WP</th>
            <th>Alamat</th>
            <th>Provinsi</th>
            <th>Kabupaten</th>
            <th>Kecamatan</th>
            <th>Desa</th>
            <th>RT / RW</th>
            <th>Letak OP</th>
            <th>Jenis Perolehan</th>
            <th>No. Sertifikat</th>
            <th>Luas Tanah (m<sup>2</sup>)</th>
            <th>NJOP Tanah</th>
            <th>Total Tanah</th>
            <th>Luas Bangunan (m<sup>2</sup>)</th>
            <th>NJOP Bangunan</th>
            <th>Total Bangunan</th>
            <th>Total NJOP PBB</th>
            <th>Total NJOPTKP</th>
            <th>Status</th>
            <th>Dibuat Oleh</th>
            <th>Dibuat Pada</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($pbbs as $key => $pbb)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $pbb->nomor_formulir }}</td>
            <td>{{ $pbb->tgl_pbb }}</td>
            <td>{{ $pbb->nik }}</td>
            <td>{{ $pbb->nama_wp }}</td>
            <td>{{ $pbb->alamat_wp }}</td>
            <td>{{ $pbb->provinsiWp->nama_prov ??'' }}</td>
            <td>{{ $pbb->kabupatenWp->nama_kab ??'' }}</td>
            <td>{{ $pbb->kecamatanWp->nama_kec ??'' }}</td>
            <td>{{ $pbb->desaWp->nama_desa ??'' }}</td>
            <td>{{ $pbb->rtrw }}</td>
            <td>{{ $pbb->letak_nop }}</td>
            <td>{{ $pbb->jenisPerolehan->kode_jenis_perolehan ?? '' }} -
                {{ $pbb->jenisPerolehan->nama_jenis_perolehan ??'' }}
            </td>
            <td>{{ $pbb->no_sertifikat }}</td>
            <td>{{ $pbb->luas_tanah }}</td>
            <td>{{ $pbb->njop_tanah }}</td>
            <td>{{ $pbb->luas_tanah * $pbb->njop_tanah  }}</td>
            <td>{{ $pbb->luas_bangunan }}</td>
            <td>{{ $pbb->njop_bangunan }}</td>
            <td>{{ number_format ($pbb->luas_bangunan  * $pbb->njop_bangunan  ) }}</td>
            <td>{{ number_format($pbb->jumlah_njop) }}</td>
            <td>{{ number_format($pbb->jumlah_njoptkp) }}</td>
            <td>
                @if ($pbb->status_pbb == STATUS_NOP_AKTIF)
                Aktif
                @elseif ($pbb->status_pbb == STATUS_NOP_TIDAK_AKTIF)
                Tidak Aktif
                @elseif ($pbb->status_pbb == STATUS_NOP_TIDAK_VALID)
                Tidak Valid
                @elseif ($pbb->status_pbb == STATUS_NOP_DIAJUKAN)
                Diajukan
                @endif
            </td>
            <td>{{ $pbb->created_by }}</td>
            <td>{{ $pbb->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
