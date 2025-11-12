@extends('layouts.admin')

@section('title', 'Kelola Stok Alat')

@section('content')

    <div class="stok-header">
        <h1>Kelola Stok Alat</h1>
        <a href="{{ route('admin.stok.create') }}" class="btn-tambah">Tambah Alat Baru</a>
    </div>

    @if (session('success'))
        <div class="alert-success" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="stok-table-container">
        <table class="stok-table">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Durasi</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>
                        <img src="{{ asset('images/' . $product->gambar_produk) }}" alt="{{ $product->nama_produk }}" class="stok-img">
                    </td>
                    <td>{{ $product->nama_produk }}</td>
                    <td>Rp{{ number_format($product->harga, 0, ',', '.') }}</td>
                    <td>{{ $product->durasi_sewa }}</td>
                    <td>{{ $product->stok }}</td>
                    <td>
                        <a href="{{ route('admin.stok.edit', $product->id) }}" class="btn-edit">Edit</a>

                        <form action="{{ route('admin.stok.destroy', $product->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Anda yakin ingin menghapus produk ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-hapus">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Belum ada data produk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection