<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\SpmModel;
use App\Models\Ref\SkSkpdModel;
use App\Models\UserModel;


class RefSkpdModel extends Model
{
    protected $table = 'ref_skpd';
    public $timestamps  = True;
    use SoftDeletes;

    protected $fillable = [
        'kode_skpd',
        'nama_skpd',
        'nama_skpd_singkat',
        'alamat_skpd',
        'nama_bendahara_skpd',
        'nip_bendahara_skpd',
        'nama_kepala_skpd',
        'nip_kepala_skpd',
        'email_skpd',

        'hp_skpd',
        'id_jenis_spm',
        'id_status_spm',
        'id_level_proses',
        'id_tolak_terima',

        'urut_sp2d',
        'tg_skpd',
    ];


    public function spm()
    {
        return $this->hasMany(SpmModel::class, 'id_skpd', 'id');
    }

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'id_penguji', 'id');
    }

    public function sk()
    {
        return $this->hasMany(SkSkpdModel::class, 'id_skpd', 'id');
    }

    public function penguji()
    {
        return $this->belongsTo(UserModel::class, 'id_penguji');
    }

    //----
}
