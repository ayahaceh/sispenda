<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class urut_stpd_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus data lama 
        DB::table('urut_stpd')->truncate();
        DB::table('urut_stpd')->insert([
            ['peralihan_nop_id' => 100, 'kode_desa' => '11.10.16.2002', 'nomor_urut' => 25,],
            ['peralihan_nop_id' => 101, 'kode_desa' => '11.10.16.2002', 'nomor_urut' => 23,],
            ['peralihan_nop_id' => 102, 'kode_desa' => '11.10.04.2004', 'nomor_urut' => 15,],
            ['peralihan_nop_id' => 103, 'kode_desa' => '11.10.04.2007', 'nomor_urut' => 17,],
        ]);
    }
}
