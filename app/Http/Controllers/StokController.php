<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File; // <-- TAMBAHKAN INI

class StokController extends Controller
{
    /**
     * Menampilkan daftar semua produk (Stok Alat).
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.stok.index', compact('products'));
    }

    /**
     * Menampilkan form untuk menambah produk baru.
     */
    public function create()
    {
        return view('admin.stok.create');
    }

    /**
     * Menyimpan produk baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi data
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0', 
            'durasi_sewa' => 'required|string', 
            'stok' => 'required|integer|min:0',
            'kategori' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'gambar_produk' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // 2. Simpan Gambar (ke public/images)
        $file = $request->file('gambar_produk');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images'), $fileName); // Pindah ke public/images

        // 3. Buat produk di database
        Product::create([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'durasi_sewa' => $request->durasi_sewa,
            'stok' => $request->stok,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'gambar_produk' => $fileName, // Simpan nama filenya
        ]);

        return redirect()->route('admin.stok.index')
                         ->with('success', 'Produk baru berhasil ditambahkan.');
    }

    /**
     * (BARU) Menampilkan form untuk mengedit produk.
     */
    public function edit(Product $stok) // $stok adalah nama parameter dari resource
    {
        // 'stok' akan otomatis ditemukan oleh Laravel berdasarkan ID
        return view('admin.stok.edit', ['product' => $stok]);
    }

    /**
     * (BARU) Menyimpan perubahan pada produk.
     */
    public function update(Request $request, Product $stok)
    {
        // 1. Validasi data
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'durasi_sewa' => 'required|string',
            'stok' => 'required|integer|min:0',
            'kategori' => 'nullable|string',
            'deskripsi' => 'nullable|string',
            'gambar_produk' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Gambar opsional saat update
        ]);

        $fileName = $stok->gambar_produk; // Simpan nama file lama

        // 2. Cek jika ada gambar baru di-upload
        if ($request->hasFile('gambar_produk')) {
            // Hapus gambar lama dari public/images
            File::delete(public_path('images/' . $stok->gambar_produk));
            
            // Simpan gambar baru
            $file = $request->file('gambar_produk');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $fileName);
        }

        // 3. Update data produk di database
        $stok->update([
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'durasi_sewa' => $request->durasi_sewa,
            'stok' => $request->stok,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'gambar_produk' => $fileName, // Simpan nama file (lama atau baru)
        ]);

        return redirect()->route('admin.stok.index')
                         ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * (BARU) Menghapus produk dari database.
     */
    public function destroy(Product $stok)
    {
        // 1. Hapus gambar dari folder public/images
        File::delete(public_path('images/' . $stok->gambar_produk));

        // 2. Hapus data dari database
        $stok->delete();

        return redirect()->route('admin.stok.index')
                         ->with('success', 'Produk berhasil dihapus.');
    }
}