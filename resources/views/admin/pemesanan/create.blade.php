@extends('layouts.admin')

@section('title', 'Tambah Pesanan Offline')

@section('content')

    <div class="stok-header">
        <h1>Pesanan Baru (Offline)</h1>
        <a href="{{ route('admin.pemesanan.index') }}" class="btn-kembali">Kembali</a>
    </div>

    @if(session('error'))
        <div class="alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.pemesanan.store') }}" method="POST" class="stok-form">
        @csrf

        <h3 style="color: #00c896; border-bottom: 1px solid #333; padding-bottom: 10px; margin-bottom: 20px;">Data Pelanggan</h3>
        
        <div class="form-group">
            <label>Nama Pelanggan</label>
            <input type="text" name="nama" required placeholder="Contoh: Budi">
        </div>

        <div class="form-group">
            <label>Metode Pembayaran</label>
            <select name="metode" style="width: 100%; padding: 12px; background: #101010; border: 1px solid #333; color: white; border-radius: 5px;">
                <option value="Cash">Cash / Tunai</option>
                <option value="Transfer">Transfer Bank</option>
                <option value="QRIS">QRIS</option>
            </select>
        </div>

        <h3 style="color: #00c896; border-bottom: 1px solid #333; padding-bottom: 10px; margin-top: 30px; margin-bottom: 20px;">
            Daftar Barang
        </h3>

        <div id="product-container">
            <div class="product-row" style="display: flex; gap: 10px; margin-bottom: 10px;">
                <select name="products[]" required style="flex: 3; padding: 12px; background: #101010; border: 1px solid #333; color: white; border-radius: 5px;">
                    <option value="" disabled selected>Pilih Alat...</option>
                    @foreach($products as $p)
                        <option value="{{ $p->id }}">{{ $p->nama_produk }} (Stok: {{ $p->stok }}) - Rp{{ number_format($p->harga) }}</option>
                    @endforeach
                </select>
                
                <input type="number" name="quantities[]" placeholder="Jml" min="1" value="1" required style="flex: 1; padding: 12px; background: #101010; border: 1px solid #333; color: white; border-radius: 5px;">
                
                <button type="button" class="btn-hapus-row" style="background: #d9534f; color: white; border: none; border-radius: 5px; padding: 0 15px; cursor: pointer;">X</button>
            </div>
        </div>

        <button type="button" id="add-row-btn" style="background: #333; color: #00c896; border: 1px dashed #00c896; width: 100%; padding: 10px; margin-bottom: 20px; cursor: pointer; border-radius: 5px;">
            + Tambah Barang Lain
        </button>

        <button type="submit" class="btn-tambah">Buat Pesanan</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('product-container');
            const addBtn = document.getElementById('add-row-btn');

            // Clone baris pertama untuk template
            const firstRow = container.querySelector('.product-row').cloneNode(true);
            firstRow.querySelector('input').value = 1;
            firstRow.querySelector('select').value = "";

            addBtn.addEventListener('click', function() {
                const newRow = firstRow.cloneNode(true);
                container.appendChild(newRow);
                
                // Pasang event listener hapus ke baris baru
                newRow.querySelector('.btn-hapus-row').addEventListener('click', function() {
                    if (container.querySelectorAll('.product-row').length > 1) {
                        this.parentElement.remove();
                    }
                });
            });

            // Pasang event ke tombol hapus baris pertama (default)
            container.querySelector('.btn-hapus-row').addEventListener('click', function() {
                if (container.querySelectorAll('.product-row').length > 1) {
                    this.parentElement.remove();
                } else {
                    alert("Minimal harus ada satu barang!");
                }
            });
        });
    </script>

@endsection