@extends('layouts.onboarding')

@section('title', 'Siap untuk Petualangan')

@section('content')
<div class="onboard-container" style="background-image: url('{{ asset('images/bromo.jpg') }}');">
    <div class="overlay"></div>
    <img class="logo" src="{{ asset('images/pdmp.png') }}" alt="Logo PDMP">

    <h2 class="title">Siap untuk petualangan</h2>

    <div class="dots">
        <a href="{{ route('onboarding.slide1') }}" class="dot"></a>
        <a href="{{ route('onboarding.slide2') }}" class="dot"></a>
        <a href="{{ route('onboarding.slide3') }}" class="dot active"></a>
    </div>

    <a href="{{ route('onboarding.slide4') }}" class="next-btn">›</a>
    <a href="{{ route('onboarding.slide4') }}" class="skip">Skip</a>
</div>
@endsection
