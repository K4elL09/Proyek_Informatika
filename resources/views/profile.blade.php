@extends('layouts.main')

@section('title', 'Akun Saya')

@section('content')
<div class="profile-page">
    <!-- 🔹 Hero section dengan background gunung -->
    <section class="profile-hero">
        <a href="{{ route('home') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i>
        </a>
        <img src="{{ asset('images/pdmp.png') }}" alt="PDMP Outdoor" class="logo">
    </section>

    <!-- 🔹 Konten profil -->
    <section class="profile-content">
  <div class="profile-card">
    <form action="{{ route('logout') }}" method="POST" class="logout-form">
        @csrf
        <button type="submit" class="logout-btn">LOGOUT</button>
    </form>
            <div class="profile-header">
                <img src="{{ asset('images/profil.png') }}" alt="Foto Profil" class="profile-avatar">
                <div class="profile-info">
                    <p>Username</p>
                    <h2>Louis Efraendly</h2>
                    <p>No. Akun</p>
                    <h3>(+62)69696969</h3>
                </div>
            </div>
        </div>

        <!-- 🔹 Pengaturan Akun -->
        <div class="settings">
            <a href="#" class="setting-item">
                <i class="fas fa-envelope"></i>
                <div>
                    <strong>E-Mail</strong>
                    <p>Ganti akun email FORGER</p>
                </div>
            </a>
            <a href="#" class="setting-item">
                <i class="fas fa-key"></i>
                <div>
                    <strong>PIN</strong>
                    <p>Ganti PIN transaksi FORGER</p>
                </div>
            </a>
            <a href="#" class="setting-item">
                <i class="fas fa-lock"></i>
                <div>
                    <strong>Password</strong>
                    <p>Ganti Password akun FORGER</p>
                </div>
            </a>
            <a href="#" class="setting-item">
                <i class="fas fa-phone"></i>
                <div>
                    <strong>Nomor Telepon</strong>
                    <p>Ganti nomor telepon</p>
                </div>
            </a>
        </div>
    </section>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endpush
