<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesananController extends Controller
{

    public function index(Request $request)
    {
        $statusFilter = $request->query('status', 'semua');

        $query = Transaksi::where('user_id', Auth::id())
                          ->with('items.product') 
                          ->orderBy('created_at', 'desc');

        switch ($statusFilter) {
            case 'belum_bayar':
                $query->where('status', 'Menunggu Pembayaran');
                break;
            case 'sedang_dikemas': 
                $query->where('status', 'Menunggu Verifikasi');
                break;
            case 'dikirim':
                $query->where('status', 'Disewa');
                break;
            case 'selesai':
                $query->where('status', 'Selesai');
                break;
            case 'dibatalkan':
                $query->where('status', 'Dibatalkan');
                break;
        }

        $orders = $query->get();

        return view('pesanan.index', compact('orders', 'statusFilter'));
    }

    public function selesai($id)
    {
        $transaksi = Transaksi::with('items.product')->findOrFail($id);
        
        if (Auth::check() && $transaksi->user_id != Auth::id()) {
            return redirect()->route('home');
        }

        return view('pesanan_selesai', compact('transaksi'));
    }
}