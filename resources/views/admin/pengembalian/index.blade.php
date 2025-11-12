@extends('layouts.admin')

@section('title', 'Pengembalian Alat')

@section('content')

    <div class="stok-header">
        <h1>Alat yang Sedang Disewa</h1>
    </div>

    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert-danger">{{ session('error') }}</div>
    @endif

    <div class="stok-table-container">
        <table class="stok-table">
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Nama Pemesan</th>
                    <th>Tanggal Sewa</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksiDisewa as $transaksi)
                <tr>
                    <td>#{{ $transaksi->id }}</td>
                    <td>{{ $transaksi->nama }}</td>
                    <td>{{ $transaksi->tanggal_sewa ? \Carbon\Carbon::parse($transaksi->tanggal_sewa)->format('d M Y') : 'N/A' }}</td>
                    <td><span style="color: #f0ad4e;">{{ $transaksi->status }}</span></td>
                    <td>
                        <form action="{{ route('admin.pengembalian.proses') }}" method="POST" onsubmit="return confirm('Anda yakin barang ini sudah dikembalikan? Stok akan dikembalikan.');">
                            @csrf
                            <input type="hidden" name="transaksi_id" value="{{ $transaksi->id }}">
                            <button type="submit" class="btn-tambah" style="width: auto; background-color: #5cb85c;">Tandai Selesai</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Tidak ada barang yang sedang disewa saat ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection