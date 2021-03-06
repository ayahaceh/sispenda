<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class profil_dua_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profil_temp')->truncate();
        // Insert data awal untuk referensi Status record
        DB::table('profil_temp')->insert([
            [
                'nik'       => '7772223334445556',
                'kk'        => '7772223334445557',
                'nama'      => 'razali_dua',
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
                'email'             => 'razali_dua@alidata.com',
                'berkas_foto'       => 'default.jpg',
                'berkas_ktp'        => 'default.pdf',
                'berkas_kk'         => 'default.pdf',
                // 'jenis_profil_id'   => 1,
                'status_profil'     => 'Belum Diverifikasi',
                'kode_ppat'         => '1001',
                'created_by'        => 'alidata',
                'created_at'        => now(),
            ], [
                'nik'       => '7782233344455566',
                'kk'        => '7782233344455568',
                'nama'      => 'ronypermadi_dua',
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
                'email'             => 'ronypermadi_dua@alidata.com',
                'berkas_foto'       => 'default.jpg',
                'berkas_ktp'        => 'default.pdf',
                'berkas_kk'         => 'default.pdf',
                // 'jenis_profil_id'   => 1,
                'status_profil'     => 'Belum Diverifikasi',
                'kode_ppat'         => '1002',
                'created_by'        => 'alidata',
                'created_at'        => now(),
            ], [
                'nik'       => '7778333444555666',
                'kk'        => '1177783334445558',
                'nama'      => 'dian_pishesa_dua',
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
                'email'             => 'dian_pishesa_dua@alidata.com',
                'berkas_foto'       => 'default.jpg',
                'berkas_ktp'        => 'default.pdf',
                'berkas_kk'         => 'default.pdf',
                // 'jenis_profil_id'   => 1,
                'status_profil'     => 'Belum Diverifikasi',
                'kode_ppat'         => '1001',
                'created_by'        => 'alidata',
                'created_at'        => now(),
            ], [
                'nik'       => '8877344455566677',
                'kk'        => '8877344455566671',
                'nama'      => 'reyfanrazali_dua',
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
                'email'             => 'reyfanrazali_dua@alidata.com',
                'berkas_foto'       => 'default.jpg',
                'berkas_ktp'        => 'default.pdf',
                'berkas_kk'         => 'default.pdf',
                // 'jenis_profil_id'   => 1,
                'status_profil'     => 'Belum Diverifikasi',
                'kode_ppat'         => '1002',
                'created_by'        => 'alidata',
                'created_at'        => now(),
            ], [
                'nik'       => '8777444555666777',
                'kk'        => '8777444555666772',
                'nama'      => 'reysazalira_dua',
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
                'email'             => 'reysazalira_dua@alidata.com',
                'berkas_foto'       => 'default.jpg',
                'berkas_ktp'        => 'default.pdf',
                'berkas_kk'         => 'default.pdf',
                // 'jenis_profil_id'   => 1,
                'status_profil'     => 'Belum Diverifikasi',
                'kode_ppat'         => '1002',
                'created_by'        => 'alidata',
                'created_at'        => now(),
            ], [
                'nik'       => '8899955566677799',
                'kk'        => '8899955566677795',
                'nama'      => 'akunpublik_dua',
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
                'email'             => 'akunpublik_dua@alidata.com',
                'berkas_foto'       => 'default.jpg',
                'berkas_ktp'        => 'default.pdf',
                'berkas_kk'         => 'default.pdf',
                // 'jenis_profil_id'   => 1,
                'status_profil'     => 'Belum Diverifikasi',
                'kode_ppat'         => '1001',
                'created_by'        => 'alidata',
                'created_at'        => now(),
            ], [
                'nik'       => '8887785556667779',
                'kk'        => '8887785556667779',
                'nama'      => 'ridwan_dua',
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
                'email'             => 'ridwan_dua@alidata.com',
                'berkas_foto'       => 'default.jpg',
                'berkas_ktp'        => 'default.pdf',
                'berkas_kk'         => 'default.pdf',
                // 'jenis_profil_id'   => 1,
                'status_profil'     => 'Belum Diverifikasi',
                'kode_ppat'         => '1001',
                'created_by'        => 'alidata',
                'created_at'        => now(),
            ], [
                'nik'       => '7779994445556667',
                'kk'        => '7779994445556667',
                'nama'      => 'budi_anduk_dua',
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
                'email'             => 'budi_anduk_dua@alidata.com',
                'berkas_foto'       => 'default.jpg',
                'berkas_ktp'        => 'default.pdf',
                'berkas_kk'         => 'default.pdf',
                // 'jenis_profil_id'   => 1,
                'status_profil'     => 'Belum Diverifikasi',
                'kode_ppat'         => '1002',
                'created_by'        => 'alidata',
                'created_at'        => now(),
            ],
        ]);
    }
}
