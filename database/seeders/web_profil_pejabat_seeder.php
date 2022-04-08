<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class web_profil_pejabat_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus data lama 
        DB::table('web_profil_pejabat')->truncate();
        DB::table('web_profil_pejabat')->insert([
            ['nama_pejabat' => 'Hendra Sunarno, SE,Ak,MSI', 'jabatan_pejabat' => 'Kepala BPKK Aceh Singkil',  'uraian_pejabat' => 'E-BPHTB Diluncurkan untuk memberikan pelayanan maksimal kepada Wajib Pajak, guna meningkatkan penerimaan dan transparansi Pengelolaan Penerimaan Pajak Daerah.', 'berkas_foto' => 'kepala.png', 'created_by' => 'alidata',],
            ['nama_pejabat' => 'Wagiman, SE', 'jabatan_pejabat' => 'Kepala Bidang Pendapatan',  'uraian_pejabat' => 'Dengan E-BPHTB Aceh Singkil, diharapkan dapat membantu para Wajib Pajak dalam melakukan pembayaran Pajak PBB.', 'berkas_foto' => 'kabid.png', 'created_by' => 'alidata',],
            ['nama_pejabat' => 'Sony', 'jabatan_pejabat' => 'Petugas BPHTB', 'uraian_pejabat' => 'Dengan E-BPHTB, para Wajib Pajak dapat melakukan pengurusan BPHTB secara Mandiri.', 'berkas_foto' => 'operator.png',  'created_by' => 'alidata',],
        ]);
    }
}
