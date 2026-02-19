<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CONTROLLERS - PUBLIK
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Web\PagesController;

/*
|--------------------------------------------------------------------------
| CONTROLLERS - ADMIN
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfilDesaController;
use App\Http\Controllers\Admin\PerangkatDesaController;
use App\Http\Controllers\Admin\StatistikPendudukController;
use App\Http\Controllers\Admin\WisataController;
use App\Http\Controllers\Admin\UmkmController;

/*
|--------------------------------------------------------------------------
| ==========================================================
| WEBSITE PUBLIK DESA
| ==========================================================
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA
|--------------------------------------------------------------------------
*/
Route::get('/', [PagesController::class, 'home'])->name('home');

/*
|--------------------------------------------------------------------------
| PROFIL DESA
|--------------------------------------------------------------------------
*/
Route::get('/profil-desa', [PagesController::class, 'profil'])->name('profil');

/*
|--------------------------------------------------------------------------
| PEMERINTAHAN DESA
|--------------------------------------------------------------------------
*/
Route::get('/pemerintahan', [PagesController::class, 'pemerintahan'])->name('pemerintahan');

/*
|--------------------------------------------------------------------------
| DATA PENDUDUK
|--------------------------------------------------------------------------
*/
Route::get('/data-penduduk', [PagesController::class, 'dataPenduduk'])->name('data-penduduk');

/*
|--------------------------------------------------------------------------
| WISATA DESA
|--------------------------------------------------------------------------
*/
Route::get('/wisata', [PagesController::class, 'wisata'])->name('wisata');

/*
|--------------------------------------------------------------------------
| UMKM DESA
|--------------------------------------------------------------------------
*/
Route::get('/umkm', [PagesController::class, 'umkm'])->name('umkm');
Route::get('/umkm/{umkm}', [PagesController::class, 'umkmDetail'])->name('umkm.show');

/*
|--------------------------------------------------------------------------
| ANGGARAN DESA  ← FIX ERROR SEBELUMNYA
|--------------------------------------------------------------------------
*/
Route::get('/anggaran', [PagesController::class, 'anggaran'])->name('anggaran');

/*
|--------------------------------------------------------------------------
| PETA & KONTAK
|--------------------------------------------------------------------------
*/
Route::get('/peta-wilayah', [PagesController::class, 'petaWilayah'])->name('peta-wilayah');
Route::get('/kontak', [PagesController::class, 'kontak'])->name('kontak');


/*
|--------------------------------------------------------------------------
| ==========================================================
| ADMIN PANEL (LOGIN WAJIB)
| ==========================================================
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | DASHBOARD
        |--------------------------------------------------------------------------
        */
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | PROFIL DESA
        |--------------------------------------------------------------------------
        */
        Route::get('/profil-desa', [ProfilDesaController::class, 'edit'])
            ->name('profil-desa.edit');

        Route::put('/profil-desa', [ProfilDesaController::class, 'update'])
            ->name('profil-desa.update');

        /*
        |--------------------------------------------------------------------------
        | PERANGKAT DESA
        |--------------------------------------------------------------------------
        */
        Route::resource('perangkat-desa', PerangkatDesaController::class)
            ->parameters([
                'perangkat-desa' => 'perangkat_desa'
            ]);

        /*
        |--------------------------------------------------------------------------
        | STATISTIK PENDUDUK
        |--------------------------------------------------------------------------
        */
        Route::resource('statistik-penduduk', StatistikPendudukController::class)
            ->except(['show']);

        /*
        |--------------------------------------------------------------------------
        | WISATA
        |--------------------------------------------------------------------------
        */
        Route::resource('wisata', WisataController::class)
            ->except(['show']);

        /*
        |--------------------------------------------------------------------------
        | UMKM
        |--------------------------------------------------------------------------
        */
        Route::resource('umkm', UmkmController::class);
    });


/*
|--------------------------------------------------------------------------
| ==========================================================
| AUTH ROUTES (WAJIB ADA UNTUK BREEZE)
| ==========================================================
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
