<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Rpjmd\RpjmdController;
use App\Http\Controllers\Rpjmd\Store\RpjmdMisiStoreController;
use App\Http\Controllers\Rpjmd\Store\RpjmdVisiStoreController;
use App\Http\Controllers\Rpjmd\Store\RpjmdTujuanStoreController;
use App\Http\Controllers\Rpjmd\Store\RpjmdPeriodeStoreController;
use App\Http\Controllers\Rpjmd\Store\RpjmdProgramStoreController;
use App\Http\Controllers\Rpjmd\Store\RpjmdSasaranStoreController;
use App\Http\Controllers\Rpjmd\Store\RpjmdIndikatorStoreController;

/*
|--------------------------------------------------------------------------
| REFERENSI
|--------------------------------------------------------------------------
|
*/


Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:admin'])->group(function () {


        /**
         * RPJMD Configurations
         */
        Route::controller(RpjmdController::class)->group(function () {
            Route::get('/rpjmd/periode', 'periode')->name('rpjmd.periode');
            Route::get('/rpjmd/visi', 'visi')->name('rpjmd.visi');
            Route::get('/rpjmd/misi', 'misi')->name('rpjmd.misi');
            Route::get('/rpjmd/tujuan', 'tujuan')->name('rpjmd.tujuan');
            Route::get('/rpjmd/sasaran', 'sasaran')->name('rpjmd.sasaran');
            Route::get('/rpjmd/indikator', 'indikator')->name('rpjmd.indikator');
            Route::get('/rpjmd/program', 'program')->name('rpjmd.program');
        });
        Route::controller(RpjmdPeriodeStoreController::class)->group(function () {
            // Periode
            Route::post('/rpjmd/periode', 'storeperiode');
            Route::post('/rpjmd/periode/update', 'updateperiode')->name('rpjmd.periode.update');
            Route::post('/rpjmd/periode/active', 'activeperiode')->name('rpjmd.periode.active');
        });

        Route::controller(RpjmdVisiStoreController::class)->group(function () {
            // Visi
            Route::post('/rpjmd/visi', 'storevisi');
            Route::post('/rpjmd/visi/update', 'updatevisi')->name('rpjmd.visi.update');
            Route::post('/rpjmd/visi/destory', 'destoryvisi')->name('rpjmd.visi.destory');
        });

        Route::controller(RpjmdMisiStoreController::class)->group(function () {
            // Misi
            Route::post('/rpjmd/misi', 'storemisi');
            Route::post('/rpjmd/misi/update', 'updatemisi')->name('rpjmd.misi.update');
            Route::post('/rpjmd/misi/destory', 'destorymisi')->name('rpjmd.misi.destory');
        });

        Route::controller(RpjmdTujuanStoreController::class)->group(function () {
            // Tujuan
            Route::post('/rpjmd/tujuan', 'storetujuan');
            Route::post('/rpjmd/tujuan/update', 'updatetujuan')->name('rpjmd.tujuan.update');
            Route::post('/rpjmd/tujuan/destory', 'destorytujuan')->name('rpjmd.tujuan.destory');
        });

        Route::controller(RpjmdSasaranStoreController::class)->group(function () {
            // Sasaran
            Route::post('/rpjmd/sasaran', 'storesasaran');
            Route::post('/rpjmd/sasaran/update', 'updatesasaran')->name('rpjmd.sasaran.update');
            Route::post('/rpjmd/sasaran/destory', 'destorysasaran')->name('rpjmd.sasaran.destory');
        });

        Route::controller(RpjmdIndikatorStoreController::class)->group(function () {
            // Indikator
            Route::post('/rpjmd/indikator', 'storeindikator');
            Route::post('/rpjmd/indikator/update', 'updateindikator')->name('rpjmd.indikator.update');
            Route::post('/rpjmd/indikator/destory', 'destoryindikator')->name('rpjmd.indikator.destory');
        });

        Route::controller(RpjmdProgramStoreController::class)->group(function () {
            // Program
            Route::post('/rpjmd/program', 'storeprogram');
            Route::post('/rpjmd/program/destory', 'destoryprogram')->name('rpjmd.program.destory');
        });
    });
});
