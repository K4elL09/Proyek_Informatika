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
        // Mengambil data pengguna yang sedang login
        $user = Auth::user();

        // Jika tidak ada user yang login (misal, sesi habis), arahkan ke halaman login
        if (!$user) {
            return redirect()->route('login');
        }

        // Tampilkan view 'profile.blade.php' dan kirim data user
        return view('profile', ['user' => $user]);
    }

    /**
     * (Opsional) Menampilkan halaman untuk mengedit profil.
     */
    public function edit()
    {
        // Logika untuk menampilkan form edit profil bisa ditambahkan di sini
    }

    /**
     * (Opsional) Menyimpan perubahan data profil.
     */
    public function update(Request $request)
    {
        // Logika untuk validasi dan menyimpan data yang di-update bisa ditambahkan di sini
    }
}