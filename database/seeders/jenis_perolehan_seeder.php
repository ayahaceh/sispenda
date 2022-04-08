<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class jenis_perolehan_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus data lama 
        DB::table('jenis_perolehan')->truncate();
        DB::table('jenis_perolehan')->insert([
            ['kode_jenis_perolehan' => '01', 'nama_jenis_perolehan' => 'Jual Beli', 'tarif_npoptkp' => 60000000],
            ['kode_jenis_perolehan' => '02', 'nama_jenis_perolehan' => 'Pertukaran', 'tarif_npoptkp' => 60000000],
            ['kode_jenis_perolehan' => '03', 'nama_jenis_perolehan' => 'Hibah', 'tarif_npoptkp' => 300000000],
            ['kode_jenis_perolehan' => '04', 'nama_jenis_perolehan' => 'Waris', 'tarif_npoptkp' => 300000000],
            ['kode_jenis_perolehan' => '05', 'nama_jenis_perolehan' => 'Hibah Wasiat', 'tarif_npoptkp' => 300000000],
            ['kode_jenis_perolehan' => '06', 'nama_jenis_perolehan' => 'Pemasukan dalam perseroan maupun badan hukum lain', 'tarif_npoptkp' => 60000000],
            ['kode_jenis_perolehan' => '07', 'nama_jenis_perolehan' => 'Penunjukan pembeli saat lelang', 'tarif_npoptkp' => 60000000],
            ['kode_jenis_perolehan' => '08', 'nama_jenis_perolehan' => 'Pemisahan hak yang menyebabkan peralihan', 'tarif_npoptkp' => 60000000],
            ['kode_jenis_perolehan' => '09', 'nama_jenis_perolehan' => 'Terkait pelaksanaan putusan hakim dengan kekuatan hukum tetap', 'tarif_npoptkp' => 60000000],
            ['kode_jenis_perolehan' => '10', 'nama_jenis_perolehan' => 'Peleburan usaha atau merger', 'tarif_npoptkp' => 60000000],
            ['kode_jenis_perolehan' => '11', 'nama_jenis_perolehan' => 'Penggabungan usaha', 'tarif_npoptkp' => 60000000],
            ['kode_jenis_perolehan' => '12', 'nama_jenis_perolehan' => 'Pemekaran usaha', 'tarif_npoptkp' => 60000000],
            ['kode_jenis_perolehan' => '13', 'nama_jenis_perolehan' => 'Hasil lelang dengan non-eksekusi', 'tarif_npoptkp' => 60000000],
            ['kode_jenis_perolehan' => '14', 'nama_jenis_perolehan' => 'Hadiah', 'tarif_npoptkp' => 60000000],
        ]);
    }
}
