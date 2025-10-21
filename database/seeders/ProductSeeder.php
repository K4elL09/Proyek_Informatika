<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product; // <-- Import Model Product

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama agar tidak duplikat (opsional tapi disarankan)
        // Product::truncate(); 

        // --- PRODUK TENDA ---
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
            'gambar_produk' => 'tenda_borneo4.png'
        ]);

        // --- PRODUK BARU (DARI GAMBAR ANDA) ---
        Product::create([
            'nama_produk' => 'Matras Camping',
            'harga' => 5000, // Ganti harganya jika perlu
            'durasi_sewa' => '24 Jam',
            'gambar_produk' => 'matras 1.jpg'
        ]);

        Product::create([
            'nama_produk' => 'Sleeping Bag (SB)',
            'harga' => 15000, // Ganti harganya jika perlu
            'durasi_sewa' => '24 Jam',
            'gambar_produk' => 'sb 1.jpg'
        ]);

        Product::create([
            'nama_produk' => 'Senter / Headlamp',
            'harga' => 10000, // Ganti harganya jika perlu
            'durasi_sewa' => '24 Jam',
            'gambar_produk' => 'senter 1.jpg'
        ]);
    }
}