<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class profil_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profil')->truncate();
        // Insert data awal untuk referensi Status record
        DB::table('profil')->insert([
            [
                'nik'       => '1112223334445556',
                'kk'        => '1112223334445557',
                'nama'      => 'razali',
                'jk'        => 'Laki-laki',
                'alamat'    => 'Jl. Permata Hati No. 12 Komp. Permata Hari',
                'kode_prov' => '11',
                'kode_kab'  => '11.10',
                'kode_kec'  => '11.10.010',
                'kode_desa' => '11.10.010.002',
                'rtrw'      => 'RT 07 / RW 03',
                'kode_pos'  => '24300',
                'hp'        => '08111657788',
                'wa'        => '08111657788',
                'tg'        => '547288630',
                'email'             => 'razali@alidata.com',
                'berkas_foto'       => 'default.jpg',
                'berkas_ktp'        => 'default.pdf',
                'berkas_kk'         => 'default.pdf',
                // 'jenis_profil_id'   => 1,
                'status_profil'     => 'Valid',
                'kode_ppat'         => '1001',
                'created_by'        => 'alidata',
                'created_at'        => now(),
            ], [
                'nik'       => '1122233344455566',
                'kk'        => '1122233344455568',
                'nama'      => 'ronypermadi',
                'jk'        => 'Laki-laki',
                'alamat'    => 'Jl. Ramayana No. 12 Komp. Permata Hari',
                'kode_prov' => '11',
                'kode_kab'  => '11.10',
                'kode_kec'  => '11.10.010',
                'kode_desa' => '11.10.010.002',
                'rtrw'      => 'RT 07 / RW 03',
                'kode_pos'  => '24300',
                'hp'        => '08111657788',
                'wa'        => '08111657788',
                'tg'        => '547288630',
                'email'             => 'ronypermadi@alidata.com',
                'berkas_foto'       => 'default.jpg',
                'berkas_ktp'        => 'default.pdf',
                'berkas_kk'         => 'default.pdf',
                // 'jenis_profil_id'   => 1,
                'status_profil'     => 'Valid',
                'kode_ppat'         => '1002',
                'created_by'        => 'alidata',
                'created_at'        => now(),
            ], [
                'nik'       => '1222333444555666',
                'kk'        => '1112223334445558',
                'nama'      => 'dian_pishesa',
                'jk'        => 'Perempuan',
                'alamat'    => 'Jl. Gunung Kidul No. 12 Komp. Permata Hari',
                'kode_prov' => '11',
                'kode_kab'  => '11.10',
                'kode_kec'  => '11.10.010',
                'kode_desa' => '11.10.010.002',
                'rtrw'      => 'RT 07 / RW 03',
                'kode_pos'  => '24300',
                'hp'        => '08111657788',
                'wa'        => '08111657788',
                'tg'        => '547288630',
                'email'             => 'dian_pishesa@alidata.com',
                'berkas_foto'       => 'default.jpg',
                'berkas_ktp'        => 'default.pdf',
                'berkas_kk'         => 'default.pdf',
                // 'jenis_profil_id'   => 1,
                'status_profil'     => 'Valid',
                'kode_ppat'         => '1001',
                'created_by'        => 'alidata',
                'created_at'        => now(),
            ], [
                'nik'       => '2233344455566677',
                'kk'        => '2233344455566671',
                'nama'      => 'reyfanrazali',
                'jk'        => 'Laki-laki',
                'alamat'    => 'Jl. Anggrek Bulan No. 12 Komp. Permata Hari',
                'kode_prov' => '11',
                'kode_kab'  => '11.10',
                'kode_kec'  => '11.10.010',
                'kode_desa' => '11.10.010.002',
                'rtrw'      => 'RT 07 / RW 03',
                'kode_pos'  => '24300',
                'hp'        => '08111657788',
                'wa'        => '08111657788',
                'tg'        => '547288630',
                'email'             => 'reyfanrazali@alidata.com',
                'berkas_foto'       => 'default.jpg',
                'berkas_ktp'        => 'default.pdf',
                'berkas_kk'         => 'default.pdf',
                // 'jenis_profil_id'   => 1,
                'status_profil'     => 'Valid',
                'kode_ppat'         => '1002',
                'created_by'        => 'alidata',
                'created_at'        => now(),
            ], [
                'nik'       => '2333444555666777',
                'kk'        => '2333444555666772',
                'nama'      => 'reysazalira',
                'jk'        => 'Perempuan',
                'alamat'    => 'Jl. Permata Hati No. 12 Komp. Permata Hari',
                'kode_prov' => '11',
                'kode_kab'  => '11.10',
                'kode_kec'  => '11.10.010',
                'kode_desa' => '11.10.010.002',
                'rtrw'      => 'RT 07 / RW 03',
                'kode_pos'  => '24300',
                'hp'        => '08111657788',
                'wa'        => '08111657788',
                'tg'        => '547288630',
                'email'             => 'reysazalira@alidata.com',
                'berkas_foto'       => 'default.jpg',
                'berkas_ktp'        => 'default.pdf',
                'berkas_kk'         => 'default.pdf',
                // 'jenis_profil_id'   => 1,
                'status_profil'     => 'Valid',
                'kode_ppat'         => '1002',
                'created_by'        => 'alidata',
                'created_at'        => now(),
            ], [
                'nik'       => '3344455566677799',
                'kk'        => '3344455566677795',
                'nama'      => 'akunpublik',
                'jk'        => 'Laki-laki',
                'alamat'    => 'Jl. Buah Batu No. 12 Komp. Permata Hari',
                'kode_prov' => '11',
                'kode_kab'  => '11.10',
                'kode_kec'  => '11.10.010',
                'kode_desa' => '11.10.010.002',
                'rtrw'      => 'RT 07 / RW 03',
                'kode_pos'  => '24300',
                'hp'        => '08111657788',
                'wa'        => '08111657788',
                'tg'        => '547288630',
                'email'             => 'akunpublik@alidata.com',
                'berkas_foto'       => 'default.jpg',
                'berkas_ktp'        => 'default.pdf',
                'berkas_kk'         => 'default.pdf',
                // 'jenis_profil_id'   => 1,
                'status_profil'     => 'Valid',
                'kode_ppat'         => '1001',
                'created_by'        => 'alidata',
                'created_at'        => now(),
            ], [
                'nik'       => '3334445556667779',
                'kk'        => '3334445556667779',
                'nama'      => 'akunbpn',
                'jk'        => 'Perempuan',
                'alamat'    => 'Jl. Merduati No. 12 Komp. Permata Hari',
                'kode_prov' => '11',
                'kode_kab'  => '11.10',
                'kode_kec'  => '11.10.010',
                'kode_desa' => '11.10.010.002',
                'rtrw'      => 'RT 07 / RW 03',
                'kode_pos'  => '24300',
                'hp'        => '08111657788',
                'wa'        => '08111657788',
                'tg'        => '547288630',
                'email'             => 'akunbpn@alidata.com',
                'berkas_foto'       => 'default.jpg',
                'berkas_ktp'        => 'default.pdf',
                'berkas_kk'         => 'default.pdf',
                // 'jenis_profil_id'   => 1,
                'status_profil'     => 'Valid',
                'kode_ppat'         => '1001',
                'created_by'        => 'alidata',
                'created_at'        => now(),
            ], [
                'nik'       => '2223334445556667',
                'kk'        => '2223334445556667',
                'nama'      => 'wajib_pajak',
                'jk'        => 'Laki-laki',
                'alamat'    => 'Jl. Wajip Pajak No. 12 Komp. Permata Hari',
                'kode_prov' => '11',
                'kode_kab'  => '11.10',
                'kode_kec'  => '11.10.010',
                'kode_desa' => '11.10.010.002',
                'rtrw'      => 'RT 07 / RW 03',
                'kode_pos'  => '24300',
                'hp'        => '08111657788',
                'wa'        => '08111657788',
                'tg'        => '547288630',
                'email'             => 'wajib_pajak@alidata.com',
                'berkas_foto'       => 'default.jpg',
                'berkas_ktp'        => 'default.pdf',
                'berkas_kk'         => 'default.pdf',
                // 'jenis_profil_id'   => 1,
                'status_profil'     => 'Valid',
                'kode_ppat'         => '1002',
                'created_by'        => 'alidata',
                'created_at'        => now(),
            ],
        ]);
    }
}
