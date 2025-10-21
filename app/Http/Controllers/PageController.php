<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // <-- PASTIKAN NAMA MODEL ANDA 'Product'

class PageController extends Controller
{
    /**
     * Menampilkan halaman home dengan daftar produk.
     * Akan memfilter produk jika ada parameter 'search' di URL.
     */
    public function home(Request $request)
    {
        // Mengambil kata kunci pencarian dari request
        $searchTerm = $request->input('search');

        // Memulai kueri ke model Product
        // Ganti 'Product' jika nama model Anda berbeda
        $query = Product::query();

        // Menerapkan filter pencarian HANYA JIKA $searchTerm tidak kosong
        $query->when($searchTerm, function ($q) use ($searchTerm) {
            
            // Ganti 'nama_produk' dengan nama kolom produk di database Anda
            return $q->where('nama_produk', 'LIKE', '%' . $searchTerm . '%');
            
            /* // Opsional: Jika ingin mencari di beberapa kolom sekaligus
            return $q->where(function($subq) use ($searchTerm) {
                $subq->where('nama_produk', 'LIKE', '%' . $searchTerm . '%')
                     ->orWhere('deskripsi', 'LIKE', '%' . $searchTerm . '%'); // Ganti 'deskripsi'
            });
            */
        });

        // Eksekusi kueri dan ambil semua hasilnya
        $products = $query->get();

        // Kirim data produk yang sudah (atau tidak) difilter ke view
        return view('home', [
            'products' => $products
        ]);
    }

    // Mungkin Anda punya method lain di sini...
}