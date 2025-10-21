<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController; // <-- TAMBAHKAN INI

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

<<<<<<< HEAD
// --- ROUTE BARU UNTUK PROFIL ---
// Rute ini akan memanggil method 'show' di ProfileController
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

// Rute untuk proses logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::fallback(fn() => redirect()->route('onboarding.slide1'));
=======
Route::fallback(fn() => redirect()->route('onboarding.slide1'));

Route::view('/onboarding/slide4', 'onboarding.slide4')->name('onboarding.slide4');

>>>>>>> 4ecc4888e1d011d76ca55d35aba374eddf2f52c1
