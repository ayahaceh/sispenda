<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SatkersModel extends Model
{
    protected $table = 'satkers';
    public $timestamps  = True;
    use SoftDeletes;
    protected $fillable = [
        'kode_satker',
        'nama_satker',
        'alamat_satker',
        'ket_satker',
        'status_satker',
        'nama_satkera',
        'nama_satkerb',
        'kota_satker',
        'prov_satker',
        'logo_satker',
        'nama_kepala',
        'nip_kepala',
        'jab_kepala',
    ];


    //----
}
