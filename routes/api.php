<?php

use App\Http\Controllers\User\AuthController;
use Illuminate\Support\Facades\Route;

// auth route
Route::group(["prefix"=> "auth/user"], function () {
    Route::post("/register", [AuthController::class, 'register'])->name("");
});