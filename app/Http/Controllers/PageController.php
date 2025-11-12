<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // <-- INI YANG HILANG
use App\Models\Product;

class PageController extends Controller
{
    /**
     * Tampilkan halaman home dengan fitur search & filter
     */
    public function home(Request $request) // <-- INI YANG HILANG
    {
        // Mulai query builder
        $query = Product::query();

        // 1. Logika untuk Search
        $query->when($request->search, function ($q) use ($request) {
            return $q->where('nama_produk', 'like', '%' . $request->search . '%')
                     ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        });

        // 2. Logika untuk Filter Kategori
        $query->when($request->kategori, function ($q) use ($request) {
            return $q->where('kategori', $request->kategori);
        });

        // 3. Ambil hasilnya
        $products = $query->get();
        
        // 4. Kirim data products ke view
        return view('home', compact('products'));
    }
}