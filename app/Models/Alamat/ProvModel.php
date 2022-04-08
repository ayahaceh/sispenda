<?php

namespace App\Models\Alamat;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Alamat\KabModel;
use App\Models\Alamat\KecModel;
use App\Models\Alamat\DesaModel;

class ProvModel extends Model
{
    protected $table = 'prov';
    // public $timestamps  = True;
    use SoftDeletes;
    protected $fillable = [
        'kode_prov',
        'nama_prov',
    ];

    public function joinKab()
    {
        return $this->hasMany(KabModel::class, 'kode_prov', 'kab_id');
    }
    public function joinKec()
    {
        return $this->hasMany(KecModel::class, 'kode_prov', 'kab_id');
    }
    public function joinDesa()
    {
        return $this->hasMany(DesaModel::class, 'kode_prov', 'kab_id');
    }





    //----
}
