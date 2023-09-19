<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Configs\AppController;
use App\Http\Controllers\TemplateBuildController;
use App\Http\Controllers\Configs\AppStoreController;
use App\Http\Controllers\Management\User\UserController;
use App\Http\Controllers\Configs\Jadwal\JadwalController;
use App\Http\Controllers\Management\User\UserStoreController;
use App\Http\Controllers\Configs\Jadwal\JadwalStoreController;
use App\Http\Controllers\Settings\RoleAndPermissionController;
use App\Http\Controllers\Settings\RoleAndPermissionStoreController;

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

Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:admin'])->group(function () {
        Route::controller(TemplateBuildController::class)->group(function () {
            Route::get('/template', 'buildTemplate');
            Route::get('/request', 'testRequest');
        });
    });
});

Route::get('/home', function () {
    return redirect()->to('/');
});

Route::get('/', function () {
    return view('home', [
        'apps' => [
            'title' => 'Myapps',
            'desc' => 'Selamat datang ' . auth()->user()->username,
        ],
    ]);
})->name('home')->middleware(['auth']);

Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:admin|bappeda'])->group(function () {
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
            Route::post('/config/jadwal/rkpd/synchorn/rancangan', 'synchornRancangan');
            Route::post('/config/jadwal/rkpd/synchorn/perubahan', 'synchornPerubahan');
        });

        /**
         * Settings Role And Permission
         */
        Route::controller(RoleAndPermissionController::class)->group(function () {
            Route::get('/user/setting/roles', 'roleandpermission');
        });
        Route::controller(RoleAndPermissionStoreController::class)->group(function () {
            Route::post('/setting/roles/save', 'rolesave');
            Route::post('/setting/roles/update', 'roleupdate');
            Route::post('/setting/roles/destory', 'roledestory');
        });
        /**
         * Settings Users
         */
        Route::controller(UserController::class)->group(function () {
            Route::get('/user/setting/users', 'home');
        });
        Route::controller(UserStoreController::class)->group(function () {
            Route::post('/user/setting/users', 'store');
            Route::post('/user/setting/users/reset', 'reset');
            Route::post('/user/setting/users/lock', 'lock');
            Route::post('/user/setting/users/unlock', 'unlock');
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
require __DIR__ . '/rancangan.php';
require __DIR__ . '/perubahan.php';
require __DIR__ . '/olahdata.php';
