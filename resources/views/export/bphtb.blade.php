<table border="1">
    <thead>
        <tr>
            <th colspan="9"></th>
            <th colspan="1">Pilihan A</th>
            <th colspan="3">Pilihan B</th>
            <th colspan="3">Pilihan C</th>
            <th colspan="1">Pilihan D</th>
            <th colspan="4"></th>
        </tr>
        <tr>
            <th>No</th>
            <th>NOP</th>
            <th>Nama WP</th>
            <th>NIK WP</th>
            <th>Tanggal BPHTB</th>
            <th>NPOP</th>
            <th>NPOPKP</th>
            <th>Jumlah</th>
            <th>Jenis Perolehan</th>
            <th>Penghitungan Wajib Pajak</th>
            <th>STPD BPHTB / SKPD Kurang Bayar / SKPDB kurang bayar tambahan</th>
            <th>No. NTPD</th>
            <th>Tanggal NTPD</th>
            <th>Pengurangan dihitung sendiri</th>
            <th>Menjadi (%)</th>
            <th>Berdasarkan Peraturan KHD Nomor</th>
            <th>Lainnya</th>
            <th>Jumlah Setor</th>
            <th>Tanggal Setor</th>
            <th>Nama Penyetor</th>
            <th>Status Transaksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($datas as $key => $data)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $data->nop }}</td>
            <td>{{ $data->nama_wp }}</td>
            <td>{{ $data->nik }}</td>
            <td>{{ $data->tgl_bphtb }}</td>
            <td>{{ $data->npop }}</td>
            <td>{{ $data->npoptkp }}</td>
            <td>{{ $data->jumlah_bphtb }}</td>
            <td>{{ $data->joinJenisPerolehan->kode_jenis_perolehan }} -
                {{ $data->joinJenisPerolehan->nama_jenis_perolehan }}
            </td>
            <td style="text-align: center;">
                @if ($data->opsi_a == 'Y')
                Ya
                @else
                -
                @endif
            </td>
            <td style="text-align: center;">
                @if ($data->opsi_b == 'Y')
                Ya
                @else
                -
                @endif
            </td>
            <td style="text-align: center;">
                @if ($data->opsi_b == 'Y')
                {{ $data->no_b }}
                @else
                -
                @endif
            </td>
            <td style="text-align: center;">
                @if ($data->opsi_b == 'Y')
                {{ $data->tgl_b }}
                @else
                -
                @endif
            </td>
            <td style="text-align: center;">
                @if ($data->opsi_c == 'Y')
                Ya
                @else
                -
                @endif
            </td>
            <td style="text-align: center;">
                @if ($data->opsi_c == 'Y')
                {{ $data->persen_c }}
                @else
                -
                @endif
            </td>
            <td style="text-align: center;">
                @if ($data->opsi_c == 'Y')
                {{ $data->uraian_c }}
                @else
                -
                @endif
            </td>
            <td style="text-align: center;">
                @if ($data->opsi_d == 'Y')
                {{ $data->uraian_d }}
                @else
                -
                @endif
            </td>
            <td>{{ $data->jumlah_setor }}</td>
            <td>{{ $data->tgl_setor }}</td>
            <td>{{ $data->nama_penyetor }}</td>
            <td>Lunas</td>
        </tr>
        @endforeach
    </tbody>
</table>