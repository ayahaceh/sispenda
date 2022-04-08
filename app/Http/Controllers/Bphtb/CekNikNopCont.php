<?php

namespace App\Http\Controllers\Bphtb;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BphtbModel;


class CekNikNopCont extends Controller
{
    public function index(Request $request)
    {
        $data = 'Cek NIK dan NOP';
        return view('bphtb.admin.cek_nik_nop', compact(
            'data',
        ));
    }
    public function cek(Request $request)
    {
        // validasi status pembayaran harus Lunas dan status bphtb Sudah Disetujui 
        // dd($request);
        $data = BphtbModel::where('status_pembayaran', '!=', STATUS_PEMBAYARAN_LUNAS)
            ->orWhere('status_bphtb', '!=', STATUS_BPHTB_SUDAH_DISETUJUI)
            ->whereNik($request->nik)
            ->count();
        if ($data > 0) {
            $data = "Ditemukan";
        }
        return view('bphtb.admin.cek_nik_nop', compact(
            'data',
        ));
    }

    //--
}
