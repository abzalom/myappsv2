<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Perubahan\Rkpd\PerubahanRkpdController;
use App\Http\Controllers\Perubahan\Rkpd\PerubahanRkpdStoreController;
use App\Http\Controllers\Perubahan\Anggaran\PaguOpdPerubahanController;
use App\Http\Controllers\Perubahan\Anggaran\PendapatanPerubahanController;
use App\Http\Controllers\Perubahan\Anggaran\SumberdanaPerubahanController;
use App\Http\Controllers\Perubahan\Anggaran\PaguOpdPerubahanStoreController;
use App\Http\Controllers\Perubahan\Anggaran\PendapatanPerubahanStoreController;
use App\Http\Controllers\Perubahan\Anggaran\SumberdanaPerubahanStoreController;

/*
|--------------------------------------------------------------------------
| RKPD Perubahan
|--------------------------------------------------------------------------
|
*/

Route::middleware(['auth', 'tahun'])->group(function () {

    Route::middleware(['role:admin|bappeda'])->group(function () {

        Route::get('/perubahan/rkpd/opd', function () {
            return redirect()->to(route('perubahan.rkpd'));
        });

        /**
         * Perubahan Awal Pendapatan
         */
        Route::controller(PendapatanPerubahanController::class)->group(function () {
            Route::get('/perubahan/pendapatan', 'pendapatan')->name('perubahan.anggaran.pendapatan');
        });
        Route::controller(PendapatanPerubahanStoreController::class)->group(function () {
            Route::post('/perubahan/pendapatan', 'pendapatanstore');
            Route::post('/perubahan/pendapatan/update', 'pendapatanupdate');
            Route::post('/perubahan/pendapatan/destroy', 'pendapatandestroy');
            Route::post('/perubahan/pendapatan/restore', 'pendapatanrestore');
        });

        /**
         * Perubahan Sumber Dana
         */
        Route::controller(SumberdanaPerubahanController::class)->group(function () {
            Route::get('/perubahan/sumberdana', 'sumberdana')->name('perubahan.anggaran.sumberdana');
            Route::get('/perubahan/sumberdana/form', 'sumberdanaform')->name('perubahan.anggaran.sumberdana.form');
            Route::get('/perubahan/sumberdana/cetak', 'sumberdanacetak');
        });

        Route::controller(SumberdanaPerubahanStoreController::class)->group(function () {
            Route::post('/perubahan/sumberdana/form', 'sumberdanastore');
            Route::post('/perubahan/sumberdana/update', 'sumberdanaupdate');
            Route::post('/perubahan/sumberdana/destroy', 'sumberdanadestroy');
            Route::post('/perubahan/sumberdana/restore', 'sumberdanarestore');
        });

        /**
         * Perubahan Awal Pagu OPD
         */
        Route::controller(PaguOpdPerubahanController::class)->group(function () {
            Route::get('/perubahan/pagu', 'paguopd')->name('perubahan.anggaran.pagu');
            Route::get('/perubahan/pagu/cetak', 'paguopdcetak');
        });

        Route::controller(PaguOpdPerubahanStoreController::class)->group(function () {
            Route::post('/perubahan/pagu', 'paguopdstore');
            Route::post('/perubahan/pagu/update', 'paguopdupdate');
            Route::post('/perubahan/pagu/destroy', 'paguopddestroy');
            Route::post('/perubahan/pagu/restore', 'paguopdrestore');
            Route::post('/perubahan/pagu/upload', 'paguopdupload');
        });
    });

    Route::middleware(['role:admin|bappeda|eselon-2a|eselon-2b|eselon-3a|eselon-3b|eselon-4a|eselon-4b|eselon-5a'])->group(function () {
        /**
         * Perubahan RKPD
         */
        Route::controller(PerubahanRkpdController::class)->group(function () {
            Route::get('/perubahan/rkpd', 'perubahan')->name('perubahan.rkpd');
            Route::get('/perubahan/rkpd/opd/{id}', 'perubahanrenja')->name('perubahan.rkpd.renja');
            Route::get('/perubahan/rkpd/opd/{id}/subkegiatan', 'perubahanrenjasubkegiatan')->name('perubahan.rkpd.renja.subkegiatan');
            Route::get('/perubahan/rkpd/opd/{id}/subkegiatan/{idsubkeg}/edit', 'perubahanrenjasubkegiatanedit')->name('perubahan.rkpd.renja.subkegiatan.edit');
            Route::get('/perubahan/rkpd/opd/{id}/subkegiatan/{idsubkeg}/subkeluaran', 'perubahanrenjasubkeluaran')->name('perubahan.rkpd.renja.subkeluaran');
            Route::get('/perubahan/rkpd/opd/{id}/subkegiatan/{idsubkeg}/subkeluaran/{idsubkel}/edit', 'perubahanrenjasubkeluaranedit')->name('perubahan.rkpd.renja.subkeluaran.edit');
            Route::get('/perubahan/rkpd/cetak', 'perubahancetak')->name('perubahan.rkpd.cetak');
        });
        Route::controller(PerubahanRkpdStoreController::class)->group(function () {
            /**
             * Upload Renja
             */
            Route::post('/perubahan/rkpd/renja/opd/upload', 'perubahanrenjaopdupload');
            Route::post('/perubahan/rkpd/renja/all/upload', 'perubahanrenjaopdallupload');
            /**
             * Route For Sub Kegiatan
             */
            Route::post('/perubahan/rkpd/opd/{id}/subkegiatan', 'perubahanrenjasubkegiatanstore');
            Route::post('/perubahan/rkpd/opd/{id}/subkegiatan/update', 'perubahanrenjasubkegiatanupdate');
            Route::post('/perubahan/rkpd/opd/{id}/subkegiatan/destroy', 'perubahanrenjasubkegiatandestroy');
            Route::post('/perubahan/rkpd/opd/{id}/subkegiatan/restore', 'perubahanrenjasubkegiatanrestore');
            /**
             * Route For Sub Keluaran
             */
            Route::post('/perubahan/rkpd/opd/{id}/subkegiatan/{idsubkeg}/subkeluaran', 'perubahanrenjasubkeluaranstore');
            Route::post('/perubahan/rkpd/opd/{id}/subkegiatan/{idsubkeg}/subkeluaran/{idsubkel}/edit', 'perubahanrenjasubkeluaranudpate');
            Route::post('/perubahan/rkpd/opd/{id}/subkegiatan/{idsubkeg}/subkeluaran/{idsubkel}/destroy', 'perubahanrenjasubkeluarandestroy');
            Route::post('/perubahan/rkpd/opd/{id}/subkegiatan/{idsubkeg}/subkeluaran/{idsubkel}/restore', 'perubahanrenjasubkeluaranrestore');
        });
    });
});
