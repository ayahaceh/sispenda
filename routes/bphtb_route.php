<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Bphtb\AdminBphtbCont;
use App\Http\Controllers\Bphtb\BatalBphtbCont;
use App\Http\Controllers\Bphtb\VerifikasiBphtbCont;
use App\Http\Controllers\Bphtb\LaporanBphtbCont;
use App\Http\Controllers\Bphtb\NomorBerurutCont;
use App\Http\Controllers\Bphtb\ReportCont;
use App\Http\Controllers\Bphtb\WpBphtbCont;
use App\Http\Controllers\DashboardCont;
use App\Http\Controllers\Transaksi\PpatPeralihanCont;

Route::group(['middleware' => ['auth', 'CekRoleMiddle:1,2,3,4,5']], function () {
    // ROUTE UNTUK INPUT KE TABEL BPHTB (TRANSAKSI BPHTB)
    Route::get('/bphtb', [AdminBphtbCont::class, 'index'])->name('bphtb'); // list
    Route::get('/bphtb/show/{id}', [AdminBphtbCont::class, 'show'])->name('bphtb.show'); // Lihat
    Route::get('/bphtb/laporan/{id}', [LaporanBphtbCont::class, 'create'])->name('bphtb.laporan'); // Cetak
    // Export
    Route::get('/bphtb/export', [AdminBphtbCont::class, 'export'])->name('bphtb.export');
    // cek tarif
    Route::get('/bphtb/kalkulasi-bphtb', [AdminBphtbCont::class, 'kalkulasi_bphtb'])->name('bphtb.kalkulasi-bphtb'); // Cek Tarif 
    // Laporan BPHTB
    Route::get('/laporan/bphtb/ringkasan/kas', [ReportCont::class, 'index'])->name('laporan.bphtb.ringkasan.kas');
    Route::get('/laporan/bphtb/ringkasan/get_laporan_ringkasan', [ReportCont::class, 'getLaporanRingkasan'])->name('laporan.bphtb.ringkasan.getLaporanRingkasan');
    Route::get('/laporan/bphtb/rekap/kas', [ReportCont::class, 'rekap_kas'])->name('laporan.bphtb.rekap.kas');
    // Route::get('/laporan/bphtb/rekap/kas', [ReportCont::class, 'rekap_kas'])->name('laporan.bphtb.rekap.kas');
    //-- 
});

Route::group(['middleware' => ['auth', 'CekRoleMiddle:1,2,3']], function () {
    // ROUTE UNTUK INPUT KE TABEL BPHTB (EDIT DAN UPDATE)
    Route::get('/bphtb/add', [AdminBphtbCont::class, 'create'])->name('bphtb.add'); // create
    Route::post('/bphtb/store', [AdminBphtbCont::class, 'store'])->name('bphtb.store'); // store
    Route::get('/bphtb/edit/{id}', [AdminBphtbCont::class, 'edit'])->name('bphtb.edit'); // Edit
    Route::POST('/bphtb/update/{id}', [AdminBphtbCont::class, 'update'])->name('bphtb.update'); // Update
    //--
});
Route::group(['middleware' => ['auth', 'CekRoleMiddle:1,2']], function () {
    // ROUTE UNTUK INPUT KE TABEL BPHTB (DELETE DAN RESTORE)
    Route::get('/bphtb/delete/{id}', [AdminBphtbCont::class, 'delete'])->name('bphtb.delete'); // Delete
    Route::get('/bphtb/restore/{id}', [AdminBphtbCont::class, 'restore'])->name('bphtb.restore'); // Restore

    // ROUTE UNTUK MEMBATALKAN BPHTB YANG SUDAH LUNAS DAN DISETUJUI
    Route::get('/bphtb/pembatalan', [BatalBphtbCont::class, 'index'])->name('bphtb.pembatalan.index');
    Route::POST('/bphtb/pembatalan', [BatalBphtbCont::class, 'index'])->name('bphtb.pembatalan.post'); // Update
    Route::POST('/bphtb/pembatalan/update/{id}', [BatalBphtbCont::class, 'update'])->name('bphtb.pembatalan.update'); // Update

    //--
});

