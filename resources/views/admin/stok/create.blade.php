@extends('layouts.admin')

@section('title', 'Tambah Stok Alat')

@section('content')

    <div class="stok-header">
        <h1 style="color: #00c896;">Tambah Alat Baru</h1>
        <a href="{{ route('admin.stok.index') }}" class="btn-kembali">Kembali ke List Stok</a>
    </div>

    @if ($errors->any())
        <div class="alert-danger">
            <strong>Oops! Ada yang salah:</strong>
            <ul style="margin-top: 10px; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.stok.store') }}" method="POST" enctype="multipart/form-data" class="stok-form">
        @csrf
        
        <div class="form-group">
            <label for="nama_produk">Nama Produk</label>
            <input type="text" id="nama_produk" name="nama_produk" value="{{ old('nama_produk') }}" required>
        </div>

        <div class="form-group">
            <label for="harga">Harga (cth: 80000)</label>
            <input type="number" id="harga" name="harga" value="{{ old('harga') }}" required>
        </div>

        <div class="form-group">
            <label for="durasi_sewa">Durasi Sewa (cth: 24 Jam)</label>
            <input type="text" id="durasi_sewa" name="durasi_sewa" value="{{ old('durasi_sewa', '24 Jam') }}" required>
        </div>

        <div class="form-group">
            <label for="stok">Jumlah Stok</label>
            <input type="number" id="stok" name="stok" value="{{ old('stok') }}" required>
        </div>
        
        <div class="form-group">
            <label for="kategori">Kategori (Opsional, cth: Tenda)</label>
            <input type="text" id="kategori" name="kategori" value="{{ old('kategori') }}">
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi (Opsional)</label>
            <textarea id="deskripsi" name="deskripsi">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="form-group">
            <label for="gambar_produk">Gambar Produk</label>
            <input type="file" id="gambar_produk" name="gambar_produk" required>
        </div>

        <button type="submit" class="btn-tambah">Simpan Produk</button>
    </form>

@endsection