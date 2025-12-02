<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $user = Auth::user();

        // Hapus foto lama jika ada
        if ($user->photo && file_exists(storage_path('app/public/' . $user->photo))) {
            @unlink(storage_path('app/public/' . $user->photo));
        }

        // Simpan foto baru ke storage/app/public/profile_photos dan dapatkan path seperti "profile_photos/xxxx.png"
        $path = $request->file('photo')->store('profile_photos', 'public');

        // Simpan path relatif ke column photo (kamu sudah menggunakan asset('storage/' . $user->photo) di Blade)
        $user->photo = $path;
        $user->save();

        return back()->with('success', 'Foto profil berhasil diperbarui!');
    }

    // Menampilkan form edit password — kirim juga $user supaya view tidak error
    public function editPassword()
    {
        $user = Auth::user();
        return view('edit-password', compact('user'));
    }

    // Proses update password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        // cek apakah current password cocok
        if (! Hash::check($request->input('current_password'), $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah'])->withInput();
        }

        // update password
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return redirect()->route('profile')->with('success', 'Password berhasil diperbarui!');
    }

    // Menampilkan form edit nomor telepon — kirim $user juga
    public function editPhone()
    {
        $user = Auth::user();
        return view('edit-phone', compact('user'));
    }

    // Proses update nomor telepon
    public function updatePhone(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|min:8|max:15',
        ]);

        $user = Auth::user();
        $user->phone = $request->input('phone');
        $user->save();

        return redirect()->route('profile')->with('success', 'Nomor telepon berhasil diperbarui!');
    }
}
