<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RefStatusSpmModel extends Model
{
    protected $table = 'ref_status_spm';
    use SoftDeletes;

    protected $fillable = [
        'nama_status',
    ];


    //----
}
