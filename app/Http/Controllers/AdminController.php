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
    // --- Dashboard ---
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // --- Laporan Keuangan ---
    public function laporan()
    {
        $totalPendapatan = DB::table('transaksi')->whereIn('status', ['Disewa', 'Selesai'])->sum('total');
        $jumlahTransaksi = DB::table('transaksi')->count(); 
        
        $transaksiTerbaru = DB::table('penyewaan')
                                ->join('products', 'penyewaan.product_id', '=', 'products.id')
                                ->select('penyewaan.*', 'products.nama_produk')
                                ->orderBy('penyewaan.created_at', 'desc')
                                ->take(10)
                                ->get();

        return view('admin.laporan.index', compact('totalPendapatan', 'jumlahTransaksi', 'transaksiTerbaru'));
    }

    // --- Informasi Pemesanan ---
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

    // --- Pesanan Manual (Offline) ---
    public function createPemesanan()
    {
        $products = Product::where('stok', '>', 0)->get();
        return view('admin.pemesanan.create', compact('products'));
    }

    public function storePemesanan(Request $request)
    {
        // (Gunakan kode storePemesanan yang sudah saya berikan sebelumnya)
        // Pastikan di sini stok LANGSUNG dikurangi karena offline
        // ...
    }


    // ==========================================
    // LOGIKA PENGEMBALIAN & VERIFIKASI (INTI)
    // ==========================================

    public function pengembalian()
    {
        // 1. Ambil data yang butuh verifikasi pembayaran
        $transaksiVerifikasi = Transaksi::where('status', 'Menunggu Verifikasi')->orderBy('created_at', 'asc')->get();

        // 2. Ambil data yang sedang disewa (barang di luar)
        $transaksiDisewa = Transaksi::where('status', 'Disewa')->orderBy('created_at', 'asc')->get();

        return view('admin.pengembalian.index', compact('transaksiVerifikasi', 'transaksiDisewa'));
    }

    /**
     * Aksi: Admin Menyetujui Pembayaran
     * Stok berkurang di sini (untuk pesanan online).
     */
    public function setujuiPembayaran($id)
    {
        $transaksi = Transaksi::with('items')->findOrFail($id);
        
        if ($transaksi->status == 'Menunggu Verifikasi') {
            
            DB::beginTransaction();
            try {
                // Cek stok dulu
                foreach ($transaksi->items as $item) {
                    $product = Product::find($item->product_id);
                    if ($product->stok < $item->quantity) {
                        return back()->with('error', "Gagal! Stok {$product->nama_produk} tidak cukup.");
                    }
                }

                // Kurangi stok
                foreach ($transaksi->items as $item) {
                    $product = Product::find($item->product_id);
                    $product->decrement('stok', $item->quantity);
                }

                // Ubah status
                $transaksi->status = 'Disewa';
                $transaksi->save();

                DB::commit();
                return back()->with('success', 'Pembayaran disetujui. Stok barang telah dikurangi.');

            } catch (\Exception $e) {
                DB::rollBack();
                return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        }

        return back()->with('error', 'Status transaksi tidak valid.');
    }

    /**
     * Aksi: Admin Menerima Barang Kembali
     * Stok bertambah di sini.
     */
    public function prosesPengembalian(Request $request)
    {
        $request->validate(['transaksi_id' => 'required|exists:transaksi,id']);

        DB::beginTransaction();
        try {
            $transaksi = Transaksi::with('items')->find($request->transaksi_id);
            
            // Ubah status
            $transaksi->status = 'Selesai';
            $transaksi->save();

            // Kembalikan stok
            foreach ($transaksi->items as $item) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->increment('stok', $item->quantity);
                }
            }
            
            DB::commit();
            return redirect()->route('admin.pengembalian.index')
                             ->with('success', 'Barang telah dikembalikan dan stok telah diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}