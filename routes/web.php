<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PengembalianController;

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

Route::get('/home', [PageController::class, 'home'])->name('home');
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // ROUTE UNTUK MENU DASHBOARD
    Route::get('/admin/stok', [StokController::class, 'index'])->name('stok.index');
    Route::get('/admin/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/admin/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
    Route::get('/admin/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
});

Route::fallback(fn() => redirect()->route('onboarding.slide1'));
