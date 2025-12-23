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
// auth
// =======================
Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])
    ->name('login');
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])
    ->name('login.submit');
Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])
    ->name('logout');


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
            Route::get('/detail', [\App\Http\Controllers\Admin\Ayam\KandangController::class, 'show'])->name('show');
            // Route::get('/{id}/edit', [\App\Http\Controllers\Admin\Ayam\KandangController::class, 'edit'])->name('edit');
        });

    //     // ---------------------------
    //     // LAPORAN
    //     // ---------------------------
        Route::prefix('laporan')->name('laporan.')->group(function () {

            Route::get('/', [\App\Http\Controllers\Admin\Ayam\LaporanController::class, 'index'])->name('index');

            // HARIAN FORM STEPS
            Route::get('/harian/step-1', [\App\Http\Controllers\Admin\Ayam\LaporanController::class, 'harianStep1'])->name('harian.step1');
            Route::get('/harian/step-2', [\App\Http\Controllers\Admin\Ayam\LaporanController::class, 'harianStep2'])->name('harian.step2');
            Route::get('/harian/step-3', [\App\Http\Controllers\Admin\Ayam\LaporanController::class, 'harianStep3'])->name('harian.step3');
            });

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
    Route::prefix('inventory')->name('inventory.')->group(function () {
        
        // MAIN PAGE
        Route::get('/', function () {
            return view('pages.admin.inventory.index');
        })->name('index');

        // CREATE NEW ITEM
        Route::get('/create', function () {
            return view('pages.admin.inventory.forms.info-utama');
        })->name('create');

        // ---------------------------
        // GUDANG 
        // ---------------------------
        Route::prefix('gudang')->name('gudang.')->group(function () {
            Route::get('/', function () {
                return view('pages.admin.inventory.gudang.index');
            })->name('index');

            Route::get('/{id}', function ($id) {
                return view('pages.admin.inventory.gudang.show', ['id' => $id]);
            })->name('show');
        });

        // ---------------------------
        // STOK 
        // ---------------------------
        Route::prefix('stok')->name('stok.')->group(function () {
            Route::get('/create', function () {
                return view('pages.admin.inventory.stok.create');
            })->name('create');
        });

        // ---------------------------
        // PEMAKAIAN 
        // ---------------------------
        Route::prefix('pemakaian')->name('pemakaian.')->group(function () {
            Route::get('/', function () {
                return view('pages.admin.inventory.pemakaian.list-pemakaian');
            })->name('index');

            Route::get('/catat', function () {
                return view('pages.admin.inventory.pemakaian.catat-pemakaian');
            })->name('catat');

            Route::get('/{id}', function ($id) {
                return view('pages.admin.inventory.pemakaian.detail', ['id' => $id]);
            })->name('detail');
        });
    });
});