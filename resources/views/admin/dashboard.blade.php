@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')

    <h1 style="color: #00c896; border-bottom: 1px solid #333; padding-bottom: 10px;">Dashboard</h1>

    <div class="menu-grid">
        <a href="{{ route('admin.stok.index') }}" class="menu-card">
            <img src="{{ asset('images/tenda-icon.png') }}" alt="Stok Alat">
            <h3>STOK ALAT</h3>
        </a>

        <a href="{{ route('admin.laporan.index') }}" class="menu-card">
            <img src="{{ asset('images/laporan-icon.png') }}" alt="Laporan Keuangan">
            <h3>LAPORAN KEUANGAN</h3>
        </a>

        <a href="{{ route('admin.pemesanan.index') }}" class="menu-card">
            <img src="{{ asset('images/info-icon.png') }}" alt="Informasi Pemesanan">
            <h3>INFORMASI PEMESANAN</h3>
        </a>

        <a href="{{ route('admin.pengembalian.index') }}" class="menu-card">
            <img src="{{ asset('images/kembali-icon.png') }}" alt="Pengembalian">
            <h3>PENGEMBALIAN</h3>
        </a>
    </div>

@endsection