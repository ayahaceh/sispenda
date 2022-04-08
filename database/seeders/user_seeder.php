<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class user_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password_in = bcrypt('rahasia');
        $password_eks = bcrypt('garuda');

        DB::table('users')->truncate();
        DB::table('users')->insert([
            [
                'id'        => 1,
                'email'     => 'superadmin@ayahaceh.com',
                'username'  => 'superadmin',
                'password'  => $password_in, // password
                'nik'       => '1112223334445556',
                'kk'        => '345',
                'nama'      => 'Nama Superadmin',
                'foto'      => 'default.jpg',
                'user_group'    => 1,
                'kode_ppat'     => NULL,
                'hp'            => '08111657788',
                'wa'            => '08111657788',
                'tg'            => '547288630',
                'status_user'   => 1,
                'terakhir'      => now(),
                'token'         => Str::random(10),
                'deskripsi'     => 'Akun Superadmin',
                'email_verified_at'     => now(),
            ], [
                'id'        => 2,
                'email'     => 'admin@ayahaceh.com',
                'username'  => 'admin',
                'password'  => $password_in, // password
                'nik'       => '1122233344455566',
                'kk'        => '345',
                'nama'      => 'Nama Admin',
                'foto'      => 'default.jpg',
                'user_group'    => 2,
                'kode_ppat'     => NULL,
                'hp'            => '08111657788',
                'wa'            => '08111657788',
                'tg'            => '547288630',
                'status_user'   => 1,
                'terakhir'      => now(),
                'token'         => Str::random(10),
                'deskripsi'     => 'Akun Admin',
                'email_verified_at'     => now(),
            ], [
                'id'        => 3,
                'email'     => 'operator@ayahaceh.com',
                'username'  => 'operator',
                'password'  => $password_in, // password
                'nik'       => '1222333444555666',
                'kk'        => '345',
                'nama'      => 'Nama operator',
                'foto'      => 'default.jpg',
                'user_group'    => 3,
                'kode_ppat'     => NULL,
                'hp'            => '08111657788',
                'wa'            => '08111657788',
                'tg'            => '547288630',
                'status_user'   => 1,
                'terakhir'      => now(),
                'token'         => Str::random(10),
                'deskripsi'     => 'Akun operator',
                'email_verified_at'     => now(),
            ], [
                'id'        => 4,
                'email'     => 'kabid@ayahaceh.com',
                'username'  => 'kabid',
                'password'  => $password_in, // password
                'nik'       => '2223334445556668',
                'kk'        => '345',
                'nama'      => 'Nama kabid',
                'foto'      => 'default.jpg',
                'user_group'    => 4,
                'kode_ppat'     => NULL,
                'hp'            => '08111657788',
                'wa'            => '08111657788',
                'tg'            => '547288630',
                'status_user'   => 1,
                'terakhir'      => now(),
                'token'         => Str::random(10),
                'deskripsi'     => 'Akun kabid',
                'email_verified_at'     => now(),
            ], [
                'id'        => 5,
                'email'     => 'kaban@ayahaceh.com',
                'username'  => 'kaban',
                'password'  => $password_in, // password
                'nik'       => '2233344455566677',
                'kk'        => '345',
                'nama'      => 'Nama kaban',
                'foto'      => 'default.jpg',
                'user_group'    => 5,
                'kode_ppat'     => NULL,
                'hp'            => '08111657788',
                'wa'            => '08111657788',
                'tg'            => '547288630',
                'status_user'   => 1,
                'terakhir'      => now(),
                'token'         => Str::random(10),
                'deskripsi'     => 'Akun kaban',
                'email_verified_at'     => now(),
            ], [
                'id'        => 6,
                'email'     => 'ppat@ayahaceh.com',
                'username'  => 'ppat',
                'password'  => $password_eks, // password
                'nik'       => '2333444555666777',
                'kk'        => '345',
                'nama'      => 'Nama ppat',
                'foto'      => 'default.jpg',
                'user_group'    => 6,
                'kode_ppat'     => 1001,
                'hp'            => '08111657788',
                'wa'            => '08111657788',
                'tg'            => '547288630',
                'status_user'   => 1,
                'terakhir'      => now(),
                'token'         => Str::random(10),
                'deskripsi'     => 'Akun ppat',
                'email_verified_at'     => now(),
            ], [
                'id'        => 7,
                'email'     => 'wajibpajak@ayahaceh.com',
                'username'  => 'wajibpajak',
                'password'  => $password_eks, // password
                'nik'       => '3334445556667778',
                'kk'        => '345',
                'nama'      => 'Nama wajib pajak',
                'foto'      => 'default.jpg',
                'user_group'    => 7,
                'kode_ppat'     => NULL,
                'hp'            => '08111657788',
                'wa'            => '08111657788',
                'tg'            => '547288630',
                'status_user'   => 1,
                'terakhir'      => now(),
                'token'         => Str::random(10),
                'deskripsi'     => 'Akun wajib pajak',
                'email_verified_at'     => now(),
            ], [
                'id'        => 8,
                'email'     => 'akunbpn@ayahaceh.com',
                'username'  => 'akunbpn',
                'password'  => $password_eks, // password
                'nik'       => '3334445556667779',
                'kk'        => '345',
                'nama'      => 'Nama akunbpn',
                'foto'      => 'default.jpg',
                'user_group'    => 8,
                'kode_ppat'     => NULL,
                'hp'            => '08111657788',
                'wa'            => '08111657788',
                'tg'            => '547288630',
                'status_user'   => 1,
                'terakhir'      => now(),
                'token'         => Str::random(10),
                'deskripsi'     => 'Akun akunbpn',
                'email_verified_at'     => now(),
            ], [
                'id'        => 9,
                'email'     => 'akunpublik@ayahaceh.com',
                'username'  => 'akunpublik',
                'password'  => $password_eks, // password
                'nik'       => '3344455566677799',
                'kk'        => '345',
                'nama'      => 'Nama akunpublik',
                'foto'      => 'default.jpg',
                'user_group'    => 9,
                'kode_ppat'     => NULL,
                'hp'            => '08111657788',
                'wa'            => '08111657788',
                'tg'            => '547288630',
                'status_user'   => 1,
                'terakhir'      => now(),
                'token'         => Str::random(10),
                'deskripsi'     => 'Akun akunpublik',
                'email_verified_at'     => now(),
            ], [
                'id'        => 10,
                'email'     => 'ppat_02@ayahaceh.com',
                'username'  => 'ppat_02',
                'password'  => $password_eks, // password
                'nik'       => '43334445556667774',
                'kk'        => '345',
                'nama'      => 'Nama ppat',
                'foto'      => 'default.jpg',
                'user_group'    => 6,
                'kode_ppat'     => 1002,
                'hp'            => '08111657788',
                'wa'            => '08111657788',
                'tg'            => '547288630',
                'status_user'   => 1,
                'terakhir'      => now(),
                'token'         => Str::random(10),
                'deskripsi'     => 'Akun ppat 02',
                'email_verified_at'     => now(),
            ],

        ]);
    }
}
