<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ref\RefSkpdModel;


class SkSkpdModel extends Model
{
    protected $table = 'sk_skpd';
    public $timestamps  = True;
    use SoftDeletes;

    protected $fillable = [
        'id_skpd',
        'tahun',
        'sk_skpd',

        'created_by',
        'updated_by',
        'deleted_by',
    ];


    public function skpd()
    {
        return $this->hasOne(RefSkpdModel::class, 'id_skpd', 'id');
    }

    //----
}
