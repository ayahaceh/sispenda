<?php

use Illuminate\Support\Facades\Route;
// use \App\Http\Controllers;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ForbidenCont;

// Controller User
use App\Http\Controllers\Users\UserCont;
use App\Http\Controllers\Users\UserGroupsCont;
use App\Http\Controllers\Users\ResetPasswordCont;
use App\Http\Controllers\Logs\LogsCont;
use App\Http\Controllers\ReportCont;

use App\Http\Controllers\Satkers\SatkersCont;
use App\Http\Controllers\DashboardCont;
use App\Http\Controllers\Profil\ProfilUserCont;
use App\Http\Controllers\Tarif\TarifNjopCont;
use App\Http\Controllers\Nop\NopPbbCont;
use App\Http\Controllers\Web\WebCont;
use App\Http\Controllers\Web\PengaturanWebCont;
use App\Http\Controllers\Web\RegisterCont;

// Backup
use App\Http\Controllers\Backup\DatabaseCont;
// use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// Boleh diakses Publik

Route::get('/', [WebCont::class, 'index'])->name('web.public');
Route::get('/register', [RegisterCont::class, 'index'])->name('register');
Route::get('/register/tambah', [RegisterCont::class, 'create'])->name('register.tambah');
Route::POST('/register/cek/{step}', [RegisterCont::class, 'validator'])->name('register.validator');
Route::POST('/register/simpan', [RegisterCont::class, 'store'])->name('register.simpan');
// Contact Admin
Route::get('/contact-admin/public', [WebCont::class, 'kirim_pesan'])->name('contactAdminPublic');
Route::post('/contact-admin/public/kirim', [WebCont::class, 'kirim_pesan_action'])->name('storeContactAdminPublic');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout.get');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/forbiden', [ForbidenCont::class, 'index'])->name('forbiden');
Route::get('/forbiden/cari', [ForbidenCont::class, 'index'])->name('forbiden.cari'); // ini jg Agar tdk error di Disposisi
Route::get('/not-found', [ForbidenCont::class, 'not_found'])->name('notfound'); // ini jg Agar tdk error saat ID tidak Ditemukan.
Route::get('/deny', [ForbidenCont::class, 'deny'])->name('deny');
// Refresh Captcha 
Route::get('/refresh-captcha', [GeneralController::class, 'refreshCaptcha'])->name('captcha.refresh');


// ===============================================================================================
// ===============================================================================================

