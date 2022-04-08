<?php

namespace App\Models\Referensi;

use Illuminate\Database\Eloquent\Model;
use App\Models\Logs\LogsModel;


class JenisLogsModel extends Model
{
    protected $table = 'jenis_logs';

    protected $fillable = [
        'nama_log',
    ];


    public function joinLogs()
    {
        return $this->hasMany(LogsModel::class, 'id', 'jenis_log');
    }



    //----
}
