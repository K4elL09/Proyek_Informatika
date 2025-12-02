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
        $request->validate([
            'tanggal_kembali' => 'required|date|after_or_equal:tomorrow', 
            'alamat' => 'required|string|min:5',
            'metode' => 'required|string|in:QRIS,Transfer Bank',
        ]);
        
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
            $tanggalSewa = Carbon::now()->startOfDay();
            $tanggalKembali = Carbon::parse($request->input('tanggal_kembali'))->startOfDay();
            
            $rentalDays = $tanggalSewa->diffInDays($tanggalKembali);
            if ($rentalDays < 1) {
                $rentalDays = 1;
            }

            $subtotalSewa = collect($cart)->sum(function ($item) use ($rentalDays) {
                return $item['harga'] * $item['quantity'] * $rentalDays;
            });

            $biayaLayanan = 7000;
            $totalAkhir = $subtotalSewa + $biayaLayanan;

            $namaPemesan = Auth::check() 
                             ? Auth::user()->name 
                             : $request->input('nama', 'Penyewa Guest');

            $transaksi = Transaksi::create([
                'user_id' => auth()->id() ?? null,
                'nama' => $namaPemesan,
                'alamat' => $request->input('alamat', 'Alamat belum diisi'),
                'metode' => $request->input('metode'), 
                'tanggal_sewa' => Carbon::now(),
                'tanggal_kembali' => $tanggalKembali, 
                'total' => $totalAkhir, 
                'status' => 'Menunggu Pembayaran' 
            ]);

            foreach ($cart as $id => $item) {
                Penyewaan::create([
                    'transaksi_id' => $transaksi->id,
                    'product_id' => $id,
                    'quantity' => $item['quantity'],
                    'harga' => $item['harga'] * $item['quantity'] * $rentalDays, 
                ]);
            }

            DB::commit();

            session()->forget('cart');
            
            return redirect()->route('pembayaran.konfirmasi.show', $transaksi->id); 

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function showKonfirmasiPembayaran($transaksiId)
    {
        $transaksi = Transaksi::findOrFail($transaksiId);

        if (Auth::check() && Auth::id() !== $transaksi->user_id) {
             return redirect()->route('home')->with('error', 'Akses ditolak.');
        }

        return view('payment_confirm', compact('transaksi'));
    }

    public function konfirmasiPembayaran(Request $request, $transaksiId)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $transaksi = Transaksi::findOrFail($transaksiId);
        
        if ($transaksi->status !== 'Menunggu Pembayaran') {
            return back()->with('error', 'Transaksi sudah diproses atau dibatalkan.');
        }

        DB::beginTransaction();
        try {
            $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
    
            $transaksi->update([
                'status' => 'Menunggu Verifikasi', 
                'bukti_transfer' => $path, 
            ]);
            
            foreach ($transaksi->penyewaan as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->stok = $product->stok - $item->quantity;
                    $product->save();
                }
            }

            DB::commit();

            return redirect()->route('pesanan.selesai', $transaksi->id)->with('success', 'Bukti pembayaran berhasil dikirim. Menunggu verifikasi admin.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memproses konfirmasi: ' . $e->getMessage());
        }
    }
}