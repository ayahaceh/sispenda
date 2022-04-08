<?php

namespace App\Models\Tarif;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Alamat\DesaModel;

class TarifNjopModel extends Model
{
    protected $table = 'tarif_njop';
    public $timestamps  = false;
    use SoftDeletes;
    protected $fillable = [
        'kode_tarif_njop',
        'kode_desa',
        'jumlah_tarif_njop',
        'ket_tarif_njop',
    ];

    // Asesor
    public $appends = ['format_tarif_njop'];

    public function getFormatTarifNjopAttribute()
    {
        return number_format($this->jumlah_tarif_njop, 0, ",", ".");
    }

    public function joinDesa()
    {
        return $this->belongsTo(DesaModel::class, 'kode_desa', 'kode_desa');
    }
    //----
}
