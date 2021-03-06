<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class kab_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Hapus data lama 
        DB::table('kab')->truncate();
        DB::table('kab')->insert([
            ['kode_kab' => '11.09', 'nama_kab' => 'Kab. Simeulue',],
            ['kode_kab' => '11.10', 'nama_kab' => 'Kab. Aceh Singkil',],
            ['kode_kab' => '11.01', 'nama_kab' => 'Kab. Aceh Selatan',],
            ['kode_kab' => '11.02', 'nama_kab' => 'Kab. Aceh Tenggara',],
            ['kode_kab' => '11.03', 'nama_kab' => 'Kab. Aceh Timur',],
            ['kode_kab' => '11.04', 'nama_kab' => 'Kab. Aceh Tengah',],
            ['kode_kab' => '11.05', 'nama_kab' => 'Kab. Aceh Barat',],
            ['kode_kab' => '11.06', 'nama_kab' => 'Kab. Aceh Besar',],
            ['kode_kab' => '11.07', 'nama_kab' => 'Kab. Pidie',],
            ['kode_kab' => '11.11', 'nama_kab' => 'Kab. Bireuen',],
            ['kode_kab' => '11.08', 'nama_kab' => 'Kab. Aceh Utara',],
            ['kode_kab' => '11.12', 'nama_kab' => 'Kab. Aceh Barat Daya',],
            ['kode_kab' => '11.13', 'nama_kab' => 'Kab. Gayo Lues',],
            ['kode_kab' => '11.16', 'nama_kab' => 'Kab. Aceh Tamiang',],
            ['kode_kab' => '11.15', 'nama_kab' => 'Kab. Nagan Raya',],
            ['kode_kab' => '11.14', 'nama_kab' => 'Kab. Aceh Jaya',],
            ['kode_kab' => '11.17', 'nama_kab' => 'Kab. Bener Meriah',],
            ['kode_kab' => '11.18', 'nama_kab' => 'Kab. Pidie Jaya',],
            ['kode_kab' => '11.71', 'nama_kab' => 'Kota Banda Aceh',],
            ['kode_kab' => '11.72', 'nama_kab' => 'Kota Sabang',],
            ['kode_kab' => '11.74', 'nama_kab' => 'Kota Langsa',],
            ['kode_kab' => '11.73', 'nama_kab' => 'Kota Lhokseumawe',],
            ['kode_kab' => '11.75', 'nama_kab' => 'Kota Subulussalam',],
            ['kode_kab' => '12.01', 'nama_kab' => 'KAB. TAPANULI TENGAH',],
            ['kode_kab' => '12.02', 'nama_kab' => 'KAB. TAPANULI UTARA',],
            ['kode_kab' => '12.03', 'nama_kab' => 'KAB. TAPANULI SELATAN',],
            ['kode_kab' => '12.04', 'nama_kab' => 'KAB. NIAS',],
            ['kode_kab' => '12.05', 'nama_kab' => 'KAB. LANGKAT',],
            ['kode_kab' => '12.06', 'nama_kab' => 'KAB. KARO',],
            ['kode_kab' => '12.07', 'nama_kab' => 'KAB. DELI SERDANG',],
            ['kode_kab' => '12.08', 'nama_kab' => 'KAB. SIMALUNGUN',],
            ['kode_kab' => '12.09', 'nama_kab' => 'KAB. ASAHAN',],
            ['kode_kab' => '12.10', 'nama_kab' => 'KAB. LABUHANBATU',],
            ['kode_kab' => '12.11', 'nama_kab' => 'KAB. DAIRI',],
            ['kode_kab' => '12.12', 'nama_kab' => 'KAB. TOBA SAMOSIR',],
            ['kode_kab' => '12.13', 'nama_kab' => 'KAB. MANDAILING NATAL',],
            ['kode_kab' => '12.14', 'nama_kab' => 'KAB. NIAS SELATAN',],
            ['kode_kab' => '12.15', 'nama_kab' => 'KAB. PAKPAK BHARAT',],
            ['kode_kab' => '12.16', 'nama_kab' => 'KAB. HUMBANG HASUNDUTAN',],
            ['kode_kab' => '12.17', 'nama_kab' => 'KAB. SAMOSIR',],
            ['kode_kab' => '12.18', 'nama_kab' => 'KAB. SERDANG BEDAGAI',],
            ['kode_kab' => '12.19', 'nama_kab' => 'KAB. BATU BARA',],
            ['kode_kab' => '12.20', 'nama_kab' => 'KAB. PADANG LAWAS UTARA',],
            ['kode_kab' => '12.21', 'nama_kab' => 'KAB. PADANG LAWAS',],
            ['kode_kab' => '12.22', 'nama_kab' => 'KAB. LABUHANBATU SELATAN',],
            ['kode_kab' => '12.23', 'nama_kab' => 'KAB. LABUHANBATU UTARA',],
            ['kode_kab' => '12.24', 'nama_kab' => 'KAB. NIAS UTARA',],
            ['kode_kab' => '12.25', 'nama_kab' => 'KAB. NIAS BARAT',],
            ['kode_kab' => '12.71', 'nama_kab' => 'KOTA MEDAN',],
            ['kode_kab' => '12.72', 'nama_kab' => 'KOTA PEMATANGSIANTAR',],
            ['kode_kab' => '12.73', 'nama_kab' => 'KOTA SIBOLGA',],
            ['kode_kab' => '12.74', 'nama_kab' => 'KOTA TANJUNG BALAI',],
            ['kode_kab' => '12.75', 'nama_kab' => 'KOTA BINJAI',],
            ['kode_kab' => '12.76', 'nama_kab' => 'KOTA TEBING TINGGI',],
            ['kode_kab' => '12.77', 'nama_kab' => 'KOTA PADANG SIDEMPUAN',],
            ['kode_kab' => '12.78', 'nama_kab' => 'KOTA GUNUNGSITOLI',],
            ['kode_kab' => '13.01', 'nama_kab' => 'KAB. PESISIR SELATAN',],
            ['kode_kab' => '13.02', 'nama_kab' => 'KAB. SOLOK',],
            ['kode_kab' => '13.03', 'nama_kab' => 'KAB. SIJUNJUNG',],
            ['kode_kab' => '13.04', 'nama_kab' => 'KAB. TANAH DATAR',],
            ['kode_kab' => '13.05', 'nama_kab' => 'KAB. PADANG PARIAMAN',],
            ['kode_kab' => '13.06', 'nama_kab' => 'KAB. AGAM',],
            ['kode_kab' => '13.07', 'nama_kab' => 'KAB. LIMA PULUH KOTA',],
            ['kode_kab' => '13.08', 'nama_kab' => 'KAB. PASAMAN',],
            ['kode_kab' => '13.09', 'nama_kab' => 'KAB. KEPULAUAN MENTAWAI',],
            ['kode_kab' => '13.10', 'nama_kab' => 'KAB. DHARMASRAYA',],
            ['kode_kab' => '13.11', 'nama_kab' => 'KAB. SOLOK SELATAN',],
            ['kode_kab' => '13.12', 'nama_kab' => 'KAB. PASAMAN BARAT',],
            ['kode_kab' => '13.71', 'nama_kab' => 'KOTA PADANG',],
            ['kode_kab' => '13.72', 'nama_kab' => 'KOTA SOLOK',],
            ['kode_kab' => '13.73', 'nama_kab' => 'KOTA SAWAHLUNTO',],
            ['kode_kab' => '13.74', 'nama_kab' => 'KOTA PADANG PANJANG',],
            ['kode_kab' => '13.75', 'nama_kab' => 'KOTA BUKITTINGGI',],
            ['kode_kab' => '13.76', 'nama_kab' => 'KOTA PAYAKUMBUH',],
            ['kode_kab' => '13.77', 'nama_kab' => 'KOTA PARIAMAN',],
            ['kode_kab' => '14.01', 'nama_kab' => 'KAB. KAMPAR',],
            ['kode_kab' => '14.02', 'nama_kab' => 'KAB. INDRAGIRI HULU',],
            ['kode_kab' => '14.03', 'nama_kab' => 'KAB. BENGKALIS',],
            ['kode_kab' => '14.04', 'nama_kab' => 'KAB. INDRAGIRI HILIR',],
            ['kode_kab' => '14.05', 'nama_kab' => 'KAB. PELALAWAN',],
            ['kode_kab' => '14.06', 'nama_kab' => 'KAB. ROKAN HULU',],
            ['kode_kab' => '14.07', 'nama_kab' => 'KAB. ROKAN HILIR',],
            ['kode_kab' => '14.08', 'nama_kab' => 'KAB. SIAK',],
            ['kode_kab' => '14.09', 'nama_kab' => 'KAB. KUANTAN SINGINGI',],
            ['kode_kab' => '14.10', 'nama_kab' => 'KAB. KEPULAUAN MERANTI',],
            ['kode_kab' => '14.71', 'nama_kab' => 'KOTA PEKANBARU',],
            ['kode_kab' => '14.72', 'nama_kab' => 'KOTA DUMAI',],
            ['kode_kab' => '15.01', 'nama_kab' => 'KAB. KERINCI',],
            ['kode_kab' => '15.02', 'nama_kab' => 'KAB. MERANGIN',],
            ['kode_kab' => '15.03', 'nama_kab' => 'KAB. SAROLANGUN',],
            ['kode_kab' => '15.04', 'nama_kab' => 'KAB. BATANGHARI',],
            ['kode_kab' => '15.05', 'nama_kab' => 'KAB. MUARO JAMBI',],
            ['kode_kab' => '15.06', 'nama_kab' => 'KAB. TANJUNG JABUNG BARAT',],
            ['kode_kab' => '15.07', 'nama_kab' => 'KAB. TANJUNG JABUNG TIMUR',],
            ['kode_kab' => '15.08', 'nama_kab' => 'KAB. BUNGO',],
            ['kode_kab' => '15.09', 'nama_kab' => 'KAB. TEBO',],
            ['kode_kab' => '15.71', 'nama_kab' => 'KOTA JAMBI',],
            ['kode_kab' => '15.72', 'nama_kab' => 'KOTA SUNGAI PENUH',],
            ['kode_kab' => '16.01', 'nama_kab' => 'KAB. OGAN KOMERING ULU',],
            ['kode_kab' => '16.02', 'nama_kab' => 'KAB. OGAN KOMERING ILIR',],
            ['kode_kab' => '16.03', 'nama_kab' => 'KAB. MUARA ENIM',],
            ['kode_kab' => '16.04', 'nama_kab' => 'KAB. LAHAT',],
            ['kode_kab' => '16.05', 'nama_kab' => 'KAB. MUSI RAWAS',],
            ['kode_kab' => '16.06', 'nama_kab' => 'KAB. MUSI BANYUASIN',],
            ['kode_kab' => '16.07', 'nama_kab' => 'KAB. BANYUASIN',],
            ['kode_kab' => '16.08', 'nama_kab' => 'KAB. OGAN KOMERING ULU TIMUR',],
            ['kode_kab' => '16.09', 'nama_kab' => 'KAB. OGAN KOMERING ULU SELATAN',],
            ['kode_kab' => '16.10', 'nama_kab' => 'KAB. OGAN ILIR',],
            ['kode_kab' => '16.11', 'nama_kab' => 'KAB. EMPAT LAWANG',],
            ['kode_kab' => '16.12', 'nama_kab' => 'KAB. PENUKAL ABAB LEMATANG ILIR',],
            ['kode_kab' => '16.13', 'nama_kab' => 'KAB. MUSI RAWAS UTARA',],
            ['kode_kab' => '16.71', 'nama_kab' => 'KOTA PALEMBANG',],
            ['kode_kab' => '16.72', 'nama_kab' => 'KOTA PAGAR ALAM',],
            ['kode_kab' => '16.73', 'nama_kab' => 'KOTA LUBUK LINGGAU',],
            ['kode_kab' => '16.74', 'nama_kab' => 'KOTA PRABUMULIH',],
            ['kode_kab' => '17.01', 'nama_kab' => 'KAB. BENGKULU SELATAN',],
            ['kode_kab' => '17.02', 'nama_kab' => 'KAB. REJANG LEBONG',],
            ['kode_kab' => '17.03', 'nama_kab' => 'KAB. BENGKULU UTARA',],
            ['kode_kab' => '17.04', 'nama_kab' => 'KAB. KAUR',],
            ['kode_kab' => '17.05', 'nama_kab' => 'KAB. SELUMA',],
            ['kode_kab' => '17.06', 'nama_kab' => 'KAB. MUKO MUKO',],
            ['kode_kab' => '17.07', 'nama_kab' => 'KAB. LEBONG',],
            ['kode_kab' => '17.08', 'nama_kab' => 'KAB. KEPAHIANG',],
            ['kode_kab' => '17.09', 'nama_kab' => 'KAB. BENGKULU TENGAH',],
            ['kode_kab' => '17.71', 'nama_kab' => 'KOTA BENGKULU',],
            ['kode_kab' => '18.01', 'nama_kab' => 'KAB. LAMPUNG SELATAN',],
            ['kode_kab' => '18.02', 'nama_kab' => 'KAB. LAMPUNG TENGAH',],
            ['kode_kab' => '18.03', 'nama_kab' => 'KAB. LAMPUNG UTARA',],
            ['kode_kab' => '18.04', 'nama_kab' => 'KAB. LAMPUNG BARAT',],
            ['kode_kab' => '18.05', 'nama_kab' => 'KAB. TULANG BAWANG',],
            ['kode_kab' => '18.06', 'nama_kab' => 'KAB. TANGGAMUS',],
            ['kode_kab' => '18.07', 'nama_kab' => 'KAB. LAMPUNG TIMUR',],
            ['kode_kab' => '18.08', 'nama_kab' => 'KAB. WAY KANAN',],
            ['kode_kab' => '18.09', 'nama_kab' => 'KAB. PESAWARAN',],
            ['kode_kab' => '18.10', 'nama_kab' => 'KAB. PRINGSEWU',],
            ['kode_kab' => '18.11', 'nama_kab' => 'KAB. MESUJI',],
            ['kode_kab' => '18.12', 'nama_kab' => 'KAB. TULANG BAWANG BARAT',],
            ['kode_kab' => '18.13', 'nama_kab' => 'KAB. PESISIR BARAT',],
            ['kode_kab' => '18.71', 'nama_kab' => 'KOTA BANDAR LAMPUNG',],
            ['kode_kab' => '18.72', 'nama_kab' => 'KOTA METRO',],
            ['kode_kab' => '19.01', 'nama_kab' => 'KAB. BANGKA',],
            ['kode_kab' => '19.02', 'nama_kab' => 'KAB. BELITUNG',],
            ['kode_kab' => '19.03', 'nama_kab' => 'KAB. BANGKA SELATAN',],
            ['kode_kab' => '19.04', 'nama_kab' => 'KAB. BANGKA TENGAH',],
            ['kode_kab' => '19.05', 'nama_kab' => 'KAB. BANGKA BARAT',],
            ['kode_kab' => '19.06', 'nama_kab' => 'KAB. BELITUNG TIMUR',],
            ['kode_kab' => '19.71', 'nama_kab' => 'KOTA PANGKAL PINANG',],
            ['kode_kab' => '21.01', 'nama_kab' => 'KAB. BINTAN',],
            ['kode_kab' => '21.02', 'nama_kab' => 'KAB. KARIMUN',],
            ['kode_kab' => '21.03', 'nama_kab' => 'KAB. NATUNA',],
            ['kode_kab' => '21.04', 'nama_kab' => 'KAB. LINGGA',],
            ['kode_kab' => '21.05', 'nama_kab' => 'KAB. KEPULAUAN ANAMBAS',],
            ['kode_kab' => '21.71', 'nama_kab' => 'KOTA BATAM',],
            ['kode_kab' => '21.72', 'nama_kab' => 'KOTA TANJUNG PINANG',],
            ['kode_kab' => '31.01', 'nama_kab' => 'KAB. ADM. KEP. SERIBU',],
            ['kode_kab' => '31.71', 'nama_kab' => 'KOTA ADM. JAKARTA PUSAT',],
            ['kode_kab' => '31.72', 'nama_kab' => 'KOTA ADM. JAKARTA UTARA',],
            ['kode_kab' => '31.73', 'nama_kab' => 'KOTA ADM. JAKARTA BARAT',],
            ['kode_kab' => '31.74', 'nama_kab' => 'KOTA ADM. JAKARTA SELATAN',],
            ['kode_kab' => '31.75', 'nama_kab' => 'KOTA ADM. JAKARTA TIMUR',],
            ['kode_kab' => '32.01', 'nama_kab' => 'KAB. BOGOR',],
            ['kode_kab' => '32.02', 'nama_kab' => 'KAB. SUKABUMI',],
            ['kode_kab' => '32.03', 'nama_kab' => 'KAB. CIANJUR',],
            ['kode_kab' => '32.04', 'nama_kab' => 'KAB. BANDUNG',],
            ['kode_kab' => '32.05', 'nama_kab' => 'KAB. GARUT',],
            ['kode_kab' => '32.06', 'nama_kab' => 'KAB. TASIKMALAYA',],
            ['kode_kab' => '32.07', 'nama_kab' => 'KAB. CIAMIS',],
            ['kode_kab' => '32.08', 'nama_kab' => 'KAB. KUNINGAN',],
            ['kode_kab' => '32.09', 'nama_kab' => 'KAB. CIREBON',],
            ['kode_kab' => '32.10', 'nama_kab' => 'KAB. MAJALENGKA',],
            ['kode_kab' => '32.11', 'nama_kab' => 'KAB. SUMEDANG',],
            ['kode_kab' => '32.12', 'nama_kab' => 'KAB. INDRAMAYU',],
            ['kode_kab' => '32.13', 'nama_kab' => 'KAB. SUBANG',],
            ['kode_kab' => '32.14', 'nama_kab' => 'KAB. PURWAKARTA',],
            ['kode_kab' => '32.15', 'nama_kab' => 'KAB. KARAWANG',],
            ['kode_kab' => '32.16', 'nama_kab' => 'KAB. BEKASI',],
            ['kode_kab' => '32.17', 'nama_kab' => 'KAB. BANDUNG BARAT',],
            ['kode_kab' => '32.18', 'nama_kab' => 'KAB. PANGANDARAN',],
            ['kode_kab' => '32.71', 'nama_kab' => 'KOTA BOGOR',],
            ['kode_kab' => '32.72', 'nama_kab' => 'KOTA SUKABUMI',],
            ['kode_kab' => '32.73', 'nama_kab' => 'KOTA BANDUNG',],
            ['kode_kab' => '32.74', 'nama_kab' => 'KOTA CIREBON',],
            ['kode_kab' => '32.75', 'nama_kab' => 'KOTA BEKASI',],
            ['kode_kab' => '32.76', 'nama_kab' => 'KOTA DEPOK',],
            ['kode_kab' => '32.77', 'nama_kab' => 'KOTA CIMAHI',],
            ['kode_kab' => '32.78', 'nama_kab' => 'KOTA TASIKMALAYA',],
            ['kode_kab' => '32.79', 'nama_kab' => 'KOTA BANJAR',],
            ['kode_kab' => '33.01', 'nama_kab' => 'KAB. CILACAP',],
            ['kode_kab' => '33.02', 'nama_kab' => 'KAB. BANYUMAS',],
            ['kode_kab' => '33.03', 'nama_kab' => 'KAB. PURBALINGGA',],
            ['kode_kab' => '33.04', 'nama_kab' => 'KAB. BANJARNEGARA',],
            ['kode_kab' => '33.05', 'nama_kab' => 'KAB. KEBUMEN',],
            ['kode_kab' => '33.06', 'nama_kab' => 'KAB. PURWOREJO',],
            ['kode_kab' => '33.07', 'nama_kab' => 'KAB. WONOSOBO',],
            ['kode_kab' => '33.08', 'nama_kab' => 'KAB. MAGELANG',],
            ['kode_kab' => '33.09', 'nama_kab' => 'KAB. BOYOLALI',],
            ['kode_kab' => '33.10', 'nama_kab' => 'KAB. KLATEN',],
            ['kode_kab' => '33.11', 'nama_kab' => 'KAB. SUKOHARJO',],
            ['kode_kab' => '33.12', 'nama_kab' => 'KAB. WONOGIRI',],
            ['kode_kab' => '33.13', 'nama_kab' => 'KAB. KARANGANYAR',],
            ['kode_kab' => '33.14', 'nama_kab' => 'KAB. SRAGEN',],
            ['kode_kab' => '33.15', 'nama_kab' => 'KAB. GROBOGAN',],
            ['kode_kab' => '33.16', 'nama_kab' => 'KAB. BLORA',],
            ['kode_kab' => '33.17', 'nama_kab' => 'KAB. REMBANG',],
            ['kode_kab' => '33.18', 'nama_kab' => 'KAB. PATI',],
            ['kode_kab' => '33.19', 'nama_kab' => 'KAB. KUDUS',],
            ['kode_kab' => '33.20', 'nama_kab' => 'KAB. JEPARA',],
            ['kode_kab' => '33.21', 'nama_kab' => 'KAB. DEMAK',],
            ['kode_kab' => '33.22', 'nama_kab' => 'KAB. SEMARANG',],
            ['kode_kab' => '33.23', 'nama_kab' => 'KAB. TEMANGGUNG',],
            ['kode_kab' => '33.24', 'nama_kab' => 'KAB. KENDAL',],
            ['kode_kab' => '33.25', 'nama_kab' => 'KAB. BATANG',],
            ['kode_kab' => '33.26', 'nama_kab' => 'KAB. PEKALONGAN',],
            ['kode_kab' => '33.27', 'nama_kab' => 'KAB. PEMALANG',],
            ['kode_kab' => '33.28', 'nama_kab' => 'KAB. TEGAL',],
            ['kode_kab' => '33.29', 'nama_kab' => 'KAB. BREBES',],
            ['kode_kab' => '33.71', 'nama_kab' => 'KOTA MAGELANG',],
            ['kode_kab' => '33.72', 'nama_kab' => 'KOTA SURAKARTA',],
            ['kode_kab' => '33.73', 'nama_kab' => 'KOTA SALATIGA',],
            ['kode_kab' => '33.74', 'nama_kab' => 'KOTA SEMARANG',],
            ['kode_kab' => '33.75', 'nama_kab' => 'KOTA PEKALONGAN',],
            ['kode_kab' => '33.76', 'nama_kab' => 'KOTA TEGAL',],
            ['kode_kab' => '34.01', 'nama_kab' => 'KAB. KULON PROGO',],
            ['kode_kab' => '34.02', 'nama_kab' => 'KAB. BANTUL',],
            ['kode_kab' => '34.03', 'nama_kab' => 'KAB. GUNUNGKIDUL',],
            ['kode_kab' => '34.04', 'nama_kab' => 'KAB. SLEMAN',],
            ['kode_kab' => '34.71', 'nama_kab' => 'KOTA YOGYAKARTA',],
            ['kode_kab' => '35.01', 'nama_kab' => 'KAB. PACITAN',],
            ['kode_kab' => '35.02', 'nama_kab' => 'KAB. PONOROGO',],
            ['kode_kab' => '35.03', 'nama_kab' => 'KAB. TRENGGALEK',],
            ['kode_kab' => '35.04', 'nama_kab' => 'KAB. TULUNGAGUNG',],
            ['kode_kab' => '35.05', 'nama_kab' => 'KAB. BLITAR',],
            ['kode_kab' => '35.06', 'nama_kab' => 'KAB. KEDIRI',],
            ['kode_kab' => '35.07', 'nama_kab' => 'KAB. MALANG',],
            ['kode_kab' => '35.08', 'nama_kab' => 'KAB. LUMAJANG',],
            ['kode_kab' => '35.09', 'nama_kab' => 'KAB. JEMBER',],
            ['kode_kab' => '35.10', 'nama_kab' => 'KAB. BANYUWANGI',],
            ['kode_kab' => '35.11', 'nama_kab' => 'KAB. BONDOWOSO',],
            ['kode_kab' => '35.12', 'nama_kab' => 'KAB. SITUBONDO',],
            ['kode_kab' => '35.13', 'nama_kab' => 'KAB. PROBOLINGGO',],
            ['kode_kab' => '35.14', 'nama_kab' => 'KAB. PASURUAN',],
            ['kode_kab' => '35.15', 'nama_kab' => 'KAB. SIDOARJO',],
            ['kode_kab' => '35.16', 'nama_kab' => 'KAB. MOJOKERTO',],
            ['kode_kab' => '35.17', 'nama_kab' => 'KAB. JOMBANG',],
            ['kode_kab' => '35.18', 'nama_kab' => 'KAB. NGANJUK',],
            ['kode_kab' => '35.19', 'nama_kab' => 'KAB. MADIUN',],
            ['kode_kab' => '35.20', 'nama_kab' => 'KAB. MAGETAN',],
            ['kode_kab' => '35.21', 'nama_kab' => 'KAB. NGAWI',],
            ['kode_kab' => '35.22', 'nama_kab' => 'KAB. BOJONEGORO',],
            ['kode_kab' => '35.23', 'nama_kab' => 'KAB. TUBAN',],
            ['kode_kab' => '35.24', 'nama_kab' => 'KAB. LAMONGAN',],
            ['kode_kab' => '35.25', 'nama_kab' => 'KAB. GRESIK',],
            ['kode_kab' => '35.26', 'nama_kab' => 'KAB. BANGKALAN',],
            ['kode_kab' => '35.27', 'nama_kab' => 'KAB. SAMPANG',],
            ['kode_kab' => '35.28', 'nama_kab' => 'KAB. PAMEKASAN',],
            ['kode_kab' => '35.29', 'nama_kab' => 'KAB. SUMENEP',],
            ['kode_kab' => '35.71', 'nama_kab' => 'KOTA KEDIRI',],
            ['kode_kab' => '35.72', 'nama_kab' => 'KOTA BLITAR',],
            ['kode_kab' => '35.73', 'nama_kab' => 'KOTA MALANG',],
            ['kode_kab' => '35.74', 'nama_kab' => 'KOTA PROBOLINGGO',],
            ['kode_kab' => '35.75', 'nama_kab' => 'KOTA PASURUAN',],
            ['kode_kab' => '35.76', 'nama_kab' => 'KOTA MOJOKERTO',],
            ['kode_kab' => '35.77', 'nama_kab' => 'KOTA MADIUN',],
            ['kode_kab' => '35.78', 'nama_kab' => 'KOTA SURABAYA',],
            ['kode_kab' => '35.79', 'nama_kab' => 'KOTA BATU',],
            ['kode_kab' => '36.01', 'nama_kab' => 'KAB. PANDEGLANG',],
            ['kode_kab' => '36.02', 'nama_kab' => 'KAB. LEBAK',],
            ['kode_kab' => '36.03', 'nama_kab' => 'KAB. TANGERANG',],
            ['kode_kab' => '36.04', 'nama_kab' => 'KAB. SERANG',],
            ['kode_kab' => '36.71', 'nama_kab' => 'KOTA TANGERANG',],
            ['kode_kab' => '36.72', 'nama_kab' => 'KOTA CILEGON',],
            ['kode_kab' => '36.73', 'nama_kab' => 'KOTA SERANG',],
            ['kode_kab' => '36.74', 'nama_kab' => 'KOTA TANGERANG SELATAN',],
            ['kode_kab' => '51.01', 'nama_kab' => 'KAB. JEMBRANA',],
            ['kode_kab' => '51.02', 'nama_kab' => 'KAB. TABANAN',],
            ['kode_kab' => '51.03', 'nama_kab' => 'KAB. BADUNG',],
            ['kode_kab' => '51.04', 'nama_kab' => 'KAB. GIANYAR',],
            ['kode_kab' => '51.05', 'nama_kab' => 'KAB. KLUNGKUNG',],
            ['kode_kab' => '51.06', 'nama_kab' => 'KAB. BANGLI',],
            ['kode_kab' => '51.07', 'nama_kab' => 'KAB. KARANGASEM',],
            ['kode_kab' => '51.08', 'nama_kab' => 'KAB. BULELENG',],
            ['kode_kab' => '51.71', 'nama_kab' => 'KOTA DENPASAR',],
            ['kode_kab' => '52.01', 'nama_kab' => 'KAB. LOMBOK BARAT',],
            ['kode_kab' => '52.02', 'nama_kab' => 'KAB. LOMBOK TENGAH',],
            ['kode_kab' => '52.03', 'nama_kab' => 'KAB. LOMBOK TIMUR',],
            ['kode_kab' => '52.04', 'nama_kab' => 'KAB. SUMBAWA',],
            ['kode_kab' => '52.05', 'nama_kab' => 'KAB. DOMPU',],
            ['kode_kab' => '52.06', 'nama_kab' => 'KAB. BIMA',],
            ['kode_kab' => '52.07', 'nama_kab' => 'KAB. SUMBAWA BARAT',],
            ['kode_kab' => '52.08', 'nama_kab' => 'KAB. LOMBOK UTARA',],
            ['kode_kab' => '52.71', 'nama_kab' => 'KOTA MATARAM',],
            ['kode_kab' => '52.72', 'nama_kab' => 'KOTA BIMA',],
            ['kode_kab' => '53.01', 'nama_kab' => 'KAB. KUPANG',],
            ['kode_kab' => '53.02', 'nama_kab' => 'KAB TIMOR TENGAH SELATAN',],
            ['kode_kab' => '53.03', 'nama_kab' => 'KAB. TIMOR TENGAH UTARA',],
            ['kode_kab' => '53.04', 'nama_kab' => 'KAB. BELU',],
            ['kode_kab' => '53.05', 'nama_kab' => 'KAB. ALOR',],
            ['kode_kab' => '53.06', 'nama_kab' => 'KAB. FLORES TIMUR',],
            ['kode_kab' => '53.07', 'nama_kab' => 'KAB. SIKKA',],
            ['kode_kab' => '53.08', 'nama_kab' => 'KAB. ENDE',],
            ['kode_kab' => '53.09', 'nama_kab' => 'KAB. NGADA',],
            ['kode_kab' => '53.10', 'nama_kab' => 'KAB. MANGGARAI',],
            ['kode_kab' => '53.11', 'nama_kab' => 'KAB. SUMBA TIMUR',],
            ['kode_kab' => '53.12', 'nama_kab' => 'KAB. SUMBA BARAT',],
            ['kode_kab' => '53.13', 'nama_kab' => 'KAB. LEMBATA',],
            ['kode_kab' => '53.14', 'nama_kab' => 'KAB. ROTE NDAO',],
            ['kode_kab' => '53.15', 'nama_kab' => 'KAB. MANGGARAI BARAT',],
            ['kode_kab' => '53.16', 'nama_kab' => 'KAB. NAGEKEO',],
            ['kode_kab' => '53.17', 'nama_kab' => 'KAB. SUMBA TENGAH',],
            ['kode_kab' => '53.18', 'nama_kab' => 'KAB. SUMBA BARAT DAYA',],
            ['kode_kab' => '53.19', 'nama_kab' => 'KAB. MANGGARAI TIMUR',],
            ['kode_kab' => '53.20', 'nama_kab' => 'KAB. SABU RAIJUA',],
            ['kode_kab' => '53.21', 'nama_kab' => 'KAB. MALAKA',],
            ['kode_kab' => '53.71', 'nama_kab' => 'KOTA KUPANG',],
            ['kode_kab' => '61.01', 'nama_kab' => 'KAB. SAMBAS',],
            ['kode_kab' => '61.02', 'nama_kab' => 'KAB. MEMPAWAH',],
            ['kode_kab' => '61.03', 'nama_kab' => 'KAB. SANGGAU',],
            ['kode_kab' => '61.04', 'nama_kab' => 'KAB. KETAPANG',],
            ['kode_kab' => '61.05', 'nama_kab' => 'KAB. SINTANG',],
            ['kode_kab' => '61.06', 'nama_kab' => 'KAB. KAPUAS HULU',],
            ['kode_kab' => '61.07', 'nama_kab' => 'KAB. BENGKAYANG',],
            ['kode_kab' => '61.08', 'nama_kab' => 'KAB. LANDAK',],
            ['kode_kab' => '61.09', 'nama_kab' => 'KAB. SEKADAU',],
            ['kode_kab' => '61.10', 'nama_kab' => 'KAB. MELAWI',],
            ['kode_kab' => '61.11', 'nama_kab' => 'KAB. KAYONG UTARA',],
            ['kode_kab' => '61.12', 'nama_kab' => 'KAB. KUBU RAYA',],
            ['kode_kab' => '61.71', 'nama_kab' => 'KOTA PONTIANAK',],
            ['kode_kab' => '61.72', 'nama_kab' => 'KOTA SINGKAWANG',],
            ['kode_kab' => '62.01', 'nama_kab' => 'KAB. KOTAWARINGIN BARAT',],
            ['kode_kab' => '62.02', 'nama_kab' => 'KAB. KOTAWARINGIN TIMUR',],
            ['kode_kab' => '62.03', 'nama_kab' => 'KAB. KAPUAS',],
            ['kode_kab' => '62.04', 'nama_kab' => 'KAB. BARITO SELATAN',],
            ['kode_kab' => '62.05', 'nama_kab' => 'KAB. BARITO UTARA',],
            ['kode_kab' => '62.06', 'nama_kab' => 'KAB. KATINGAN',],
            ['kode_kab' => '62.07', 'nama_kab' => 'KAB. SERUYAN',],
            ['kode_kab' => '62.08', 'nama_kab' => 'KAB. SUKAMARA',],
            ['kode_kab' => '62.09', 'nama_kab' => 'KAB. LAMANDAU',],
            ['kode_kab' => '62.10', 'nama_kab' => 'KAB. GUNUNG MAS',],
            ['kode_kab' => '62.11', 'nama_kab' => 'KAB. PULANG PISAU',],
            ['kode_kab' => '62.12', 'nama_kab' => 'KAB. MURUNG RAYA',],
            ['kode_kab' => '62.13', 'nama_kab' => 'KAB. BARITO TIMUR',],
            ['kode_kab' => '62.71', 'nama_kab' => 'KOTA PALANGKARAYA',],
            ['kode_kab' => '63.01', 'nama_kab' => 'KAB. TANAH LAUT',],
            ['kode_kab' => '63.02', 'nama_kab' => 'KAB. KOTABARU',],
            ['kode_kab' => '63.03', 'nama_kab' => 'KAB. BANJAR',],
            ['kode_kab' => '63.04', 'nama_kab' => 'KAB. BARITO KUALA',],
            ['kode_kab' => '63.05', 'nama_kab' => 'KAB. TAPIN',],
            ['kode_kab' => '63.06', 'nama_kab' => 'KAB. HULU SUNGAI SELATAN',],
            ['kode_kab' => '63.07', 'nama_kab' => 'KAB. HULU SUNGAI TENGAH',],
            ['kode_kab' => '63.08', 'nama_kab' => 'KAB. HULU SUNGAI UTARA',],
            ['kode_kab' => '63.09', 'nama_kab' => 'KAB. TABALONG',],
            ['kode_kab' => '63.10', 'nama_kab' => 'KAB. TANAH BUMBU',],
            ['kode_kab' => '63.11', 'nama_kab' => 'KAB. BALANGAN',],
            ['kode_kab' => '63.71', 'nama_kab' => 'KOTA BANJARMASIN',],
            ['kode_kab' => '63.72', 'nama_kab' => 'KOTA BANJARBARU',],
            ['kode_kab' => '64.01', 'nama_kab' => 'KAB. PASER',],
            ['kode_kab' => '64.02', 'nama_kab' => 'KAB. KUTAI KARTANEGARA',],
            ['kode_kab' => '64.03', 'nama_kab' => 'KAB. BERAU',],
            ['kode_kab' => '64.07', 'nama_kab' => 'KAB. KUTAI BARAT',],
            ['kode_kab' => '64.08', 'nama_kab' => 'KAB. KUTAI TIMUR',],
            ['kode_kab' => '64.09', 'nama_kab' => 'KAB. PENAJAM PASER UTARA',],
            ['kode_kab' => '64.11', 'nama_kab' => 'KAB. MAHAKAM ULU',],
            ['kode_kab' => '64.71', 'nama_kab' => 'KOTA BALIKPAPAN',],
            ['kode_kab' => '64.72', 'nama_kab' => 'KOTA SAMARINDA',],
            ['kode_kab' => '64.74', 'nama_kab' => 'KOTA BONTANG',],
            ['kode_kab' => '65.01', 'nama_kab' => 'KAB. BULUNGAN',],
            ['kode_kab' => '65.02', 'nama_kab' => 'KAB. MALINAU',],
            ['kode_kab' => '65.03', 'nama_kab' => 'KAB. NUNUKAN',],
            ['kode_kab' => '65.04', 'nama_kab' => 'KAB. TANA TIDUNG',],
            ['kode_kab' => '65.71', 'nama_kab' => 'KOTA TARAKAN',],
            ['kode_kab' => '71.01', 'nama_kab' => 'KAB. BOLAANG MONGONDOW',],
            ['kode_kab' => '71.02', 'nama_kab' => 'KAB. MINAHASA',],
            ['kode_kab' => '71.03', 'nama_kab' => 'KAB. KEPULAUAN SANGIHE',],
            ['kode_kab' => '71.04', 'nama_kab' => 'KAB. KEPULAUAN TALAUD',],
            ['kode_kab' => '71.05', 'nama_kab' => 'KAB. MINAHASA SELATAN',],
            ['kode_kab' => '71.06', 'nama_kab' => 'KAB. MINAHASA UTARA',],
            ['kode_kab' => '71.07', 'nama_kab' => 'KAB. MINAHASA TENGGARA',],
            ['kode_kab' => '71.08', 'nama_kab' => 'KAB. BOLAANG MONGONDOW UTARA',],
            ['kode_kab' => '71.09', 'nama_kab' => 'KAB. KEP. SIAU TAGULANDANG BIARO',],
            ['kode_kab' => '71.10', 'nama_kab' => 'KAB. BOLAANG MONGONDOW TIMUR',],
            ['kode_kab' => '71.11', 'nama_kab' => 'KAB. BOLAANG MONGONDOW SELATAN',],
            ['kode_kab' => '71.71', 'nama_kab' => 'KOTA MANADO',],
            ['kode_kab' => '71.72', 'nama_kab' => 'KOTA BITUNG',],
            ['kode_kab' => '71.73', 'nama_kab' => 'KOTA TOMOHON',],
            ['kode_kab' => '71.74', 'nama_kab' => 'KOTA KOTAMOBAGU',],
            ['kode_kab' => '72.01', 'nama_kab' => 'KAB. BANGGAI',],
            ['kode_kab' => '72.02', 'nama_kab' => 'KAB. POSO',],
            ['kode_kab' => '72.03', 'nama_kab' => 'KAB. DONGGALA',],
            ['kode_kab' => '72.04', 'nama_kab' => 'KAB. TOLI TOLI',],
            ['kode_kab' => '72.05', 'nama_kab' => 'KAB. BUOL',],
            ['kode_kab' => '72.06', 'nama_kab' => 'KAB. MOROWALI',],
            ['kode_kab' => '72.07', 'nama_kab' => 'KAB. BANGGAI KEPULAUAN',],
            ['kode_kab' => '72.08', 'nama_kab' => 'KAB. PARIGI MOUTONG',],
            ['kode_kab' => '72.09', 'nama_kab' => 'KAB. TOJO UNA UNA',],
            ['kode_kab' => '72.10', 'nama_kab' => 'KAB. SIGI',],
            ['kode_kab' => '72.11', 'nama_kab' => 'KAB. BANGGAI LAUT',],
            ['kode_kab' => '72.12', 'nama_kab' => 'KAB. MOROWALI UTARA',],
            ['kode_kab' => '72.71', 'nama_kab' => 'KOTA PALU',],
            ['kode_kab' => '73.01', 'nama_kab' => 'KAB. KEPULAUAN SELAYAR',],
            ['kode_kab' => '73.02', 'nama_kab' => 'KAB. BULUKUMBA',],
            ['kode_kab' => '73.03', 'nama_kab' => 'KAB. BANTAENG',],
            ['kode_kab' => '73.04', 'nama_kab' => 'KAB. JENEPONTO',],
            ['kode_kab' => '73.05', 'nama_kab' => 'KAB. TAKALAR',],
            ['kode_kab' => '73.06', 'nama_kab' => 'KAB. GOWA',],
            ['kode_kab' => '73.07', 'nama_kab' => 'KAB. SINJAI',],
            ['kode_kab' => '73.08', 'nama_kab' => 'KAB. BONE',],
            ['kode_kab' => '73.09', 'nama_kab' => 'KAB. MAROS',],
            ['kode_kab' => '73.10', 'nama_kab' => 'KAB. PANGKAJENE KEPULAUAN',],
            ['kode_kab' => '73.11', 'nama_kab' => 'KAB. BARRU',],
            ['kode_kab' => '73.12', 'nama_kab' => 'KAB. SOPPENG',],
            ['kode_kab' => '73.13', 'nama_kab' => 'KAB. WAJO',],
            ['kode_kab' => '73.14', 'nama_kab' => 'KAB. SIDENRENG RAPPANG',],
            ['kode_kab' => '73.15', 'nama_kab' => 'KAB. PINRANG',],
            ['kode_kab' => '73.16', 'nama_kab' => 'KAB. ENREKANG',],
            ['kode_kab' => '73.17', 'nama_kab' => 'KAB. LUWU',],
            ['kode_kab' => '73.18', 'nama_kab' => 'KAB. TANA TORAJA',],
            ['kode_kab' => '73.22', 'nama_kab' => 'KAB. LUWU UTARA',],
            ['kode_kab' => '73.24', 'nama_kab' => 'KAB. LUWU TIMUR',],
            ['kode_kab' => '73.26', 'nama_kab' => 'KAB. TORAJA UTARA',],
            ['kode_kab' => '73.71', 'nama_kab' => 'KOTA MAKASSAR',],
            ['kode_kab' => '73.72', 'nama_kab' => 'KOTA PARE PARE',],
            ['kode_kab' => '73.73', 'nama_kab' => 'KOTA PALOPO',],
            ['kode_kab' => '74.01', 'nama_kab' => 'KAB. KOLAKA',],
            ['kode_kab' => '74.02', 'nama_kab' => 'KAB. KONAWE',],
            ['kode_kab' => '74.03', 'nama_kab' => 'KAB. MUNA',],
            ['kode_kab' => '74.04', 'nama_kab' => 'KAB. BUTON',],
            ['kode_kab' => '74.05', 'nama_kab' => 'KAB. KONAWE SELATAN',],
            ['kode_kab' => '74.06', 'nama_kab' => 'KAB. BOMBANA',],
            ['kode_kab' => '74.07', 'nama_kab' => 'KAB. WAKATOBI',],
            ['kode_kab' => '74.08', 'nama_kab' => 'KAB. KOLAKA UTARA',],
            ['kode_kab' => '74.09', 'nama_kab' => 'KAB. KONAWE UTARA',],
            ['kode_kab' => '74.10', 'nama_kab' => 'KAB. BUTON UTARA',],
            ['kode_kab' => '74.11', 'nama_kab' => 'KAB. KOLAKA TIMUR',],
            ['kode_kab' => '74.12', 'nama_kab' => 'KAB. KONAWE KEPULAUAN',],
            ['kode_kab' => '74.13', 'nama_kab' => 'KAB. MUNA BARAT',],
            ['kode_kab' => '74.14', 'nama_kab' => 'KAB. BUTON TENGAH',],
            ['kode_kab' => '74.15', 'nama_kab' => 'KAB. BUTON SELATAN',],
            ['kode_kab' => '74.71', 'nama_kab' => 'KOTA KENDARI',],
            ['kode_kab' => '74.72', 'nama_kab' => 'KOTA BAU BAU',],
            ['kode_kab' => '75.01', 'nama_kab' => 'KAB. GORONTALO',],
            ['kode_kab' => '75.02', 'nama_kab' => 'KAB. BOALEMO',],
            ['kode_kab' => '75.03', 'nama_kab' => 'KAB. BONE BOLANGO',],
            ['kode_kab' => '75.04', 'nama_kab' => 'KAB. PAHUWATO',],
            ['kode_kab' => '75.05', 'nama_kab' => 'KAB. GORONTALO UTARA',],
            ['kode_kab' => '75.71', 'nama_kab' => 'KOTA GORONTALO',],
            ['kode_kab' => '76.01', 'nama_kab' => 'KAB. PASANGKAYU',],
            ['kode_kab' => '76.02', 'nama_kab' => 'KAB. MAMUJU',],
            ['kode_kab' => '76.03', 'nama_kab' => 'KAB. MAMASA',],
            ['kode_kab' => '76.04', 'nama_kab' => 'KAB. POLEWALI MANDAR',],
            ['kode_kab' => '76.05', 'nama_kab' => 'KAB. MAJENE',],
            ['kode_kab' => '76.06', 'nama_kab' => 'KAB. MAMUJU TENGAH',],
            ['kode_kab' => '81.01', 'nama_kab' => 'KAB. MALUKU TENGAH',],
            ['kode_kab' => '81.02', 'nama_kab' => 'KAB. MALUKU TENGGARA',],
            ['kode_kab' => '81.03', 'nama_kab' => 'KAB. KEPULAUAN TANIMBAR',],
            ['kode_kab' => '81.04', 'nama_kab' => 'KAB. BURU',],
            ['kode_kab' => '81.05', 'nama_kab' => 'KAB. SERAM BAGIAN TIMUR',],
            ['kode_kab' => '81.06', 'nama_kab' => 'KAB. SERAM BAGIAN BARAT',],
            ['kode_kab' => '81.07', 'nama_kab' => 'KAB. KEPULAUAN ARU',],
            ['kode_kab' => '81.08', 'nama_kab' => 'KAB. MALUKU BARAT DAYA',],
            ['kode_kab' => '81.09', 'nama_kab' => 'KAB. BURU SELATAN',],
            ['kode_kab' => '81.71', 'nama_kab' => 'KOTA AMBON',],
            ['kode_kab' => '81.72', 'nama_kab' => 'KOTA TUAL',],
            ['kode_kab' => '82.01', 'nama_kab' => 'KAB. HALMAHERA BARAT',],
            ['kode_kab' => '82.02', 'nama_kab' => 'KAB. HALMAHERA TENGAH',],
            ['kode_kab' => '82.03', 'nama_kab' => 'KAB. HALMAHERA UTARA',],
            ['kode_kab' => '82.04', 'nama_kab' => 'KAB. HALMAHERA SELATAN',],
            ['kode_kab' => '82.05', 'nama_kab' => 'KAB. KEPULAUAN SULA',],
            ['kode_kab' => '82.06', 'nama_kab' => 'KAB. HALMAHERA TIMUR',],
            ['kode_kab' => '82.07', 'nama_kab' => 'KAB. PULAU MOROTAI',],
            ['kode_kab' => '82.08', 'nama_kab' => 'KAB. PULAU TALIABU',],
            ['kode_kab' => '82.71', 'nama_kab' => 'KOTA TERNATE',],
            ['kode_kab' => '82.72', 'nama_kab' => 'KOTA TIDORE KEPULAUAN',],
            ['kode_kab' => '91.01', 'nama_kab' => 'KAB. MERAUKE',],
            ['kode_kab' => '91.02', 'nama_kab' => 'KAB. JAYAWIJAYA',],
            ['kode_kab' => '91.03', 'nama_kab' => 'KAB. JAYAPURA',],
            ['kode_kab' => '91.04', 'nama_kab' => 'KAB. NABIRE',],
            ['kode_kab' => '91.05', 'nama_kab' => 'KAB. KEPULAUAN YAPEN',],
            ['kode_kab' => '91.06', 'nama_kab' => 'KAB. BIAK NUMFOR',],
            ['kode_kab' => '91.07', 'nama_kab' => 'KAB. PUNCAK JAYA',],
            ['kode_kab' => '91.08', 'nama_kab' => 'KAB. PANIAI',],
            ['kode_kab' => '91.09', 'nama_kab' => 'KAB. MIMIKA',],
            ['kode_kab' => '91.10', 'nama_kab' => 'KAB. SARMI',],
            ['kode_kab' => '91.11', 'nama_kab' => 'KAB. KEEROM',],
            ['kode_kab' => '91.12', 'nama_kab' => 'KAB PEGUNUNGAN BINTANG',],
            ['kode_kab' => '91.13', 'nama_kab' => 'KAB. YAHUKIMO',],
            ['kode_kab' => '91.14', 'nama_kab' => 'KAB. TOLIKARA',],
            ['kode_kab' => '91.15', 'nama_kab' => 'KAB. WAROPEN',],
            ['kode_kab' => '91.16', 'nama_kab' => 'KAB. BOVEN DIGOEL',],
            ['kode_kab' => '91.17', 'nama_kab' => 'KAB. MAPPI',],
            ['kode_kab' => '91.18', 'nama_kab' => 'KAB. ASMAT',],
            ['kode_kab' => '91.19', 'nama_kab' => 'KAB. SUPIORI',],
            ['kode_kab' => '91.20', 'nama_kab' => 'KAB. MAMBERAMO RAYA',],
            ['kode_kab' => '91.21', 'nama_kab' => 'KAB. MAMBERAMO TENGAH',],
            ['kode_kab' => '91.22', 'nama_kab' => 'KAB. YALIMO',],
            ['kode_kab' => '91.23', 'nama_kab' => 'KAB. LANNY JAYA',],
            ['kode_kab' => '91.24', 'nama_kab' => 'KAB. NDUGA',],
            ['kode_kab' => '91.25', 'nama_kab' => 'KAB. PUNCAK',],
            ['kode_kab' => '91.26', 'nama_kab' => 'KAB. DOGIYAI',],
            ['kode_kab' => '91.27', 'nama_kab' => 'KAB. INTAN JAYA',],
            ['kode_kab' => '91.28', 'nama_kab' => 'KAB. DEIYAI',],
            ['kode_kab' => '91.71', 'nama_kab' => 'KOTA JAYAPURA',],
            ['kode_kab' => '92.01', 'nama_kab' => 'KAB. SORONG',],
            ['kode_kab' => '92.02', 'nama_kab' => 'KAB. MANOKWARI',],
            ['kode_kab' => '92.03', 'nama_kab' => 'KAB. FAK FAK',],
            ['kode_kab' => '92.04', 'nama_kab' => 'KAB. SORONG SELATAN',],
            ['kode_kab' => '92.05', 'nama_kab' => 'KAB. RAJA AMPAT',],
            ['kode_kab' => '92.06', 'nama_kab' => 'KAB. TELUK BINTUNI',],
            ['kode_kab' => '92.07', 'nama_kab' => 'KAB. TELUK WONDAMA',],
            ['kode_kab' => '92.08', 'nama_kab' => 'KAB. KAIMANA',],
            ['kode_kab' => '92.09', 'nama_kab' => 'KAB. TAMBRAUW',],
            ['kode_kab' => '92.10', 'nama_kab' => 'KAB. MAYBRAT',],
            ['kode_kab' => '92.11', 'nama_kab' => 'KAB. MANOKWARI SELATAN',],
            ['kode_kab' => '92.12', 'nama_kab' => 'KAB. PEGUNUNGAN ARFAK',],
            ['kode_kab' => '92.71', 'nama_kab' => 'KOTA SORONG',],

        ]);
    }
}
