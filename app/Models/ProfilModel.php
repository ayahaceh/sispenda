<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\TransaksiBphtbModel;
use App\Models\NopPbbModel;
use App\Models\Alamat\DesaModel;
use App\Models\Alamat\KecModel;
use App\Models\Alamat\KabModel;
use App\Models\Alamat\ProvModel;
use App\Models\UserGroup\UserGroupModel;

class ProfilModel extends Model
{
    protected $table = 'profil';
    public $timestamps  = True;
    use SoftDeletes;
    protected $fillable = [
        'nik',
        'kk',
        'nama',
        'jk',
        'alamat',
        'kode_prov',
        'kode_kab',
        'kode_kec',
        'kode_desa',
        'rtrw',
        'kode_pos',
        'hp',
        'wa',
        'tg',
        'email',
        'berkas_foto',
        'berkas_ktp',
        'berkas_kk',
        // 'jenis_profil_id',
        'status_profil',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
    // Asesor
    public $appends = ['file_foto', 'file_ktp', 'file_kk', 'format_nik'];

    public function getFileFotoAttribute()
    {
        return url('upload/users/' . $this->berkas_foto);
    }
    public function getFileKtpAttribute()
    {
        return url('upload/berkas_ktp/' . $this->berkas_ktp);
    }
    public function getFileKkAttribute()
    {
        return url('upload/berkas_kk/' . $this->berkas_kk);
    }

    public function getFormatNikAttribute()
    {
        $i = $this->nik;
        $j = ' ';

        $a = substr($i, 0, 2);
        $b = substr($i, 2, 4);
        $c = substr($i, 6, 3);
        $d = substr($i, 9, 5);
        $e = substr($i, 14, 3);
        $formatNIK = $a . $j . $b . $j . $c . $j . $d . $j . $e;
        return $formatNIK;
    }
    // Relasi
    public function jumlahNop()
    {
        return $this->hasMany(NopPbbModel::class, 'nik', 'nik');
    }

    public function joinTransaksi()
    {
        return $this->hasMany(TransaksiBphtbModel::class, 'profil_id');
    }
    public function joinDesa()
    {
        return $this->belongsTo(DesaModel::class, 'kode_desa', 'kode_desa');
    }
    public function joinKec()
    {
        return $this->belongsTo(KecModel::class, 'kode_kec', 'kode_kec');
    }
    public function joinKab()
    {
        return $this->belongsTo(KabModel::class, 'kode_kab', 'kode_kab');
    }
    public function joinProv()
    {
        return $this->belongsTo(ProvModel::class, 'kode_prov', 'kode_prov');
    }
    // public function joinUserGroup()
    // {
    //     return $this->belongsTo(UserGroupModel::class, 'jenis_profil_id');
    // }
    public function joinNopPbb()
    {
        return $this->hasMany(NopPbbModel::class, 'profil_id');
    }







    //----
}
