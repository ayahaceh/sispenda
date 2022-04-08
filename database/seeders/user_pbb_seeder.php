<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class user_pbb_seeder extends Seeder
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

        // DB::table('users')->truncate();
        DB::table('users')->insert([
            [
                'id'        => 11,
                'email'     => 'superadmin_pbb@ayahaceh.com',
                'username'  => 'superadmin_pbb',
                'password'  => $password_in, // password
                'nik'       => '1112220004445556',
                'kk'        => '345',
                'nama'      => 'Nama Superadmin_pbb',
                'foto'      => 'default.jpg',
                'user_group'    => 11,
                'kode_ppat'     => NULL,
                'hp'            => '08111657788',
                'wa'            => '08111657788',
                'tg'            => '547288630',
                'status_user'   => 1,
                'terakhir'      => now(),
                'token'         => Str::random(10),
                'deskripsi'     => 'Akun Superadmin_pbb',
                'email_verified_at'     => now(),
            ], [
                'id'        => 12,
                'email'     => 'admin_pbb@ayahaceh.com',
                'username'  => 'admin_pbb',
                'password'  => $password_in, // password
                'nik'       => '1122230004455566',
                'kk'        => '345',
                'nama'      => 'Nama Admin_pbb',
                'foto'      => 'default.jpg',
                'user_group'    => 12,
                'kode_ppat'     => NULL,
                'hp'            => '08111657788',
                'wa'            => '08111657788',
                'tg'            => '547288630',
                'status_user'   => 1,
                'terakhir'      => now(),
                'token'         => Str::random(10),
                'deskripsi'     => 'Akun Admin_pbb',
                'email_verified_at'     => now(),
            ], [
                'id'        => 13,
                'email'     => 'operator_pbb@ayahaceh.com',
                'username'  => 'operator_pbb',
                'password'  => $password_in, // password
                'nik'       => '1222330004555666',
                'kk'        => '345',
                'nama'      => 'Nama operator_pbb',
                'foto'      => 'default.jpg',
                'user_group'    => 13,
                'kode_ppat'     => NULL,
                'hp'            => '08111657788',
                'wa'            => '08111657788',
                'tg'            => '547288630',
                'status_user'   => 1,
                'terakhir'      => now(),
                'token'         => Str::random(10),
                'deskripsi'     => 'Akun operator_pbb',
                'email_verified_at'     => now(),
            ], [
                'id'        => 14,
                'email'     => 'kabid_pbb@ayahaceh.com',
                'username'  => 'kabid_pbb',
                'password'  => $password_in, // password
                'nik'       => '2223330005556668',
                'kk'        => '345',
                'nama'      => 'Nama kabid',
                'foto'      => 'default.jpg',
                'user_group'    => 14,
                'kode_ppat'     => NULL,
                'hp'            => '08111657788',
                'wa'            => '08111657788',
                'tg'            => '547288630',
                'status_user'   => 1,
                'terakhir'      => now(),
                'token'         => Str::random(10),
                'deskripsi'     => 'Akun kabid_pbb',
                'email_verified_at'     => now(),
            ], [
                'id'        => 15,
                'email'     => 'kaban_pbb@ayahaceh.com',
                'username'  => 'kaban_pbb',
                'password'  => $password_in, // password
                'nik'       => '2233340005566677',
                'kk'        => '345',
                'nama'      => 'Nama kaban',
                'foto'      => 'default.jpg',
                'user_group'    => 15,
                'kode_ppat'     => NULL,
                'hp'            => '08111657788',
                'wa'            => '08111657788',
                'tg'            => '547288630',
                'status_user'   => 1,
                'terakhir'      => now(),
                'token'         => Str::random(10),
                'deskripsi'     => 'Akun kaban_pbb',
                'email_verified_at'     => now(),
            ], [
                'id'        => 16,
                'email'     => 'ppat_pbb@ayahaceh.com',
                'username'  => 'ppat_pbb',
                'password'  => $password_eks, // password
                'nik'       => '2333440005666777',
                'kk'        => '345',
                'nama'      => 'Nama ppat',
                'foto'      => 'default.jpg',
                'user_group'    => 16,
                'kode_ppat'     => 1001,
                'hp'            => '08111657788',
                'wa'            => '08111657788',
                'tg'            => '547288630',
                'status_user'   => 1,
                'terakhir'      => now(),
                'token'         => Str::random(10),
                'deskripsi'     => 'Akun ppat_pbb',
                'email_verified_at'     => now(),
            ], [
                'id'        => 17,
                'email'     => 'wajibpajak_pbb@ayahaceh.com',
                'username'  => 'wajibpajak_pbb',
                'password'  => $password_eks, // password
                'nik'       => '3334440006667778',
                'kk'        => '345',
                'nama'      => 'Nama wajib pajak_pbb',
                'foto'      => 'default.jpg',
                'user_group'    => 17,
                'kode_ppat'     => NULL,
                'hp'            => '08111657788',
                'wa'            => '08111657788',
                'tg'            => '547288630',
                'status_user'   => 1,
                'terakhir'      => now(),
                'token'         => Str::random(10),
                'deskripsi'     => 'Akun wajib pajak_pbb',
                'email_verified_at'     => now(),
            ], [
                'id'        => 18,
                'email'     => 'akunbpn_pbb@ayahaceh.com',
                'username'  => 'akunbpn_pbb',
                'password'  => $password_eks, // password
                'nik'       => '3334440006667779',
                'kk'        => '345',
                'nama'      => 'Nama akunbpn',
                'foto'      => 'default.jpg',
                'user_group'    => 18,
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
                'id'        => 19,
                'email'     => 'akunpublik_pbb@ayahaceh.com',
                'username'  => 'akunpublik_pbb',
                'password'  => $password_eks, // password
                'nik'       => '3344450006677799',
                'kk'        => '345',
                'nama'      => 'Nama akunpublik_pbb',
                'foto'      => 'default.jpg',
                'user_group'    => 19,
                'kode_ppat'     => NULL,
                'hp'            => '08111657788',
                'wa'            => '08111657788',
                'tg'            => '547288630',
                'status_user'   => 1,
                'terakhir'      => now(),
                'token'         => Str::random(10),
                'deskripsi'     => 'Akun akunpublik_pbb',
                'email_verified_at'     => now(),
            ], [
                'id'        => 20,
                'email'     => 'ppat_02_pbb@ayahaceh.com',
                'username'  => 'ppat_02_pbb',
                'password'  => $password_eks, // password
                'nik'       => '43334400056667774',
                'kk'        => '345',
                'nama'      => 'Nama ppat',
                'foto'      => 'default.jpg',
                'user_group'    => 16,
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
