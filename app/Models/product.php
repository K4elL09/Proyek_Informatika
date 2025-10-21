<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terhubung dengan model ini.
     * (Opsional jika nama tabel Anda 'products')
     */
    // protected $table = 'nama_tabel_produk';

    /**
     * Kolom yang boleh diisi secara massal (mass assignable).
     * (Praktik yang baik untuk keamanan)
     */
    protected $fillable = [
        'nama_produk',
        'harga',
        'durasi_sewa',
        'gambar_produk',
        'deskripsi',
        // tambahkan kolom lain di sini
    ];
}