<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('auth')->group(function () {
    Route::get('/register', function () {
        return view('pages.v2.register');
    })->name('register');
    
    Route::get('/login', function () {
        return view('pages.v2.login');
    })->name('login');
});


