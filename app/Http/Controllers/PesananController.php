<?php
namespace App\Http\Controllers;

use App\Models\Transaksi;

class PesananController extends Controller
{
    public function selesai($id)
    {
        $transaksi = Transaksi::with('penyewaan.product')->findOrFail($id);
        return view('pesanan_selesai', compact('transaksi'));
    }
}