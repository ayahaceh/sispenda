<?php

namespace App\Models\Referensi;

use Illuminate\Database\Eloquent\Model;
use App\Models\UserModel;

class StatusUserModel extends Model
{
    protected $table = 'status_user';

    protected $fillable = [
        'nama_status',
    ];


    public function joinUser()
    {
        return $this->hasMany(UserModel::class, 'kode_status_user', 'status_user');
    }



    //----
}
