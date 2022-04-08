<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class npop_tkp_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('npop_tkp')->truncate();
        // Insert data awal untuk referensi Status record
        DB::table('npop_tkp')->insert([
            [
                'kode_npop_tkp'     => 'T-01',
                'tarif_npop_tkp'    => 60000000,
                'ket_npop_tkp'      => 'Permendagri Nomor ... Tahun ... berkalu untuk umum',
                'default'           => '1',
                'created_by'        => 'alidata',
                'created_at'        => now(),
            ], [
                'kode_npop_tkp'     => 'T-02',
                'tarif_npop_tkp'    => 0,
                'ket_npop_tkp'      => 'Permendagri Nomor ... Tahun ... berlaku khusus',
                'default'           => '0',
                'created_by'        => 'alidata',
                'created_at'        => now(),
            ],

        ]);
    }
}
