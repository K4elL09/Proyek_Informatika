<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return redirect()->route('onboarding.slide1');
});

Route::prefix('onboarding')->group(function () {
    Route::get('1', function () {
        return view('onboarding.slide1');
    })->name('onboarding.slide1');

    Route::get('2', function () {
        return view('onboarding.slide2');
    })->name('onboarding.slide2');

    Route::get('3', function ()  {
        return view('onboarding.slide3');
    })->name('onboarding.slide3');
});

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');