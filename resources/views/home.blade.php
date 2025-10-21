@extends('layouts.main')

@section('title', 'Beranda PDMP Outdoor')

@section('content')
{{-- 
    Container, Header, dan Footer sudah ada di main.blade.php.
    Kita hanya perlu menampilkan konten unik halaman ini.
--}}

<form action="{{ route('home') }}" method="GET">
    <div class="search-bar">
        <input type="text" 
               name="search" 
               placeholder="Search" 
               value="{{ request('search') }}">
        
        <i class="fas fa-search search-icon"></i>
        
        {{-- Tombol submit tidak terlihat, menekan Enter akan otomatis submit --}}
    </div>
</form>

<div class="categories">
    <button class="active">Rekomendasi</button>
    <button>Tenda</button>
    <button>Sleeping Bag</button>
    <button>Carrier</button>
    <button>Headlamp</button>
    <button>Lainnya</button>
</div>

<div class="products">

    {{-- Loop semua data dari variabel $products --}}
    @forelse ($products as $product)
        <div class="product-card">

            {{-- Asumsi kolom gambar adalah 'gambar_produk' --}}
            <img src="{{ asset('images/' . $product->gambar_produk) }}" alt="{{ $product->nama_produk }}">
            
            <div class="product-info">
                {{-- Asumsi kolom nama adalah 'nama_produk' --}}
                <h3>{{ $product->nama_produk }}</h3>

                {{-- Asumsi kolom harga 'harga' dan durasi 'durasi_sewa' --}}
                <p>Rp.{{ number_format($product->harga, 0, ',', '.') }}/{{ $product->durasi_sewa }}</p>
            </div>
        </div>

    {{-- Jika $products kosong (pencarian tidak ditemukan) --}}
    @empty
        <div style="text-align: center; color: white; width: 100%;">
            <p>Produk tidak ditemukan.</p>
        </div>
    @endforelse

</div>
@endsection