<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Referensi\RekeningCont;
use App\Http\Controllers\BpnCont;
use App\Http\Controllers\LogsCont;
use App\Http\Controllers\Referensi\PenandatanganCont;
use App\Http\Controllers\Select2Cont;

Route::group(['middleware' => ['auth', 'CekRoleMiddle:1,2,3']], function () {
    // Ref REKENING
    Route::get('/rekening', [RekeningCont::class, 'index'])->name('rekening');
    Route::get('/rekening/lihat/{id}', [RekeningCont::class, 'view'])->name('rekening.lihat');
    Route::get('/rekening/cari', [RekeningCont::class, 'index'])->name('rekening.cari');
    //-- 
});

Route::group(['middleware' => ['auth', 'CekRoleMiddle:1,2']], function () {
    // Ref REKENING
    Route::get('/rekening/tambah', [RekeningCont::class, 'create'])->name('rekening.tambah');
    Route::POST('/rekening/simpan', [RekeningCont::class, 'store'])->name('rekening.simpan');
    Route::get('/rekening/edit/{id}', [RekeningCont::class, 'edit'])->name('rekening.edit');
    Route::DELETE('/rekening/hapus/{id}', [RekeningCont::class, 'hapus'])->name('rekening.hapus');
    Route::POST('/rekening/update/{id}', [RekeningCont::class, 'update'])->name('rekening.update');
    //-- 
});

Route::group(['middleware' => ['auth', 'CekRoleMiddle:1,2,3,4,5']], function () {
    // Ref REKENING
    Route::get('/petugas', [PenandatanganCont::class, 'index'])->name('petugas');
    Route::get('/petugas/tambah', [PenandatanganCont::class, 'create'])->name('petugas.tambah');
    Route::POST('/petugas/simpan', [PenandatanganCont::class, 'store'])->name('petugas.simpan');
    Route::get('/petugas/cari', [PenandatanganCont::class, 'index'])->name('petugas.cari');
    //-- 
});

Route::group(['middleware' => ['auth', 'CekRoleMiddle:1,2']], function () {
    // Ref REKENING
    Route::get('/petugas/hapus/{id}', [PenandatanganCont::class, 'hapus'])->name('petugas.hapus');
    Route::POST('/petugas/update/{id}', [PenandatanganCont::class, 'update'])->name('petugas.update');
    //-- 
});

// ROUTE KHUSUS BPN DAN AKUN PUBLIK LAINNYA
Route::group(['middleware' => ['auth', 'CekRoleMiddle:1,8,9']], function () {
    Route::get('/bpn-publik', [BpnCont::class, 'index'])->name('bpn.publik');
    Route::get('/bpn-publik/bphtb/semua', [BpnCont::class, 'semua'])->name('bpn.publik.semua');
    Route::get('/bpn-publik/bphtb/bulan-ini', [BpnCont::class, 'bulan_ini'])->name('bpn.publik.bulan-ini');
    Route::get('/bpn-publik/bphtb/filter', [BpnCont::class, 'filter'])->name('bpn.publik.filter');
    Route::get('/bpn-publik/bphtb/lihat/{id}', [BpnCont::class, 'show'])->name('bpn.publik.lihat');
    Route::get('/bpn-publik/bphtb/eksport', [BpnCont::class, 'export'])->name('bpn.publik.eksport');
    //-- 
});

// ROUTE KHUSUS Logs (Aktivitas User)
Route::group(['middleware' => ['auth', 'CekRoleMiddle:1,2,4,5']], function () {
    Route::get('/logs', [LogsCont::class, 'index'])->name('my.logs');
    Route::get('/logs/operator', [LogsCont::class, 'operator'])->name('logs.operator');
    Route::get('/logs/admin', [LogsCont::class, 'admin'])->name('logs.admin');
    Route::get('/logs/pejabat', [LogsCont::class, 'pejabat'])->name('logs.pejabat');
    Route::get('/logs/ppat', [LogsCont::class, 'ppat'])->name('logs.ppat');
    Route::get('/logs/publik', [LogsCont::class, 'publik'])->name('logs.publik');
    Route::get('/logs/semua', [LogsCont::class, 'semua_logs'])->name('logs.semua');
    Route::get('/logs/lihat/{id}', [LogsCont::class, 'show'])->name('logs.lihat');
    //-- 
});

// ROUTE KHUSUS Logs (Aktivitas User)
Route::group(['middleware' => ['auth', 'CekRoleMiddle:1,2,3,4,5']], function () {
    Route::get('/logs', [LogsCont::class, 'index'])->name('my.logs');
    Route::get('/logs/operator', [LogsCont::class, 'operator'])->name('logs.operator');
    Route::get('/logs/ppat', [LogsCont::class, 'ppat'])->name('logs.ppat');
    Route::get('/logs/publik', [LogsCont::class, 'publik'])->name('logs.publik');
    Route::get('/logs/semua', [LogsCont::class, 'semua_logs'])->name('logs.semua');
    Route::get('/logs/lihat/{id}', [LogsCont::class, 'show'])->name('logs.lihat');
    //-- 
});

// ROUTE KHUSUS Logs (Aktivitas User)
Route::group(['middleware' => ['auth', 'CekRoleMiddle:1,2']], function () {
    Route::DELETE('/logs/hapus/{id}', [LogsCont::class, 'hapus'])->name('logs.hapus');
    Route::get('/logs/hapus/semua', [LogsCont::class, 'kosongkan'])->name('logs.hapus.all');
    //-- 
});

Route::get('/select2/get-kec', [Select2Cont::class, 'getKec'])->name('select2.get-kec');
Route::get('/select2/get-desa', [Select2Cont::class, 'getDesa'])->name('select2.get-desa');
