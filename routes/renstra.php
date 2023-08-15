<?php

use App\Http\Controllers\Renstra\RenstraController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| REFERENSI
|--------------------------------------------------------------------------
|
*/

Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:admin|bappeda|eselon-2a|eselon-2b'])->group(function () {
        /**
         * Renstra Perangkat Daerah
         */
        Route::controller(RenstraController::class)->group(function () {
            Route::get('/renstra', 'renstra')->name('renstra');
            Route::get('/renstra/opd/{id}', 'renstrainput')->name('renstra.input');
        });
    });
});
