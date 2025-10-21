<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product; // <-- 1. IMPORT MODEL ANDA

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 2. Gunakan Model Product untuk membuat data
        Product::create([
            'nama_produk' => 'Tenda NSM Kapasitas 6',
            'harga' => 80000,
            'durasi_sewa' => '24 Jam',
            'gambar_produk' => 'tenda_nsm6.jpg' // Sesuaikan nama file gambar
        ]);

        Product::create([
            'nama_produk' => 'Tenda NSM Kapasitas 4',
            'harga' => 80000, // Anda menulis 80rb di kode lama, sesuaikan
            'durasi_sewa' => '24 Jam',
            'gambar_produk' => 'tenda_nsm4.jpg'
        ]);

        Product::create([
            'nama_produk' => 'Tenda Borneo Kapasitas 4',
            'harga' => 50000,
            'durasi_sewa' => '24 Jam',
            'gambar_produk' => 'tenda_borneo4.jpg'
        ]);

    }
}