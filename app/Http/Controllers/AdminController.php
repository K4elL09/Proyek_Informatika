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
    public function laporan(Request $request)
    {
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        $totalPendapatanSemua = DB::table('transaksi')->whereIn('status', ['Disewa', 'Selesai'])->sum('total');
        $totalPendapatanBulanan = DB::table('transaksi')->whereIn('status', ['Disewa', 'Selesai'])
            ->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->sum('total');
        $jumlahTransaksiBulanan = DB::table('transaksi')->whereIn('status', ['Disewa', 'Selesai'])
            ->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->count();

        $itemTerjual = DB::table('penyewaan')
            ->join('transaksi', 'penyewaan.transaksi_id', '=', 'transaksi.id')
            ->join('products', 'penyewaan.product_id', '=', 'products.id')
            ->select('penyewaan.*', 'products.nama_produk', 'transaksi.created_at as tanggal_transaksi', 'transaksi.status')
            ->whereIn('transaksi.status', ['Disewa', 'Selesai'])
            ->whereMonth('transaksi.created_at', $bulan)->whereYear('transaksi.created_at', $tahun)
            ->orderBy('transaksi.created_at', 'desc')->get();

        return view('admin.laporan.index', compact('totalPendapatanSemua', 'totalPendapatanBulanan', 'jumlahTransaksiBulanan', 'itemTerjual', 'bulan', 'tahun'));
    }

    // --- Informasi Pemesanan ---
    public function pemesanan(Request $request)
    {
        $status = $request->input('status');
        $query = Transaksi::with('user')->orderBy('created_at', 'desc');
        if ($status) {
            $query->where('status', $status);
        }
        $semuaPemesanan = $query->get();
        $listStatus = ['Menunggu Pembayaran', 'Menunggu Verifikasi', 'Disewa', 'Selesai', 'Dibatalkan'];

        return view('admin.pemesanan.index', compact('semuaPemesanan', 'status', 'listStatus'));
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
        $request->validate(['nama' => 'required', 'metode' => 'required', 'products' => 'required|array', 'quantities' => 'required|array']);

        DB::beginTransaction();
        try {
            $totalHargaTransaksi = 0;
            $itemsToInsert = [];

            foreach ($request->products as $index => $productId) {
                $product = Product::find($productId);
                $qty = $request->quantities[$index];
                if ($product->stok < $qty) return back()->with('error', "Stok {$product->nama_produk} tidak cukup!");
                
                $subtotal = $product->harga * $qty;
                $totalHargaTransaksi += $subtotal;
                $itemsToInsert[] = ['product' => $product, 'qty' => $qty, 'subtotal' => $subtotal];
            }

            $transaksi = Transaksi::create([
                'user_id' => null, 'nama' => $request->nama . ' (Offline)', 'alamat' => 'Toko Fisik',
                'metode' => $request->metode, 'tanggal_sewa' => now(), 'tanggal_kembali' => now()->addDays(1),
                'total' => $totalHargaTransaksi, 'status' => 'Disewa'
            ]);

            foreach ($itemsToInsert as $item) {
                Penyewaan::create(['transaksi_id' => $transaksi->id, 'product_id' => $item['product']->id, 'quantity' => $item['qty'], 'harga' => $item['subtotal']]);
                $item['product']->decrement('stok', $item['qty']);
            }

            DB::commit();
            return redirect()->route('admin.pemesanan.index')->with('success', 'Pesanan offline berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    // [BARU] Admin Batalkan Pesanan
    public function batalkanPesananAdmin($id)
    {
        $transaksi = Transaksi::with('items')->findOrFail($id);
        if ($transaksi->status == 'Selesai') return back()->with('error', 'Transaksi Selesai tidak bisa dibatalkan.');

        DB::beginTransaction();
        try {
            // Jika status sebelumnya 'Disewa', kembalikan stok
            if ($transaksi->status == 'Disewa') {
                foreach ($transaksi->items as $item) {
                    Product::find($item->product_id)->increment('stok', $item->quantity);
                }
            }
            $transaksi->status = 'Dibatalkan';
            $transaksi->save();

            DB::commit();
            return back()->with('success', 'Pesanan dibatalkan (Stok dikembalikan jika perlu).');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    // --- Pengembalian & Verifikasi ---
    public function pengembalian()
    {
        $transaksiVerifikasi = Transaksi::where('status', 'Menunggu Verifikasi')->orderBy('created_at', 'asc')->get();
        $transaksiDisewa = Transaksi::where('status', 'Disewa')->orderBy('created_at', 'asc')->get();
        return view('admin.pengembalian.index', compact('transaksiVerifikasi', 'transaksiDisewa'));
    }

    public function setujuiPembayaran($id)
    {
        $transaksi = Transaksi::with('items')->findOrFail($id);
        if ($transaksi->status == 'Menunggu Verifikasi') {
            DB::beginTransaction();
            try {
                foreach ($transaksi->items as $item) {
                    if (Product::find($item->product_id)->stok < $item->quantity) return back()->with('error', 'Stok habis.');
                }
                foreach ($transaksi->items as $item) {
                    Product::find($item->product_id)->decrement('stok', $item->quantity);
                }
                $transaksi->status = 'Disewa';
                $transaksi->save();
                DB::commit();
                return back()->with('success', 'Pembayaran disetujui.');
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->with('error', 'Error: ' . $e->getMessage());
            }
        }
        return back()->with('error', 'Status invalid.');
    }

    public function prosesPengembalian(Request $request)
    {
        $request->validate(['transaksi_id' => 'required|exists:transaksi,id']);
        DB::beginTransaction();
        try {
            $transaksi = Transaksi::with('items')->find($request->transaksi_id);
            $transaksi->status = 'Selesai';
            $transaksi->save();
            foreach ($transaksi->items as $item) {
                Product::find($item->product_id)->increment('stok', $item->quantity);
            }
            DB::commit();
            return redirect()->route('admin.pengembalian.index')->with('success', 'Barang dikembalikan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}