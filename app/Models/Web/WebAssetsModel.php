<?php

namespace App\Models\Web;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class WebAssetsModel extends Model
{
    protected $table = 'web_assets';
    public $timestamps  = True;
    use SoftDeletes;
    protected $fillable = [
        'berkas_video',
        'berkas_gambar',
        'created_by',
    ];
    // Asesor
    public $appends = ['file_gambar', 'file_video'];

    public function getFileGambarAttribute()
    {
        return url('web/images/' . $this->berkas_gambar);
    }

    public function getFileVideoAttribute()
    {
        return url('web/images/' . $this->berkas_video);
    }


    //----
}
