<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class status_user_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus data lama 
        DB::table('status_user')->truncate();
        DB::table('status_user')->insert([
            ['nama_status' => 'Aktif',],
            ['nama_status' => 'Belum Profil',],
            ['nama_status' => 'Belum Aktif',],
            ['nama_status' => 'Di Blokir',],
        ]);
    }
}
