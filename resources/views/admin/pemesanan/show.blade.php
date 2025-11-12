@extends('layouts.admin')

@section('title', 'Detail Pemesanan #' . $transaksi->id)

@section('content')

    <div class="stok-header" style="margin-bottom: 0;">
        <a href="{{ route('admin.pemesanan.index') }}" class="btn-kembali" style="margin-right: 15px;"><i class="fas fa-arrow-left"></i></a>
        <h1>Detail Pesanan</h1>
    </div>

    <div class="order-list" style="margin-top: 20px;">
        <div class="order-card" style="background-color: #1c1c1c;">
            <div class="order-card-icon">
                <i class="fas fa-user"></i>
            </div>
            <div class="order-card-info">
                <h4>{{ $transaksi->user->name ?? $transaksi->nama }}</h4>
                <p>{{ $transaksi->user->email ?? 'No Email' }}</p>
            </div>
        </div>
    </div>

    <div class="order-detail-card">
        <h3 class="detail-title">Rincian Barang</h3>
        <div class="item-list">
            @foreach($transaksi->items as $item)
                <div class="item-row">
                    <img src="{{ asset('images/' . $item->product->gambar_produk) }}" alt="{{ $item->product->nama_produk }}" class="item-img">
                    <div class="item-info">
                        <h4>{{ $item->product->nama_produk }}</h4>
                        <p>Rp{{ number_format($item->harga / $item->quantity, 0, ',', '.') }}</p>
                    </div>
                    <div class="item-qty">
                        x{{ $item->quantity }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="order-detail-card">
        <h3 class="detail-title">Rincian Pembayaran</h3>
        
        <div class="detail-row">
            <span>Alamat</span>
            <strong>{{ $transaksi->alamat }}</strong>
        </div>
        <div class="detail-row">
            <span>No. Pesanan</span>
            <strong>#{{ $transaksi->id }}</strong>
        </div>
        <div class="detail-row">
            <span>Waktu Pemesanan</span>
            <strong>{{ $transaksi->created_at->format('d-m-Y H:i') }}</strong>
        </div>
        <div class="detail-row">
            <span>Metode Pembayaran</span>
            <strong>{{ $transaksi->metode }}</strong>
        </div>
        <div class="detail-row total">
            <span>Total Pembayaran</span>
            <strong>Rp{{ number_format($transaksi->total, 0, ',', '.') }}</strong>
        </div>
    </div>

@endsection