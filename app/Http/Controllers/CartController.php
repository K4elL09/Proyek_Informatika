<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaksi;
use App\Models\Penyewaan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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

    public function sewaLangsung($id)
    {
        session()->forget('cart'); 
        $product = Product::findOrFail($id);
        $cart = [
            $id => [
                'nama' => $product->nama_produk,
                'harga' => $product->harga,
                'gambar' => $product->gambar_produk,
                'quantity' => 1,
                'durasi' => $product->durasi_sewa,
            ]
        ];
        $total = $product->harga;
        session()->put('cart', $cart);
        return view('checkout', compact('cart', 'total'));
    }

    public function prosesCheckout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('keranjang.index')->with('error', 'Keranjang kosong!');
        }

        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if ($product->stok < $item['quantity']) {
                return back()->with('error', 'Stok untuk ' . $product->nama_produk . ' tidak mencukupi! Sisa stok: ' . $product->stok);
            }
        }

        DB::beginTransaction();

        try {

            $namaPemesan = Auth::check() 
                            ? Auth::user()->name 
                            : $request->input('nama', 'Penyewa Guest');

            $transaksi = Transaksi::create([
                'user_id' => auth()->id() ?? null,
                'nama' => $namaPemesan,
                'alamat' => $request->input('alamat', 'Alamat belum diisi'),
                'metode' => $request->input('metode', 'Transfer Bank - Bank Jateng'),
                'tanggal_sewa' => Carbon::now(),
                'tanggal_kembali' => Carbon::now()->addDays(3), 
                'total' => collect($cart)->sum(fn($i) => $i['harga'] * $i['quantity']) + 7000,
                'status' => 'Disewa' 
            ]);

            foreach ($cart as $id => $item) {
                Penyewaan::create([
                    'transaksi_id' => $transaksi->id,
                    'product_id' => $id,
                    'quantity' => $item['quantity'],
                    'harga' => $item['harga'] * $item['quantity'],
                ]);

                $product = Product::find($id);
                $product->stok = $product->stok - $item['quantity'];
                $product->save();
            }

            DB::commit();

            session()->forget('cart');
            return redirect()->route('pesanan.selesai', $transaksi->id);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}