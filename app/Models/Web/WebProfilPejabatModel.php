<?php

namespace App\Models\Web;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class WebProfilPejabatModel extends Model
{
    protected $table = 'web_profil_pejabat';
    public $timestamps  = True;
    use SoftDeletes;
    protected $fillable = [
        'nama_pejabat',
        'jabatan_pejabat',
        'uraian_pejabat',
        'berkas_foto',

        'created_by',
    ];

    // Asesor
    public $appends = ['file_foto'];

    public function getFileFotoAttribute()
    {
        return url('web/images/' . $this->berkas_foto);
    }


    //----
}
