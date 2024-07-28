<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * Authentication Routes
 */
Route::group([
    'prefix' => 'auth',
    'controller' => \App\Http\Controllers\AuthenticationController::class
], function () {
    Route::post('login', 'login')->name('api.auth.login');
    Route::post('logout', 'logout')->name('api.auth.logout');
    Route::post('register', 'register')->name('api.auth.register');
});
