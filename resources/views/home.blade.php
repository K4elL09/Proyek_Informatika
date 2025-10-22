@extends('layouts.main')

@section('title', 'Beranda PDMP Outdoor')

@section('content')

    <form action="{{ route('home') }}" method="GET">
        <div class="search-bar" style="position: relative; margin-bottom: 20px;">
            <input type="text" 
                   name="search" 
                   placeholder="Search" 
                   value="{{ request('search') }}"
                   style="width: 100%; padding: 12px 20px; background-color: #3c3c3c; border: none; border-radius: 8px; color: white; font-size: 16px;"
            >
            </div>
    </form>

    <div class="categories" style="margin-bottom: 30px;">
        <button style="background-color: #00A87D; color: white; border: none; padding: 8px 16px; border-radius: 20px; margin-right: 10px; font-size: 14px; cursor: pointer;">Rekomendasi</button>
        <button style="background-color: #3c3c3c; color: white; border: none; padding: 8px 16px; border-radius: 20px; margin-right: 10px; font-size: 14px; cursor: pointer;">Tenda</button>
        <button style="background-color: #3c3c3c; color: white; border: none; padding: 8px 16px; border-radius: 20px; margin-right: 10px; font-size: 14px; cursor: pointer;">Sleeping Bag</button>
        <button style="background-color: #3c3c3c; color: white; border: none; padding: 8px 16px; border-radius: 20px; margin-right: 10px; font-size: 14px; cursor: pointer;">Carrier</button>
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


@push('scripts')
<script>
    const swiper = new Swiper('.product-slider', {
        loop: false, 
        slidesPerView: 'auto', 
        spaceBetween: 20, // Jarak antar produk

        // Tombol Navigasi Kanan/Kiri
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

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