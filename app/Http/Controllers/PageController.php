<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // <-- Import Model Product

class PageController extends Controller
{
    /**
     * Menampilkan halaman beranda dengan produk
     * dan menangani logika pencarian.
     */
    public function home(Request $request)
    {
        // 1. Ambil kata kunci pencarian dari URL
        $searchTerm = $request->input('search');

        // 2. Mulai kueri ke model Product
        $query = Product::query();

        // 3. JIKA ada kata kunci pencarian, filter datanya
        $query->when($searchTerm, function ($q, $term) {
            
            // Ganti 'nama_produk' jika nama kolom Anda berbeda
            return $q->where('nama_produk', 'LIKE', '%' . $term . '%');
        });

        // 4. Ambil semua data hasil kueri
        $products = $query->get();

        // 5. Kirim data $products ke view 'home'
        return view('home', [
            'products' => $products
        ]);
    }
}