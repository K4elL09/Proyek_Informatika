@extends('layouts.main')

@section('title', 'Pesanan Saya')

@section('content')
<style>
    /* TAB NAVIGASI */
    .shopee-tabs {
        display: flex;
        background-color: #2c2c2c;
        border-radius: 8px 8px 0 0;
        margin-top: 20px;
        border-bottom: 1px solid #444;
        overflow-x: auto;
        white-space: nowrap;
    }
    .shopee-tab-item {
        flex: 1;
        text-align: center;
        padding: 15px 20px;
        color: #bbb;
        text-decoration: none;
        font-size: 14px;
        border-bottom: 3px solid transparent;
        transition: all 0.3s;
        min-width: 120px;
    }
    .shopee-tab-item:hover { color: #00AA6C; background-color: rgba(255,255,255,0.02); }
    .shopee-tab-item.active { color: #00AA6C; border-bottom: 3px solid #00AA6C; font-weight: 700; background-color: rgba(0, 170, 108, 0.05); }

    /* CONTAINER */
    .order-container { width: 100%; margin: 0 auto 50px auto; min-height: 60vh; }

    /* CARD PESANAN */
    .order-card { background-color: #252525; border-radius: 0 0 8px 8px; margin-bottom: 20px; padding: 20px; border: 1px solid #333; }
    .shopee-tabs + .order-container .order-card:first-child { border-top: none; border-radius: 0 0 8px 8px; }

    .card-header-custom { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #3a3a3a; padding-bottom: 15px; margin-bottom: 15px; }
    .shop-name { font-weight: 700; display: flex; align-items: center; gap: 8px; color: #fff; }
    .status-text { text-transform: uppercase; font-weight: 700; font-size: 12px; }

    /* STATUS COLORS */
    .status-menunggu { color: #ffc107; }
    .status-verifikasi { color: #17a2b8; }
    .status-disewa { color: #00AA6C; }
    .status-selesai { color: #00AA6C; }
    .status-batal { color: #dc3545; }

    /* PRODUCT ITEM */
    .product-item { display: flex; gap: 20px; margin-bottom: 15px; border-bottom: 1px solid #333; padding-bottom: 15px; align-items: flex-start; }
    
    .product-img { width: 100px; height: 100px; object-fit: cover; border-radius: 6px; background-color: #333; border: 1px solid #444; }
    
    .product-info { flex: 1; }
    .product-name { font-size: 16px; font-weight: 600; margin-bottom: 8px; display: block; color: white; text-decoration: none; }
    .product-variant { font-size: 13px; color: #aaa; margin-bottom: 5px; }
    .price-final { color: #00AA6C; font-weight: 600; font-size: 15px; text-align: right; }

    /* FOOTER & BUTTONS */
    .card-footer-custom { display: flex; flex-direction: column; align-items: flex-end; gap: 15px; padding-top: 10px; }
    .total-info-row { display: flex; align-items: center; gap: 10px; }
    .total-amount { font-size: 20px; color: #00AA6C; font-weight: bold; }
    
    .action-buttons { display: flex; gap: 10px; flex-wrap: wrap; justify-content: flex-end; }
    .btn-action { padding: 8px 20px; border-radius: 6px; font-size: 14px; text-decoration: none; cursor: pointer; border: 1px solid #555; background: transparent; color: #fff; transition: 0.2s; display: inline-block; text-align: center; }
    
    .btn-primary-custom { background-color: #00AA6C; border-color: #00AA6C; }
    .btn-primary-custom:hover { background-color: #00cc88; }
    .btn-secondary-custom:hover { background-color: #444; }
    .btn-danger-custom { border-color: #dc3545; color: #dc3545; }
    .btn-danger-custom:hover { background-color: #dc3545; color: white; }

    .search-input { width: 100%; background: #252525; border: 1px solid #444; color: white; padding: 12px 15px; border-radius: 8px; margin: 20px 0; }
</style>

<div class="shopee-tabs">
    <a href="{{ route('pesanan.index', ['status' => 'semua']) }}" class="shopee-tab-item {{ $statusFilter == 'semua' ? 'active' : '' }}">Semua</a>
    <a href="{{ route('pesanan.index', ['status' => 'belum_bayar']) }}" class="shopee-tab-item {{ $statusFilter == 'belum_bayar' ? 'active' : '' }}">Belum Bayar</a>
    <a href="{{ route('pesanan.index', ['status' => 'sedang_dikemas']) }}" class="shopee-tab-item {{ $statusFilter == 'sedang_dikemas' ? 'active' : '' }}">Menunggu Verifikasi</a>
    <a href="{{ route('pesanan.index', ['status' => 'dikirim']) }}" class="shopee-tab-item {{ $statusFilter == 'dikirim' ? 'active' : '' }}">Sedang Disewa</a>
    <a href="{{ route('pesanan.index', ['status' => 'selesai']) }}" class="shopee-tab-item {{ $statusFilter == 'selesai' ? 'active' : '' }}">Selesai</a>
    <a href="{{ route('pesanan.index', ['status' => 'dibatalkan']) }}" class="shopee-tab-item {{ $statusFilter == 'dibatalkan' ? 'active' : '' }}">Dibatalkan</a>
</div>

<div class="order-container">
    <input type="text" class="search-input" placeholder="Cari pesanan...">

    @forelse($orders as $transaksi)
        <div class="order-card">
            <div class="card-header-custom">
                <div class="shop-name">
                    <i class="fas fa-mountain"></i> PDMP Outdoor
                    <span style="color: #777; font-size: 12px; margin-left: 5px;">| ID: #{{ $transaksi->id }}</span>
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
                @endphp

                <div class="status-text {{ $statusColor }}">{{ strtoupper($transaksi->status) }}</div>
            </div>

            {{-- LOOP ITEM --}}
            @foreach($transaksi->items as $item)
            <div class="product-item">
                
                {{-- GAMBAR DENGAN PENGECEKAN KEAMANAN --}}
                @if($item->product)
                    <img 
src="{{ asset('images/' . $item->product->gambar_produk) }}"                        alt="{{ $item->product->nama_produk }}" 
                        class="product-img"
                        onerror="this.onerror=null;this.src='https://via.placeholder.com/100?text=No+Img';"
                    >
                    <div class="product-info">
                        <a href="{{ route('produk.show', $item->product_id) }}" class="product-name">
                            {{ $item->product->nama_produk }}
                        </a>
                        <div class="product-variant">Durasi: {{ $item->product->durasi_sewa }}</div>
                        <div class="product-qty">x{{ $item->quantity }}</div>
                    </div>
                @else
                    {{-- JIKA PRODUK TERHAPUS --}}
                    <div class="product-img" style="display:flex;align-items:center;justify-content:center;color:#888;font-size:10px;">Deleted</div>
                    <div class="product-info">
                        <span class="product-name" style="color: #888;">Produk Telah Dihapus</span>
                    </div>
                @endif

                <div class="price-final">Rp{{ number_format($item->harga, 0, ',', '.') }}</div>
            </div>
            @endforeach

            <div class="card-footer-custom">
                <div class="total-info-row">
                    <span class="total-label">Total:</span>
                    <span class="total-amount">Rp{{ number_format($transaksi->total, 0, ',', '.') }}</span>
                </div>
                <div class="action-buttons">
                    <a href="{{ route('pembayaran.konfirmasi.show', $transaksi->id) }}" class="btn-action btn-secondary-custom">Rincian</a>
                    
                    @if($transaksi->status == 'Menunggu Pembayaran')
                        <form action="{{ route('pesanan.batalkan', $transaksi->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Batalkan?');">
                            @csrf <button class="btn-action btn-danger-custom">Batalkan</button>
                        </form>
                        <a href="{{ route('pembayaran.konfirmasi.show', $transaksi->id) }}" class="btn-action btn-primary-custom">Bayar</a>
                    @elseif($transaksi->status == 'Selesai')
                        <a href="{{ route('home') }}" class="btn-action btn-primary-custom">Sewa Lagi</a>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <div style="text-align: center; padding: 50px; color: #666;">
            <i class="fas fa-box-open" style="font-size: 50px;"></i>
            <p>Belum ada pesanan.</p>
        </div>
    @endforelse
</div>
@endsection