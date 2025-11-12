<?php

namespace App\Http\Controllers;

// ===== TAMBAHKAN DUA BARIS INI =====
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// ===================================

use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Proses login untuk User dan Admin
     */
    public function login(Request $request)
    {
        // 1️⃣ Validasi input
        $request->validate([
            'login_field' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginInput = $request->input('login_field');
        $password = $request->input('password');

        // 2️⃣ Tentukan apakah input berupa email atau username
        $fieldType = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // 3️⃣ KUNCI: Coba login ke tabel admins (guard 'admin') TERLEBIH DAHULU
        if (Auth::guard('admin')->attempt([$fieldType => $loginInput, 'password' => $password])) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        // 4️⃣ Jika bukan admin, coba login ke tabel users (guard 'web')
        if (Auth::guard('web')->attempt([$fieldType => $loginInput, 'password' => $password])) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }

        // 5️⃣ Jika dua-duanya gagal
        return back()->withErrors([
            'login_field' => 'Email/Username atau password salah.',
        ])->onlyInput('login_field');
    }

    /**
     * Tampilkan halaman register user biasa
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Proses register user biasa (admin tidak bisa register di sini)
     */
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Login otomatis
        Auth::guard('web')->login($user);

        return redirect()->route('home');
    }

    /**
     * Logout untuk kedua jenis pengguna
     */
    public function logout(Request $request)
    {
        // Logout dari semua guard aktif
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }

        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}