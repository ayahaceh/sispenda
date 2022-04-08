<?php

namespace App\Imports;

use App\Models\Pemilih\PemilihModel;
use Maatwebsite\Excel\Concerns\ToModel;

class PemilihImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new PemilihModel([
            'id_kec'    => $row[1],
            'id_desa'   => $row[2],
            'no_kk'     => $row[3],
            'nik'       => $row[4],
            'nama'      => $row[5],
            'tp_lahir'  => $row[6],
            'tgl_lahir' => $row[7],
            'kawin'     => $row[8],
            'jk'        => $row[9],
            'alamat'    => $row[10],
            'rt'        => $row[11],
            'rw'        => $row[12],
            'disabilitas'   => $row[13],
            'rekam'    => $row[14],
            'ket'       => $row[15],

        ]);
    }
}
