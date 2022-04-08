<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pbb\AdminPbbCont;
use App\Http\Controllers\Pbb\ExportPbbController;
use App\Http\Controllers\Pbb\GeneratePbbController;
use App\Http\Controllers\Pbb\MakePdfPbbController;

// Cek NIK dan NOP Ujicoba
use App\Http\Controllers\Bphtb\CekNikNopCont;

Route::get('/cek-nik', [CekNikNopCont::class, 'index'])->name('cek-nik'); // Cek NIK
Route::post('/cek-nik-hasil', [CekNikNopCont::class, 'cek'])->name('cek-nik-hasil'); // Cek NIK


Route::group(['middleware' => ['auth', 'CekRoleMiddle:1,2,3,4,5,6,7,8,9,10,11,12,20,30']], function () {

    Route::middleware("CekRoleMiddle:1,2")->get('/pbb', [AdminPbbCont::class, 'index'])->name('pbb');  // LIST PBB
    Route::get('/pbb/edit/{pbb}', [AdminPbbCont::class, 'edit'])->name('pbb.edit'); // EDIT PBB
    Route::put('/pbb/update/{pbb}', [AdminPbbCont::class, 'update'])->name('pbb.update'); // UPDATE PBB
    Route::get('/pbb/lihat/{pbb}', [AdminPbbCont::class, 'show'])->name('pbb.lihat'); // LIHAT PBB
    Route::get('/pbb/print/{pbb}/{type}', [AdminPbbCont::class, 'print'])->name('pbb.print'); // PRINT  PBB


    Route::post('/pbb/generate', [GeneratePbbController::class, 'index'])->name('pbb.generate'); //GENERATE PBB
    Route::post('/pbb/export/excel', [ExportPbbController::class, 'toExcel'])->name('pbb.export-excel'); //EXPORT EXCEL PBB
    Route::get('/pbb/pdf/{pbb}', [MakePdfPbbController::class, 'showPdf'])->name('pbb.pdf'); // PDF PBB
    Route::get('/pbb/pdf-stts/{pbb}', [MakePdfPbbController::class, 'sttsPdf'])->name('pbb.pdf-stts'); // PDF PBB

    Route::post('/pbb/store', [AdminPbbCont::class, 'store'])->name('pbb.store'); // store
    Route::post('/pbb/delete/{id}', [AdminPbbCont::class, 'delete'])->name('pbb.delete'); // Delete
    Route::get('/pbb/restore/{id}', [AdminPbbCont::class, 'restore'])->name('pbb.restore'); // Restore
    Route::get('/pbb/laporan/{id}', [AdminPbbCont::class, 'laporan'])->name('pbb.laporan'); // Cetak

    // get autocomplete
    Route::get('/pbb/cari-wp', [AdminPbbCont::class, 'search_wp'])->name('pbb.search-wp'); // Cari WP
    Route::get('/pbb/cari-nop', [AdminPbbCont::class, 'search_nop'])->name('pbb.search-nop'); // Cari NOP

    // cek tarif
    Route::get('/pbb/kalkulasi-pbb', [AdminPbbCont::class, 'kalkulasi_pbb'])->name('pbb.kalkulasi-pbb'); // Cek Tarif
    //--
});
