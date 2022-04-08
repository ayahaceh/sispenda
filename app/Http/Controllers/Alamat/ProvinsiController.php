<?php

namespace App\Http\Controllers\Alamat;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProvinsiResource;
use App\Models\Alamat\ProvModel;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    public function DaftarProvinsiSelect2(Request $request)
    {
        $provinsi = ProvModel::orderBy("nama_prov", "asc");
        if ($request->has("cari")) {
            $keyword = $request->cari;
            $provinsi->where('nama_prov', 'LIKE',  '%' . $keyword . '%')
                ->orWhere('kode_prov', 'LIKE',  '%' . $keyword . '%');
        }
        $provinsies = $provinsi->paginate(10);
        return  ProvinsiResource::collection($provinsies);
    }
}