// 8,9,10 --> User Admin, Kepala, Super Admin 
Route::group(['middleware' => ['auth', 'CekRoleMiddle:1,2']], function () {
    // USER BPKK
    Route::get('/setting/user', [UserCont::class, 'index'])->name('user');
    Route::get('/setting/user/tambah', [UserCont::class, 'create'])->name('user.tambah');
    Route::get('/setting/user/lihat/{id}', [UserCont::class, 'view'])->name('user.lihat');
    Route::POST('/setting/user/simpan', [UserCont::class, 'store'])->name('user.simpan');
    Route::get('/setting/user/edit/{id}', [UserCont::class, 'edit'])->name('user.edit');
    Route::DELETE('/setting/user/hapus/{id}', [UserCont::class, 'hapus'])->name('user.hapus');
    Route::POST('/setting/user/update/{id}', [UserCont::class, 'update'])->name('user.update');
    Route::get('/setting/user/cari', [UserCont::class, 'index'])->name('user.cari');
    // Reset Password / Pembekuan Akses oleh Admin/Operator
    Route::get('/setting/reset-password/{id}', [UserCont::class, 'resetpassword'])->name('user.reset');
    Route::get('/setting/bekukan-akses/{id}', [UserCont::class, 'freezeuser'])->name('user.freeze');
    Route::POST('/setting/user/aktivasi/{id}', [UserCont::class, 'aktivasi'])->name('user.aktivasi');

    // USER GROUP
    Route::get('/setting/user-groups', [UserGroupsCont::class, 'index'])->name('user-groups');
    Route::get('/setting/user-groups/tambah', [UserGroupsCont::class, 'create'])->name('user-groups.tambah');
    Route::POST('/setting/user-groups/simpan', [UserGroupsCont::class, 'store'])->name('user-groups.simpan');
    Route::get('/setting/user-groups/edit/{id}', [UserGroupsCont::class, 'edit'])->name('user-groups.edit');
    Route::DELETE('/setting/user-groups/hapus/{id}', [UserGroupsCont::class, 'hapus'])->name('user-groups.hapus');
    Route::POST('/setting/user-groups/update/{id}', [UserGroupsCont::class, 'update'])->name('user-groups.update');
    Route::get('/setting/user-groups/cari', [UserGroupsCont::class, 'index'])->name('user-group.cari');

    // Setting Satkers Pengguna Aplikasi
    Route::get('/setting/satkers', [SatkersCont::class, 'index'])->name('setting.satkers');
    Route::get('/setting/satkers/edit', [SatkersCont::class, 'edit'])->name('setting.satkers.edit');
    Route::POST('/setting/satkers/update', [SatkersCont::class, 'update'])->name('setting.satkers.update');

    // Hanya Super admin yang boleh mengubah tampilan Front End Website
    // Ini untuk CRUD ke tabel web_*
    Route::GET('/web/public/assets', [PengaturanWebCont::class, 'assets'])->name('web.public.assets');
    Route::POST('/web/public/assets/update', [PengaturanWebCont::class, 'update_assets'])->name('web.public.assets.update');

    // Ucapan Pejabat
    Route::GET('/web/public/profil-pejabat', [PengaturanWebCont::class, 'profil_pejabat'])->name('web.public.profil-pejabat');
    Route::GET('/web/public/profil-pejabat/tambah', [PengaturanWebCont::class, 'tambah_profil_pejabat'])->name('web.public.profil-pejabat.tambah');
    Route::POST('/web/public/profil-pejabat/tambah', [PengaturanWebCont::class, 'store_profil_pejabat'])->name('web.public.profil-pejabat.tambah');
    Route::GET('/web/public/profil-pejabat/edit/{id}', [PengaturanWebCont::class, 'edit_profil_pejabat'])->name('web.public.profil-pejabat.edit');
    Route::POST('/web/public/profil-pejabat/edit/{id}', [PengaturanWebCont::class, 'update_profil_pejabat'])->name('web.public.profil-pejabat.update');
    Route::DELETE('/web/public/profil-pejabat/hapus/{id}', [PengaturanWebCont::class, 'hapus_profil_pejabat'])->name('web.public.profil-pejabat.hapus');

    // Kanal Pembayaran
    Route::GET('/web/public/kanal-pembayaran', [PengaturanWebCont::class, 'kanal_pembayaran'])->name('web.public.kanal-pembayaran');
    Route::GET('/web/public/kanal-pembayaran/tambah', [PengaturanWebCont::class, 'tambah_kanal_pembayaran'])->name('web.public.kanal-pembayaran.tambah');
    Route::POST('/web/public/kanal-pembayaran/tambah', [PengaturanWebCont::class, 'store_kanal_pembayaran'])->name('web.public.kanal-pembayaran.tambah');
    Route::GET('/web/public/kanal-pembayaran/edit/{id}', [PengaturanWebCont::class, 'edit_kanal_pembayaran'])->name('web.public.kanal-pembayaran.edit');
    Route::POST('/web/public/kanal-pembayaran/edit/{id}', [PengaturanWebCont::class, 'update_kanal_pembayaran'])->name('web.public.kanal-pembayaran.update');
    Route::DELETE('/web/public/kanal-pembayaran/hapus/{id}', [PengaturanWebCont::class, 'hapus_kanal_pembayaran'])->name('web.public.kanal-pembayaran.hapus');

    // Regulasi
    Route::GET('/web/public/regulasi', [PengaturanWebCont::class, 'regulasi'])->name('web.public.regulasi');
    Route::GET('/web/public/regulasi/tambah', [PengaturanWebCont::class, 'tambah_regulasi'])->name('web.public.regulasi.tambah');
    Route::POST('/web/public/regulasi/tambah', [PengaturanWebCont::class, 'store_regulasi'])->name('web.public.regulasi.tambah');
    Route::GET('/web/public/regulasi/edit/{id}', [PengaturanWebCont::class, 'edit_regulasi'])->name('web.public.regulasi.edit');
    Route::POST('/web/public/regulasi/edit/{id}', [PengaturanWebCont::class, 'update_regulasi'])->name('web.public.regulasi.update');
    Route::DELETE('/web/public/regulasi/hapus/{id}', [PengaturanWebCont::class, 'hapus_regulasi'])->name('web.public.regulasi.hapus');

    // // Logs
    // Route::get('/logs', [LogsCont::class, 'index'])->name('logs');
    // Route::get('/logs/tambah', [LogsCont::class, 'create'])->name('logs.tambah');
    // Route::get('/logs/lihat/{id}', [LogsCont::class, 'view'])->name('logs.lihat');
    // Route::POST('/logs/simpan', [LogsCont::class, 'store'])->name('logs.simpan');
    // Route::get('/logs/edit/{id}', [LogsCont::class, 'edit'])->name('logs.edit');
    // Route::DELETE('/logs/hapus/{id}', [LogsCont::class, 'hapus'])->name('logs.hapus');
    // Route::POST('/logs/update/{id}', [LogsCont::class, 'update'])->name('logs.update');
    // Route::get('/logs/cari', [LogsCont::class, 'index'])->name('logs.cari');


    // --
}); // -- 8,9,10



