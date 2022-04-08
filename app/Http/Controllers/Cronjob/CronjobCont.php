<?php

namespace App\Http\Controllers\Cronjob;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PengantarModel;
use App\Models\SpmModel;
use App\Models\ProsesPjbModel;
use App\Http\Traits\TgTrait; // Telegram ada di trait

class CronjobCont extends Controller
{
    use TgTrait; // Gunakan trait

    public function index()
    {
        // Ini harus dijalankan tiap jam 12 Siang
        // Kirim Notif SPM Belum diproses ke KBUD
        // $this->kirim_notif_kbud();
        // Kirim notif SP2D belum di Upload 
        // $this->kirim_notif_operator_sp2d();

        // Cek di App/Kernel.php
    }

    public function pengantar()
    {
        $hari_ini   = now();
        $data       = PengantarModel::with('spm')
            ->select('id', 'urut_pengantar', 'tgl_pengantar', 'jl_pengantar')
            ->whereDate('created_at', $hari_ini)
            ->where('id_status_pengantar', STATUS_PENGANTAR_SUDAH_UPDATE_BANK)
            ->get();
        // dd($data);
    }

    public function spmMasuk()
    {
        $hari_ini   = now();
        $data       = SpmModel::select('id', 'urut_spm', 'penerima_dana', 'ket_spm', 'jl_spm')
            ->whereDate('created_at', $hari_ini)
            ->get();

        // dd($data);
        foreach ($data as $dt) {
            // Kirim ke telegram :

        }
    }

    // only for testing
    public function updateSPM()
    {
        $today  = \Carbon\Carbon::now()->format('Y-m-d');
        $getData = \App\Models\ProsesPjbModel::all();
        foreach ($getData as $value) {
            if (formatDateAddMonth(formatDate($value->tgl_proses), 1) == $today) {
                // cari data dengan status spm 5
                $spm = \App\Models\SpmModel::where([
                    ['id', '=', $value->id_spm],
                    ['id_status_spm', '=', 5]
                ])->first();
                if ($spm) {
                    // update status menjadi 10
                    $spm->id_status_spm = 10;
                    $spm->save();
                }
            }
        }
        // return 'Successfully update status spm.';
    }


    // only for testing via Route
    public function UpdateStatusSpmSelesai()
    {
        $bulan_ini = date('m');
        $getData = ProsesPjbModel::where('id_ref_proses_pejabat', STATUS_SPM_BANK_5)
            ->whereMonth('tgl_proses', '<', $bulan_ini)
            ->get();
        foreach ($getData as $value) {
            // cari data spm bulan lalu yang statusnya masih bank (5)
            $spm = SpmModel::where('id', $value->id_spm)
                ->where('id_status_spm', STATUS_SPM_BANK_5)
                ->first();
            if ($spm) {
                // update status menjadi 10
                $spm->id_status_spm = 10;
                $spm->save();
            }
        }
        // return 'Successfully update status spm.';

        // $this->info('SPM Bank (5) telah diupdate ke Status Selesai (10) !');
        // ----
    }
    // ---
}
