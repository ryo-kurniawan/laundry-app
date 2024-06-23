<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\AuthController::class, 'index'])->name('login');
Route::post('/proses_login', [\App\Http\Controllers\AuthController::class, 'proses_login']);
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

Route::middleware('check.login')->group(function () {
    Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/pelanggan', \App\Http\Controllers\PelangganController::class);
    Route::resource('/transaksi', \App\Http\Controllers\TransaksiController::class);
    Route::get('/transaksi/{id}/cetak-nota', [\App\Http\Controllers\TransaksiController::class, 'cetakNota'])->name('transaksi.cetakNota');

    Route::name('settings.')->prefix('/settings')->group(function () {
        // Resource route
        Route::resource('/', \App\Http\Controllers\SettingController::class);
        Route::get('/create-paket', [\App\Http\Controllers\SettingController::class, 'createPaket'])->name('create-paket');
        Route::post('/store-paket', [\App\Http\Controllers\SettingController::class, 'storePaket'])->name('store-paket');
        Route::get('/edit-paket/{id}', [\App\Http\Controllers\SettingController::class, 'editPaket'])->name('edit-paket');
        Route::put('/update-paket/{id}', [\App\Http\Controllers\SettingController::class, 'updatePaket'])->name('update-paket');
        Route::delete('/destroy-paket/{id}', [\App\Http\Controllers\SettingController::class, 'destroyPaket'])->name('destroy-paket');

        Route::get('/create-layanan', [\App\Http\Controllers\SettingController::class, 'createLayanan'])->name('create-layanan');
        Route::post('/store-layanan', [\App\Http\Controllers\SettingController::class, 'storeLayanan'])->name('store-layanan');
        Route::get('/edit-layanan/{id}', [\App\Http\Controllers\SettingController::class, 'editLayanan'])->name('edit-layanan');
        Route::put('/update-layanan/{id}', [\App\Http\Controllers\SettingController::class, 'updateLayanan'])->name('update-layanan');
        Route::delete('/destroy-layanan/{id}', [\App\Http\Controllers\SettingController::class, 'destroyLayanan'])->name('destroy-layanan');

        Route::get('/create-promo', [\App\Http\Controllers\SettingController::class, 'createPromo'])->name('create-promo');
        Route::post('/store-promo', [\App\Http\Controllers\SettingController::class, 'storePromo'])->name('store-promo');
        Route::get('/edit-promo/{id}', [\App\Http\Controllers\SettingController::class, 'editPromo'])->name('edit-promo');
        Route::put('/update-promo/{id}', [\App\Http\Controllers\SettingController::class, 'updatePromo'])->name('update-promo');
        Route::delete('/destroy-promo/{id}', [\App\Http\Controllers\SettingController::class, 'destroyPromo'])->name('destroy-promo');
    });

    Route::resource('/profile', \App\Http\Controllers\ProfileController::class);


    Route::get('riwayat', [\App\Http\Controllers\TransaksiController::class, 'riwayat'])->name('riwayat');
});

