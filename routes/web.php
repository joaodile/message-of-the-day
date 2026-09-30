<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::prefix('/auth')->name('auth.')->group(function() {
    Route::get('/google/redirect', [AuthController::class, 'googleRedirect'])
        ->middleware('guest')
        ->name('google.redirect');
    Route::get('/google/callback', [AuthController::class, 'googleCallback'])
        ->middleware('guest')
        ->name('google.callback');
    Route::get('/logout', [AuthController::class, 'logout'])
        ->middleware('auth')
        ->name('logout');
});