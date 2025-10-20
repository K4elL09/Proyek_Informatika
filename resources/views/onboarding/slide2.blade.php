@extends('layouts.onboarding')

@section('title', 'Peralatan Berkualitas')

@section('content')
<div class="onboard-container" style="background-image: url('{{ asset('images/bromo.jpg') }}');">
    <div class="overlay"></div>
    <img class="logo" src="{{ asset('images/pdmp.png') }}" alt="Logo PDMP">

    <h2 class="title">Peralatan Berkualitas</h2>
    <p class="desc">Kami menyediakan peralatan outdoor berkualitas tinggi untuk menjaga kenyamanan dan keselamatan Anda di alam bebas.</p>

    <div class="dots">
        <a href="{{ route('onboarding.slide1') }}" class="dot"></a>
        <a href="{{ route('onboarding.slide2') }}" class="dot active"></a>
        <a href="{{ route('onboarding.slide3') }}" class="dot"></a>
    </div>

    <a href="{{ route('onboarding.slide3') }}" class="next-btn">›</a>
    <a href="{{ route('home') }}" class="skip">Skip</a>
</div>
@endsection
