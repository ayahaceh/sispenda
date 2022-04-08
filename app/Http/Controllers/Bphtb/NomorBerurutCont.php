<?php

namespace App\Http\Controllers\Bphtb;

use App\Http\Controllers\Controller;
use App\Models\BphtbModel;


class NomorBerurutCont extends Controller
{

    public function nomor_berikutnya($kode_desa_nop = null, $tgl_setor_string = null)
    {
        // Ini dikirim dari inputan pada view
        $kode_desa_nop      = '11.10.010.001';
        $tgl_setor_string   = '2021-12-11';
        // Ini diconvert untuk digunakan
        $kode_desa_kec      = explode('.', $kode_desa_nop)[2] . explode('.', $kode_desa_nop)[3];
        $tgl_setor_date     = date('Y', strtotime($tgl_setor_string));
        $tahun_dua_digit    = $tgl_setor_string[2] . $tgl_setor_string[3]; // Ambil dari tgl setor.
        // Cari kedalam database
        $ntpd_lama = BphtbModel::select('no_b')
            ->where('kode_desa_nop', $kode_desa_nop)
            ->whereYear('tgl_setor', $tgl_setor_date)
            ->orderBy('id', 'DESC')
            ->first();
        // Jika ditemukan datanya
        if ($ntpd_lama != null) {
            $ntpd_lama  = $ntpd_lama->no_b;
            // Jika datanya format lama 109, maka mulai dari 00001 lagi.
            if ($ntpd_lama[0] == "1") {
                $ntpd_berikutnya    = $tahun_dua_digit . $kode_desa_kec . '00001';
            } else {
                $ntpd_berikutnya    = intval($ntpd_lama) + 1;
            }
        } else {
            // Jika NULL (Tidak Ditemukan)
            $ntpd_berikutnya =  $tahun_dua_digit . $kode_desa_kec . '00001';
        }
        // Return
        return $ntpd_berikutnya;
    }




    //--
}
