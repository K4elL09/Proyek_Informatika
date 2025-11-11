<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PageController extends Controller
{
    /**
     * Menampilkan halaman beranda dengan produk
     * serta mendukung pencarian dan filter kategori.
     */
   public function home(Request $request)
    {
        $searchTerm = $request->input('search');
        $kategori = $request->input('kategori');

        $query = Product::query();

        // Filter berdasarkan pencarian nama produk
        if ($searchTerm) {
            $query->where('nama_produk', 'LIKE', '%' . $searchTerm . '%');
        }

        // Filter berdasarkan kategori
        if ($kategori && $kategori !== 'Semua') {
            $query->whereRaw('LOWER(kategori) = ?', [strtolower($kategori)]);
        }

        // Ambil data produk
        $products = $query->get();

        // Kirim ke view
        return view('home', [
            'products' => $products,
        ]);
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('onboarding.show', compact('product'));
    }
}
