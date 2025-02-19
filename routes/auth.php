<?php

use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::get('login', [Login::class, 'create'])
        ->name('login');
    Route::post('login', [Login::class, 'store']);

    Route::get('register', [Register::class, 'create'])
        ->name('register');
    Route::post('register', [Register::class, 'store']);
});

Route::middleware('auth')->group(function () {

    Route::post('logout', [Login::class, 'destroy'])
        ->name('logout');
});

