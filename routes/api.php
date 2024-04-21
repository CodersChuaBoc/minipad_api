<?php

use App\Http\Controllers\User\AuthController;
use Illuminate\Support\Facades\Route;

// auth route
Route::controller(AuthController::class)->group(function () {
    Route::group(['prefix' => '/auth/user'], function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
    });
})->middleware('auth:api');