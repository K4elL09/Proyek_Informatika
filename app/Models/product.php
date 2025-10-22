<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Kolom yang boleh diisi oleh Seeder atau Form.
     */
    protected $fillable = [
        'nama_produk',
        'harga',
        'durasi_sewa',
        'gambar_produk',
        'deskripsi',
    ];
}