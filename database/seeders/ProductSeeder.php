@extends('layouts.main')

@section('title', $product->nama_produk)

@section('content')
    <div style="max-width: 480px; margin: 0 auto; color: white;">

        {{-- Tombol kembali --}}
        <a href="{{ route('home') }}" 
           style="display: inline-block; color: #00A87D; text-decoration: none; margin-bottom: 10px;">
            ← Kembali ke Beranda
        </a>

        {{-- Kartu detail produk --}}
        <div style="background-color: #1e1e1e; border-radius: 16px; padding: 20px;">
            <img src="{{ asset('images/' . $product->gambar_produk) }}" 
                 alt="{{ $product->nama_produk }}" 
                 style="width: 100%; border-radius: 12px; margin-bottom: 15px;">

            <h2>{{ $product->nama_produk }}</h2>
            <p style="color: #00A87D; font-weight: bold;">
                Rp.{{ number_format($product->harga, 0, ',', '.') }}/{{ $product->durasi_sewa }}
            </p>

            <hr style="border-color: #333; margin: 15px 0;">

            <h4>Detail Produk</h4>
            <p>Stock: <strong>{{ $product->stok ?? '1 Buah' }}</strong></p>
            <p>Kategori: <strong>{{ $product->kategori }}</strong></p>

            <h4 style="margin-top: 15px;">Deskripsi Produk</h4>
            <p style="white-space: pre-line; color: #ddd;">{{ $product->deskripsi }}</p>

            <div style="display: flex; justify-content: space-between; margin-top: 20px;">
                <a href="#" style="
                    background-color: #00A87D;
                    color: white;
                    padding: 10px 20px;
                    border-radius: 8px;
                    text-align: center;
                    flex: 1;
                    margin-right: 10px;
                    text-decoration: none;
                    font-weight: bold;
                ">Beli Langsung</a>

                <a href="#" style="
                    background-color: #2e7d32;
                    color: white;
                    padding: 10px 20px;
                    border-radius: 8px;
                    text-align: center;
                    flex: 1;
                    text-decoration: none;
                    font-weight: bold;
                ">+ Keranjang</a>
            </div>
        </div>
    </div>
@endsection
