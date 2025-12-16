@extends('layouts.admin')

@section('title', 'Informasi Pemesanan')

@section('content')

<style>
    .filter-box { background-color: #1a1a1a; padding: 15px; border-radius: 10px; margin-bottom: 20px; border: 1px solid #333; display: flex; align-items: center; gap: 10px; }
    .filter-box select { padding: 10px; border-radius: 5px; border: 1px solid #444; background-color: #000; color: white; min-width: 200px; cursor: pointer; }
    .filter-label { color: #ccc; font-weight: 600; }
    .badge { padding: 5px 10px; border-radius: 5px; font-size: 11px; font-weight: bold; text-transform: uppercase; display: inline-block; letter-spacing: 0.5px; }
    .badge-menunggu-pembayaran { background-color: #ffc107; color: #000; }
    .badge-menunggu-verifikasi { background-color: #17a2b8; color: #fff; }
    .badge-disewa { background-color: #007bff; color: #fff; }
    .badge-selesai { background-color: #28a745; color: #fff; }
    .badge-dibatalkan { background-color: #dc3545; color: #fff; }
</style>

<div class="stok-header">
    <h1>Informasi Pemesanan</h1>
    <a href="{{ route('admin.pemesanan.create') }}" class="btn-tambah"><i class="fas fa-plus"></i> Pesanan Manual (Offline)</a>
</div>

<form action="{{ route('admin.pemesanan.index') }}" method="GET" class="filter-box">
    <span class="filter-label"><i class="fas fa-filter"></i> Filter Status:</span>
    <select name="status" onchange="this.form.submit()">
        <option value="">-- Tampilkan Semua --</option>
        @foreach($listStatus as $s)
            <option value="{{ $s }}" {{ $status == $s ? 'selected' : '' }}>{{ $s }}</option>
        @endforeach
    </select>
</form>

<div class="stok-table-container">
    <table class="stok-table">
        <thead>
            <tr>
                <th>ID</th><th>Nama</th><th>Tgl Sewa</th><th>Tgl Selesai</th><th>Total</th><th>Status</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($semuaPemesanan as $transaksi)
            <tr>
                <td>#{{ $transaksi->id }}</td>
                <td>{{ $transaksi->nama }}<br><small style="color: #aaa;">{{ $transaksi->metode }}</small></td>
                <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_sewa)->format('d M Y') }}</td>
                <td style="color: #00FF77;">{{ \Carbon\Carbon::parse($transaksi->tanggal_kembali)->format('d M Y') }}</td>
                <td>Rp{{ number_format($transaksi->total, 0, ',', '.') }}</td>
                <td>
                    @php
                        $badge = match($transaksi->status) {
                            'Menunggu Pembayaran' => 'badge-menunggu-pembayaran',
                            'Menunggu Verifikasi' => 'badge-menunggu-verifikasi',
                            'Disewa' => 'badge-disewa',
                            'Selesai' => 'badge-selesai',
                            default => 'badge-dibatalkan',
                        };
                    @endphp
                    <span class="badge {{ $badge }}">{{ $transaksi->status }}</span>
                </td>
                <td>
                    <a href="{{ route('admin.pemesanan.show', $transaksi->id) }}" class="btn-edit" style="background: #333; border: 1px solid #555; color: #eee; margin-right: 5px;"><i class="fas fa-eye"></i> Detail</a>
                    
                    @if(!in_array($transaksi->status, ['Selesai', 'Dibatalkan']))
                        <form action="{{ route('admin.pemesanan.batalkan', $transaksi->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Batalkan pesanan ini?');">
                            @csrf
                            <button type="submit" class="btn-edit" style="background: #dc3545; color: white; border: none; cursor: pointer;"><i class="fas fa-times"></i> Batal</button>
                        </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align: center; padding: 40px; color: #888;">Tidak ada pesanan.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection