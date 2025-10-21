<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product; // Pastikan Model Product di-import

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // --- PRODUK TENDA (YANG SUDAH ADA) ---
        Product::create([
            'nama_produk' => 'Tenda NSM Kapasitas 6',
            'harga' => 80000,
            'durasi_sewa' => '24 Jam',
            'gambar_produk' => 'tenda_nsm6.jpg'
        ]);

        Product::create([
            'nama_produk' => 'Tenda NSM Kapasitas 4',
            'harga' => 80000,
            'durasi_sewa' => '24 Jam',
            'gambar_produk' => 'tenda_nsm4.jpg'
        ]);

        Product::create([
            'nama_produk' => 'Tenda Borneo Kapasitas 4',
            'harga' => 50000,
            'durasi_sewa' => '24 Jam',
            'gambar_produk' => 'tenda_borneo4.jpg'
        ]);

        // --- PRODUK BARU (DARI GAMBAR ANDA) ---
        
        Product::create([
            'nama_produk' => 'Matras Camping', // <-- Ganti jika perlu
            'harga' => 5000, // <-- GANTI HARGANYA ⚠️
            'durasi_sewa' => '24 Jam',
            'gambar_produk' => 'matras 1.jpg' // Nama file dari gambar Anda
        ]);

        Product::create([
            'nama_produk' => 'Sleeping Bag (SB)', // <-- Ganti jika perlu
            'harga' => 15000, // <-- GANTI HARGANYA ⚠️
            'durasi_sewa' => '24 Jam',
            'gambar_produk' => 'sb 1.jpg' // Nama file dari gambar Anda
        ]);

        Product::create([
            'nama_produk' => 'Senter / Headlamp', // <-- Ganti jika perlu
            'harga' => 10000, // <-- GANTI HARGANYA ⚠️
            'durasi_sewa' => '24 Jam',
            'gambar_produk' => 'senter 1.jpg' // Nama file dari gambar Anda
        ]);

        // Tambahkan produk lain di sini jika ada...
    }
}