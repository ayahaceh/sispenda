<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class prov_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus data lama 
        DB::table('prov')->truncate();
        DB::table('prov')->insert([
            ['kode_prov' => '11', 'nama_prov' => 'Aceh',],
            ['kode_prov' => '12', 'nama_prov' => 'Sumatera Utara',],
            ['kode_prov' => '13', 'nama_prov' => 'Sumatera Barat',],
            ['kode_prov' => '14', 'nama_prov' => 'Riau',],
            ['kode_prov' => '15', 'nama_prov' => 'Jambi',],
            ['kode_prov' => '16', 'nama_prov' => 'Sumatera Selatan',],
            ['kode_prov' => '17', 'nama_prov' => 'Bengkulu',],
            ['kode_prov' => '18', 'nama_prov' => 'Lampung',],
            ['kode_prov' => '19', 'nama_prov' => 'Kep. Bangka Belitung',],
            ['kode_prov' => '21', 'nama_prov' => 'Kep. Riau',],
            ['kode_prov' => '31', 'nama_prov' => 'Dki Jakarta',],
            ['kode_prov' => '32', 'nama_prov' => 'Jawa Barat',],
            ['kode_prov' => '33', 'nama_prov' => 'Jawa Tengah',],
            ['kode_prov' => '34', 'nama_prov' => 'Di Yogyakarta',],
            ['kode_prov' => '35', 'nama_prov' => 'Jawa Timur',],
            ['kode_prov' => '36', 'nama_prov' => 'Banten',],
            ['kode_prov' => '51', 'nama_prov' => 'Bali',],
            ['kode_prov' => '52', 'nama_prov' => 'Nusa Tenggara Barat',],
            ['kode_prov' => '53', 'nama_prov' => 'Nusa Tenggara Timur',],
            ['kode_prov' => '61', 'nama_prov' => 'Kalimantan Barat',],
            ['kode_prov' => '62', 'nama_prov' => 'Kalimantan Tengah',],
            ['kode_prov' => '63', 'nama_prov' => 'Kalimantan Selatan',],
            ['kode_prov' => '64', 'nama_prov' => 'Kalimantan Timur',],
            ['kode_prov' => '65', 'nama_prov' => 'Kalimantan Utara',],
            ['kode_prov' => '71', 'nama_prov' => 'Sulawesi Utara',],
            ['kode_prov' => '72', 'nama_prov' => 'Sulawesi Tengah',],
            ['kode_prov' => '73', 'nama_prov' => 'Sulawesi Selatan',],
            ['kode_prov' => '74', 'nama_prov' => 'Sulawesi Tenggara',],
            ['kode_prov' => '75', 'nama_prov' => 'Gorontalo',],
            ['kode_prov' => '76', 'nama_prov' => 'Sulawesi Barat',],
            ['kode_prov' => '81', 'nama_prov' => 'Maluku',],
            ['kode_prov' => '82', 'nama_prov' => 'Maluku Utara',],
            ['kode_prov' => '92', 'nama_prov' => 'Papua Barat',],
            ['kode_prov' => '91', 'nama_prov' => 'Papua',],


        ]);
    }
}
