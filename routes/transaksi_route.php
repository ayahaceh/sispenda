<?php

use App\Http\Controllers\Bphtb\AdminBphtbCont;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Transaksi\TransaksiPeralihanCont;
use App\Http\Controllers\Transaksi\PpatPeralihanCont;
use App\Http\Controllers\Transaksi\LaporanPeralihanCont;

use App\Http\Controllers\Profil\PpatProfilUserCont;
use App\Http\Controllers\Nop\PpatNopPbbCont;
use App\Http\Controllers\Profil\ProfilUserCont;

Route::group(['middleware' => ['auth', 'CekRoleMiddle:1,2,3,4,5,6,7,8,9,10,11,12,20,30']], function () {
    // Transaksi Peralihan NOP (Transaksi BPHTB)
    Route::get('/transaksi/peralihan', [TransaksiPeralihanCont::class, 'index'])->name('transaksi.peralihan');
    Route::get('/transaksi/peralihan/show/{id}', [TransaksiPeralihanCont::class, 'show'])->name('transaksi.peralihan.show');
    Route::get('/transaksi/peralihan/tambah', [TransaksiPeralihanCont::class, 'create'])->name('transaksi.peralihan.tambah');
    Route::POST('/transaksi/peralihan/simpan', [TransaksiPeralihanCont::class, 'store'])->name('transaksi.peralihan.store');
    Route::get('/transaksi/peralihan/edit/{id}', [TransaksiPeralihanCont::class, 'edit'])->name('transaksi.peralihan.edit');
    Route::PUT('/transaksi/peralihan/update/{id}', [TransaksiPeralihanCont::class, 'update'])->name('transaksi.peralihan.update');
    Route::get('/transaksi/peralihan/export', [TransaksiPeralihanCont::class, 'export'])->name('transaksi.peralihan.export');
    Route::DELETE('/transaksi/peralihan/hapus/{id}', [TransaksiPeralihanCont::class, 'hapus'])->name('transaksi.peralihan.hapus');
    Route::get('/transaksi/peralihan/find/{id}', [TransaksiPeralihanCont::class, 'find'])->name('transaksi.peralihan.find');
    Route::get('/transaksi/laporan/{id}', [LaporanPeralihanCont::class, 'create'])->name('transaksi.peralihan.laporan');
});

