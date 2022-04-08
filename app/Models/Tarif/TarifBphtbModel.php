<?php

namespace App\Models\Tarif;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class TarifBphtbModel extends Model
{
    protected $table = 'tarif_bphtb';
    public $timestamps  = False;
    use SoftDeletes;
    protected $fillable = [
        'kode_tarif_bphtb',
        'persen_tarif_bphtb',
        'ket_tarif_bphtb',
    ];

    // Asesor
    public $appends = ['format_tarif_bphtb'];

    public function getFormatTarifBphtbAttribute()
    {
        return $this->persen_tarif_bphtb * 100;
    }

    //----
}
