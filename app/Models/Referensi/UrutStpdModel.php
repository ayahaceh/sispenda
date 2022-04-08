<?php

namespace App\Models\Referensi;

use Illuminate\Database\Eloquent\Model;


class UrutStpdModel extends Model
{
    protected $table = 'urut_stpd';

    protected $fillable = [
        'peralihan_nop_id',
        'kode_desa',
        'nomor_urut',
    ];






    //----
}
