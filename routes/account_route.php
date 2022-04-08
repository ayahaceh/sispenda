<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\MyAccountCont;

// User Verify
Route::get('/activation/user/{id}', [MyAccountCont::class, 'verify'])->name('user.verify');

// Ini nantinya dipindahin ke file route yang lainnya aja 
Route::group(['middleware' => ['auth', 'CekRoleMiddle:1,2,3,4,5,6,7,8,9,10,11,12,13,20,30']], function () {
    Route::get('/my-account', [MyAccountCont::class, 'index'])->name('my-account');
    Route::post('/my-account/update', [MyAccountCont::class, 'account_update'])->name('my-account.update');
    Route::get('/my-account/photo', [MyAccountCont::class, 'change_photo'])->name('my-account.photo');
    Route::post('/my-account/photo/update/', [MyAccountCont::class, 'change_photo_update'])->name('my-account.photo.update');
    Route::get('/my-account/pass', [MyAccountCont::class, 'change_pass'])->name('my-account.pass');
    Route::post('/my-account/pass/update', [MyAccountCont::class, 'change_pass_update'])->name('my-account.pass.update');
    Route::get('/my-account/profil', [MyAccountCont::class, 'change_profil'])->name('my-account.profil');

    //-- 
});
