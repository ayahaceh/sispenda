<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RefStatusPengantarModel extends Model
{
    protected $table = 'ref_status_pengantar';
    use SoftDeletes;

    protected $fillable = [
        'nama_status_pengantar',
    ];


    //----
}
