<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Tambahkan ini

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil pengguna.
     */
    public function show()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        return view('profile', ['user' => $user]);
    }

    /**
     * Menampilkan halaman untuk mengedit profil.
     */
    public function edit()
    {
        // Logika untuk menampilkan form edit profil nanti di isi
    }

    /**
     * Menyimpan perubahan data profil.
     */
    public function update(Request $request)
    {
        // Logika untuk validasi dan menyimpan data yang di-update
    }
}