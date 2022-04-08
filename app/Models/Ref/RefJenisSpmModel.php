<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\SpmModel;


class RefJenisSpmModel extends Model
{
    protected $table = 'ref_jenis_spm';
    use SoftDeletes;

    protected $fillable = [
        'jenis_spm',
    ];

    public function spm()
    {
        return $this->hasMany(SpmModel::class, 'id_jenis_spm', 'id');
    }
    //----
}
