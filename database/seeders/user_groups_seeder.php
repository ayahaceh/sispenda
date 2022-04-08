<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class user_groups_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus data lama 
        DB::table('user_groups')->truncate();
        // Insert data awal untuk referensi Status record
        DB::table('user_groups')->insert([
            [
                'id' => 1,
                'nama_group' => 'Super Admin',
                'deskripsi_group' => 'Super Admin Aplikasi BPHTB',
            ], [
                'id' => 2,
                'nama_group' => 'Admin BPHTB',
                'deskripsi_group' => 'Akun untuk Admin Aplikasi BPHTB',
            ], [
                'id' => 3,
                'nama_group' => 'Operator',
                'deskripsi_group' => 'Akun untuk Operator Aplikasi BPHTB',
            ], [
                'id' => 4,
                'nama_group' => 'Kabid Pendapatan',
                'deskripsi_group' => 'Akun untuk Kabid Pendapatan',
            ], [
                'id' => 5,
                'nama_group' => 'Kepala BPKK',
                'deskripsi_group' => 'Akun untuk Kepala BPKK',
            ], [
                'id' => 6,
                'nama_group' => 'PPAT',
                'deskripsi_group' => 'Akun untuk PPAT Kecamatan',
            ], [
                'id' => 7,
                'nama_group' => 'Wajib Pajak',
                'deskripsi_group' => 'Akun untuk Wajib Pajak',
            ], [
                'id' => 8,
                'nama_group' => 'BPN',
                'deskripsi_group' => 'Akun untuk BPN dan Propinsi',
            ], [
                'id' => 9,
                'nama_group' => 'Lembaga Publik',
                'deskripsi_group' => 'Akun untuk Lembaga Publik',
            ],

        ]);



        //----------------
    }
}
