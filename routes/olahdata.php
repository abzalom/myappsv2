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
    Route::get('/test', [TestController::class, 'testuser']);
    Route::get('/rollback/perubahan', [TestController::class, 'RollbackPerubahan']);
});
