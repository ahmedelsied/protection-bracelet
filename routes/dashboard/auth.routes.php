<?php

use App\Http\Controllers\Dashboard\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'as' => 'auth.'], static function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
         ->middleware('guest')
         ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
         ->middleware('guest');

    Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
         ->middleware('auth')
         ->name('logout');
});
