<?php

use App\Http\Controllers\Management\Pegawai\PegawaiController;
use App\Http\Controllers\Management\Pegawai\PegawaiStoreController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Management\PejabatSekdaController;
use App\Http\Controllers\Opd\OpdController;
use App\Http\Controllers\Opd\OpdStoreController;

/*
|--------------------------------------------------------------------------
| MANAGEMENT
|--------------------------------------------------------------------------
|
*/


Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:admin'])->group(function () {
        Route::controller(PegawaiController::class)->group(function () {
            /**
             * Pegawai ASN
             */
            Route::get('/management/pegawai/asn', 'pegawaiasn')->name('man.pegawai.asn');
            Route::get('/management/pegawai/asn/create', 'pegawaiasncreate')->name('man.pegawai.asn.create');
            Route::get('/management/pegawai/asn/{pegawai}/profile', 'pegawaiasntagingopd')->name('man.pegawai.asn.taging.opd');
            /**
             * Pegawai PPPK
             */
            Route::get('/management/pegawai/pppk', 'pegawaipppk')->name('man.pegawai.pppk');
        });

        Route::controller(PegawaiStoreController::class)->group(function () {
            /**
             * Pegawai ASN
             */
            Route::post('/management/pegawai/asn/create', 'pegawaiasnstore');
            Route::post('/management/pegawai/asn/{pegawai}/profile', 'pegawaiasnudpate');
        });



        /**
         * Management Pejabat
         */
        Route::controller(PejabatSekdaController::class)->group(function () {
            Route::get('/management/pejabat/sekda', 'index')->name('man.pejabat.sekda');
            Route::post('/management/pejabat/sekda', 'store');
            Route::post('/management/pejabat/sekda/update', 'update')->name('man.pejabat.sekda.update');
            Route::post('/management/pejabat/sekda/delete', 'delete')->name('man.pejabat.sekda.delete');
            Route::post('/management/pejabat/sekda/active', 'active')->name('man.pejabat.sekda.active');
        });

        Route::controller(OpdController::class)->group(function () {
            Route::get('/management/opd', 'opd')->name('opd');
            Route::get('/management/opd/create', 'create')->name('opd.create');
            Route::get('/management/opd/edit/{kode}', 'edit')->name('opd.edit');
        });

        Route::controller(OpdStoreController::class)->group(function () {
            Route::post('/management/opd/create', 'store');
            Route::post('/management/opd/edit/{kode}', 'update');
            Route::post('/management/opd/destroy', 'destroy')->name('opd.destroy');
            Route::post('/management/opd/restore', 'restore')->name('opd.restore');
        });
    });
});
