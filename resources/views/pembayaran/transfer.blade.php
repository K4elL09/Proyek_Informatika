@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="card shadow-lg border-0 rounded-4 p-3">

        <h4 class="fw-bold text-center mb-2">Menunggu Pembayaran</h4>
        <p class="text-center text-muted">Silakan transfer ke rekening di bawah ini</p>

        <div class="border rounded-4 p-3 bg-light">
            <h6 class="fw-semibold">Total Pembayaran</h6>
            <h3 class="fw-bold text-primary">
                Rp{{ number_format($transaksi->total,0,',','.') }}
            </h3>
        </div>

        <div class="mt-4">
            <h6 class="fw-semibold mb-2">Transfer Ke</h6>

            <div class="border rounded-4 p-3">
                <p class="mb-1">Bank: <strong>BCA</strong></p>
                <p class="mb-1">Nomor Rekening:</p>
                <h4 class="fw-bold text-success">5314 1790 0008 223</h4>
                <p class="mb-1">Atas Nama: <strong>Nama Toko</strong></p>
            </div>
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
