<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\TransaksiBphtbModel;
use App\Models\Alamat\DesaModel;
use App\Models\Alamat\KecModel;
use App\Models\Alamat\KabModel;
use App\Models\Alamat\ProvModel;
use App\Models\ProfilModel;
use App\Models\UserGroup\UserGroupModel;
use App\Models\Referensi\JenisPerolehanModel;

class NopPbbModel extends Model
{
    protected $table = 'nop_pbb';
    public $timestamps  = True;
    use SoftDeletes;
    protected $fillable = [
        'nik',
        'nop',
        'letak',
        'kode_prov',
        'kode_kab',
        'kode_kec',
        'kode_desa',
        'rtrw',
        'luas_tanah',
        'njop_tanah',
        'luas_bangunan',
        'njop_bangunan',
        'jenis_perolehan',
        'hak_nilai_pasar',
        'no_sertifikat',
        'status_nop_pbb',
        'created_by',
        'updated_by',
        'deleted_by',

    ];

    // Asesor
    public $appends = [
        'jl_luas_tanah', 'jl_luas_bangunan',
        'jl_njop_tanah', 'jl_njop_bangunan',
        'jl_tanah', 'jl_bangunan', 'jl_total', 'angka_total',
        'jl_hak_nilai_pasar',
        'luas_tanah_rm_dec',
        'luas_bangunan_rm_dec', 'format_nop', 'format_nik',
        'format_hak_nilai_pasar'
    ];

    public function getFormatNopAttribute()
    {
        $i = $this->nop;
        $j = ' ';
        $k = ' ';

        $a = substr($i, 0, 2);
        $b = substr($i, 2, 2);
        $c = substr($i, 4, 3);
        $d = substr($i, 7, 3);
        $e = substr($i, 10, 4);
        $f = substr($i, 13, 4);
        $g = substr($i, 17, 3);
        $formatNOP = $a . $j . $b . $j . $c . $j . $d . $j . $e . $j . $f . $k . $g;
        return $formatNOP;
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
    public function getJlLuasTanahAttribute()
    {
        return number_format($this->luas_tanah, 0, ",", ".");
    }
    public function getJlLuasBangunanAttribute()
    {
        return number_format($this->luas_bangunan, 0, ",", ".");
    }
    public function getJlNjopTanahAttribute()
    {
        return number_format($this->njop_tanah, 0, ",", ".");
    }
    public function getJlNjopBangunanAttribute()
    {
        return number_format($this->njop_bangunan, 0, ",", ".");
    }
    public function getJlTanahAttribute()
    {
        $luas = $this->luas_tanah * $this->njop_tanah;
        return number_format($luas, 0, ",", ".");
    }
    public function getJlBangunanAttribute()
    {
        $luas = $this->luas_bangunan * $this->njop_bangunan;
        return number_format($luas, 0, ",", ".");
    }
    public function getJlTotalAttribute()
    {
        $tanah      = $this->luas_tanah * $this->njop_tanah;
        $bangunan   = $this->luas_bangunan * $this->njop_bangunan;
        $total      = $tanah + $bangunan;
        return number_format($total, 0, ",", ".");
    }
    public function getAngkaTotalAttribute()
    {
        $tanah      = $this->luas_tanah * $this->njop_tanah;
        $bangunan   = $this->luas_bangunan * $this->njop_bangunan;
        return $tanah + $bangunan;
        // return number_format($total, 0, ",", ".");
    }
    public function getFormatHakNilaiPasarAttribute()
    {
        return number_format($this->hak_nilai_pasar, 0, ",", ".");
    }
    public function getJlHakNilaiPasarAttribute()
    {
        return explode('.', $this->hak_nilai_pasar)[0];
    }

    // Hapus Desimal
    public function getLuasTanahRmDecAttribute()
    {
        return explode('.', $this->luas_tanah)[0];
    }

    public function getLuasBangunanRmDecAttribute()
    {
        return explode('.', $this->luas_bangunan)[0];
    }
    // Relasi
    public function joinProfil()
    {
        return $this->belongsTo(ProfilModel::class, 'nik', 'nik');
    }
    public function joinTransaksi()
    {
        return $this->hasMany(TransaksiBphtbModel::class, 'nop_pbb_id');
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
    public function joinUserGroup()
    {
        return $this->belongsTo(UserGroupModel::class, 'jenis_profil_id');
    }
    public function joinNopPbb()
    {
        return $this->hasMany(NopPbbModel::class, 'profil_id');
    }
    public function joinJenisPerolehan()
    {
        return $this->belongsTo(JenisPerolehanModel::class, 'kode_jenis_perolehan', 'kode_jenis_perolehan');
    }



    //----
}
