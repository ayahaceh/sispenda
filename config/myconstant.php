<?php
/*
    |--------------------------------------------------------------------------
    | KONSTANSTA GLOBAL UNTUK DIPAKAI SECARA GLOBAL
    |--------------------------------------------------------------------------
    |
    | Ada beberapa jenis konstanta global pada aplikasi ini :
    | 1. User_Group         => Menentukan id user_group, tabel (user_group)
    | 2. Jenis Profil       => Menentukan kelompok profil (mengambil user_group juga)
    | 3.        =>
    | 4.        =>
    | 5.        =>
    */
/*
    |--------------------------------------------------------------------------
    | 1. UNTUK MENENTUKAN USER_GROUP (GROUP USER/PEJABAT) (tabel : user_group)
    |--------------------------------------------------------------------------
    |
*/

define('USER_SUPER_ADMIN', 1);
define('USER_ADMIN', 2);
define('USER_OPERATOR', 3);
define('USER_KABID', 4);
define('USER_KABAN', 5);
define('USER_PPAT', 6);
define('USER_WAJIB_PAJAK', 7);
define('USER_BPN', 8);
define('USER_PUBLIK', 9);
// Untuk user PBB
define('USER_SUPER_ADMIN_PBB', 11);
define('USER_ADMIN_PBB', 12);
define('USER_OPERATOR_PBB', 13);
define('USER_KABID_PBB', 14);
define('USER_KABAN_PBB', 15);
define('USER_PPAT_PBB', 16);
define('USER_WAJIB_PAJAK_PBB', 17);
define('USER_BPN_PBB', 18);
define('USER_PUBLIK_PBB', 19);
/*
    |--------------------------------------------------------------------------
    | 2. UNTUK MENENTUKAN KELOMPOK PROFIL (mengambil user_group juga)
    |--------------------------------------------------------------------------
    |
*/

define('PROFIL_SUPER_ADMIN', 1);
define('PROFIL_ADMIN', 2);
define('PROFIL_OPERATOR', 3);
define('PROFIL_KABID', 4);
define('PROFIL_KABAN', 5);
define('PROFIL_PPAT', 6);
define('PROFIL_WAJIB_PAJAK', 7);
define('PROFIL_BPN', 8);
define('PROFIL_PUBLIK', 9);

/*
    |--------------------------------------------------------------------------
    | 3. UNTUK MENENTUKAN STATUS PROFIL USER / PROFIL WP
    |--------------------------------------------------------------------------
    |
*/
define('STATUS_PROFIL_TIDAK_AKTIF', 'Tidak Aktif');
define('STATUS_PROFIL_BELUM_VERIFIKASI', "Belum Diverifikasi");
define('STATUS_PROFIL_TIDAK_VALID', 'Tidak Valid');
define('STATUS_PROFIL_VALID', 'Valid');

/*
    |--------------------------------------------------------------------------
    | 4. UNTUK MENENTUKAN STATUS NOP AKTIF ATAU TIDAK
    |--------------------------------------------------------------------------
*/
define('STATUS_NOP_AKTIF', '1');
define('STATUS_NOP_TIDAK_AKTIF', '2');
define('STATUS_NOP_TIDAK_VALID', '3');
define('STATUS_NOP_DIAJUKAN', '4');

/*
    |--------------------------------------------------------------------------
    | 5. UNTUK MENENTUKAN STATUS BPHTB SUDAH DI APRROVE ATAU BELUM (KOLOM APPROVED)
    |--------------------------------------------------------------------------
*/
// define('STATUS_BPHTB_APPROVED', 'Disetujui');
// define('STATUS_BPHTB_BELUM_APPROVE', "Belum Disetujui");
/*
    |--------------------------------------------------------------------------
    | 6. UNTUK MENENTUKAN STATUS TRANSAKSI PERALIHAN BPHTB  LUNAS ATAU BELUM (KOLOM STATUS TRANSAKSI)
    |--------------------------------------------------------------------------
*/
define('STATUS_TRANSAKSI_LUNAS', 'Lunas');
define('STATUS_TRANSAKSI_BELUM_LUNAS', 'Belum Lunas');

/*
    |--------------------------------------------------------------------------
    | 7. UNTUK MENENTUKAN STATUS VERIFIKASI TRANSAKSI (KOLOM STATUS VERIFIKASI)
    |--------------------------------------------------------------------------
    |
*/
define('STATUS_PEMBAYARAN_SUDAH_VERIFIKASI', 'Sudah Verifikasi');
define('STATUS_PEMBAYARAN_BELUM_VERIFIKASI', 'Belum Verifikasi');




/*
    |--------------------------------------------------------------------------
    | 5. UNTUK MENENTUKAN STATUS USER (LOGIN/BARU DAFTAR),
    |--------------------------------------------------------------------------
    |
*/

