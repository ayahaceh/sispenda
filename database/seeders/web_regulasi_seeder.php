<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class web_regulasi_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus data lama 
        DB::table('web_regulasi')->truncate();
        DB::table('web_regulasi')->insert([
            ['nama_regulasi' => 'Permendagri', 'berkas_regulasi' => 'permendagri.pdf', 'created_by' => 'alidata',],
            ['nama_regulasi' => 'Perbub', 'berkas_regulasi' => 'perbup.pdf', 'created_by' => 'alidata',],
            ['nama_regulasi' => 'lainnya', 'berkas_regulasi' => 'lainnya.pdf', 'created_by' => 'alidata',],
        ]);
    }
}