Route::group(['middleware' => ['auth', 'CekRoleMiddle:1,2,3,4,5']], function () {
    // ROUTE UNTUK VERIFIKASI BPHTB (TRANSAKSI BPHTB)
    Route::get('/bphtb/verifikasi', [VerifikasiBphtbCont::class, 'index'])->name('bphtb.verifikasi'); // list
    Route::get('/bphtb/verifikasi/show/{id}', [VerifikasiBphtbCont::class, 'show'])->name('bphtb.verifikasi.show'); // Lihat
    Route::get('/bphtb/verifikasi/edit/{id}', [VerifikasiBphtbCont::class, 'edit'])->name('bphtb.verifikasi.edit'); // Lihat
    Route::POST('/bphtb/verifikasi/update/{id}', [VerifikasiBphtbCont::class, 'update'])->name('bphtb.verifikasi.update'); // Update

    //--
});

// PPAT
Route::group(['middleware' => ['auth', 'CekRoleMiddle:6']], function () {
    Route::get('/ppat/bphtb', [PpatPeralihanCont::class, 'index'])->name('ppat.bphtb');
    Route::get('/ppat/bphtb/add', [PpatPeralihanCont::class, 'create'])->name('ppat.bphtb.create');
    Route::post('/ppat/bphtb/store', [PpatPeralihanCont::class, 'store'])->name('ppat.bphtb.store');
    Route::get('/ppat/bphtb/show/{id}', [PpatPeralihanCont::class, 'show'])->name('ppat.bphtb.show');
    Route::get('/ppat/bphtb/edit/{id}', [PpatPeralihanCont::class, 'edit'])->name('ppat.bphtb.edit');
    Route::post('/ppat/bphtb/update/{id}', [PpatPeralihanCont::class, 'update'])->name('ppat.bphtb.update');
    Route::get('/ppat/bphtb/delete/{id}', [PpatPeralihanCont::class, 'delete'])->name('ppat.bphtb.delete');
    Route::get('/ppat/bphtb/pembayaran/{id}', [PpatPeralihanCont::class, 'upload_bukti_show'])->name('ppat.bphtb.pembayaran.show');
    Route::post('/ppat/bphtb/pembayaran/store/{id}', [PpatPeralihanCont::class, 'upload_bukti_store'])->name('ppat.bphtb.pembayaran.store');
});

// WP
Route::group(['middleware' => ['auth', 'CekRoleMiddle:7']], function () {
    Route::get('/wp/bphtb', [WpBphtbCont::class, 'index'])->name('wp.bphtb');
    Route::get('/wp/bphtb/temp/lihat/{id}', [WpBphtbCont::class, 'show_temp'])->name('wp.bphtb-temp.show');
    Route::get('/wp/bphtb/lihat/{id}', [WpBphtbCont::class, 'show'])->name('wp.bphtb.show');
    Route::get('/wp/bphtb/lihat/edit/{id}', [WpBphtbCont::class, 'edit'])->name('wp.bphtb.edit');
    Route::get('/wp/bphtb/tambah', [WpBphtbCont::class, 'create'])->name('wp.bphtb.create');
    Route::post('/wp/bphtb/simpan', [WpBphtbCont::class, 'store'])->name('wp.bphtb.store');
    Route::post('/wp/bphtb/edit/{id}', [WpBphtbCont::class, 'update'])->name('wp.bphtb.update');
    Route::get('/wp/bphtb/hapus/{id}', [WpBphtbCont::class, 'delete'])->name('wp.bphtb.delete');
    Route::get('/wp/bphtb/pembayaran/{id}', [WpBphtbCont::class, 'upload_bukti_show'])->name('wp.bphtb.pembayaran.show');
    Route::post('/wp/bphtb/pembayaran/store/{id}', [WpBphtbCont::class, 'upload_bukti_store'])->name('wp.bphtb.pembayaran.store');
});


// Upload bukti setor


Route::group(['middleware' => ['auth', 'CekRoleMiddle:1,2,3,6,7']], function () {
    // get autocomplete
    Route::get('/bphtb/cari-wp', [AdminBphtbCont::class, 'search_wp'])->name('bphtb.search-wp'); // Cari WP
    Route::get('/bphtb/cari-nop', [AdminBphtbCont::class, 'search_nop'])->name('bphtb.search-nop'); // Cari NOP
});

Route::get('/nomor-berikutnya', [NomorBerurutCont::class, 'nomor_berikutnya'])->name('nomor-berikutnya');


//--