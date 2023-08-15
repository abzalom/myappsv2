<?php

use App\Http\Controllers\Configs\AppController;
use App\Http\Controllers\Configs\AppStoreController;
use App\Http\Controllers\Configs\Jadwal\JadwalController;
use App\Http\Controllers\Configs\Jadwal\JadwalStoreController;
use App\Http\Controllers\Management\PejabatSekdaController;
use App\Http\Controllers\Opd\OpdController;
use App\Http\Controllers\Opd\OpdStoreController;
use App\Http\Controllers\Rpjmd\RpjmdController;
use App\Http\Controllers\Rpjmd\Store\RpjmdIndikatorStoreController;
use App\Http\Controllers\Rpjmd\Store\RpjmdMisiStoreController;
use App\Http\Controllers\Rpjmd\Store\RpjmdPeriodeStoreController;
use App\Http\Controllers\Rpjmd\Store\RpjmdProgramStoreController;
use App\Http\Controllers\Rpjmd\Store\RpjmdSasaranStoreController;
use App\Http\Controllers\Rpjmd\Store\RpjmdTujuanStoreController;
use App\Http\Controllers\Rpjmd\Store\RpjmdVisiStoreController;
use App\Http\Controllers\Settings\RoleAndPermissionController;
use App\Http\Controllers\Settings\RoleAndPermissionStoreController;
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

Route::get('/', function () {
    return view('home', [
        'apps' => [
            'title' => 'Myapps',
            'desc' => 'Selamat datang ' . auth()->user()->username,
        ],
    ]);
})->name('home')->middleware(['auth']);

Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:admin'])->group(function () {
        /**
         * App Configurations
         */
        Route::controller(AppController::class)->group(function () {
            // Route::get('/config/app', 'app')->name('config.app');
            Route::get('/config/app/menu', 'menu')->name('config.app.menu');
            Route::get('/config/tahun', 'tahun')->name('config.tahun');
        });
        Route::controller(AppStoreController::class)->group(function () {
            Route::post('/config/app/menu', 'menustore');
            Route::post('/config/app/menu/update', 'menuupdate');
            Route::post('/config/app/menu/destroy', 'menudestroy');
            Route::post('/config/app/menu/restore', 'menurestore');
            Route::post('/config/app/submenu', 'submenustore');
            Route::post('/config/app/submenu/update', 'submenuupdate');
            Route::post('/config/app/submenu/destroy', 'submenudestroy');
            Route::post('/config/app/submenu/restore', 'submenurestore');
            Route::post('/config/tahun', 'tahunstore');
            Route::post('/config/tahun/update', 'tahunupdate');
        });

        Route::controller(JadwalController::class)->group(function () {
            Route::get('/config/jadwal', 'home')->name('config.jadwal');
            Route::get('/config/jadwal/renstra', 'jadwalrenstra')->name('config.jadwal.renstra');
            Route::get('/config/jadwal/rkpd', 'jadwalrkpd')->name('config.jadwal.rkpd');
        });

        Route::controller(JadwalStoreController::class)->group(function () {
            Route::post('/config/jadwal/rkpd', 'store_jadwal_rkpd');
            Route::post('/config/jadwal/rkpd/update', 'update_jadwal_rkpd');
            Route::post('/config/jadwal/rkpd/destory', 'destory_jadwal_rkpd');
            Route::post('/config/jadwal/rkpd/synchorn', 'synchorn');
        });

        /**
         * Settings Role And Permission
         */
        Route::controller(RoleAndPermissionController::class)->group(function () {
            Route::get('/setting/roles', 'roleandpermission');
        });
        Route::controller(RoleAndPermissionStoreController::class)->group(function () {
            Route::post('/setting/roles/save', 'rolesave');
            Route::post('/setting/roles/update', 'roleupdate');
            Route::post('/setting/roles/destory', 'roledestory');
        });
    });
});

require __DIR__ . '/auth.php';
require __DIR__ . '/api.php';
require __DIR__ . '/rpjmd.php';
require __DIR__ . '/renstra.php';
require __DIR__ . '/referensi.php';
require __DIR__ . '/management.php';
require __DIR__ . '/ranwal.php';
require __DIR__ . '/olahdata.php';