// Semua user yang login
Route::group(['middleware' => ['auth', 'CekRoleMiddle:1,2,3,4,5,6,7,8,9,10,11,12,20,30']], function () {

    Route::get('/home', [DashboardCont::class, 'index'])->name('home');
    Route::get('/monitoring', [DashboardCont::class, 'monitoring'])->name('monitoring.home');
    // Contact Admin
    Route::get('/contact-admin', [DashboardCont::class, 'contactAdmin'])->name('contactAdmin');
    Route::post('/contact-admin', [DashboardCont::class, 'storeContactAdmin'])->name('storeContactAdmin');

    Route::get('/profil-saya', [DashboardCont::class, 'profilSaya'])->name('wp.profil-saya');
    

    // Route::get('/pengajuan-bphtb', [DashboardCont::class, 'pengajuanBPHTB'])->name('wp.pengajuan-bphtb');
    // Route::get('/pengajuan-bphtb/lihat/{id}', [DashboardCont::class, 'bphtbLihat'])->name('wp.pengajuan-bphtb.lihat');
    // Route::POST('/pengajuan-bphtb/upload/{id}', [DashboardCont::class, 'upload_pembayaran'])->name('wp.pengajuan-bphtb.upload');



    // Untuk Select (Halaman Buat NJOP Baru)
    Route::get('/profil/pilih/{profil_id}', [ProfilUserCont::class, 'pilih_profil'])->name('getProfil');
    Route::get('/njop/pilih/njop_tanah/{kode_desa}', [TarifNjopCont::class, 'pilih_njop_tanah'])->name('getNjopTanah');
    //--


});


