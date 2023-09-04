<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ranwal\Rkpd\RanwalRkpdController;
use App\Http\Controllers\Ranwal\Rkpd\RanwalRkpdStoreController;
use App\Http\Controllers\Ranwal\Anggaran\PaguOpdRanwalController;
use App\Http\Controllers\Ranwal\Anggaran\PendapatanRanwalController;
use App\Http\Controllers\Ranwal\Anggaran\SumberdanaRanwalController;
use App\Http\Controllers\Ranwal\Anggaran\PaguOpdRanwalStoreController;
use App\Http\Controllers\Ranwal\Anggaran\PendapatanRanwalStoreController;
use App\Http\Controllers\Ranwal\Anggaran\SumberdanaRanwalStoreController;

/*
|--------------------------------------------------------------------------
| RKPD RANWAL
|--------------------------------------------------------------------------
|
*/

Route::middleware(['auth', 'tahun'])->group(function () {

    Route::middleware(['role:admin|bappeda'])->group(function () {

        Route::get('/ranwal/rkpd/opd', function () {
            return redirect()->to(route('rkpd.ranwal'));
        });

        /**
         * Rancangan Awal Pendapatan
         */
        Route::controller(PendapatanRanwalController::class)->group(function () {
            Route::get('/ranwal/pendapatan', 'pendapatan')->name('anggaran.pendapatan');
        });
        Route::controller(PendapatanRanwalStoreController::class)->group(function () {
            Route::post('/ranwal/pendapatan', 'pendapatanstore');
            Route::post('/ranwal/pendapatan/update', 'pendapatanupdate');
            Route::post('/ranwal/pendapatan/destroy', 'pendapatandestroy');
            Route::post('/ranwal/pendapatan/restore', 'pendapatanrestore');
        });

        /**
         * Ranwal Sumber Dana
         */
        Route::controller(SumberdanaRanwalController::class)->group(function () {
            Route::get('/ranwal/sumberdana', 'sumberdana')->name('anggaran.sumberdana');
            Route::get('/ranwal/sumberdana/form', 'sumberdanaform')->name('anggaran.sumberdana.form');
            Route::get('/ranwal/sumberdana/cetak', 'sumberdanacetak');
        });

        Route::controller(SumberdanaRanwalStoreController::class)->group(function () {
            Route::post('/ranwal/sumberdana/form', 'sumberdanastore');
            Route::post('/ranwal/sumberdana/update', 'sumberdanaupdate');
            Route::post('/ranwal/sumberdana/destroy', 'sumberdanadestroy');
            Route::post('/ranwal/sumberdana/restore', 'sumberdanarestore');
        });

        /**
         * Rancangan Awal Pagu OPD
         */
        Route::controller(PaguOpdRanwalController::class)->group(function () {
            Route::get('/ranwal/pagu', 'paguopd')->name('anggaran.pagu');
        });

        Route::controller(PaguOpdRanwalStoreController::class)->group(function () {
            Route::post('/ranwal/pagu', 'paguopdstore');
            Route::post('/ranwal/pagu/update', 'paguopdupdate');
            Route::post('/ranwal/pagu/destroy', 'paguopddestroy');
            Route::post('/ranwal/pagu/restore', 'paguopdrestore');
            Route::post('/ranwal/pagu/upload', 'paguopdupload');
        });
    });

    Route::middleware(['role:admin|bappeda|eselon-2a|eselon-2b|eselon-3a|eselon-3b|eselon-4a|eselon-4b|eselon-5a'])->group(function () {
        /**
         * Rancangan Awal RKPD
         */
        Route::controller(RanwalRkpdController::class)->group(function () {
            Route::get('/ranwal/rkpd', 'ranwal')->name('rkpd.ranwal');
            Route::get('/ranwal/rkpd/opd/{id}', 'ranwalrenja')->name('rkpd.ranwal.renja');
            Route::get('/ranwal/rkpd/opd/{id}/subkegiatan', 'ranwalrenjasubkegiatan')->name('rkpd.ranwal.renja.subkegiatan');
            Route::get('/ranwal/rkpd/opd/{id}/subkegiatan/{idsubkeg}/edit', 'ranwalrenjasubkegiatanedit')->name('rkpd.ranwal.renja.subkegiatan.edit');
            Route::get('/ranwal/rkpd/opd/{id}/subkegiatan/{idsubkeg}/subkeluaran', 'ranwalrenjasubkeluaran')->name('rkpd.ranwal.renja.subkeluaran');
            Route::get('/ranwal/rkpd/opd/{id}/subkegiatan/{idsubkeg}/subkeluaran/{idsubkel}/edit', 'ranwalrenjasubkeluaranedit')->name('rkpd.ranwal.renja.subkeluaran.edit');
        });
        Route::controller(RanwalRkpdStoreController::class)->group(function () {
            /**
             * Upload Renja
             */
            Route::post('/ranwal/rkpd/renja/opd/upload', 'ranwalrenjaopdupload');
            Route::post('/ranwal/rkpd/renja/all/upload', 'ranwalrenjaopdallupload');
            /**
             * Route For Sub Kegiatan
             */
            Route::post('/ranwal/rkpd/opd/{id}/subkegiatan', 'ranwalrenjasubkegiatanstore');
            Route::post('/ranwal/rkpd/opd/{id}/subkegiatan/update', 'ranwalrenjasubkegiatanupdate');
            Route::post('/ranwal/rkpd/opd/{id}/subkegiatan/destroy', 'ranwalrenjasubkegiatandestroy');
            Route::post('/ranwal/rkpd/opd/{id}/subkegiatan/restore', 'ranwalrenjasubkegiatanrestore');
            /**
             * Route For Sub Keluaran
             */
            Route::post('/ranwal/rkpd/opd/{id}/subkegiatan/{idsubkeg}/subkeluaran', 'ranwalrenjasubkeluaranstore');
            Route::post('/ranwal/rkpd/opd/{id}/subkegiatan/{idsubkeg}/subkeluaran/{idsubkel}/edit', 'ranwalrenjasubkeluaranudpate');
            Route::post('/ranwal/rkpd/opd/{id}/subkegiatan/{idsubkeg}/subkeluaran/{idsubkel}/destroy', 'ranwalrenjasubkeluarandestroy');
            Route::post('/ranwal/rkpd/opd/{id}/subkegiatan/{idsubkeg}/subkeluaran/{idsubkel}/restore', 'ranwalrenjasubkeluaranrestore');
        });
    });
});
