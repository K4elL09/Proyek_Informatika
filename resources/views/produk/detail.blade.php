@extends('layouts.main')

@section('title', $product->nama_produk)

@section('content')
<div class="product-detail-container">

    <a href="{{ route('home') }}" class="back-btn">
        ← Kembali
    </a>

    <div class="product-detail-card">
        {{-- Gambar --}}
        <div class="product-image">
            <img src="{{ asset('images/' . $product->gambar_produk) }}" alt="{{ $product->nama_produk }}">
        </div>

        {{-- Info Produk --}}
        <div class="product-info">
            <h2>{{ $product->nama_produk }}</h2>
            <p class="price">Rp{{ number_format($product->harga, 0, ',', '.') }}/{{ $product->durasi_sewa }}</p>

            <div class="divider"></div>

            <div class="detail-section">
                <h4>Detail Produk</h4>
                <div class="info-grid">
                    <div><span>Stock:</span> {{ $product->stok }} Buah</div>
                    <div><span>Kategori:</span> {{ $product->kategori }}</div>
                </div>
            </div>

            <div class="divider"></div>

            <div class="description-section">
                <h4>Deskripsi Produk</h4>
                <p>{{ $product->deskripsi }}</p>
            </div>

            <div class="action-buttons">
    <form action="{{ route('checkout.sewaLangsung', $product->id) }}" method="POST" style="flex: 1;">
    @csrf
    <button type="submit" class="btn-outline">Sewa Langsung</button>
</form>

                <form action="{{ route('keranjang.tambah', $product->id) }}" method="POST" style="flex: 1;">
                    @csrf
                    <button type="submit" class="btn-primary">+ Keranjang</button>
                </form>
            </div>
        </div>
    </div>

</div>

<style>
.product-detail-container {
    max-width: 1000px;
    margin: 40px auto;
    color: white;
}

.back-btn {
    display: inline-block;
    color: #00AA6C;
    text-decoration: none;
    margin-bottom: 20px;
    font-weight: 600;
}

.product-detail-card {
    display: flex;
    gap: 40px;
    background: #2a292a;
    border-radius: 16px;
    padding: 30px;
}

.product-image img {
    width: 420px;
    height: 420px;
    object-fit: cover;
    border-radius: 12px;
}

.product-info {
    flex: 1;
}

.product-info h2 {
    font-size: 26px;
    font-weight: 600;
    margin-bottom: 10px;
}

.price {
    color: #00FF80;
    font-weight: 600;
    font-size: 18px;
    margin-bottom: 20px;
}

.divider {
    height: 1px;
    background: #3c3b3b;
    margin: 15px 0;
}

.detail-section h4,
.description-section h4 {
    font-weight: 600;
    margin-bottom: 10px;
    color: #fff;
}

.info-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
    font-size: 14px;
}

.info-grid span {
    color: #8f8f8f;
    font-weight: 600;
}

.description-section p {
    font-size: 14px;
    line-height: 1.6;
    white-space: pre-line;
}

.action-buttons {
    display: flex;
    gap: 15px;
    margin-top: 30px;
}

.btn-outline {
    flex: 1;
    background: transparent;
    border: 2px solid #00AA6C;
    color: #00AA6C;
    border-radius: 8px;
    padding: 12px 30px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.2s;
}

.btn-primary {
    flex: 1;
    background: transparent;
    border: 2px solid #00AA6C;
    color: #00AA6C;
    border-radius: 8px;
    padding: 12px 30px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.2s;
}

.btn-outline:hover, 
.btn-primary:hover {
    background: #00AA6C;
    color: white;

@media (max-width: 768px) {
    .product-detail-card {
        flex-direction: column;
        align-items: center;
    }
    .product-image img {
        width: 100%;
        height: auto;
    }
}
</style>
@endsection