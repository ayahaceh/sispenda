<?php

namespace App\Http\Controllers\Alamat;

use App\Http\Controllers\Controller;
use App\Http\Resources\KecamatanResource;
use App\Models\Alamat\KabModel;
use App\Models\Alamat\KecModel;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    public function DaftarKecamatanSelect2(Request $request, KabModel $kabupaten)
    {
        $kecamatan = KecModel::orderBy("nama_kec", "asc")->where("kode_kec", "LIKE", $kabupaten->kode_kab .  ".%");
        if ($request->has("cari")) {
            $keyword = $request->cari;
            $kecamatan->where('nama_kec', 'LIKE',  '%' . $keyword . '%')
                ->orWhere('kode_kec', 'LIKE', $kabupaten->kode_kab . "." . $keyword . '%');
        }
        $kecamatans = $kecamatan->paginate(10);
        return  KecamatanResource::collection($kecamatans);
    }
}
