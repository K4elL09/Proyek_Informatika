<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{
    /**
     * Menampilkan Daftar Pesanan Saya (Ala Shopee)
     */
    public function index(Request $request)
    {
        // 1. Ambil Parameter Status dari URL (?status=...)
        $statusFilter = $request->query('status', 'semua');

        // 2. Query Dasar: Ambil transaksi milik user yang sedang login
        $query = Transaksi::where('user_id', Auth::id())
                          ->with('items.product') // Eager load produk agar query ringan
                          ->orderBy('created_at', 'desc');

        // 3. Logika Filtering Tab ala Shopee
        switch ($statusFilter) {
            case 'belum_bayar':
                $query->where('status', 'Menunggu Pembayaran');
                break;
            case 'sedang_dikemas': 
                // Di rental, ini kita anggap 'Sedang Proses' atau 'Menunggu Verifikasi'
                $query->where('status', 'Menunggu Verifikasi');
                break;
            case 'dikirim':
                // Di rental, ini berarti barang sedang 'Disewa' (Di bawa user)
                $query->where('status', 'Disewa');
                break;
            case 'selesai':
                $query->where('status', 'Selesai');
                break;
            case 'dibatalkan':
                $query->where('status', 'Dibatalkan');
                break;
            // Case 'semua' tidak perlu filter, tampilkan apa adanya
        }

        $orders = $query->get();

        return view('pesanan.index', compact('orders', 'statusFilter'));
    }

    /**
     * Halaman Sukses (Kode Lama Anda)
     */
    public function selesai($id)
    {
        $transaksi = Transaksi::with('items.product')->findOrFail($id);
        
        // Cek apakah user berhak melihat ini
        if (Auth::check() && $transaksi->user_id != Auth::id()) {
            return redirect()->route('home');
        }

        return view('pesanan_selesai', compact('transaksi'));
    }
}