define('STATUS_USER_AKTIF', 1);
define('STATUS_USER_BELUM_PROFIL', 2);
define('STATUS_USER_BARU_DAFTAR', 3);
define('STATUS_USER_DIBLOKIR', 4);

/*
    |--------------------------------------------------------------------------
    | 6. UNTUK MENENTUKAN LOG TABEL MANA (Log hanya mencatat edit/hapus/) serta kegiatan lainnya
    |--------------------------------------------------------------------------
    |
*/

define('LOGS_PROFIL', 'Profil WP');
define('LOGS_NOP', 'Objek Pajak');
define('LOGS_PERALIHAN', 'BPHTB');
define('LOGS_TARIF_NPOPTKP', 'NPOPTKP');
define('LOGS_TARIF_ZNT', 'ZNT');
define('LOGS_TARIF_BPHTB', 'Tarif BPHTB');
define('LOGS_PENDAFTARAN', 'Pendaftaran User');
define('LOGS_USERS', 'User');
define('LOGS_WEB', 'Web Publik');
define('LOGS_REKENING', 'Rekening');
define('LOGS_LAINNYA', 'Lainnya');

/*
    |--------------------------------------------------------------------------
    | 7. Untuk menentukan definisi nama setting pada tabel setting_app
    |
    |--------------------------------------------------------------------------
    |
*/
define('COPYRIGHT_ACCOUNT', '@alidata_id');
define('COPYRIGHT_WEB', 'www.alidata.co.id');

/*
    |--------------------------------------------------------------------------
    | 8. Jenis Notifikasi Telegram
    |
    |--------------------------------------------------------------------------
    |
*/

define('NOTIF_KEPADA_SUPERADMIN', 1);
define('NOTIF_KEPADA_INTERNAL', 2);
define('NOTIF_KEPADA_PPAT', 3);
define('NOTIF_KEPADA_WP', 4);
define('NOTIF_KEPADA_OPERATOR', 5);

// define('NOTIF_PENGAJUAN', 3);
// define('NOTIF_PEMBAYARAN', 4);
// define('NOTIF_PPAT_PENGAJUAN_DITERIMA', 5);
// define('NOTIF_PPAT_PENGAJUAN_DITOLAK', 6);
// define('NOTIF_PPAT_PEMBAYARAN_DITERIMA', 7);
// define('NOTIF_PPAT_PEMBAYARAN_DITOLAK', 8);
// define('NOTIF_PPAT_PEMBAYARAN_D', 9);

/*
    |--------------------------------------------------------------------------
    | 8. Status Tanda Terima
    |
    |--------------------------------------------------------------------------
    |
*/
define('NOTIFIKASI_USER_DITERIMA', 1);
define('NOTIFIKASI_USER_DITOLAK', 2);

// ============================================================================
// ============================================================================
/*
    |--------------------------------------------------------------------------
    | 8. REVISI TABEL BPHTB
    |
    |--------------------------------------------------------------------------
    |
*/
// KOLOM STATUS_PEMBAYARAN
define('STATUS_PEMBAYARAN_BELUM_BAYAR', 'Belum Dibayar');
define('STATUS_PEMBAYARAN_SEDANG_VERIFIKASI', 'Sedang Diverifikasi');
define('STATUS_PEMBAYARAN_LUNAS', 'Lunas');
// KOLOM STATUS_BPHTB
define('STATUS_BPHTB_BELUM_VERIFIKASI', 'Belum Diverifikasi');
define('STATUS_BPHTB_SUDAH_VERIFIKASI', 'Sudah Diverifikasi');
define('STATUS_BPHTB_BELUM_DISETUJUI', 'Belum Disetujui');
define('STATUS_BPHTB_SUDAH_DISETUJUI', 'Sudah Disetujui');
// KOLOM STATUS_PBB
define('STATUS_PBB_BELUM_VERIFIKASI', 'Belum Diverifikasi');
define('STATUS_PBB_SUDAH_VERIFIKASI', 'Sudah Diverifikasi');
define('STATUS_PBB_BELUM_DISETUJUI', 'Belum Disetujui');
define('STATUS_PBB_SUDAH_DISETUJUI', 'Sudah Disetujui');

// TABEL PENANDATANGAN
define('PETUGAS_TTD_BPHTB_VERIFIKASI', 'diverifikasi');
define('PETUGAS_TTD_BPHTB_BENDAHARA', 'diterima');

// UKURAN KERTAS
define('KERTAS_PBB_TINGGI', 721.88976378); // 191mm
define('KERTAS_PBB_LEBAR', 672.75590551); //178mm
define('KERTAS_PBB_P_T', 11.338582677); //3mm
define('KERTAS_PBB_P_B', 11.338582677); //3mm


return [

    // 'your-returned-const' => 'Your returned constant value!'

];
