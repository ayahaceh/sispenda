<?php

namespace App\Http\Traits;

use App\Models\Logs\LogsModel;
use Illuminate\Support\Facades\Auth;

trait LogsTrait
{
    public function simpanLogs($jenis, $id, $keg)
    {
        if (Auth()->user()->user_group != USER_SUPER_ADMIN) {
            try {
                $LOG                = new LogsModel;
                $LOG->user_id       = Auth()->user()->id;
                $LOG->jenis_log     = $jenis;       // Menentukan jenis log (tabel yang mana) ada di konstanta
                $LOG->waktu         = now();            // Ambil waktu sekarang 
                $LOG->kegiatan      = $keg;        // Uraian kegiatan user
                $LOG->dokumen_id    = $id;      // id dokumen (id record)
                $LOG->save();
            } catch (\Throwable $th) {
                dd("error", $th);
            }
        }
        //--
    }



    //
}