// Untuk Route BPHTB PPAT 6
Route::group(['middleware' => ['auth', 'CekRoleMiddle:1,6']], function () {
    // Transaksi Peralihan NOP (Transaksi BPHTB) oleh PPAT
    Route::get('/ppat/peralihan', [PpatPeralihanCont::class, 'index'])->name('ppat.peralihan');
    Route::get('/ppat/peralihan/show/{id}', [PpatPeralihanCont::class, 'show'])->name('ppat.peralihan.show');
    Route::get('/ppat/bphtb/tambah', [PpatPeralihanCont::class, 'bphtb_create'])->name('ppat.bphtb.create');

    // Cari NOP dan WP
    Route::get('/ppat/bphtb/cari-wp', [AdminBphtbCont::class, 'search_wp'])->name('bphtb.search-wp'); // Cari WP
    Route::get('/ppat/bphtb/cari-nop', [AdminBphtbCont::class, 'search_nop'])->name('bphtb.search-nop'); // Cari NOP

    // Route::POST('/ppat/peralihan/simpan', [PpatPeralihanCont::class, 'store'])->name('ppat.peralihan.store');
    // Route::get('/ppat/peralihan/edit/{id}', [PpatPeralihanCont::class, 'edit'])->name('ppat.peralihan.edit');
    Route::PUT('/ppat/peralihan/update_bukti_pembayaran/{id}', [PpatPeralihanCont::class, 'update_bukti_pembayaran'])->name('ppat.peralihan.update_bukti_pembayaran');
    Route::POST('/ppat/peralihan/pembayaran/upload/{id}', [PpatPeralihanCont::class, 'upload_pembayaran'])->name('ppat.pembayaran.upload');
    Route::get('/ppat/peralihan/export', [PpatPeralihanCont::class, 'export'])->name('ppat.peralihan.export');
    // Route::DELETE('/ppat/peralihan/hapus/{id}', [PpatPeralihanCont::class, 'hapus'])->name('ppat.peralihan.hapus');
    // Route::get('/ppat/peralihan/find/{id}', [PpatPeralihanCont::class, 'find'])->name('ppat.peralihan.find');
    // Route::get('/ppat/laporan/{id}', [LaporanPeralihanCont::class, 'create'])->name('ppat.peralihan.laporan');

    // Profil User
    Route::get('/ppat/profil/user', [PpatProfilUserCont::class, 'index'])->name('ppat.profil.user');
    Route::get('/ppat/profil/user/lihat/{id}', [PpatProfilUserCont::class, 'show'])->name('ppat.profil.user.lihat');
    Route::get('/ppat/profil/user/tambah', [PpatProfilUserCont::class, 'create'])->name('ppat.profil.user.tambah');
    Route::POST('/ppat/profil/user/simpan', [PpatProfilUserCont::class, 'store'])->name('ppat.profil.user.simpan');
    // Edit Data Diri
    Route::put('/ppat/profil/user/update-data-diri/{id}', [PpatProfilUserCont::class, 'updateDataDiri'])->name('ppat.profil.user.updateDataDiri');
    // Edit Tempat Tinggal
    Route::put('/ppat/profil/user/update-tempat-tinggal/{id}', [PpatProfilUserCont::class, 'updateTempatTinggal'])->name('ppat.profil.user.updateTempatTinggal');
    // Edit Kontak
    Route::put('/ppat/profil/user/update-kontak/{id}', [PpatProfilUserCont::class, 'updateKontak'])->name('ppat.profil.user.updateKontak');
    // Edit Berkas Identitas
    Route::put('/ppat/profil/user/update-berkas-identitas/{id}', [PpatProfilUserCont::class, 'updateBerkasIdentitas'])->name('ppat.profil.user.updateBerkasIdentitas');
    // Edit Status Profil
    Route::put('/ppat/profil/user/update-status-profil/{id}', [PpatProfilUserCont::class, 'updateStatusProfil'])->name('ppat.profil.user.updateStatusProfil');

    Route::get('/ppat/profil/user/edit/{id}', [PpatProfilUserCont::class, 'edit'])->name('ppat.profil.user.edit');
    Route::POST('/ppat/profil/user/update/{id}', [PpatProfilUserCont::class, 'update'])->name('ppat.profil.user.update');
    Route::DELETE('/ppat/profil/user/hapus/{id}', [PpatProfilUserCont::class, 'hapus'])->name('ppat.profil.user.hapus');
    Route::get('/ppat/getProfilAutoComplete', [PpatProfilUserCont::class, 'getProfilAutoComplete'])->name('ppat.getProfilAutoComplete');
    // Export
    Route::get('/ppat/profil/user/export', [PpatProfilUserCont::class, 'export'])->name('ppat.profil.user.export');
    // Profil Valid dari tabel profil
    Route::get('/ppat/profil/user/valid', [PpatProfilUserCont::class, 'profil_valid'])->name('ppat.profil.user.valid');
    Route::get('/ppat/profil/user/lihat/valid/{id}', [PpatProfilUserCont::class, 'profil_valid_lihat'])->name('ppat.profil.user.lihat.valid');

    Route::get('/ppat/profil/pilih/{profil_id}', [ProfilUserCont::class, 'pilih_profil'])->name('getProfil');
    // =========
    // NOP PBB
    Route::get('/ppat/nop/pbb', [PpatNopPbbCont::class, 'index'])->name('ppat.nop.pbb');
    Route::get('/ppat/nop/pbb/lihat/{id}', [PpatNopPbbCont::class, 'show'])->name('ppat.nop.pbb.lihat');
    Route::get('/ppat/nop/pbb/tambah', [PpatNopPbbCont::class, 'create'])->name('ppat.nop.pbb.tambah');
    Route::POST('/ppat/nop/pbb/simpan', [PpatNopPbbCont::class, 'store'])->name('ppat.nop.pbb.simpan');
    Route::get('/ppat/nop/pbb/edit/{id}', [PpatNopPbbCont::class, 'edit'])->name('ppat.nop.pbb.edit');
    Route::POST('/ppat/nop/pbb/update/{id}', [PpatNopPbbCont::class, 'update'])->name('ppat.nop.pbb.update');
    Route::DELETE('/ppat/nop/pbb/hapus/{id}', [PpatNopPbbCont::class, 'hapus'])->name('ppat.nop.pbb.hapus');

    Route::get('/ppat/nop/pbb/pilih/{no_nik}', [PpatNopPbbCont::class, 'getDataNopPbb'])->name('ppat.getDataNopPbb');
    Route::get('/ppat/nop/pbb/tampilan/{no_nop}/{nik}', [PpatNopPbbCont::class, 'getTampilanNopPbb'])->name('ppat.getTampilanNopPbb');
    Route::get('/ppat/nop/pbb/tarif', [PpatNopPbbCont::class, 'getTarifNopPbb'])->name('ppat.getTarifNopPbb');
    Route::get('/ppat/nop/autocomplete/{nik}', [PpatNopPbbCont::class, 'getNopAutoComplete'])->name('ppat.nop.autocomplete');
    // Export
    Route::get('/ppat/nop/pbb/export', [PpatNopPbbCont::class, 'export'])->name('ppat.nop.pbb.export');
    // NOP Valid 
    Route::get('/ppat/nop/pbb/valid', [PpatNopPbbCont::class, 'nop_valid'])->name('ppat.nop.pbb.valid');
    Route::get('/ppat/nop/pbb/valid/lihat/{id}', [PpatNopPbbCont::class, 'nop_valid_lihat'])->name('ppat.nop.pbb.valid.lihat');
});

//--