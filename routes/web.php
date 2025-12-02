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

// =======================
// landing
// =======================
Route::get('/', [\App\Http\Controllers\LandingController::class, 'index'])
    ->name('landing.index');


// =======================
// admin
// =======================
Route::prefix('admin')->name('admin.')->group(function () {

    // ============================
    // AYAM
    // ============================
    Route::prefix('ayam')->name('ayam.')->group(function () {

        // Halaman utama ayam
        Route::get('/', [\App\Http\Controllers\Admin\Ayam\IndexController::class, 'index'])
            ->name('index');

    //     // ---------------------------
    //     // KANDANG
    //     // ---------------------------
        Route::prefix('kandang')->name('kandang.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\Ayam\KandangController::class, 'index'])->name('index');
            // Route::get('/create', [\App\Http\Controllers\Admin\Ayam\KandangController::class, 'create'])->name('create');
            // Route::get('/{id}', [\App\Http\Controllers\Admin\Ayam\KandangController::class, 'show'])->name('show');
            // Route::get('/{id}/edit', [\App\Http\Controllers\Admin\Ayam\KandangController::class, 'edit'])->name('edit');
        });

    //     // ---------------------------
    //     // LAPORAN
    //     // ---------------------------
    //     Route::prefix('laporan')->name('laporan.')->group(function () {

    //         // HAR IAN
    //         Route::get('/harian', [\App\Http\Controllers\Admin\Ayam\LaporanController::class, 'harian'])->name('harian');
    //         Route::get('/harian/{id}', [\App\Http\Controllers\Admin\Ayam\LaporanController::class, 'harianDetail'])->name('harian.detail');

    //         // INSIDEN
    //         Route::get('/insiden', [\App\Http\Controllers\Admin\Ayam\LaporanController::class, 'insiden'])->name('insiden');
    //         Route::get('/insiden/{id}', [\App\Http\Controllers\Admin\Ayam\LaporanController::class, 'insidenDetail'])->name('insiden.detail');

    //         // PANEN
    //         Route::get('/panen', [\App\Http\Controllers\Admin\Ayam\LaporanController::class, 'panen'])->name('panen');
    //         Route::get('/panen/{id}', [\App\Http\Controllers\Admin\Ayam\LaporanController::class, 'panenDetail'])->name('panen.detail');
    //     });

    //     // ---------------------------
    //     // FORM (STEP-STEP)
    //     // ---------------------------
    //     Route::prefix('form')->name('form.')->group(function () {

    //         Route::get('/harian/step-1', [\App\Http\Controllers\Admin\Ayam\FormController::class, 'stepHarian1'])->name('harian.step1');
    //         Route::get('/harian/step-2', [\App\Http\Controllers\Admin\Ayam\FormController::class, 'stepHarian2'])->name('harian.step2');
    //         Route::get('/harian/step-3', [\App\Http\Controllers\Admin\Ayam\FormController::class, 'stepHarian3'])->name('harian.step3');

    //         Route::get('/insiden/step-1', [\App\Http\Controllers\Admin\Ayam\FormController::class, 'stepInsiden1'])->name('insiden.step1');
    //         Route::get('/insiden/step-2', [\App\Http\Controllers\Admin\Ayam\FormController::class, 'stepInsiden2'])->name('insiden.step2');
    //         Route::get('/insiden/step-3', [\App\Http\Controllers\Admin\Ayam\FormController::class, 'stepInsiden3'])->name('insiden.step3');

    //         Route::get('/panen/step-1', [\App\Http\Controllers\Admin\Ayam\FormController::class, 'stepPanen1'])->name('panen.step1');
    //         Route::get('/panen/step-2', [\App\Http\Controllers\Admin\Ayam\FormController::class, 'stepPanen2'])->name('panen.step2');
    //         Route::get('/panen/step-3', [\App\Http\Controllers\Admin\Ayam\FormController::class, 'stepPanen3'])->name('panen.step3');
    //     });

    //     // ---------------------------
    //     // PAKAN
    //     // ---------------------------
    //     Route::get('/pakan', [\App\Http\Controllers\Admin\Ayam\PakanController::class, 'index'])
    //         ->name('pakan.index');
    });


    // ============================
    // INVENTORY
    // ============================
    // Route::prefix('inventory')->name('inventory.')->group(function () {
        
           // MAIN PAGE
    //         Route::get('/', [\App\Http\Controllers\Admin\Inventory\IndexController::class, 'index'])
    //             ->name('index');

           // ---------------------------
           // GUDANG 
           // ---------------------------
    //     Route::prefix('gudang')->name('gudang.')->group(function () {

    //         // DETAIL ITEM
    //         Route::get('/{id}', [\App\Http\Controllers\Admin\Inventory\GudangController::class, 'show'])
    //             ->name('show');

    //         // TAMBAH STOK
    //         Route::get('/{id}/tambah-stok', [\App\Http\Controllers\Admin\Inventory\GudangController::class, 'tambahStok'])
    //             ->name('tambahstok');

    //         // FORMS
    //         Route::get('/forms/info-utama', [\App\Http\Controllers\Admin\Inventory\GudangController::class, 'infoUtama'])
    //             ->name('form.infoutama');

    //         Route::get('/forms/review', [\App\Http\Controllers\Admin\Inventory\GudangController::class, 'review'])
    //             ->name('form.review');

    //         Route::get('/forms/logistik', [\App\Http\Controllers\Admin\Inventory\GudangController::class, 'logistik'])
    //             ->name('form.logistik');

    //         Route::get('/forms/spesifikasi', [\App\Http\Controllers\Admin\Inventory\GudangController::class, 'spesifikasi'])
    //             ->name('form.spesifikasi');

    //         Route::get('/forms/submitted', [\App\Http\Controllers\Admin\Inventory\GudangController::class, 'submitted'])
    //             ->name('form.submitted');
    //     });

    //     // ---------------------------
    //     // PEMAKAIAN 
    //     // ---------------------------
    //     Route::prefix('pemakaian')->name('pemakaian.')->group(function () {
    //         Route::get('/', [\App\Http\Controllers\Admin\Inventory\PemakaianController::class, 'index'])->name('index');
    //         Route::get('/list', [\App\Http\Controllers\Admin\Inventory\PemakaianController::class, 'list'])->name('list');
    //         Route::get('/{id}', [\App\Http\Controllers\Admin\Inventory\PemakaianController::class, 'detail'])->name('detail');
    //     });
    // });
});