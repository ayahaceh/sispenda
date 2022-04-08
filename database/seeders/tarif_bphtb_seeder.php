<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tarif_bphtb_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus data lama 
        DB::table('tarif_bphtb')->truncate();
        DB::table('tarif_bphtb')->insert([
            ['kode_tarif_bphtb' => '01', 'persen_tarif_bphtb' => 0.05, 'ket_tarif_bphtb' => 'Tarif Berlaku 5%',],
        ]);
    }
}
