<?php

namespace App\Models\Logs;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProfilModel;
use App\Models\UserModel;

use Illuminate\Database\Eloquent\SoftDeletes;

class LogsModel extends Model
{
    protected $table    = 'logs';
    public $timestamps  = false;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'jenis_log',
        'waktu',
        'kegiatan',
        'dokumen_id',
    ];

    public function joinProfil()
    {
        return $this->belongsTo(ProfilModel::class, 'user_id');
    }

    public function joinUser()
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }

    //---
}
