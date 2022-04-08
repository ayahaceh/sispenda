<?php

namespace App\Models\Web;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class WebRegulasiModel extends Model
{
    protected $table = 'web_regulasi';
    public $timestamps  = True;
    use SoftDeletes;
    protected $fillable = [
        'nama_regulasi',
        'berkas_regulasi',

        'created_by',
    ];

    // Asesor
    public $appends = ['file_regulasi'];

    public function getFileRegulasiAttribute()
    {
        return url('web/files/' . $this->berkas_regulasi);
    }


    //----
}
