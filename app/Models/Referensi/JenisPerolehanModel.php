<?php

namespace App\Models\Referensi;

use Illuminate\Database\Eloquent\Model;
use App\Models\NopPbbModel;


class JenisPerolehanModel extends Model
{
    protected $table = 'jenis_perolehan';

    protected $fillable = [
        'kode_jenis_perolehan',
        'nama_jenis_perolehan',
    ];


    public function joinNop()
    {
        return $this->hasMany(NopPbbModel::class, 'kode_jenis_perolehan', 'jenis_perolehan');
    }



    //----
}
