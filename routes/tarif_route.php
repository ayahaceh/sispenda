<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tarif\TarifNpopTkpCont;
use App\Http\Controllers\Tarif\TarifNjopCont;
use App\Http\Controllers\Tarif\TarifBphtbCont;
use App\Http\Controllers\Transaksi\PeralihanNopCont;

Route::group(['middleware' => ['auth', 'CekRoleMiddle:1,2,3,4,5,6,7,8,9,10,11,12,13,20,30']], function () {
    // Tarif NPOP TKP
    Route::get('/tarif/npoptkp', [TarifNpopTkpCont::class, 'index'])->name('tarif.npoptkp');
    Route::POST('/tarif/npoptkp/simpan', [TarifNpopTkpCont::class, 'store'])->name('tarif.npoptkp.simpan');
    Route::get('/tarif/npoptkp/edit/{id}', [TarifNpopTkpCont::class, 'edit'])->name('tarif.npoptkp.edit');
    Route::POST('/tarif/npoptkp/update/{id}', [TarifNpopTkpCont::class, 'update'])->name('tarif.npoptkp.update');
    Route::DELETE('/tarif/npoptkp/hapus/{id}', [TarifNpopTkpCont::class, 'delete'])->name('tarif.npoptkp.hapus');

    // Tarif NJOP --> ZNT Zona Nilai Tanah
    Route::get('/tarif/njop', [TarifNjopCont::class, 'index'])->name('tarif.njop');
    Route::post('/tarif/njop/save', [TarifNjopCont::class, 'store'])->name('tarif.njop.save');
    Route::post('/tarif/njop/update/{id}', [TarifNjopCont::class, 'update'])->name('tarif.njop.update');
    Route::DELETE('/tarif/njop/hapus/{id}', [TarifNjopCont::class, 'delete'])->name('tarif.njop.delete');
    Route::get('/tarif/kodeDesaAutoComplete', [TarifNjopCont::class, 'kodeDesaAutoComplete'])->name('tarif.kodeDesaAutoComplete');

    // Tarif PBB --> Tarifnya berbentuk tunggal / Persen
    Route::get('/tarif/bphtb', [TarifBphtbCont::class, 'index'])->name('tarif.bphtb');
    Route::get('/tarif/bphtb/simpan', [TarifBphtbCont::class, 'store'])->name('tarif.bphtb.simpan');
    Route::get('/tarif/bphtb/edit/{id}', [TarifBphtbCont::class, 'edit'])->name('tarif.bphtb.edit');
    Route::post('/tarif/bphtb/update/{id}', [TarifBphtbCont::class, 'update'])->name('tarif.bphtb.update');
    Route::get('/tarif/bphtb/hapus/{id}', [TarifBphtbCont::class, 'delete'])->name('tarif.bphtb.delete');

    Route::get('/stpd/terakhir/{kode_desa}', [PeralihanNopCont::class, 'getUrutStpd'])->name('stpd.terakhir');





    //-- 
});
