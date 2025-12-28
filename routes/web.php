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

        // ---------------------------
        // KANDANG
        // ---------------------------
        Route::prefix('kandang')->name('kandang.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\Ayam\KandangController::class, 'index'])->name('index');
            Route::get('/detail', [\App\Http\Controllers\Admin\Ayam\KandangController::class, 'show'])->name('show');
        });

        // ---------------------------
        // LAPORAN
        // ---------------------------
        Route::prefix('laporan')->name('laporan.')->group(function () {

            Route::get('/', [\App\Http\Controllers\Admin\Ayam\LaporanController::class, 'index'])->name('index');

            // HARIAN FORM STEPS
            Route::get('/harian/step-1', [\App\Http\Controllers\Admin\Ayam\LaporanController::class, 'harianStep1'])->name('harian.step1');
            Route::get('/harian/step-2', [\App\Http\Controllers\Admin\Ayam\LaporanController::class, 'harianStep2'])->name('harian.step2');
            Route::get('/harian/step-3', [\App\Http\Controllers\Admin\Ayam\LaporanController::class, 'harianStep3'])->name('harian.step3');

            // DETAIL
            Route::get('/harian/detail', [\App\Http\Controllers\Admin\Ayam\LaporanController::class, 'harianDetail'])->name('harian.detail');
            Route::get('/panen/detail', [\App\Http\Controllers\Admin\Ayam\LaporanController::class, 'panenDetail'])->name('panen.detail');
            Route::get('/insiden/detail', [\App\Http\Controllers\Admin\Ayam\LaporanController::class, 'insidenDetail'])->name('insiden.detail');
        });
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

            // Create must be defined BEFORE {id} to prevent matching
            Route::get('/create', function () {
                return view('pages.admin.inventory.gudang.create');
            })->name('create');

            Route::get('/show', function () {
                return view('pages.admin.inventory.gudang.show');
            })->name('show');

            Route::get('/{id}', function ($id) {
                return view('pages.admin.inventory.gudang.show', ['id' => $id]);
            })->name('detail');
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
