<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RefBulanModel extends Model
{
    protected $table = 'ref_rekening';

    protected $fillable = [
        'nama_bulan',
    ];

    public function namaBulan($angka)
    {
        return $this->attributes['nama_bulan']->where('id', $angka);
    }

    //----
}
