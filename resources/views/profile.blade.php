@extends('layouts.main')

@section('title', 'Akun Saya')

@section('content')
<div class="profile-page">

    <section class="profile-hero">
        <a href="{{ route('home') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i>
        </a>
        <img src="{{ asset('images/pdmp.png') }}" alt="PDMP Outdoor" class="logo">
    </section>

    <section class="profile-content">

        {{-- CARD UTAMA --}}
        <div class="profile-card">

            {{-- LOGOUT --}}
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="logout-btn">LOGOUT</button>
            </form>

            <div class="profile-header">

                {{-- FOTO PROFIL (DIKLIK → UPLOAD OTOMATIS) --}}
                <div class="photo-container">

                    <form action="{{ route('profile.update.photo') }}" method="POST" enctype="multipart/form-data" id="photoForm">
                        @csrf

                        <!-- INPUT FILE HIDDEN -->
                        <input 
                            type="file" 
                            name="photo" 
                            id="photoInput" 
                            accept="image/*" 
                            style="display:none"
                            onchange="document.getElementById('photoForm').submit();"
                        >

                        <!-- FOTO PROFIL -->
                        <img 
                            src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('images/profil.png') }}" 
                            class="profile-avatar"
                            onclick="document.getElementById('photoInput').click();" 
                            style="cursor: pointer;"
                        >
                    </form>

                </div>

                <div class="profile-info">
                    <p>Username</p>
                    <h2>{{ $user->name }}</h2>

                    <p>E-Mail</p>
                    <h3>{{ $user->email }}</h3>

                    <p>No. Akun / Telepon</p>
                    <h3>{{ $user->phone ?? 'Belum diisi' }}</h3>
                </div>

            </div>
        </div>

        {{-- MENU PENGATURAN --}}
        <div class="settings">

            <a href="#" class="setting-item">
                <i class="fas fa-envelope"></i>
                <div>
                    <strong>E-Mail</strong>
                    <p>{{ $user->email }}</p>
                </div>
            </a>

            <a href="{{ route('profile.edit.password') }}" class="setting-item">
                <i class="fas fa-lock"></i>
                <div>
                    <strong>Password</strong>
                    <p>Ganti Password Akun</p>
                </div>
            </a>

            <a href="{{ route('profile.edit.phone') }}" class="setting-item">
                <i class="fas fa-phone"></i>
                <div>
                    <strong>Nomor Telepon</strong>
                    <p>{{ $user->phone ?? 'Belum diisi' }}</p>
                </div>
            </a>

        </div>

    </section>
</div>
@endsection
