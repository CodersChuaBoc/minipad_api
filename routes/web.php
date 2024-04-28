<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::get('logout', 'AuthController@logout');
//    Route::get('register', 'User/AuthController@indexRegister');
//    Route::get('login', 'User/AuthController@indexLogin');
//    Route::get('login', [\App\Http\Controllers\User\AuthController::class, 'indexLogin']);
    Route::get('forgot-password', 'AuthController@forgot');
    Route::post('reset-password', 'AuthController@reset');
});

Route::get('/register', function () {
    return view('pages.register');
})->name('register');

Route::get('/login', function () {
    return view('pages.login');
})->name('login');

