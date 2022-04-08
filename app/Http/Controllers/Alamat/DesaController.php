<?php

namespace App\Http\Controllers\Alamat;

use App\Http\Controllers\Controller;
use App\Http\Resources\DesaResource;
use App\Models\Alamat\DesaModel;
use App\Models\Alamat\KecModel;
use Illuminate\Http\Request;

class DesaController extends Controller
{
    public function DaftarDesaSelect2(Request $request, KecModel $kecamatan)
    {
        $desa = DesaModel::orderBy("nama_desa", "asc")->where("kode_desa", "LIKE", $kecamatan->kode_kec .  ".%");
        if ($request->has("cari")) {
            $keyword = $request->cari;
            $desa->where('nama_desa', 'LIKE',  '%' . $keyword . '%')
                ->orWhere('kode_desa', 'LIKE', $kecamatan->kode_kec . "." . $keyword . '%');
        }
        $desas = $desa->paginate(10);
        return  DesaResource::collection($desas);
    }
}
