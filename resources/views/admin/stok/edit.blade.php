@extends('layouts.admin')

@section('title', 'Edit Stok Alat')

@section('content')

    <div class="stok-header">
        <h1 style="color: #00c896;">Edit Alat: {{ $product->nama_produk }}</h1>
        <a href="{{ route('admin.stok.index') }}" class="btn-kembali">Kembali ke List Stok</a>
    </div>

    @if ($errors->any())
        <div class="alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.stok.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="stok-form">
        @csrf
        @method('PUT') <div class="form-group">
            <label for="nama_produk">Nama Produk</label>
            <input type="text" id="nama_produk" name="nama_produk" value="{{ old('nama_produk', $product->nama_produk) }}" required>
        </div>

        <div class="form-group">
            <label for="harga">Harga (cth: 80000)</label>
            <input type="number" id="harga" name="harga" value="{{ old('harga', $product->harga) }}" required>
        </div>

        <div class="form-group">
            <label for="durasi_sewa">Durasi Sewa (cth: 24 Jam)</label>
            <input type="text" id="durasi_sewa" name="durasi_sewa" value="{{ old('durasi_sewa', $product->durasi_sewa) }}" required>
        </div>

        <div class="form-group">
            <label for="stok">Jumlah Stok</label>
            <input type="number" id="stok" name="stok" value="{{ old('stok', $product->stok) }}" required>
        </div>
        
        <div class="form-group">
            <label for="kategori">Kategori</label>
            <input type="text" id="kategori" name="kategori" value="{{ old('kategori', $product->kategori) }}">
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi">{{ old('deskripsi', $product->deskripsi) }}</textarea>
        </div>

        <div class="form-group">
            <label for="gambar_produk">Ganti Gambar (Opsional)</label>
            <p>Gambar Saat Ini: <img src="{{ asset('images/' . $product->gambar_produk) }}" alt="{{ $product->nama_produk }}" width="100"></p>
            <input type="file" id="gambar_produk" name="gambar_produk">
        </div>

        <button type="submit" class="btn-tambah">Perbarui Produk</button>
    </form>

@endsection