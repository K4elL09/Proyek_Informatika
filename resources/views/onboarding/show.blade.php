@extends('layouts.main')

@section('title', $product->nama_produk)

@section('content')
<div style="max-width: 900px; margin: 40px auto; color: white; display: flex; gap: 30px;">

    {{-- Gambar produk --}}
    <div style="flex: 1;">
        <a href="{{ route('home') }}" 
           style="display: inline-block; color: #00A87D; text-decoration: none; margin-bottom: 10px;">
            ← Kembali ke Beranda
        </a>
        <div style="background-color: #1e1e1e; border-radius: 16px; padding: 15px;">
            <img src="{{ asset('images/' . $product->gambar_produk) }}" 
                 alt="{{ $product->nama_produk }}" 
                 style="width: 100%; border-radius: 12px; object-fit: cover;">
        </div>
    </div>

    {{-- Detail produk --}}
    <div style="flex: 1; background-color: #1e1e1e; border-radius: 16px; padding: 25px;">
        <h2 style="font-weight: bold;">{{ $product->nama_produk }}</h2>
        <p style="color: #00A87D; font-weight: bold; font-size: 18px;">
            Rp{{ number_format($product->harga, 0, ',', '.') }}/{{ $product->durasi_sewa }}
        </p>

        <hr style="border-color: #333; margin: 15px 0;">

        <h4 style="margin-bottom: 10px;">Detail Produk</h4>
        <p style="margin: 3px 0;">Stock: <strong>{{ $product->stok ?? '1 Buah' }}</strong></p>
        <p style="margin: 3px 0;">Kategori: <strong>{{ $product->kategori }}</strong></p>
        <p style="margin: 3px 0;">Durasi: <strong>{{ $product->durasi_sewa }}</strong></p>

        <h4 style="margin-top: 20px;">Deskripsi Produk</h4>
        <p style="color: #ddd; line-height: 1.6;">{{ $product->deskripsi }}</p>

        {{-- Tombol --}}
        <div style="display: flex; gap: 15px; margin-top: 25px;">
            <a href="#" style="
                background-color: #00A87D;
                color: white;
                padding: 12px 25px;
                border-radius: 8px;
                text-align: center;
                text-decoration: none;
                font-weight: bold;
                flex: 1;
            ">Beli Langsung</a>

            <a href="#" style="
                background-color: transparent;
                border: 2px solid #00A87D;
                color: #00A87D;
                padding: 12px 25px;
                border-radius: 8px;
                text-align: center;
                text-decoration: none;
                font-weight: bold;
                flex: 1;
            ">+ Keranjang</a>
        </div>
    </div>
</div>
@endsection
