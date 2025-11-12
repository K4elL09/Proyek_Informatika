<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Ganti $fillable Anda dengan ini
     */
    protected $fillable = [
        'nama_produk',
        'harga',
        'durasi_sewa',
        'stok',
        'gambar_produk',
        'deskripsi',
        'kategori',
    ];
}