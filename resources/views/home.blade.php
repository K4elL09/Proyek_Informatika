@extends('layouts.main')

@section('title', 'Beranda PDMP Outdoor')

@section('content')
<div style="text-align:center; margin-bottom:25px;">
    <input type="text" placeholder="Cari barang sewaan..." 
           style="width: 80%; max-width: 600px; padding: 10px; border-radius: 8px; border: none; background:#1e1e1e; color:white;">
</div>

<div style="display:flex; justify-content:center; gap:10px; margin-bottom:30px;">
    <button class="btn-main">Rekomendasi</button>
    <button class="btn-main" style="background-color:#333;">Tenda</button>
    <button class="btn-main" style="background-color:#333;">Sleeping Bag</button>
</div>

<div style="
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 20px;
    padding: 0 20px;
">
    <div style="background-color:#1e1e1e; border-radius:12px; padding:10px; box-shadow:0 2px 6px rgba(0,0,0,0.5); transition:transform 0.2s;">
        <img src="{{ asset('images/tenda_nsm6.jpg') }}" alt="Tenda NSM 6" style="width:100%; border-radius:8px;">
        <h3 style="margin:10px 0 5px;">Tenda NSM Kapasitas 6</h3>
        <p style="color:#00c67d;">Rp80.000,00 / 24 Jam</p>
    </div>

    <div style="background-color:#1e1e1e; border-radius:12px; padding:10px; box-shadow:0 2px 6px rgba(0,0,0,0.5); transition:transform 0.2s;">
        <img src="{{ asset('images/tenda_nsm4.jpg') }}" alt="Tenda NSM 4" style="width:100%; border-radius:8px;">
        <h3 style="margin:10px 0 5px;">Tenda NSM Kapasitas 4</h3>
        <p style="color:#00c67d;">Rp80.000,00 / 24 Jam</p>
    </div>

    <div style="background-color:#1e1e1e; border-radius:12px; padding:10px; box-shadow:0 2px 6px rgba(0,0,0,0.5); transition:transform 0.2s;">
        <img src="{{ asset('images/tenda_borneo4.jpg') }}" alt="Tenda Borneo 4" style="width:100%; border-radius:8px;">
        <h3 style="margin:10px 0 5px;">Tenda Borneo Kapasitas 4</h3>
        <p style="color:#00c67d;">Rp50.000,00 / 24 Jam</p>
    </div>
</div>
@endsection
