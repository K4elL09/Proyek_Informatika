<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;
use App\Models\Penyewaan;
use App\Models\Product;

class AdminController extends Controller
{
    public function dashboard() { return view('admin.dashboard'); }

    public function laporan()
    {
        $totalPendapatan = DB::table('transaksi')->where('status', 'Selesai')->orWhere('status', 'Disewa')->sum('total');
        $jumlahTransaksi = DB::table('transaksi')->count(); 
        $transaksiTerbaru = DB::table('penyewaan')
                                ->join('products', 'penyewaan.product_id', '=', 'products.id')
                                ->select('penyewaan.*', 'products.nama_produk')
                                ->orderBy('penyewaan.created_at', 'desc')->take(10)->get();

        return view('admin.laporan.index', compact('totalPendapatan', 'jumlahTransaksi', 'transaksiTerbaru'));
    }

    public function pemesanan()
    {
        $semuaPemesanan = Transaksi::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.pemesanan.index', compact('semuaPemesanan'));
    }

    public function showPemesananDetail($id)
    {
        $transaksi = Transaksi::with(['user', 'items.product'])->findOrFail($id);
        return view('admin.pemesanan.show', compact('transaksi'));
    }

    public function createPemesanan()
    {
        $products = Product::where('stok', '>', 0)->get();
        return view('admin.pemesanan.create', compact('products'));
    }

    public function storePemesanan(Request $request)
    {
        // (Kode Pesanan Offline Anda - Ini harus langsung mengurangi stok)
        // ... (Gunakan kode storePemesanan yang sebelumnya saya berikan) ...
        // ... Karena offline dianggap langsung 'deal', stok langsung dikurangi.
        
        // Agar ringkas, saya fokus ke logika online di bawah ini:
    }


    // --- LOGIKA INTI ---

    public function pengembalian()
    {
     $transaksiVerifikasi = Transaksi::where('status', 'Menunggu Verifikasi')->get();

    $transaksiDisewa = Transaksi::where('status', 'Disewa')->get();

    return view('admin.pengembalian.index', compact('transaksiVerifikasi', 'transaksiDisewa'));
    }

    /**
     * 3. ADMIN SETUJUI (Stok Berkurang Di Sini)
     */
    public function setujuiPembayaran($id)
    {
        $transaksi = Transaksi::with('items')->findOrFail($id);
        
        if ($transaksi->status == 'Menunggu Verifikasi') {
            DB::beginTransaction();
            try {
                // Cek ketersediaan stok dulu sebelum mengurangi
                foreach ($transaksi->items as $item) {
                    $product = Product::find($item->product_id);
                    if ($product->stok < $item->quantity) {
                        return back()->with('error', "Gagal! Stok {$product->nama_produk} tidak cukup (Sisa: {$product->stok}).");
                    }
                }

                // Jika aman, kurangi stok
                foreach ($transaksi->items as $item) {
                    $product = Product::find($item->product_id);
                    $product->decrement('stok', $item->quantity);
                }

                $transaksi->status = 'Disewa';
                $transaksi->save();

                DB::commit();
                return back()->with('success', 'Pembayaran disetujui. Stok berhasil dikurangi.');

            } catch (\Exception $e) {
                DB::rollBack();
                return back()->with('error', 'Error: ' . $e->getMessage());
            }
        }
        return back()->with('error', 'Status transaksi tidak valid.');
    }

    /**
     * 4. ADMIN TERIMA KEMBALI (Stok Bertambah)
     */
    public function prosesPengembalian(Request $request)
    {
        $request->validate(['transaksi_id' => 'required|exists:transaksi,id']);

        DB::beginTransaction();
        try {
            $transaksi = Transaksi::find($request->transaksi_id);
            $transaksi->status = 'Selesai';
            $transaksi->save();

            $itemsSewa = Penyewaan::where('transaksi_id', $transaksi->id)->get();

            foreach ($itemsSewa as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->increment('stok', $item->quantity); // Tambah stok kembali
                }
            }
            
            DB::commit();
            return redirect()->route('admin.pengembalian.index')->with('success', 'Barang dikembalikan. Stok diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}