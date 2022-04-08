<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class setting_default_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus data lama 
        DB::table('setting_default')->truncate();
        DB::table('setting_default')->insert([
            [
                'nama_setting_default'      => 'default_provinsi',
                'kode_setting_default'      => '11',
                'ket_setting_default'       => 'Provinsi Default',
            ], [
                'nama_setting_default'      => 'default_kabupaten',
                'kode_setting_default'      => '11.10',
                'ket_setting_default'       => 'Kabupaten Default',
            ], [
                'nama_setting_default'      => 'default_kecamatan',
                'kode_setting_default'      => '11.10.04',
                'ket_setting_default'       => 'Kecamatan Default',
            ], [
                'nama_setting_default'      => 'default_desa',
                'kode_setting_default'      => '11.10.04.2003',
                'ket_setting_default'       => 'Desa Default',
            ], [
                'nama_setting_default'      => 'default_rekening',
                'kode_setting_default'      => 'R-01',
                'ket_setting_default'       => 'Rekening Default',
            ], [
                'nama_setting_default'      => 'default_tarif_npoptkp',
                'kode_setting_default'      => 'T-01',
                'ket_setting_default'       => 'Tarif NPOPTKP Default',
            ],
        ]);
    }
}
