<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardCont;
use App\Http\Controllers\Verifikasi\VerifikasiUserCont;
use App\Http\Controllers\Verifikasi\VerifikasiProfilCont;
use App\Http\Controllers\Verifikasi\VerifikasiNopCont;
use App\Http\Controllers\Verifikasi\VerifikasiTransaksiCont;

Route::group(['middleware' => ['auth', 'CekRoleMiddle:1']], function () {
    Route::get('/superadmin', [DashboardCont::class, 'superadmin'])->name('dash.superadmin');
}); // --
Route::group(['middleware' => ['auth', 'CekRoleMiddle:1,2']], function () {
    Route::get('/admin', [DashboardCont::class, 'admin'])->name('dash.admin');
}); // --
Route::group(['middleware' => ['auth', 'CekRoleMiddle:1,3']], function () {
    Route::get('/operator', [DashboardCont::class, 'operator'])->name('dash.operator');
}); // --
Route::group(['middleware' => ['auth', 'CekRoleMiddle:1,4,5']], function () {
    Route::get('/monitoring', [DashboardCont::class, 'monitoring'])->name('dash.monitoring');
}); // --
Route::group(['middleware' => ['auth', 'CekRoleMiddle:1,6']], function () {
    Route::get('/ppat', [DashboardCont::class, 'ppat'])->name('dash.ppat');
}); // --
Route::group(['middleware' => ['auth', 'CekRoleMiddle:1,7']], function () {
    Route::get('/wp', [DashboardCont::class, 'wp'])->name('dash.wp');
}); // --
Route::group(['middleware' => ['auth', 'CekRoleMiddle:1,8']], function () {
    Route::get('/bpn', [DashboardCont::class, 'bpn'])->name('dash.bpn');
}); // --
Route::group(['middleware' => ['auth', 'CekRoleMiddle:1,9']], function () {
    Route::get('/public', [DashboardCont::class, 'publik'])->name('dash.publik');
}); // --

// Verifikasi Pendaftaran User, Profil, NOP, dan Pengajuan Transaksi
Route::group(['middleware' => ['auth', 'CekRoleMiddle:1,2,4,5']], function () {

    // Verifikasi Account user
    Route::get('/verifikasi/user', [VerifikasiUserCont::class, 'index'])->name('verifikasi.user');
    Route::get('/verifikasi/user/lihat/{id}', [VerifikasiUserCont::class, 'user_lihat'])->name('verifikasi.user.lihat');
    Route::get('/verifikasi/user/update/{id}', [VerifikasiUserCont::class, 'user_update'])->name('verifikasi.user.update');

    // Verifikasi Profil User
    Route::get('/verifikasi/profil', [VerifikasiProfilCont::class, 'profil'])->name('verifikasi.profil');
    Route::get('/verifikasi/profil/lihat/{id}', [VerifikasiProfilCont::class, 'profil_lihat'])->name('verifikasi.profil.lihat');
    Route::get('/verifikasi/profil/update/{id}', [VerifikasiProfilCont::class, 'profil_update'])->name('verifikasi.profil.update');

    // Verifikasi NOP
    Route::get('/verifikasi/nop', [VerifikasiNopCont::class, 'nop'])->name('verifikasi.nop');
    Route::get('/verifikasi/nop/lihat/{id}', [VerifikasiNopCont::class, 'nop_lihat'])->name('verifikasi.nop.lihat');
    Route::get('/verifikasi/nop/update/{id}', [VerifikasiNopCont::class, 'nop_update'])->name('verifikasi.nop.update');

    // Verifikasi Transaksi Peralihan BPHTB
    Route::get('/verifikasi/transaksi', [VerifikasiTransaksiCont::class, 'transaksi'])->name('verifikasi.transaksi');
    Route::get('/verifikasi/transaksi/lihat/{id}', [VerifikasiTransaksiCont::class, 'transaksi_lihat'])->name('verifikasi.transaksi.lihat');
    Route::get('/verifikasi/transaksi/update/{id}', [VerifikasiTransaksiCont::class, 'transaksi_update'])->name('verifikasi.transaksi.update');
});
