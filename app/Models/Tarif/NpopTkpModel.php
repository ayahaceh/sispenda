<?php

namespace App\Models\Tarif;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class NpopTkpModel extends Model
{
    protected $table = 'npop_tkp';
    public $timestamps  = True;
    use SoftDeletes;
    protected $fillable = [
        'kode_npop_tkp',
        'tarif_npop_tkp',
        'ket_npop_tkp',
        'default',
    ];

    // Asesor
    public $appends = ["tarif"];

    public function getTarifAttribute()
    {
        return number_format($this->tarif_npop_tkp, 0, ",", ".");
    }

    //----
}
