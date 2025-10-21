@extends('layouts.main') {{-- 1. Memberi tahu Laravel untuk menggunakan layout main.blade.php --}}

@section('title', 'Beranda PDMP Outdoor') {{-- 2. Mengatur judul halaman --}}

{{-- 3. Semua kode di bawah ini akan dimasukkan ke @yield('content') --}}
@section('content')

    <form action="{{ route('home') }}" method="GET">
        <div class="search-bar">
            <input type="text" 
                   name="search" 
                   placeholder="Search" 
                   value="{{ request('search') }}">
            <i class="fas fa-search search-icon"></i>
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

    <div class="swiper product-slider">
        <div class="swiper-wrapper">

            @forelse ($products as $product)
                
                <div class="swiper-slide">
                    
                    <div class="product-card">
                        <img src="{{ asset('images/' . $product->gambar_produk) }}" alt="{{ $product->nama_produk }}">
                        <div class="product-info">
                            <h3>{{ $product->nama_produk }}</h3>
                            <p>Rp.{{ number_format($product->harga, 0, ',', '.') }}/{{ $product->durasi_sewa }}</p>
                        </div>
                    </div>

                </div>
            @empty
                <div class="swiper-slide" style="text-align: center; color: white; width: 100%;">
                    <p>Produk tidak ditemukan.</p>
                </div>
            @endforelse

        </div>

        <div class="swiper-button-next" style="color: #fff;"></div>
        <div class="swiper-button-prev" style="color: #fff;"></div>

    </div>

@endsection


{{-- 4. Kode JS ini akan dimasukkan ke @stack('scripts') --}}
@push('scripts')
<script>
    // Inisialisasi Swiper.js
    const swiper = new Swiper('.product-slider', {
        loop: false,
        slidesPerView: 'auto',
        spaceBetween: 20,

        // Tombol Navigasi Kanan/Kiri
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        // Mengatur tampilan di berbagai ukuran layar
        breakpoints: {
            320: {
                slidesPerView: 1.5,
                spaceBetween: 15
            },
            640: {
                slidesPerView: 2,
                spaceBetween: 20
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 30
            }
        }
    });
</script>
@endpush