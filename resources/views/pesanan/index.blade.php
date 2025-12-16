@extends('layouts.main')

@section('title', 'Pesanan Saya')

@section('content')
<style>
    /* CUSTOM CSS UNTUK HALAMAN PESANAN SAYA */
    body { background-color: #121212; color: #fff; }

    /* 1. TAB NAVIGASI SHOPEE STYLE */
    .shopee-tabs {
        display: flex;
        background-color: #1e1e1e;
        position: sticky;
        top: 70px; /* Sesuaikan dengan tinggi Navbar Anda */
        z-index: 99;
        border-bottom: 1px solid #333;
        overflow-x: auto; /* Agar bisa discroll di HP */
        white-space: nowrap;
    }

    .shopee-tab-item {
        flex: 1;
        text-align: center;
        padding: 15px 10px;
        color: #aaa;
        text-decoration: none;
        font-size: 14px;
        border-bottom: 2px solid transparent;
        transition: all 0.3s;
        min-width: 100px;
    }

    .shopee-tab-item:hover { color: #00AA6C; }
    
    .shopee-tab-item.active {
        color: #00AA6C;
        border-bottom: 2px solid #00AA6C;
        font-weight: 600;
    }

    /* 2. CARD PESANAN */
    .order-container {
        max-width: 900px;
        margin: 20px auto;
        padding: 0 10px;
        min-height: 60vh;
    }

    .order-card {
        background-color: #1e1e1e;
        border-radius: 2px; /* Shopee cenderung kotak */
        margin-bottom: 15px;
        padding: 20px;
        border: 1px solid #333;
    }

    .card-header-custom {
        display: flex;
        justify-content: space-between;
        border-bottom: 1px solid #333;
        padding-bottom: 10px;
        margin-bottom: 15px;
        font-size: 13px;
    }

    .shop-name { font-weight: bold; display: flex; align-items: center; gap: 5px; }
    .status-text { text-transform: uppercase; font-weight: 600; }

    /* Warna Status */
    .status-menunggu { color: #ffc107; }
    .status-verifikasi { color: #17a2b8; }
    .status-disewa { color: #00AA6C; }
    .status-selesai { color: #00AA6C; }
    .status-batal { color: #dc3545; }

    /* 3. LIST ITEM PRODUK */
    .product-item {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
        border-bottom: 1px solid #2a2a2a;
        padding-bottom: 15px;
    }

    .product-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 4px;
        border: 1px solid #333;
    }

    .product-info { flex: 1; }
    .product-name { font-size: 16px; margin-bottom: 5px; display: block; color: white; text-decoration: none; }
    .product-variant { font-size: 12px; color: #888; margin-bottom: 5px; }
    .product-qty { font-size: 12px; color: #fff; }
    
    .product-price { text-align: right; }
    .price-original { text-decoration: line-through; color: #888; font-size: 12px; }
    .price-final { color: #00AA6C; font-weight: bold; font-size: 14px; }

    /* 4. FOOTER TOTAL & AKSI */
    .card-footer-custom {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 15px;
        padding-top: 10px;
    }

    .total-label { font-size: 14px; color: #fff; }
    .total-amount { font-size: 20px; color: #00AA6C; font-weight: bold; margin-left: 10px; }

    .action-buttons { display: flex; gap: 10px; }

    .btn-action {
        padding: 8px 20px;
        border-radius: 4px;
        font-size: 14px;
        text-decoration: none;
        cursor: pointer;
        border: 1px solid #444;
        background: transparent;
        color: #fff;
        transition: 0.2s;
    }

    .btn-primary-custom {
        background-color: #00AA6C;
        border-color: #00AA6C;
        color: white;
    }
    .btn-primary-custom:hover { background-color: #00cc88; }
    
    .btn-secondary-custom:hover { background-color: #333; }

    /* Search Bar (Opsional) */
    .search-bar-container {
        background: #1e1e1e;
        padding: 10px;
        margin-bottom: 10px;
    }
    .search-input {
        width: 100%;
        background: #121212;
        border: 1px solid #333;
        color: white;
        padding: 10px;
        border-radius: 2px;
    }
</style>

<div style="padding-top: 60px;"> <div class="shopee-tabs">
        <a href="{{ route('pesanan.index', ['status' => 'semua']) }}" class="shopee-tab-item {{ $statusFilter == 'semua' ? 'active' : '' }}">Semua</a>
        <a href="{{ route('pesanan.index', ['status' => 'belum_bayar']) }}" class="shopee-tab-item {{ $statusFilter == 'belum_bayar' ? 'active' : '' }}">Belum Bayar</a>
        <a href="{{ route('pesanan.index', ['status' => 'sedang_dikemas']) }}" class="shopee-tab-item {{ $statusFilter == 'sedang_dikemas' ? 'active' : '' }}">Menunggu Verifikasi</a>
        <a href="{{ route('pesanan.index', ['status' => 'dikirim']) }}" class="shopee-tab-item {{ $statusFilter == 'dikirim' ? 'active' : '' }}">Sedang Disewa</a>
        <a href="{{ route('pesanan.index', ['status' => 'selesai']) }}" class="shopee-tab-item {{ $statusFilter == 'selesai' ? 'active' : '' }}">Selesai</a>
        <a href="{{ route('pesanan.index', ['status' => 'dibatalkan']) }}" class="shopee-tab-item {{ $statusFilter == 'dibatalkan' ? 'active' : '' }}">Dibatalkan</a>
    </div>

    <div class="order-container">
        <div class="search-bar-container">
            <input type="text" class="search-input" placeholder="Cari berdasarkan Nama Alat atau ID Pesanan">
        </div>

        @forelse($orders as $transaksi)
            <div class="order-card">
                <div class="card-header-custom">
                    <div class="shop-name">
                        <i class="fas fa-store"></i> PDMP Outdoor
                        <span style="color: #666; margin-left: 5px; font-weight: normal;">| ID: #{{ $transaksi->id }}</span>
                    </div>
                    
                    @php
                        $statusColor = match($transaksi->status) {
                            'Menunggu Pembayaran' => 'status-menunggu',
                            'Menunggu Verifikasi' => 'status-verifikasi',
                            'Disewa' => 'status-disewa',
                            'Selesai' => 'status-selesai',
                            'Dibatalkan' => 'status-batal',
                            default => ''
                        };
                        
                        // Mapping teks agar lebih user friendly
                        $statusText = $transaksi->status;
                        if($transaksi->status == 'Disewa') $statusText = 'BARANG SEDANG DISEWA';
                    @endphp

                    <div class="status-text {{ $statusColor }}">
                        {{ strtoupper($statusText) }}
                    </div>
                </div>

                @foreach($transaksi->items as $item)
                <div class="product-item">
                    <img src="{{ asset('storage/' . $item->product->gambar_produk) }}" alt="Produk" class="product-img">
                    <div class="product-info">
                        <a href="{{ route('produk.show', $item->product_id) }}" class="product-name">
                            {{ $item->product->nama_produk }}
                        </a>
                        <div class="product-variant">
                            Durasi Sewa: {{ $item->product->durasi_sewa }}
                        </div>
                        <div class="product-qty">x{{ $item->quantity }}</div>
                    </div>
                    <div class="product-price">
                        <div class="price-final">Rp{{ number_format($item->harga, 0, ',', '.') }}</div>
                    </div>
                </div>
                @endforeach

                <div class="card-footer-custom">
                    <div class="total-label">
                        Total Pesanan: <span class="total-amount">Rp{{ number_format($transaksi->total, 0, ',', '.') }}</span>
                    </div>

                    <div class="action-buttons">
                        
                        {{-- TOMBOL: DETAIL --}}
                        <a href="{{ route('pembayaran.konfirmasi.show', $transaksi->id) }}" class="btn-action btn-secondary-custom">
                            Lihat Rincian
                        </a>

                        {{-- TOMBOL LOGIKA BERDASARKAN STATUS --}}
                        @if($transaksi->status == 'Menunggu Pembayaran')
                            <a href="{{ route('pembayaran.konfirmasi.show', $transaksi->id) }}" class="btn-action btn-primary-custom">
                                Bayar Sekarang
                            </a>
                        @elseif($transaksi->status == 'Menunggu Verifikasi')
                            <button class="btn-action" style="cursor: not-allowed; color: #888;" disabled>Menunggu Konfirmasi</button>
                        
                        @elseif($transaksi->status == 'Disewa')
                            <button class="btn-action btn-primary-custom" disabled style="opacity: 0.8;">
                                <i class="fas fa-clock"></i> Sedang Digunakan
                            </button>
                        
                        @elseif($transaksi->status == 'Selesai')
                            <a href="{{ route('home') }}" class="btn-action btn-primary-custom">
                                Sewa Lagi
                            </a>
                            <a href="{{ route('produk.show', $transaksi->items->first()->product_id) }}" class="btn-action btn-secondary-custom">
                                Beri Nilai
                            </a>
                        @endif

                    </div>
                </div>
            </div>
        @empty
            <div style="text-align: center; padding: 50px; color: #666;">
                <i class="fas fa-clipboard-list" style="font-size: 50px; margin-bottom: 20px;"></i>
                <p>Belum ada pesanan di kategori ini.</p>
                <a href="{{ route('home') }}" class="btn-action btn-primary-custom" style="display: inline-block; margin-top: 10px;">
                    Mulai Menyewa
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection