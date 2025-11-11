<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller; // <-- Tambahkan ini
use Illuminate\Http\Request;          // <-- Tambahkan ini

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException; 

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * FUNGSI LOGIN YANG SUDAH DIMODIFIKASI
     */
    public function login(Request $request)
    {
        // 1. Validasi (Sudah benar)
        $request->validate([
            'login_field' => 'required|string',
            'password' => 'required',
        ]);

        // 2. Logika Email/Username (Sudah benar)
        $loginInput = $request->input('login_field');
        $fieldType = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $fieldType => $loginInput,
            'password' => $request->input('password')
        ];

        // 3. Coba Login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // --- INI PERUBAHANNYA ---
            // Cek role pengguna yang baru saja login
            if (Auth::user()->role === 'admin') {
                // Jika dia 'admin', arahkan ke dashboard admin
                return redirect()->route('admin.dashboard');
            }

            // Jika bukan admin (user biasa), arahkan ke 'home'
            return redirect()->intended(route('home'));
            // --- BATAS PERUBAHAN ---
        }

        // 4. Gagal Login (Sudah benar)
        return back()->withErrors([
            'login_field' => 'Email/Username atau password yang diberikan salah.',
        ])->onlyInput('login_field');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Fungsi Register (Sudah benar)
     */
    public function register(Request $request)
    {
        //Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        //Buat pengguna baru di database
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'role' akan otomatis 'user' (sesuai default di migrasi)
        ]);

        //Langsung login ketika pengguna yang baru mendaftar
        Auth::login($user);

        //Ke halaman home
        return redirect()->route('home');
    }

    /**
     * Fungsi Logout (Sudah benar)
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}