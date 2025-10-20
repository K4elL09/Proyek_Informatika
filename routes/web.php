<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;

Route::get('/', function () {
    return redirect()->route('onboarding.slide1');
});

Route::prefix('onboarding')->group(function () {
    Route::get('1', fn() => view('onboarding.slide1'))->name('onboarding.slide1');
    Route::get('2', fn() => view('onboarding.slide2'))->name('onboarding.slide2');
    Route::get('3', fn() => view('onboarding.slide3'))->name('onboarding.slide3');

    Route::get('login', [AuthController::class, 'showLogin'])->name('onboarding.login');
    Route::get('register', [AuthController::class, 'showRegister'])->name('onboarding.register');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/home', [PageController::class, 'home'])->name('home');

Route::fallback(fn() => redirect()->route('onboarding.slide1'));
