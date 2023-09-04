<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Referensi\NomenklaturController;
use App\Http\Controllers\Referensi\RekeningController;
use App\Http\Controllers\Referensi\RekeningLoController;
use App\Http\Controllers\Referensi\RekeningLraController;
use App\Http\Controllers\Referensi\RekeningNeracaController;
use App\Http\Controllers\Referensi\SumberdanaController;

/*
|--------------------------------------------------------------------------
| REFERENSI
|--------------------------------------------------------------------------
|
*/

Route::middleware(['auth'])->group(function () {

    Route::middleware(['auth', 'role:admin|bappeda|user|guest|eselon-2a|eselon-2b|eselon-3a|eselon-3b|eselon-4a|eselon-4b|eselon-5a'])->group(function () {
        // Route::middleware(['auth', 'role:admin|user|guest|eselon-2a'])->group(function () {
        /**
         * REFERENSI NOMENKLATUR
         */
        Route::controller(NomenklaturController::class)->group(function () {
            Route::get('/referensi/nomenklatur/urusan', 'urusan')->name('referensi.nomenklatur.urusan');
            Route::get('/referensi/nomenklatur/urusan/{urusan}/bidang', 'bidang')->name('referensi.nomenklatur.bidang');
            Route::get('/referensi/nomenklatur/urusan/{urusan}/bidang/{bidang}/program', 'program')->name('referensi.nomenklatur.program');
            Route::get('/referensi/nomenklatur/urusan/{urusan}/bidang/{bidang}/program/{program}/kegiatan', 'kegiatan')->name('referensi.nomenklatur.kegiatan');
            Route::get('/referensi/nomenklatur/urusan/{urusan}/bidang/{bidang}/program/{program}/kegiatan/{kegiatan}/subkegiatan', 'subkegiatan')->name('referensi.nomenklatur.subkegiatan');
        });

        Route::controller(RekeningNeracaController::class)->group(function () {
            Route::get('/referensi/rekening/neraca', 'akun')->name('referensi.rekening.neraca');
            Route::post('/referensi/rekening/neraca/kelompok', 'kelompok');
            Route::post('/referensi/rekening/neraca/jenis', 'jenis');
            Route::post('/referensi/rekening/neraca/objek', 'objek');
            Route::post('/referensi/rekening/neraca/rincian', 'rincian');
            Route::post('/referensi/rekening/neraca/subrincian', 'subrincian');
        });

        Route::controller(RekeningLraController::class)->group(function () {
            Route::get('/referensi/rekening/lra', 'akun')->name('referensi.rekening.lra');
            Route::post('/referensi/rekening/lra/kelompok', 'kelompok');
            Route::post('/referensi/rekening/lra/jenis', 'jenis');
            Route::post('/referensi/rekening/lra/objek', 'objek');
            Route::post('/referensi/rekening/lra/rincian', 'rincian');
            Route::post('/referensi/rekening/lra/subrincian', 'subrincian');
        });

        Route::controller(RekeningLoController::class)->group(function () {
            Route::get('/referensi/rekening/lo', 'akun')->name('referensi.rekening.lo');
            Route::post('/referensi/rekening/lo/kelompok', 'kelompok');
            Route::post('/referensi/rekening/lo/jenis', 'jenis');
            Route::post('/referensi/rekening/lo/objek', 'objek');
            Route::post('/referensi/rekening/lo/rincian', 'rincian');
            Route::post('/referensi/rekening/lo/subrincian', 'subrincian');
        });

        Route::controller(SumberdanaController::class)->group(function () {
            Route::get('/referensi/sumberdana', 'sumberdana')->name('referensi.sumberdana');
        });
    });
});
