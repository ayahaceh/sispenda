<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RefProsesPejabatModel extends Model
{
    protected $table = 'ref_proses_pejabat';
    use SoftDeletes;

    protected $fillable = [
        'nama_proses',
    ];

    //----
}
