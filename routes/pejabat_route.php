<?php

// use App\Http\Controllers\Bphtb\AdminBphtbCont;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Petunjuk\PetunjukCont;
use App\Http\Controllers\Transaksi\ApprovePeralihanCont;
use App\Http\Controllers\Transaksi\RekapCont;


Route::group(['middleware' => ['auth', 'CekRoleMiddle:1,2,4,5']], function () {
    // Hanya bisa diakses sama Pejabat Kabid dan Kaban

    Route::get('/pejabat/bphtb/belum-approve', [ApprovePeralihanCont::class, 'belum_approve'])->name('pejabat.bphtb.belum-approve');
    Route::get('/pejabat/bphtb/sudah-approve', [ApprovePeralihanCont::class, 'sudah_approve'])->name('pejabat.bphtb.sudah-approve');
    Route::get('/pejabat/bphtb/semua', [ApprovePeralihanCont::class, 'semua'])->name('pejabat.bphtb.semua');
    Route::get('/pejabat/bphtb/lihat/{id}', [ApprovePeralihanCont::class, 'show'])->name('pejabat.bphtb.lihat');
    Route::get('/pejabat/bphtb/approve/{id}', [ApprovePeralihanCont::class, 'approve'])->name('pejabat.bphtb.approve');
    //-- 
});

Route::group(['middleware' => ['auth', 'CekRoleMiddle:1,2,3,4,5,6,7,8,9,10']], function () {
    Route::get('/ringkasan/bphtb/kas', [RekapCont::class, 'index'])->name('ringkasan.bphtb.kas');
    Route::get('/ringkasan/bphtb/get_laporan_ringkasan', [RekapCont::class, 'getLaporanRingkasan'])->name('ringkasan.bphtb.getLaporanRingkasan');
    //-- 
});
