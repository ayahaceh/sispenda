<?php

namespace App\Models\Pengumuman;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\UserModel;
use App\Models\PengumumanReadModel;

class PengumumanModel extends Model
{
    protected $table = 'pengumuman';
    public $timestamps  = True;
    use SoftDeletes;

    protected $fillable = [
        'tgl',
        'judul',
        'isi',
        'berkas',
    ];


    public function read()
    {
        return $this->hasMany(PengumumanReadModel::class, 'id_pengumuman');
    }
    public function createdby()
    {
        return $this->belongsTo(UserModel::class, 'created_by');
    }
    public function updatedby()
    {
        return $this->belongsTo(UserModel::class, 'updated_by');
    }
    public function deletedby()
    {
        return $this->belongsTo(UserModel::class, 'deleted_by');
    }

    //----
}
