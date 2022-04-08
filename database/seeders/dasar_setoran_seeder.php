<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class dasar_setoran_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus data lama 
        DB::table('dasar_setoran')->truncate();
        DB::table('dasar_setoran')->insert([
            ['nama_dasar_setoran' => 'Penghitungan WP',],
            ['nama_dasar_setoran' => 'STPD BPHTB',],
            ['nama_dasar_setoran' => 'Pengurangan Dihitung Sendiri',],
            ['nama_dasar_setoran' => 'Lainnya',],
        ]);
    }
}
