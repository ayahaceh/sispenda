<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RefLogsModel extends Model
{
    protected $table = 'ref_logs';
    use SoftDeletes;

    protected $fillable = [
        'nama_log',
        'deskripsi_log',
    ];


    //----
}
