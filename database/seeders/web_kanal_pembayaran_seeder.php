<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class web_kanal_pembayaran_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus data lama 
        DB::table('web_kanal_pembayaran')->truncate();
        DB::table('web_kanal_pembayaran')->insert([
            ['nama_kanal' => 'Bank BSI', 'uraian_kanal' => 'Pembayaran dapat langsung dilakukan dengan rekening Bank BSI, baik menggunakan BSI Mobile / ATM BSI / Maupun Transfer Manual di Bank.', 'berkas_kanal' => 'bank-bsi-logo.jpg', 'created_by' => 'alidata',],
            ['nama_kanal' => 'Bank Aceh', 'uraian_kanal' => 'Pembayaran dapat langsung dilakukan dengan rekening Bank Aceh, baik menggunakan Action Bank Aceh / ATM Bank Aceh / Maupun Transfer Manual di Bank.', 'berkas_kanal' => 'bank-aceh-logo.jpg', 'created_by' => 'alidata',],
            ['nama_kanal' => 'QRIS', 'uraian_kanal' => 'Pembayaran dapat langsung dilakukan dengan menggunakan QRIS.', 'berkas_kanal' => 'qris-logo.jpg', 'created_by' => 'alidata',],
        ]);
    }
}
