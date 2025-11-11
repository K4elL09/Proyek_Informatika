<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

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

Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::view('/onboarding/slide4', 'onboarding.slide4')->name('onboarding.slide4');

Route::fallback(fn() => redirect()->route('onboarding.slide1'));

Route::get('/ulasan', function () {
    return view('ulasan');
});

Route::get('/produk/{id}', [ProductController::class, 'show'])->name('produk.show');

Route::post('/keranjang/tambah/{id}', [CartController::class, 'tambah'])->name('keranjang.tambah');
Route::get('/keranjang', [CartController::class, 'index'])->name('keranjang.index');

Route::post('/keranjang/update/{id}', [CartController::class, 'update'])->name('keranjang.update');
Route::post('/keranjang/hapus/{id}', [CartController::class, 'hapus'])->name('keranjang.hapus');