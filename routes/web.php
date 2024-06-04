<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CaptchaController;

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
    Route::get('/forgot', function () {
        return view('pages.forgot');
    })->name('forgot');
    Route::get('/resetpassword', function () {
        return view('pages.resetpassword');
    })->name('resetpassword');
});

Route::get('/captcha', [CaptchaController::class, 'createCaptcha']);
Route::get('/get-captcha', [CaptchaController::class, 'getCaptcha']);
Route::get('/limit-attempts', [CaptchaController::class, 'limitAttempts']);
