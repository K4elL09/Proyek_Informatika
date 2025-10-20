<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Tampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses login (sementara redirect saja)
    public function login(Request $request)
    {
        // Validasi sederhana
        $request->validate([
            'emailOrPhone' => 'required',
            'password' => 'required',
        ]);

        // Di sini nanti kamu bisa tambahkan autentikasi (Auth::attempt)
        return redirect()->route('home');
    }

    // Tampilkan halaman register
    public function showRegister()
    {
        return view('auth.register');
    }

    // Proses registrasi (sementara redirect saja)
    public function register(Request $request)
    {
        // Validasi sederhana
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        // Nanti bisa tambahkan logika simpan user baru di sini
        return redirect()->route('login');
    }
}
