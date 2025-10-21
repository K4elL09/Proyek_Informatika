@extends('layouts.main')

@section('title', 'Beranda PDMP Outdoor')

@section('content')
{{-- 
    Container, Header, dan Footer sudah ada di main.blade.php.
    Kita hanya perlu menampilkan konten unik halaman ini.
--}}

<div class="search-bar">
    <input type="text" placeholder="Search">
    <i class="fas fa-search search-icon"></i>
</div>

<div class="categories">
    <button class="active">Rekomendasi</button>
    <button>Tenda</button>
    <button>Sleeping Bag</button>
    <button>Carrier</button>
    <button>Headlamp</button>
    <button>Lainnya</button>
</div>

<div class="products">
    <div class="product-card">
        <img src="{{ asset('images/tenda_nsm6.jpg') }}" alt="Tenda NSM 6">
        <div class="product-info">
            <h3>Tenda NSM Kapasitas 6</h3>
            <p>Rp.80.000,00/24 Jam</p>
        </div>
    </div>
    
    <div class="product-card">
        <img src="{{ asset('images/tenda_nsm4.jpg') }}" alt="Tenda NSM 4">
        <div class="product-info">
            <h3>Tenda NSM Kapasitas 4</h3>
            <p>Rp.80.000,00/24 Jam</p>
        </div>
    </div>
    
    <div class="product-card">
        <img src="{{ asset('images/tenda_borneo4.jpg') }}" alt="Tenda Borneo 4">
        <div class="product-info">
            <h3>Tenda Borneo Kapasitas 4</h3>
            <p>Rp.50.000,00/24 Jam</p>
        </div>
    </div>
</div>
@endsection