@extends('layouts.main')

@section('title', 'Akun Saya')

@section('content')
<div class="profile-page">

    <!-- Header dengan Tombol Kembali -->
    <header class="profile-header">
        <a href="{{ route('home') }}" class="back-button">
            <i class="fas fa-arrow-left"></i>
        </a>
    </header>

    <!-- Konten Utama Profil -->
    <main class="profile-content">
        <!-- Kartu Informasi Pengguna -->
        <div class="profile-card" style="text-align: center;">
            <div class="profile-picture" style="margin-bottom: 15px;">
                {{-- Ganti 'profil.png' dengan gambar profil user jika ada --}}
                <img src="{{ asset('images/profil.png') }}" 
                     alt="Foto Profil" 
                     style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 2px solid #ddd;">
            </div>
            
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="logout-button-header">LOGOUT</button>
            </form>

            <div class="user-info">
                <h3>Username</h3>
                <p>{{ $user->name ?? 'Nama Pengguna' }}</p>
                <h3>No. Akun</h3>
                <p>{{ $user->phone_number ?? '(+62) 8123456789' }}</p>
            </div>
        </div>

        <!-- Menu Opsi Akun -->
        <div class="profile-menu">
            <a href="#" class="menu-item">
                <i class="fas fa-envelope"></i>
                <div class="menu-text">
                    <h4>E-Mail</h4>
                    <p>Ganti alamat email</p>
                </div>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-thumbtack"></i>
                <div class="menu-text">
                    <h4>PIN</h4>
                    <p>Ganti PIN transaksi</p>
                </div>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-lock"></i>
                <div class="menu-text">
                    <h4>Password</h4>
                    <p>Ganti password akun</p>
                </div>
            </a>
            <a href="#" class="menu-item">
                <i class="fas fa-phone"></i>
                <div class="menu-text">
                    <h4>Nomor Telepon</h4>
                    <p>Ganti nomor telepon</p>
                </div>
            </a>
        </div>
    </main>
</div>
@endsection
