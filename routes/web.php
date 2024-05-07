<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('auth')->group(function () {
    Route::get('/register', function () {
        return view('pages.register');
    })->name('register');

    Route::get('/login', function () {
        return view('pages.login');
    })->name('login');
    Route::get('/forgot', function () {
        return view('pages.forgot');
    })->name('forgot');
    Route::get('/resetpassword', function () {
        return view('pages.resetpassword');
    })->name('resetpassword');
});


