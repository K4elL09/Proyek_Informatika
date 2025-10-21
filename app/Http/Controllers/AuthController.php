<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // <-- PENTING
use Illuminate\Support\Facades\Auth; // <-- PENTING
use Illuminate\Support\Facades\Hash; // <-- PENTING

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * INI FUNGSI YANG DIPERBAIKI
     * Menangani proses login.
     */
    public function login(Request $request)
    {
        // 1. Validasi input
        // PASTIKAN form login Anda menggunakan name="email"
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. KUNCI: Coba untuk melakukan login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Regenerasi session untuk keamanan
            
            // Jika berhasil, redirect ke 'home'
            return redirect()->intended('home'); 
        }

        // 3. Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau password yang diberikan salah.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Menangani proses registrasi.
     */
    public function register(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users', // (Ini butuh kolom 'username' di DB)
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 2. Buat pengguna baru di database
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Enkripsi password
        ]);

        // 3. Langsung login-kan pengguna yang baru mendaftar
        Auth::login($user);

        // 4. Arahkan ke halaman home
        return redirect()->route('home');
    }

    /**
     * Menangani proses logout pengguna.
     */
    public function logout(Request $request)
    {
        Auth::logout(); // KUNCI: Proses logout

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login'); // Arahkan ke halaman login setelah logout
    }
}