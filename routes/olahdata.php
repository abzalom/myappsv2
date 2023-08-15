<?php

use App\Http\Controllers\Olahdata\OlahNomenklaturController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| OLAH DATA ROUTES
|--------------------------------------------------------------------------
|
*/



Route::middleware('auth')->group(function () {
    // Route::get('/olahdata/looping/tahun', [TestController::class, 'test']);
    Route::get('/olahdata/ranwal/delete', [TestController::class, 'deleteRanwal']);
});
