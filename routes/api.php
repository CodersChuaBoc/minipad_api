<?php

use App\Http\Controllers\User\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

// auth route
Route::controller(AuthController::class)->group(function () {
    Route::group(['prefix' => '/auth/user'], function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
        Route::post('forgot-password', 'forgotPassword');
        Route::post('validate-otp', 'validateOTP');
        Route::post('reset-password', 'resetPassword');
    });
})->middleware('auth:api');


Route::controller(UserController::class)->group(function () {
    Route::group(['prefix' => '/auth/user'], function () {
        Route::post('update', 'updateUser');
    });
});
