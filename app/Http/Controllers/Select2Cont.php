<?php

namespace App\Http\Controllers;

use App\Models\Alamat\DesaModel;
use App\Models\Alamat\KecModel;

class Select2Cont extends Controller
{
    public function getKec()
    {
        return KecModel::where('kode_kec', 'like', '11.10' . '.' . '%')->orderBy('nama_kec', 'ASC')->get();
    }

    public function getDesa()
    {
        return DesaModel::where('kode_desa', 'like', '11.10' . '.' . '%')->orderBy('nama_desa', 'ASC')->get();
    }
}
