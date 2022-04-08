<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class web_assets_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus data lama 
        DB::table('web_assets')->truncate();
        DB::table('web_assets')->insert([
            ['berkas_video' => 'video-bg.mp4', 'berkas_gambar' => 'bg7-2.png', 'created_by' => 'alidata',],
        ]);
    }
}
