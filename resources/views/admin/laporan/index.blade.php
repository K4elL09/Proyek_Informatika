@extends('layouts.admin')

@section('title', 'Laporan Keuangan')

@section('content')

<style>
    /* Styling Filter & Cards */
    .filter-box {
        background-color: #1a1a1a;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        border: 1px solid #333;
        display: flex;
        gap: 15px;
        align-items: center;
        flex-wrap: wrap;
    }
    .filter-box select, .filter-box button {
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #444;
        background-color: #000;
        color: white;
    }
    .filter-box button {
        background-color: #00AA6C;
        border: none;
        cursor: pointer;
        font-weight: bold;
    }
    .filter-box button:hover {
        background-color: #00cc88;
    }
    .card-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    .stat-card {
        background-color: #1a1a1a;
        padding: 25px;
        border-radius: 12px;
        border: 1px solid #333;
    }
    .stat-title { color: #888; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 1px; }
    .stat-value { font-size: 28px; font-weight: bold; color: #00FF77; }
    .stat-sub { font-size: 12px; color: #666; margin-top: 5px; }
</style>

<div class="stok-header">
    <h1>Laporan Keuangan</h1>
</div>

<form action="{{ route('admin.laporan.index') }}" method="GET" class="filter-box">
    <label style="color: #fff;">Filter Periode:</label>
    
    <select name="bulan">
        @foreach(range(1, 12) as $m)
            <option value="{{ $m }}" {{ $bulan == $m ? 'selected' : '' }}>
                {{ DateTime::createFromFormat('!m', $m)->format('F') }}
            </option>
        @endforeach
    </select>

    <select name="tahun">
        @foreach(range(date('Y'), 2024) as $y)
            <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>
                {{ $y }}
            </option>
        @endforeach
    </select>

    <button type="submit">Tampilkan Laporan</button>
</form>

<div class="card-container">
    
    <div class="stat-card">
        <div class="stat-title">Total Pendapatan (Keseluruhan)</div>
        <div class="stat-value" style="color: #00AA6C;">
            Rp{{ number_format($totalPendapatanSemua, 0, ',', '.') }}
        </div>
        <div class="stat-sub">Akumulasi semua transaksi sukses</div>
    </div>

    <div class="stat-card" style="border-color: #00FF77;">
        <div class="stat-title">Pendapatan Bulan Ini</div>
        <div class="stat-value">
            Rp{{ number_format($totalPendapatanBulanan, 0, ',', '.') }}
        </div>
        <div class="stat-sub">
            Periode: {{ DateTime::createFromFormat('!m', $bulan)->format('F') }} {{ $tahun }}
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-title">Jumlah Transaksi</div>
        <div class="stat-value" style="color: white;">
            {{ $jumlahTransaksiBulanan }}
        </div>
        <div class="stat-sub">Transaksi sukses pada periode ini</div>
    </div>
</div>

<div class="stok-header" style="border-top: 1px solid #333; padding-top: 20px;">
    <h2>Rincian Item Sewa ({{ DateTime::createFromFormat('!m', $bulan)->format('F') }} {{ $tahun }})</h2>
</div>

<div class="stok-table-container">
    <table class="stok-table">
        <thead>
            <tr>
                <th>ID Item</th>
                <th>Nama Produk</th>
                <th>ID Transaksi</th>
                <th>Tanggal</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($itemTerjual as $item)
            <tr>
                <td>#{{ $item->product_id }}</td>
                <td>{{ $item->nama_produk }}</td>
                <td>#{{ $item->transaksi_id }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_transaksi)->format('d M Y') }}</td>
                <td>{{ $item->quantity }}</td>
                <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; color: #aaa; padding: 30px;">
                    Tidak ada transaksi pada bulan ini.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection