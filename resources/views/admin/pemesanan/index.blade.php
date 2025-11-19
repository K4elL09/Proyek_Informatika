@extends('layouts.admin')

@section('title', 'Informasi Pemesanan')

@section('content')

    <div class="stok-header">
        <h1>Informasi Pemesanan</h1>
        <a href="{{ route('admin.pemesanan.create') }}" class="btn-tambah">
            <i class="fas fa-plus"></i> Pesanan Manual
        </a>
    </div>

    @if(session('success'))
        <div class="alert-success" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="order-list">
        @forelse($semuaPemesanan as $pesanan)
            <a href="{{ route('admin.pemesanan.show', $pesanan->id) }}" class="order-card">
                <div class="order-card-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="order-card-info">
                    <h4>{{ $pesanan->user->name ?? $pesanan->nama }}</h4>
                    <p>{{ $pesanan->user->email ?? 'No Email (Offline)' }}</p>
                    <small>Status: <span class="status-{{ strtolower(str_replace(' ', '-', $pesanan->status)) }}">{{ $pesanan->status }}</span></small>
                </div>
                <div class="order-card-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </a>
        @empty
            <p style="text-align: center; color: #aaa;">Belum ada pemesanan.</p>
        @endforelse
    </div>

@endsection