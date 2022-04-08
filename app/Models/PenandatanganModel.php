<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PenandatanganModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'penandatangan';
    protected $fillable = [
        'kode_penandatangan',
        'nip_penandatangan',
        'nama_penandatangan'
    ];
    // Asesor
    public $appends = [
        'format_jabatan', 'format_nip',
    ];
    public function getFormatJabatanAttribute()
    {
        if ($this->kode_penandatangan == PETUGAS_TTD_BPHTB_BENDAHARA) {
            return 'Bendahara Penerimaan';
        } else {
            return 'Verifikator';
        }
    }
    public function getFormatNipAttribute()
    {
        $i = $this->nip_penandatangan;
        $j = ' ';

        $a = substr($i, 0, 8);
        $b = substr($i, 8, 6);
        $c = substr($i, 14, 1);
        $d = substr($i, 15, 4);
        $formatNip = $a . $j . $b . $j . $c . $j . $d;
        return $formatNip;
    }
    //--
}
