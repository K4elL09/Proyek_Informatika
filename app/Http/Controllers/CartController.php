<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function tambah(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'nama' => $product->nama_produk,
                'harga' => $product->harga,
                'gambar' => $product->gambar_produk,
                'durasi' => $product->durasi_sewa,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('keranjang.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        return view('keranjang', compact('cart'));
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $newQty = $request->input('quantity');
            if ($newQty > 0) {
                $cart[$id]['quantity'] = $newQty;
            } else {
                unset($cart[$id]);
            }
            session()->put('cart', $cart);
        }

        return redirect()->route('keranjang.index');
    }

    public function hapus($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('keranjang.index')->with('success', 'Produk dihapus dari keranjang!');
    }

    
    public function checkout()
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(function ($item) {
            return $item['harga'] * $item['quantity'];
        });

        return view('checkout', compact('cart', 'total'));
    }

 
    public function prosesCheckout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('keranjang.index')->with('error', 'Keranjang kosong!');
        }

        // Simulasi penyimpanan (bisa disimpan ke database nantinya)
        $order = [
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'metode' => $request->input('metode'),
            'total' => collect($cart)->sum(fn($i) => $i['harga'] * $i['quantity']),
        ];

        // Kosongkan keranjang setelah checkout
        session()->forget('cart');

        return redirect()->route('home')->with('success', 'Pesanan berhasil dibuat!');
    }
}