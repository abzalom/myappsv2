<?php

use App\Http\Controllers\Anggaran\Ranwal\AnggaranRanwalController;
use App\Http\Controllers\Anggaran\Ranwal\AnggaranRanwalStoreController;
use App\Http\Controllers\Anggaran\Ranwal\PaguOpdRanwalController;
use App\Http\Controllers\Anggaran\Ranwal\PaguOpdRanwalStoreController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Rkpd\RanwalRkpdController;
use App\Http\Controllers\Rkpd\Store\RanwalRkpdStoreController;

/*
|--------------------------------------------------------------------------
| RKPD RANWAL
|--------------------------------------------------------------------------
|
*/

Route::middleware(['auth'])->group(function () {

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/rkpd/ranwal/opd', function () {
            return redirect()->to(route('rkpd.ranwal'));
        });

        /**
         * Rancangan Awal Pendapatan
         */
        Route::controller(AnggaranRanwalController::class)->group(function () {
            Route::get('/management/pendapatan/ranwal', 'pendapatan')->name('anggaran.pendapatan');
        });
        Route::controller(AnggaranRanwalStoreController::class)->group(function () {
            Route::post('/management/pendapatan/ranwal', 'pendapatanstore');
            Route::post('/management/pendapatan/ranwal/update', 'pendapatanupdate');
            Route::post('/management/pendapatan/ranwal/destroy', 'pendapatandestroy');
            Route::post('/management/pendapatan/ranwal/restore', 'pendapatanrestore');
        });

        /**
         * Rancangan Awal Pagu OPD
         */
        Route::controller(PaguOpdRanwalController::class)->group(function () {
            Route::get('/management/pagu', 'paguopd')->name('anggaran.pagu');
        });

        Route::controller(PaguOpdRanwalStoreController::class)->group(function () {
            Route::post('/management/pagu', 'paguopdstore');
            Route::post('/management/pagu/update', 'paguopdupdate');
            Route::post('/management/pagu/destroy', 'paguopddestroy');
            Route::post('/management/pagu/restore', 'paguopdrestore');
        });
    });

    Route::middleware(['role:admin|eselon-2a|eselon-2b|eselon-3a|eselon-3b|eselon-4a|eselon-4b|eselon-5a'])->group(function () {
        /**
         * Rancangan Awal RKPD
         */
        Route::controller(RanwalRkpdController::class)->group(function () {
            Route::get('/rkpd/ranwal', 'ranwal')->name('rkpd.ranwal');
            Route::get('/rkpd/ranwal/opd/{id}', 'ranwalrenja')->name('rkpd.ranwal.renja');
            Route::get('/rkpd/ranwal/opd/{id}/subkegiatan', 'ranwalrenjasubkegiatan')->name('rkpd.ranwal.renja.subkegiatan');
            Route::get('/rkpd/ranwal/opd/{id}/subkegiatan/{idsubkeg}/edit', 'ranwalrenjasubkegiatanedit')->name('rkpd.ranwal.renja.subkegiatan.edit');
            Route::get('/rkpd/ranwal/opd/{id}/subkegiatan/{idsubkeg}/subkeluaran', 'ranwalrenjasubkeluaran')->name('rkpd.ranwal.renja.subkeluaran');
            Route::get('/rkpd/ranwal/opd/{id}/subkegiatan/{idsubkeg}/subkeluaran/{idsubkel}/edit', 'ranwalrenjasubkeluaranedit')->name('rkpd.ranwal.renja.subkeluaran.edit');
        });
        Route::controller(RanwalRkpdStoreController::class)->group(function () {
            /**
             * Upload Renja
             */
            Route::post('/rkpd/ranwal/upload', 'ranwalrenjaupload');
            /**
             * Route For Sub Kegiatan
             */
            Route::post('/rkpd/ranwal/opd/{id}/subkegiatan', 'ranwalrenjasubkegiatanstore');
            Route::post('/rkpd/ranwal/opd/{id}/subkegiatan/update', 'ranwalrenjasubkegiatanupdate');
            Route::post('/rkpd/ranwal/opd/{id}/subkegiatan/destroy', 'ranwalrenjasubkegiatandestroy');
            Route::post('/rkpd/ranwal/opd/{id}/subkegiatan/restore', 'ranwalrenjasubkegiatanrestore');
            /**
             * Route For Sub Keluaran
             */
            Route::post('/rkpd/ranwal/opd/{id}/subkegiatan/{idsubkeg}/subkeluaran', 'ranwalrenjasubkeluaranstore');
            Route::post('/rkpd/ranwal/opd/{id}/subkegiatan/{idsubkeg}/subkeluaran/{idsubkel}/edit', 'ranwalrenjasubkeluaranudpate');
            Route::post('/rkpd/ranwal/opd/{id}/subkegiatan/{idsubkeg}/subkeluaran/{idsubkel}/destroy', 'ranwalrenjasubkeluarandestroy');
            Route::post('/rkpd/ranwal/opd/{id}/subkegiatan/{idsubkeg}/subkeluaran/{idsubkel}/restore', 'ranwalrenjasubkeluaranrestore');
        });
    });
});
