<?php

namespace App\Models\Pengumuman;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\UserModel;
use App\Models\Pengumuman\PengumumanModel;

class PengumumanReadModel extends Model
{
    protected $table = 'pengumuman_read';
    public $timestamps  = True;
    // use SoftDeletes;

    protected $fillable = [
        'id_pengumuman',
        'id_user',
    ];


    public function pengumuman()
    {
        return $this->belongsTo(PengumumanModel::class, 'id_pengumuman');
    }
    public function nama()
    {
        return $this->belongsTo(UserModel::class, 'id_user');
    }
    //----
}
