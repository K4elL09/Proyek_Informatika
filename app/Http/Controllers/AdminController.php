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
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function laporan()
    {
        $totalPendapatan = DB::table('transaksi')->sum('total');
        $jumlahTransaksi = DB::table('transaksi')->count(); 
        
        $transaksiTerbaru = DB::table('penyewaan')
                                ->join('products', 'penyewaan.product_id', '=', 'products.id')
                                ->select('penyewaan.*', 'products.nama_produk')
                                ->orderBy('penyewaan.created_at', 'desc')
                                ->take(10)
                                ->get();

        return view('admin.laporan.index', [
            'totalPendapatan' => $totalPendapatan,
            'jumlahTransaksi' => $jumlahTransaksi,
            'transaksiTerbaru' => $transaksiTerbaru,
        ]);
    }

    public function pemesanan()
    {
        $semuaPemesanan = Transaksi::with('user')
                                    ->orderBy('created_at', 'desc')
                                    ->get();
                                    
        return view('admin.pemesanan.index', compact('semuaPemesanan'));
    }

    public function showPemesananDetail($id)
    {
        $transaksi = Transaksi::with(['user', 'items.product'])
                                ->findOrFail($id);

        return view('admin.pemesanan.show', compact('transaksi'));
    }

    public function pengembalian()
    {
        $transaksiDisewa = Transaksi::where('status', 'Disewa')->get();
        return view('admin.pengembalian.index', compact('transaksiDisewa'));
    }

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
                    $product->stok = $product->stok + $item->quantity;
                    $product->save();
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