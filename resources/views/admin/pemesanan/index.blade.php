@extends('layouts.admin')

@section('title', 'Informasi Pemesanan')

@section('content')

    <div class="stok-header">
        <h1>Informasi Pemesanan</h1>
    </div>

    <div class="order-list">
        @forelse($semuaPemesanan as $pesanan)
            <a href="{{ route('admin.pemesanan.show', $pesanan->id) }}" class="order-card">
                <div class="order-card-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="order-card-info">
                    <h4>{{ $pesanan->user->name ?? $pesanan->nama }}</h4>
                    <p>{{ $pesanan->user->email ?? 'No Email' }}</p>
                    
                    <small>Status: <span class="status-{{ strtolower(str_replace(' ', '-', $pesanan->status)) }}">{{ $pesanan->status }}</span></small>
                
                </div>
                <div class="order-card-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>
        @empty
            <p>Belum ada pemesanan.</p>
        @endforelse
    </div>

@endsec