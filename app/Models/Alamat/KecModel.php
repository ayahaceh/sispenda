<?php

namespace App\Models\Alamat;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Alamat\DesaModel;
use App\Models\Alamat\KabModel;

class KecModel extends Model
{
    protected $table = 'kec';
    // public $timestamps  = True;
    use SoftDeletes;
    protected $fillable = [
        'kode_kec',
        'nama_kec',
    ];

    public function joinDesa()
    {
        return $this->hasMany(DesaModel::class, 'id', 'kec_id');
    }
    public function joinKab()
    {
        return $this->belongsTo(KabModel::class, 'kab_id');
    }




    //----
}
