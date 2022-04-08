<?php

namespace App\Models\Alamat;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ProvModel;
use App\Models\KecModel;
use App\Models\DesaModel;
use App\Models\NopPbbModel;

class KabModel extends Model
{
    protected $table = 'kab';
    // public $timestamps  = True;
    use SoftDeletes;
    protected $fillable = [
        'kode_kab',
        'nama_kab',
    ];
    public function joinProv()
    {
        return $this->belongsTo(ProvModel::class, 'kab_id');
    }
    public function joinKec()
    {
        return $this->hasMany(KecModel::class, 'id', 'kab_id');
    }
    public function joinDesa()
    {
        return $this->hasMany(DesaModel::class, 'id', 'kab_id');
    }

    public function joinNopPbb(){
        return $this->hasMany(NopPbbModel::class,'kode_kab','kode_kab');
    }

}
