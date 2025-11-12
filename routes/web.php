<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StokController;

Route::get('/', function () {
    return redirect()->route('onboarding.slide1');
});

Route::prefix('onboarding')->group(function () {
    Route::get('1', fn() => view('onboarding.slide1'))->name('onboarding.slide1');
    Route::get('2', fn() => view('onboarding.slide2'))->name('onboarding.slide2');
    Route::get('3', fn() => view('onboarding.slide3'))->name('onboarding.slide3');
    Route::get('4', fn() => view('onboarding.slide4'))->name('onboarding.slide4');
    Route::get('login', [AuthController::class, 'showLogin'])->name('onboarding.login');
    Route::get('register', [AuthController::class, 'showRegister'])->name('onboarding.register');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth:web'])->group(function () {
    Route::get('/home', [PageController::class, 'home'])->name('home');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
});

Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    Route::resource('stok', StokController::class);

    Route::get('/laporan', [AdminController::class, 'laporan'])->name('laporan.index');
    Route::get('/pemesanan', [AdminController::class, 'pemesanan'])->name('pemesanan.index');
    Route::get('/pengembalian', [AdminController::class, 'pengembalian'])->name('pengembalian.index');
});

Route::fallback(fn() => redirect()->route('onboarding.slide1'));