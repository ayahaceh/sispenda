<?php

namespace App\Http\Traits;

use App\Models\Referensi\UrutStpdModel;

trait UrutStpdTrait
{
    public function ambilUrutTerakhir($kode_desa)
    {
        // cek nomor terakhir
        $urutTerakhir = UrutStpdModel::select('nomor_urut')
            ->where('kode_desa', $kode_desa)
            ->orderBy('id', 'DESC')
            ->latest()
            ->first();
        $urutBerikutnya = 1;
        if (!empty($urutTerakhir)) {
            $urutBerikutnya = $urutTerakhir->nomor_urut + 1;
        }
        return $urutBerikutnya;
    }


    //
}
