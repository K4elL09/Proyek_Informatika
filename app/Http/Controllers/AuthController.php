<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException; // <-- Pastikan ini ada

class AuthController extends Controller
{
    public function showLogin()
    {
        // Path ini dari file Anda sebelumnya
        return view('auth.login');
    }

    /**
     * FUNGSI LOGIN YANG SUDAH DIMODIFIKASI
     * Menangani proses login dengan email ATAU username.
     */
    public function login(Request $request)
    {
        // 1. Validasi input
        // Kita ubah 'email' menjadi 'login_field' agar lebih jelas
        $request->validate([
            'login_field' => 'required|string',
            'password' => 'required',
        ]);

        // 2. Tentukan tipe input (email atau username)
        $loginInput = $request->input('login_field');
        
        // Cek apakah inputnya format email
        $fieldType = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // 3. Buat credentials untuk login
        $credentials = [
            $fieldType => $loginInput,
            'password' => $request->input('password')
        ];

        // 4. Coba untuk melakukan login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            return redirect()->intended('home');
        }

        // 5. Jika login gagal
        // Kita gunakan nama field 'login_field' untuk error
        return back()->withErrors([
            'login_field' => 'Email/Username atau password yang diberikan salah.',
        ])->onlyInput('login_field');
    }

    public function showRegister()
    {
        // Path ini dari file Anda sebelumnya
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
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // 2. Buat pengguna baru di database
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
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
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}