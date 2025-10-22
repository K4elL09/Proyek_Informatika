<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PageController extends Controller
{
    /**
     * Menampilkan halaman beranda dengan produk
     * dan menangani logika pencarian.
     */
    public function home(Request $request)
    {
        $searchTerm = $request->input('search');

        $query = Product::query();

        $query->when($searchTerm, function ($q, $term) {
            
            return $q->where('nama_produk', 'LIKE', '%' . $term . '%');
        });

        $products = $query->get();

        return view('home', [
            'products' => $products
        ]);
    }
}