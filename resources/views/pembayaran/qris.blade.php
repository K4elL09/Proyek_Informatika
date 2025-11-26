@extends('layouts.app')

@section('content')
<div class="container py-4">

    <!-- Card utama -->
    <div class="card shadow-lg border-0 rounded-4 p-3">

        <h4 class="fw-bold text-center mb-2">Menunggu Pembayaran</h4>
        <p class="text-center text-muted">Silakan selesaikan pembayaran melalui QRIS</p>

        <div class="border rounded-4 p-3 mt-3 bg-light">
            <h6 class="fw-semibold mb-1">Total Pembayaran</h6>
            <h3 class="fw-bold text-primary">
                Rp{{ number_format($transaksi->total,0,',','.') }}
            </h3>
        </div>

        <div class="text-center my-4">
            <h6 class="fw-semibold mb-3">Scan QR Berikut</h6>

            <!-- Gambar QR -->
            <img src="{{ asset('img/qris-example.png') }}" 
                 alt="QRIS" 
                 class="img-fluid rounded-4 shadow" 
                 style="max-width: 260px;">
        </div>

        <div class="mt-4">
            <h6 class="fw-semibold">Batas Pembayaran</h6>
            <p class="text-danger fw-bold">
                {{ now()->addMinutes(30)->format('d M Y - H:i') }}
            </p>
        </div>

        <div class="mt-4">
            <h6 class="fw-semibold mb-2">Detail Pesanan</h6>
            <div class="border rounded-4 p-3">
                <p class="mb-1">Nama: <strong>{{ $transaksi->nama }}</strong></p>
                <p class="mb-1">Metode: <strong>{{ $transaksi->metode }}</strong></p>
                <p class="mb-1">Tanggal Penyewaan: <strong>{{ $transaksi->tanggal_sewa }}</strong></p>
                <p class="mb-1">Kembali: <strong>{{ $transaksi->tanggal_kembali }}</strong></p>
            </div>
        </div>

        <div class="d-grid mt-4">
            <a href="{{ route('upload.bukti', $transaksi->id) }}" 
               class="btn btn-primary btn-lg rounded-4 fw-semibold">
               Upload Bukti Pembayaran
            </a>
        </div>

    </div>

</div>
@endsection