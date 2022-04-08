<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RefValidSpmModel extends Model
{
    protected $table = 'ref_valid_spm';
    use SoftDeletes;

    protected $fillable = [
        'valid_spm',
    ];


    //----
}
