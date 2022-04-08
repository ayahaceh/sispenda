<?php

namespace App\Http\Controllers\Alamat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alamat\ProvModel;
use App\Models\Alamat\KabModel;
use App\Models\Alamat\KecModel;
use App\Models\Alamat\DesaModel;

class AlamatCont extends Controller
{

    public function index()
    {
        // return $dataProv = ProvModel::all();
    }

    public function pilih_kab($kode_prov)
    {
        $dataKab = KabModel::where('kode_kab', 'LIKE',  $kode_prov . '.' . '%')->get();
        return response()->json($dataKab);
    }

    public function pilih_kec($kode_kab)
    {
        $dataKec = KecModel::where('kode_kec', 'LIKE',  $kode_kab . '.' . '%')->get();
        return response()->json($dataKec);
    }

    public function pilih_desa($kode_kec)
    {
        $dataDesa = DesaModel::where('kode_desa', 'LIKE',  $kode_kec . '.' . '%')->get();
        return response()->json($dataDesa);
    }

    public function nama_prov($kode_prov)
    {
        $dataProv = KabModel::where('kode_kab', $kode_prov)->first();
        return response()->json($dataProv);
    }

    public function nama_kab($kode_kab)
    {
        $dataKab = KabModel::where('kode_kab', $kode_kab)->first();
        return response()->json($dataKab);
    }

    public function nama_kec($kode_kec)
    {
        $dataKec = KecModel::where('kode_kec', $kode_kec)->first();
        return response()->json($dataKec);
    }

    public function nama_desa($kode_desa)
    {
        $dataDesa = DesaModel::where('kode_desa', $kode_desa)->first();
        return response()->json($dataDesa);
    }

    // ----------------
}
