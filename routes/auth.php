<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginSessionController;
use App\Http\Controllers\Configs\ProfileController;

/**
 * -------------------------------------
 * AUTHENTICATION SESSION
 * --------------------------------------
 */

Route::controller(LoginSessionController::class)->middleware(['guest'])->group(function () {
    Route::get('/login', 'login')->name('auth.login');
    Route::post('/login', 'store');
});

Route::controller(LoginSessionController::class)->middleware(['auth'])->group(function () {
    Route::post('/logout', 'logout')->name('auth.logout');
});

Route::middleware(['role:admin|user|guest|eselon-2a|eselon-2b|eselon-3a|eselon-3b|eselon-4a|eselon-4b|eselon-5a'])->controller(ProfileController::class)->group(function () {
    Route::get('/user/profile', 'profile')->name('user.profile');
    Route::post('/user/profile/update', 'update');
});
