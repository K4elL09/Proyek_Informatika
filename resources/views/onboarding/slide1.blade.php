@extends('layouts.layout')

@section('title', 'Selamat Datang')

@section('content')
<div class="onboard-container" style="background-image: url('{{ asset('images/bromo.jpg') }}');">
    <div class="overlay"></div>
    <img class="logo" src="{{ asset('images/pdmp.png') }}" alt="Logo PDMP">

    <h2 class="title">Selamat Datang</h2>
    <p class="desc">Selamat datang di PDMP Outdoor! Kami sangat senang Anda bergabung. Bersama kami, Anda akan menemukan segala yang Anda butuhkan untuk memulai petualangan yang luar biasa.</p>

    <div class="dots">
        <a href="{{ route('onboarding.slide1') }}" class="dot active"></a>
        <a href="{{ route('onboarding.slide2') }}" class="dot"></a>
        <a href="{{ route('onboarding.slide3') }}" class="dot"></a>
    </div>

    <a href="{{ route('onboarding.slide2') }}" class="next-btn">›</a>
    <a href="{{ route('home') }}" class="skip">Skip</a>
</div>
@endsection
