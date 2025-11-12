<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// Kita 'extends Authenticatable' agar model ini bisa digunakan untuk login
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Tentukan guard autentikasi yang digunakan oleh model ini.
     * Ini harus cocok dengan yang ada di config/auth.php
     */
    protected $guard = 'admin';

    /**
     * Kolom yang boleh diisi (mass assignable).
     * Pastikan semua kolom ini ada di tabel 'admins' Anda.
     */
    protected $fillable = [
        'name',
        'username', // <-- Pastikan ini ada di tabel 'admins'
        'email',
        'password',
    ];

    /**
     * Kolom yang harus disembunyikan saat di-serialisasi.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}