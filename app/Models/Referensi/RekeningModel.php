<?php

namespace App\Models\Referensi;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class RekeningModel extends Model
{
    protected $table    = 'rekening';
    public $timestamps  = false;
    use SoftDeletes;

    protected $fillable = [
        'no_rekening',
        'nama_rekening',
        'status_rekening',
        'gambar_qris',
        'gambar_rekening',
        'gambar_logo_bank',
    ];
    // Asesor
    public $appends = ['file_qris', 'file_rekening', 'file_logo_bank'];

    public function getFileQrisAttribute()
    {
        return url('upload/rekening/' . $this->gambar_qris);
    }
    public function getFileRekeningAttribute()
    {
        return url('upload/rekening/' . $this->gambar_rekening);
    }
    public function getFileLogoBankAttribute()
    {
        return url('upload/rekening/' . $this->gambar_logo_bank);
    }

    //----
}
