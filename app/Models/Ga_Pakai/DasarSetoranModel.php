<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\PeralihanNopModel;

class DasarSetoranModel extends Model
{
    protected $table = 'dasar_setoran';
    // public $timestamps  = True;
    // use SoftDeletes;
    protected $fillable = [
        'nama_dasar_setoran',
    ];

    public function joinTransaksi()
    {
        return $this->hasMany(PeralihanNopModel::class, 'dasar_setoran_id');
    }





    //----
}
