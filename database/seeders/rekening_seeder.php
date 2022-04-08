<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class rekening_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus data lama 
        DB::table('rekening')->truncate();
        DB::table('rekening')->insert([
            [
                'no_rekening'       => '13001028030038',
                'nama_rekening'     => 'Bank Aceh Cab. Singkil',
                'gambar_qris'       => 'qris_02.png',
                'gambar_rekening'   => 'rekening_02.png',
                'gambar_logo_bank'  => 'logo_bank_02.png',
                'status_rekening'   => 'Default',
            ],
        ]);
    }
}
