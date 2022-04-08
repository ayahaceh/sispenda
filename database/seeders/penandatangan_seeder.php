<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class penandatangan_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('penandatangan')->truncate();
        DB::table('penandatangan')->insert([
            [
                'kode_penandatangan' => 'diterima',
                'nip_penandatangan' => '121212121212021010',
                'nama_penandatangan' => 'Nama Bendahara',
                'created_by'        => 'alidata',
                'created_at'        => now(),
            ], [
                'kode_penandatangan' => 'diverifikasi',
                'nip_penandatangan' => '197708282007012004',
                'nama_penandatangan' => 'Ermawati, S.Ip',
                'created_by'        => 'alidata',
                'created_at'        => now(),
            ],

        ]);
    }
}
