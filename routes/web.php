<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\ReviewController;

// ====================
// REDIRECT ROOT
// ====================
Route::get('/', function () {
    return redirect()->route('onboarding.slide1');
});

// ====================
// ONBOARDING
// ====================
Route::prefix('onboarding')->group(function () {
    Route::get('1', fn() => view('onboarding.slide1'))->name('onboarding.slide1');
    Route::get('2', fn() => view('onboarding.slide2'))->name('onboarding.slide2');
    Route::get('3', fn() => view('onboarding.slide3'))->name('onboarding.slide3');
    Route::get('4', fn() => view('onboarding.slide4'))->name('onboarding.slide4');
    Route::get('login', [AuthController::class, 'showLogin'])->name('onboarding.login');
    Route::get('register', [AuthController::class, 'showRegister'])->name('onboarding.register');
});

// ====================
// AUTHENTICATION
// ====================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ====================
// USER AREA (Akses Wajib Login)
// ====================
Route::middleware(['auth:web'])->group(function () {
    // HOME & PROFILE
    Route::get('/home', [PageController::class, 'home'])->name('home');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    
    // Profile Updates
    Route::post('/profile/update-photo', [ProfileController::class, 'updatePhoto'])->name('profile.update.photo');
    Route::get('/profile/edit-password', [ProfileController::class, 'editPassword'])->name('profile.edit.password');
    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
    Route::get('/profile/edit-phone', [ProfileController::class, 'editPhone'])->name('profile.edit.phone');
    Route::post('/profile/update-phone', [ProfileController::class, 'updatePhone'])->name('profile.update.phone');
    
    // RUTE KONFIRMASI PEMBAYARAN
    Route::get('/konfirmasi-pembayaran/{transaksiId}', [CartController::class, 'showKonfirmasiPembayaran'])->name('pembayaran.konfirmasi.show');
    Route::post('/konfirmasi-pembayaran/{transaksiId}', [CartController::class, 'konfirmasiPembayaran'])->name('pembayaran.konfirmasi');

    // RUTE ULASAN
    Route::get('/produk/{productId}/ulasan', [ReviewController::class, 'index'])->name('review.index');
    Route::post('/produk/{productId}/ulasan', [ReviewController::class, 'store'])->name('review.store');
});

// ====================
// ADMIN AREA
// ====================
Route::middleware(['auth:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Stok Alat (CRUD)
    Route::resource('stok', StokController::class);

    // Laporan Keuangan
    Route::get('/laporan', [AdminController::class, 'laporan'])->name('laporan.index');
    
    // Informasi Pemesanan (Online & Offline)
    Route::get('/pemesanan', [AdminController::class, 'pemesanan'])->name('pemesanan.index');
    Route::get('/pemesanan/{id}', [AdminController::class, 'showPemesananDetail'])->name('pemesanan.show');
    
    // Tambah Pesanan Manual (Offline)
    Route::get('/pemesanan/buat/baru', [AdminController::class, 'createPemesanan'])->name('pemesanan.create');
    Route::post('/pemesanan/store', [AdminController::class, 'storePemesanan'])->name('pemesanan.store');

    // Pengembalian & Verifikasi
    Route::get('/pengembalian', [AdminController::class, 'pengembalian'])->name('pengembalian.index');
    
    // Aksi Admin: Terima Barang Kembali
    Route::post('/pengembalian/proses', [AdminController::class, 'prosesPengembalian'])->name('pengembalian.proses');
    
    // Aksi Admin: Setujui Pembayaran
    Route::post('/pembayaran/setuju/{id}', [AdminController::class, 'setujuiPembayaran'])->name('pembayaran.setuju');
});

// ====================
// PUBLIC/GLOBAL ROUTES
// ====================
Route::fallback(fn() => redirect()->route('onboarding.slide1'));

Route::get('/produk/{id}', [ProductController::class, 'show'])->name('produk.show');

// Keranjang
Route::post('/keranjang/tambah/{id}', [CartController::class, 'tambah'])->name('keranjang.tambah');
Route::get('/keranjang', [CartController::class, 'index'])->name('keranjang.index');
Route::post('/keranjang/update/{id}', [CartController::class, 'update'])->name('keranjang.update');
Route::post('/keranjang/hapus/{id}', [CartController::class, 'hapus'])->name('keranjang.hapus');

// Checkout
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/checkout/process', [CartController::class, 'prosesCheckout'])->name('checkout.process');
Route::post('/checkout/sewa-langsung/{id}', [CartController::class, 'sewaLangsung'])->name('checkout.sewaLangsung');

// Halaman Sukses
Route::get('/pesanan/selesai/{id}', [PesananController::class, 'selesai'])->name('pesanan.selesai');