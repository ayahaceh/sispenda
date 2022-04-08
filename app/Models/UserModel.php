<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\UserGroup\UserGroupModel;
use App\Models\Ref\RefSkpdModel;
use App\Models\Referensi\StatusUserModel;

class UserModel extends Model
{
    protected $table = 'users';
    use SoftDeletes;
    public $timestamps  = True;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'email',
        'username',
        'password',
        'nik',
        'kk',
        'nama',
        'foto',
        'user_group',
        'kode_ppat',
        'hp',
        'wa',
        'tg',
        'status_user',
        'terakhir',
        'token',
        'deskripsi',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // Asesor
    public $appends = ['file_foto'];

    public function getFileFotoAttribute()
    {
        return url('upload/users/comp/' . $this->foto);
    }

    public function joinStatusUser()
    {
        return $this->belongsTo(StatusUserModel::class, 'status_user');
    }
    public function usergroup()
    {
        return $this->belongsTo(UserGroupModel::class, 'user_group');
    }

    public function satker()
    {
        return $this->belongsTo(SatkersModel::class, 'id_satker');
    }
    public function skpd()
    {
        return $this->belongsTo(RefSkpdModel::class, 'id_skpd');
    }

    public function pengujiSkpd()
    {
        return $this->hasMany(RefSkpdModel::class, 'id_penguji');
    }

    public function data_user()
    {
        // id_user = Auth::id();
        // user_aktif = 
        // return $this->belongsTo(UserGroupModel::class, 'user_group');
    }
}
