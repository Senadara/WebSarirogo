<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Ayam\LaporanController;
use App\Http\Controllers\Admin\Ayam\KandangController;

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
            Route::get('/', [KandangController::class, 'index'])->name('index');
            Route::get('/detail', [KandangController::class, 'show'])->name('show');

            //form create
            Route::get('/create/{step}', [KandangController::class, 'create'])
                ->whereIn('step', [1, 2, 3])
                ->name('create');

            //form edit route
            Route::get('/{kandang}/edit/{step}', [KandangController::class, 'edit'])
                ->whereIn('step', [1, 2, 3])
                ->name('edit');
        });

        // ---------------------------
        // LAPORAN
        // ---------------------------
        Route::prefix('laporan')->name('laporan.')->group(function () {

            Route::get('/', [LaporanController::class, 'index'])->name('index');

            Route::get('/create/{type}/step/{step}', [LaporanController::class, 'create'])
                ->name('create');

            Route::get('/{type}/{id}', [LaporanController::class, 'detail'])
                ->name('detail');
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

            // Edit route
            Route::get('/edit', function () {
                return view('pages.admin.inventory.gudang.edit');
            })->name('edit');

            Route::get('/show', function () {
                return view('pages.admin.inventory.gudang.show');
            })->name('show');

            Route::get('/{id}', function ($id) {
                return view('pages.admin.inventory.gudang.show', ['id' => $id]);
            })->name('detail');

            Route::get('/{id}/edit', function ($id) {
                return view('pages.admin.inventory.gudang.edit', ['id' => $id]);
            })->name('edit.id');
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

    // ============================
    // USER MANAGEMENT
    // ============================
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', function () {
            return view('pages.admin.users.index');
        })->name('index');
    });

    // ============================
    // ACTIVITY HISTORY
    // ============================
    Route::prefix('activities')->name('activities.')->group(function () {
        Route::get('/', function () {
            return view('pages.admin.activities.index');
        })->name('index');
    });
});