Route::group(['middleware' => ['auth', 'CekRoleMiddle:1,2,3,4,5']], function () {

    // Backup Database
    Route::GET('/backup/database', [DatabaseCont::class, 'index'])->name('backup.database');
    Route::GET('/backup/database/tambah', [DatabaseCont::class, 'create'])->name('backup.database.create');
    Route::POST('/backup/database/store', [DatabaseCont::class, 'store'])->name('backup.database.store');
    Route::DELETE('/backup/database/delete/{file_name}', [DatabaseCont::class, 'delete'])->name('backup.database.delete');

    // Profil User
    Route::get('/profil/user', [ProfilUserCont::class, 'index'])->name('profil.user');
    Route::get('/profil/user/lihat/{id}', [ProfilUserCont::class, 'show'])->name('profil.user.lihat');
    Route::get('/profil/user/tambah', [ProfilUserCont::class, 'create'])->name('profil.user.tambah');
    Route::POST('/profil/user/simpan', [ProfilUserCont::class, 'store'])->name('profil.user.simpan');
    // Edit Data Diri
    Route::put('/profil/user/update-data-diri/{id}', [ProfilUserCont::class, 'updateDataDiri'])->name('profil.user.updateDataDiri');
    // Edit Tempat Tinggal
    Route::put('/profil/user/update-tempat-tinggal/{id}', [ProfilUserCont::class, 'updateTempatTinggal'])->name('profil.user.updateTempatTinggal');
    // Edit Kontak
    Route::put('/profil/user/update-kontak/{id}', [ProfilUserCont::class, 'updateKontak'])->name('profil.user.updateKontak');
    // Edit Berkas Identitas
    Route::put('/profil/user/update-berkas-identitas/{id}', [ProfilUserCont::class, 'updateBerkasIdentitas'])->name('profil.user.updateBerkasIdentitas');
    // Edit Status Profil
    Route::put('/profil/user/update-status-profil/{id}', [ProfilUserCont::class, 'updateStatusProfil'])->name('profil.user.updateStatusProfil');

    Route::get('/profil/user/edit/{id}', [ProfilUserCont::class, 'edit'])->name('profil.user.edit');
    Route::POST('/profil/user/update/{id}', [ProfilUserCont::class, 'update'])->name('profil.user.update');
    Route::DELETE('/profil/user/hapus/{id}', [ProfilUserCont::class, 'hapus'])->name('profil.user.hapus');
    Route::get('getProfilAutoComplete', [ProfilUserCont::class, 'getProfilAutoComplete'])->name('getProfilAutoComplete');
    // Export
    Route::get('/profil/user/export', [ProfilUserCont::class, 'export'])->name('profil.user.export');
    Route::get('/profil/user/verifikasi', [ProfilUserCont::class, 'baru'])->name('profil.user.baru');
    Route::get('/profil/user/verifikasi/{id}', [ProfilUserCont::class, 'verifikasi'])->name('profil.user.verifikasi');
    Route::post('/profil/user/verifikasi/store', [ProfilUserCont::class, 'verifikasi_store'])->name('profil.user.verifikasi.store');

    // NOP PBB
    Route::get('/nop/pbb', [NopPbbCont::class, 'index'])->name('nop.pbb');
    Route::get('/nop/pbb/lihat/{id}', [NopPbbCont::class, 'show'])->name('nop.pbb.lihat');
    Route::get('/nop/pbb/tambah', [NopPbbCont::class, 'create'])->name('nop.pbb.tambah');
    Route::POST('/nop/pbb/simpan', [NopPbbCont::class, 'store'])->name('nop.pbb.simpan');
    Route::get('/nop/pbb/edit/{id}', [NopPbbCont::class, 'edit'])->name('nop.pbb.edit');
    Route::POST('/nop/pbb/update/{id}', [NopPbbCont::class, 'update'])->name('nop.pbb.update');
    Route::DELETE('/nop/pbb/hapus/{id}', [NopPbbCont::class, 'hapus'])->name('nop.pbb.hapus');

    Route::get('/nop/pbb/pilih/{no_nik}', [NopPbbCont::class, 'getDataNopPbb'])->name('getDataNopPbb');
    Route::get('/nop/pbb/tampilan/{no_nop}/{nik}', [NopPbbCont::class, 'getTampilanNopPbb'])->name('getTampilanNopPbb');
    Route::get('/nop/pbb/tarif', [NopPbbCont::class, 'getTarifNopPbb'])->name('getTarifNopPbb');
    Route::get('/nop/autocomplete/{nik}', [NopPbbCont::class, 'getNopAutoComplete'])->name('nop.autocomplete');
    // Export
    Route::get('/nop/pbb/export', [NopPbbCont::class, 'export'])->name('nop.pbb.export');
    Route::get('/nop/pbb/verifikasi', [NopPbbCont::class, 'verifikasi'])->name('nop.pbb.verifikasi');
    Route::get('/nop/pbb/verifikasi/{id}', [NopPbbCont::class, 'verifikasiShow'])->name('nop.pbb.verifikasi.show');
    Route::post('/nop/pbb/verifikasi/simpan', [NopPbbCont::class, 'verifikasiStore'])->name('nop.pbb.verifikasi.store');

    //--
});
