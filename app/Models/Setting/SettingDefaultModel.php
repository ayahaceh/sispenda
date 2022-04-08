<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SettingDefaultModel extends Model
{
    protected $table = 'setting_default';
    // public $timestamps = false;
    use SoftDeletes;

    protected $fillable = [
        'nama_setting_default',
        'kode_setting_default',
        'ket_setting_default',
    ];

    // Relasi pakai belong semua, krn recordnya berisi kode lengkap
    public function joinProv()
    {
        return $this->belongsTo(ProvModel::class, 'kode_setting_default', 'kode_prov');
    }
    public function joinKab()
    {
        return $this->belongsTo(KabModel::class, 'kode_setting_default', 'kode_kab');
    }
    public function joinKec()
    {
        return $this->belongsTo(KecModel::class, 'kode_setting_default', 'kode_kec');
    }
    public function joinDesa()
    {
        return $this->belongsTo(DesaModel::class, 'kode_setting_default', 'kode_desa');
    }


    //----
}
