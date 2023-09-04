<?php

use App\Http\Controllers\Rancangan\Anggaran\PaguOpdRancanganController;
use App\Http\Controllers\Rancangan\Anggaran\PaguOpdRancanganStoreController;
use App\Http\Controllers\Rancangan\Anggaran\PendapatanRancanganController;
use App\Http\Controllers\Rancangan\Anggaran\PendapatanRancanganStoreController;
use App\Http\Controllers\Rancangan\Anggaran\SumberdanaRancanganController;
use App\Http\Controllers\Rancangan\Anggaran\SumberdanaRancanganStoreController;
use App\Http\Controllers\Rancangan\Rkpd\RancanganRkpdController;
use App\Http\Controllers\Rancangan\Rkpd\RancanganRkpdStoreController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| RKPD rancangan
|--------------------------------------------------------------------------
|
*/

Route::middleware(['auth', 'tahun'])->group(function () {

    Route::middleware(['role:admin|bappeda'])->group(function () {

        Route::get('/rancangan/rkpd/opd', function () {
            return redirect()->to(route('rancangan.rkpd'));
        });

        /**
         * Rancangan Awal Pendapatan
         */
        Route::controller(PendapatanRancanganController::class)->group(function () {
            Route::get('/rancangan/pendapatan', 'pendapatan')->name('rancangan.anggaran.pendapatan');
        });
        Route::controller(PendapatanRancanganStoreController::class)->group(function () {
            Route::post('/rancangan/pendapatan', 'pendapatanstore');
            Route::post('/rancangan/pendapatan/update', 'pendapatanupdate');
            Route::post('/rancangan/pendapatan/destroy', 'pendapatandestroy');
            Route::post('/rancangan/pendapatan/restore', 'pendapatanrestore');
        });

        /**
         * rancangan Sumber Dana
         */
        Route::controller(SumberdanaRancanganController::class)->group(function () {
            Route::get('/rancangan/sumberdana', 'sumberdana')->name('rancangan.anggaran.sumberdana');
            Route::get('/rancangan/sumberdana/form', 'sumberdanaform')->name('rancangan.anggaran.sumberdana.form');
            Route::get('/rancangan/sumberdana/cetak', 'sumberdanacetak');
        });

        Route::controller(SumberdanaRancanganStoreController::class)->group(function () {
            Route::post('/rancangan/sumberdana/form', 'sumberdanastore');
            Route::post('/rancangan/sumberdana/update', 'sumberdanaupdate');
            Route::post('/rancangan/sumberdana/destroy', 'sumberdanadestroy');
            Route::post('/rancangan/sumberdana/restore', 'sumberdanarestore');
        });

        /**
         * Rancangan Awal Pagu OPD
         */
        Route::controller(PaguOpdRancanganController::class)->group(function () {
            Route::get('/rancangan/pagu', 'paguopd')->name('anggaran.pagu');
        });

        Route::controller(PaguOpdRancanganStoreController::class)->group(function () {
            Route::post('/rancangan/pagu', 'paguopdstore');
            Route::post('/rancangan/pagu/update', 'paguopdupdate');
            Route::post('/rancangan/pagu/destroy', 'paguopddestroy');
            Route::post('/rancangan/pagu/restore', 'paguopdrestore');
            Route::post('/rancangan/pagu/upload', 'paguopdupload');
        });
    });

    Route::middleware(['role:admin|bappeda|eselon-2a|eselon-2b|eselon-3a|eselon-3b|eselon-4a|eselon-4b|eselon-5a'])->group(function () {
        /**
         * Rancangan Awal RKPD
         */
        Route::controller(RancanganRkpdController::class)->group(function () {
            Route::get('/rancangan/rkpd', 'rancangan')->name('rancangan.rkpd');
            Route::get('/rancangan/rkpd/opd/{id}', 'rancanganrenja')->name('rancangan.rkpd.renja');
            Route::get('/rancangan/rkpd/opd/{id}/subkegiatan', 'rancanganrenjasubkegiatan')->name('rancangan.rkpd.renja.subkegiatan');
            Route::get('/rancangan/rkpd/opd/{id}/subkegiatan/{idsubkeg}/edit', 'rancanganrenjasubkegiatanedit')->name('rancangan.rkpd.renja.subkegiatan.edit');
            Route::get('/rancangan/rkpd/opd/{id}/subkegiatan/{idsubkeg}/subkeluaran', 'rancanganrenjasubkeluaran')->name('rancangan.rkpd.renja.subkeluaran');
            Route::get('/rancangan/rkpd/opd/{id}/subkegiatan/{idsubkeg}/subkeluaran/{idsubkel}/edit', 'rancanganrenjasubkeluaranedit')->name('rancangan.rkpd.renja.subkeluaran.edit');
        });
        Route::controller(RancanganRkpdStoreController::class)->group(function () {
            /**
             * Upload Renja
             */
            Route::post('/rancangan/rkpd/renja/opd/upload', 'rancanganrenjaopdupload');
            Route::post('/rancangan/rkpd/renja/all/upload', 'rancanganrenjaopdallupload');
            /**
             * Route For Sub Kegiatan
             */
            Route::post('/rancangan/rkpd/opd/{id}/subkegiatan', 'rancanganrenjasubkegiatanstore');
            Route::post('/rancangan/rkpd/opd/{id}/subkegiatan/update', 'rancanganrenjasubkegiatanupdate');
            Route::post('/rancangan/rkpd/opd/{id}/subkegiatan/destroy', 'rancanganrenjasubkegiatandestroy');
            Route::post('/rancangan/rkpd/opd/{id}/subkegiatan/restore', 'rancanganrenjasubkegiatanrestore');
            /**
             * Route For Sub Keluaran
             */
            Route::post('/rancangan/rkpd/opd/{id}/subkegiatan/{idsubkeg}/subkeluaran', 'rancanganrenjasubkeluaranstore');
            Route::post('/rancangan/rkpd/opd/{id}/subkegiatan/{idsubkeg}/subkeluaran/{idsubkel}/edit', 'rancanganrenjasubkeluaranudpate');
            Route::post('/rancangan/rkpd/opd/{id}/subkegiatan/{idsubkeg}/subkeluaran/{idsubkel}/destroy', 'rancanganrenjasubkeluarandestroy');
            Route::post('/rancangan/rkpd/opd/{id}/subkegiatan/{idsubkeg}/subkeluaran/{idsubkel}/restore', 'rancanganrenjasubkeluaranrestore');
        });
    });
});
