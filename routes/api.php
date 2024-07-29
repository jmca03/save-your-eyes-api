<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('health-check', function () {
    return response()->json([
        'timestamp' => now()->format('Y-m-d H:i:s'),
        'status'    => 'ok',
    ]);
});

//  Authentication Routes
Route::group([
    'prefix'     => 'auth',
    'controller' => \App\Http\Controllers\AuthenticationController::class
], function () {
    Route::post('login', 'login')->name('api.auth.login');
    Route::post('logout', 'logout')->name('api.auth.logout')->middleware('auth:api');
    Route::post('register', 'register')->name('api.auth.register');
});
