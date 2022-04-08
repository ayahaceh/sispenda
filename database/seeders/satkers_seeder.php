<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class satkers_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('satkers')->truncate();
        // Insert data awal untuk referensi Status record
        DB::table('satkers')->insert([
            [
                'id' => 1,
                'nama_satker'   => 'BPKK Aceh Singkil',
                'alamat_satker' => 'Jl. Singkil – Rimo Nomor 5 Desa Pulo Sarok, Kecamatan Singkil',
                'kota_satker'   => 'Kab. Aceh Singkil',
                'prov_satker'   => 'Provinsi Aceh',
                'ket_satker'    => 'Keterangan satker disini',
                'nama_satkera'  => 'Pemerintah Kabupaten Aceh Singkil',
                'nama_satkerb'  => 'Badan Pengelolaan Keuangan Kabupaten Aceh Singkil',
                'logo_satker'   => 'default.png',
                'telp_satker'   => '08111-65-7788',
                'email_satker'  => 'bpkk@bpkksingkil.com',
                'nama_kepala'   => 'Hendra Sunarno, SE.Ak',
                'nip_kepala'    => '198606152010121002',
                'jab_kepala'    => 'Kepala',
            ]
        ]);
    }
}
