<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Alamat\AlamatCont;
use App\Http\Controllers\Alamat\DesaController;
use App\Http\Controllers\Alamat\KabupatenController;
use App\Http\Controllers\Alamat\KecamatanController;
use App\Http\Controllers\Alamat\ProvinsiController;
use App\Http\Controllers\Referensi\RekeningCont;
use App\Http\Controllers\Referensi\PenandatanganCont;


// Pilih semua --> result array (banyak)
Route::get('/alamat/pilih/prov', [AlamatCont::class, 'index'])->name('getDataProv');
Route::middleware("CekRoleMiddle:1,2")->get('alamat/provinsi', [ProvinsiController::class, 'DaftarProvinsiSelect2'])->name('provinsi.select2');

Route::get('/alamat/pilih/kab/{kode_prov}', [AlamatCont::class, 'pilih_kab'])->name('getDataKab');
Route::middleware("CekRoleMiddle:1,2")->get('alamat/kabupaten/{provinsi:kode_prov}', [KabupatenController::class, 'DaftarKabupatenSelect2'])->name('kabupaten.select2');

Route::get('/alamat/pilih/kec/{kode_kab}', [AlamatCont::class, 'pilih_kec'])->name('getDataKec');
Route::middleware("CekRoleMiddle:1,2")->get('alamat/kecamatan/{kabupaten:kode_kab}', [KecamatanController::class, 'DaftarKecamatanSelect2'])->name('kecamatan.select2');

Route::get('/alamat/pilih/desa/{kode_kec}', [AlamatCont::class, 'pilih_desa'])->name('getDataDesa');
Route::middleware("CekRoleMiddle:1,2")->get('alamat/desa/{kecamatan:kode_kec}', [DesaController::class, 'DaftarDesaSelect2'])->name('desa.select2');


// Pilih 1 --> result nama
Route::get('/alamat/nama/prov', [AlamatCont::class, 'nama_prov'])->name('getNamaProv');
Route::get('/alamat/nama/kab/{kode_prov}', [AlamatCont::class, 'nama_kab'])->name('getNamaKab');
Route::get('/alamat/nama/kec/{kode_kab}', [AlamatCont::class, 'nama_kec'])->name('getNamaKec');
Route::get('/alamat/nama/desa/{kode_kec}', [AlamatCont::class, 'nama_desa'])->name('getNamaDesa');
// Harus bisa semua get rekening
Route::get('/rekening/get', [RekeningCont::class, 'get_rekening'])->name('rekening.get');
Route::get('/rekening/get/{rekening_bank}', [RekeningCont::class, 'get_rekening_one'])->name('rekening.get.one');
Route::get('/bendahara/get', [PenandatanganCont::class, 'get_bendahara'])->name('bendahara.get');
Route::get('/verifikator/get', [PenandatanganCont::class, 'get_verifikator'])->name('verifikator.get');
