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
            <input type="text" name="nama" required placeholder="Contoh: Budi (Offline)">
        </div>

        <div class="form-group">
            <label>Metode Pembayaran</label>
            <select name="metode" class="form-control" style="width: 100%; padding: 12px; background: #101010; border: 1px solid #333; color: white; border-radius: 5px;">
                <option value="Cash">Cash / Tunai</option>
                <option value="Transfer">Transfer Bank</option>
                <option value="QRIS">QRIS</option>
            </select>
        </div>

        <h3 style="color: #00c896; border-bottom: 1px solid #333; padding-bottom: 10px; margin-top: 30px; margin-bottom: 20px;">
            Daftar Barang
        </h3>

        <div id="product-container">
            <div class="product-row" style="display: flex; gap: 10px; margin-bottom: 15px; align-items: center;">
                
                <div style="flex: 3;">
                    <select name="products[]" required style="width: 100%; padding: 12px; background: #101010; border: 1px solid #333; color: white; border-radius: 5px;">
                        <option value="" disabled selected>Pilih Alat...</option>
                        @foreach($products as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_produk }} (Stok: {{ $p->stok }}) - Rp{{ number_format($p->harga) }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div style="flex: 1;">
                    <input type="number" name="quantities[]" placeholder="Jml" min="1" value="1" required style="width: 100%;">
                </div>
                
                <button type="button" class="btn-hapus-row" style="background: #d9534f; color: white; border: none; border-radius: 5px; width: 40px; height: 42px; cursor: pointer; font-weight: bold;">
                    X
                </button>
            </div>
        </div>

        <button type="button" id="add-row-btn" style="background: #333; color: #00c896; border: 1px dashed #00c896; width: 100%; padding: 12px; margin-bottom: 25px; cursor: pointer; border-radius: 5px; font-weight: 600;">
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
            
            // Reset nilai di clone
            firstRow.querySelector('input').value = 1;
            firstRow.querySelector('select').value = "";

            addBtn.addEventListener('click', function() {
                const newRow = firstRow.cloneNode(true);
                container.appendChild(newRow);
                
                // Pasang event listener hapus ke baris baru
                attachDeleteEvent(newRow.querySelector('.btn-hapus-row'));
            });

            function attachDeleteEvent(btn) {
                btn.addEventListener('click', function() {
                    if (container.querySelectorAll('.product-row').length > 1) {
                        this.parentElement.remove();
                    } else {
                        alert("Minimal harus ada satu barang!");
                    }
                });
            }

            // Pasang event ke tombol hapus baris pertama
            attachDeleteEvent(container.querySelector('.btn-hapus-row'));
        });
    </script>

@endsection