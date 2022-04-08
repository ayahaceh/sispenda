<?php

namespace App\Models\Alamat;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Alamat\KecModel;
use App\Models\Alamat\KabModel;
use App\Models\Tarif\TarifNjopModel;

class DesaModel extends Model
{
    protected $table = 'desa';
    // public $timestamps  = True;
    use SoftDeletes;
    protected $fillable = [
        'kode_desa',
        'nama_desa',
    ];

    public function joinKec()
    {
        return $this->belongsTo(KecModel::class, 'kode_desa');
    }

    public function joinKab()
    {
        return $this->belongsTo(KabModel::class, 'kode_desa');
    }

    public function joinNjop()
    {
        return $this->hasMany(TarifNjopModel::class, 'kode_desa');
    }



    //----
}
