@extends('layouts.admin')

@section('title', 'Laporan Keuangan')

@section('content')

    <div class="stok-header">
        <h1>Laporan Keuangan</h1>
    </div>

    <div class="stats-grid">
        <div class="stat-card">
            <h4>Total Pendapatan (dari item)</h4>
            <p>Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</p>
        </div>
        <div class="stat-card">
            <h4>Jumlah Transaksi</h4>
            <p>{{ $jumlahTransaksi }}</p>
        </div>
    </div>

    <h2 style="color: #00c896; margin-top: 40px; border-bottom: 1px solid #333; padding-bottom: 10px;">
        Item Sewa Terbaru
    </h2>
    <div class="stok-table-container">
        <table class="stok-table">
            <thead>
                <tr>
                    <th>ID Item</th>
                    <th>ID Transaksi</th>
                    <th>Tanggal</th>
                    <th>Harga Item</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksiTerbaru as $item)
                <tr>
                    {{-- === PERBAIKAN DI SINI === --}}
                    <td>#{{ $item->id }}</td>
                    <td>{{ $item->transaksi_id }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                    <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center;">Belum ada data transaksi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection