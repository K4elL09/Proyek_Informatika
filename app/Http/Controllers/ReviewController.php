<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review; // Asumsi model Review sudah dibuat
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Tampilkan halaman ulasan untuk produk tertentu.
     */
    public function index($productId)
    {
        // Memastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk memberikan ulasan.');
        }

        $product = Product::findOrFail($productId);
        
        // Ambil semua ulasan untuk produk ini (disortir dari terbaru)
        $reviews = Review::where('product_id', $productId)->latest()->get();

        // Cek ulasan user saat ini (untuk edit jika sudah pernah)
        $userReview = Review::where('product_id', $productId)
                            ->where('user_id', Auth::id())
                            ->first();

        // Pass data ke view
        return view('ulasan', compact('product', 'reviews', 'userReview'));
    }

    /**
     * Simpan ulasan baru atau update ulasan yang sudah ada.
     */
    public function store(Request $request, $productId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|max:500',
        ]);

        $user = Auth::user();

        // Pastikan produk ada
        Product::findOrFail($productId);

        // Simpan/Update ulasan
        $review = Review::updateOrCreate(
            [
                'user_id' => $user->id,
                'product_id' => $productId,
            ],
            [
                'rating' => $request->rating,
                'content' => $request->content,
            ]
        );

        $action = $review->wasRecentlyCreated ? 'ditambahkan' : 'diperbarui';

        return redirect()->route('review.index', $productId)->with('success', "Ulasan Anda berhasil {$action}!");
    }
}