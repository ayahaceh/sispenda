<?php

namespace App\Http\Controllers\Alamat;

use App\Http\Controllers\Controller;
use App\Http\Resources\KabupatenResource;
use App\Http\Resources\ProvinsiResource;
use App\Models\Alamat\KabModel;
use App\Models\Alamat\ProvModel;
use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    public function DaftarKabupatenSelect2(Request $request, ProvModel $provinsi)
    {
        $kabupaten = KabModel::orderBy("nama_kab", "asc")->where("kode_kab", "LIKE", $provinsi->kode_prov .  ".%");
        if ($request->has("cari")) {
            $keyword = $request->cari;
            $kabupaten->where('nama_kab', 'LIKE',  '%' . $keyword . '%')
                ->orWhere('kode_kab', 'LIKE', $provinsi->kode_prov . "." . $keyword . '%');
        }
        $kabupatenes = $kabupaten->paginate(10);
        return  KabupatenResource::collection($kabupatenes);
    }
}
