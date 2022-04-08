<?php

namespace App\Models\Web;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class WebKanalPembayaranModel extends Model
{
    protected $table = 'web_kanal_pembayaran';
    public $timestamps  = True;
    use SoftDeletes;
    protected $fillable = [
        'nama_kanal',
        'uraian_kanal',
        'berkas_kanal',

        'created_by',
    ];

    // Asesor
    public $appends = ['file_kanal'];

    public function getFileKanalAttribute()
    {
        return url('web/images/' . $this->berkas_kanal);
    }


    //----
}
