<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class jenis_logs_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus data lama 
        DB::table('jenis_logs')->truncate();
        DB::table('jenis_logs')->insert([
            ['nama_log' => 'Log Database Wajib Pajak'],
            ['nama_log' => 'Log Database Nomor Objek Pajak'],
            ['nama_log' => 'Log Database Transaksi BPHTB'],
            ['nama_log' => 'Log Database Tarif NPOPTKP'],
            ['nama_log' => 'Log Database Tarif ZNT'],
            ['nama_log' => 'Log Database Tarif Bea BPHTB'],
            ['nama_log' => 'Log Database Pendaftaran Wajib Pajak'],
            ['nama_log' => 'Log Database Akun Pengguna'],
            ['nama_log' => 'Log Database Tampilan Website'],
            ['nama_log' => 'Log Database Lainnya'],
        ]);
    }
}
