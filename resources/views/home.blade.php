@extends('layouts.main')

@section('title', 'Beranda PDMP Outdoor')

@section('content')

    {{-- Search Bar --}}
    <form action="{{ route('home') }}" method="GET">
        <div class="search-bar" style="position: relative; margin-bottom: 20px;">
            <input type="text" 
                   name="search" 
                   placeholder="Cari alat outdoor..."
                   value="{{ request('search') }}"
                   style="width: 100%; padding: 12px 20px; background-color: #3c3c3c; border: none; border-radius: 8px; color: white; font-size: 16px;"
            >
        </div>
    </form>

    {{-- Kategori Filter --}}
    <div class="categories" style="margin-bottom: 30px;">
        @php
            $kategoriList = ['Semua', 'Tenda', 'Sleeping Bag', 'Carrier', 'Kompor', 'Senter', 'Peralatan Masak', 'Matras'];
            $activeKategori = request('kategori') ?? 'Semua';
        @endphp

        @foreach($kategoriList as $kategori)
            <a href="{{ route('home', ['kategori' => $kategori !== 'Semua' ? $kategori : null]) }}"
                style="
                    background-color: {{ $activeKategori === $kategori ? '#00A87D' : '#3c3c3c' }};
                    color: white; 
                    border: none; 
                    padding: 8px 16px; 
                    border-radius: 20px; 
                    margin-right: 10px; 
                    font-size: 14px; 
                    cursor: pointer;
                    text-decoration: none;
                ">
                {{ $kategori }}
            </a>
        @endforeach
    </div>

    {{-- Informasi pencarian / kategori --}}
    @if(request('search'))
        <p style="color: #aaa; margin-bottom: 10px;">Menampilkan hasil untuk: 
            <strong>"{{ request('search') }}"</strong>
        </p>
    @elseif(request('kategori'))
        <p style="color: #aaa; margin-bottom: 10px;">Kategori: 
            <strong>{{ request('kategori') }}</strong>
        </p>
    @endif

    {{-- Produk Slider --}}
    <div class="swiper product-slider">
        <div class="swiper-wrapper">

            @forelse ($products as $product)
                <div class="swiper-slide">
                    {{-- 🔗 Bungkus kartu dengan link ke halaman detail --}}
                    <a href="{{ route('produk.show', $product->id) }}" class="product-card-link">
                        <div class="product-card">
                            {{-- Gambar produk --}}
                            <img src="{{ asset('images/' . $product->gambar_produk) }}" alt="{{ $product->nama_produk }}">

                            {{-- Info produk --}}
                            <div class="product-info">
                                <h3 style="margin-bottom: 5px;">{{ $product->nama_produk }}</h3>

                                {{-- Kategori --}}
                                <p style="margin: 0; color: #ccc; font-size: 13px;">
                                    {{ $product->kategori ?? 'Tanpa kategori' }}
                                </p>

                                {{-- Harga & durasi --}}
                                <p style="margin-top: 5px; color: #00A87D; font-weight: bold;">
                                    Rp.{{ number_format($product->harga, 0, ',', '.') }}/{{ $product->durasi_sewa }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="swiper-slide" style="text-align: center; color: white; width: 100%;">
                    <p>Produk tidak ditemukan.</p>
                </div>
            @endforelse

        </div>

        {{-- Navigasi slider --}}
        <div class="swiper-button-next" style="color: #fff;"></div>
        <div class="swiper-button-prev" style="color: #fff;"></div>
    </div>

@endsection

<style>
.product-card-link {
    text-decoration: none;
    color: inherit;
}
.product-card-link:hover .product-card {
    transform: scale(1.02);
    transition: 0.2s ease;
}
</style>

@push('scripts')
<script>
    const swiper = new Swiper('.product-slider', {
        loop: false, 
        slidesPerView: 'auto', 
        spaceBetween: 20,

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
