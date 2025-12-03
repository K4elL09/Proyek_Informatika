@extends('layouts.main')

@section('title', 'Akun Saya')

@section('content')

<style>
    .profile-content {
        max-width: 900px;
        margin: -100px auto 50px auto;
        padding: 0 15px;
    }

    .profile-card {
        background-color: #383838;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
        margin-bottom: 25px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .profile-header {
        display: flex;
        align-items: flex-start;
        gap: 30px;
        margin-top: 15px;
    }

    .profile-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #00AA6C;
    }

    .profile-info {
        flex-grow: 1;
    }
    .profile-info p {
        font-size: 13px;
        color: #B0B0B0;
        margin: 0;
        margin-top: 10px;
    }
    .profile-info h2 {
        font-size: 20px;
        font-weight: 600;
        color: #00AA6C;
        margin: 0;
        margin-bottom: 5px;
    }
    .profile-info h3 {
        font-size: 16px;
        color: white;
        margin: 0;
        margin-bottom: 15px;
    }

    .settings {
        max-width: 600px;
        margin: 0 auto;
        display: grid;
        gap: 15px;
    }
    .setting-item {
        display: flex;
        align-items: center;
        background-color: #383838;
        padding: 15px;
        border-radius: 10px;
        text-decoration: none;
        color: white;
        transition: background-color 0.2s;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
    }
    .setting-item:hover {
        background-color: #444;
    }
    .setting-item i {
        font-size: 20px;
        color: #00AA6C;
        margin-right: 15px;
        width: 25px;
        text-align: center;
    }
    .setting-item strong {
        display: block;
        font-size: 16px;
        color: white;
        margin-bottom: 2px;
    }
    .setting-item p {
        font-size: 14px;
        color: #B0B0B0;
        margin: 0;
    }
</style>

<div class="profile-page">

    <section class="profile-hero relative h-64 bg-cover bg-center" style="background-image: url('{{ asset('images/bromo.jpg') }}');">
        <div class="absolute inset-0 bg-black opacity-30"></div>
        <div class="relative p-4 flex justify-between items-start">
             <a href="{{ route('home') }}" class="back-btn text-white text-3xl hover:text-green-400 transition-colors">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <div class="absolute w-full text-center" style="bottom: 20px;">
            <img src="{{ asset('images/pdmp.png') }}" alt="PDMP Outdoor" class="w-24 mx-auto logo">
        </div>
    </section>

    <section class="profile-content">

        <div class="profile-card">

            <div style="text-align: right; margin-bottom: 20px;">
                <form action="{{ route('logout') }}" method="POST" class="logout-form" style="display: inline-block;">
                    @csrf
                    <button type="submit" class="logout-btn" style="background-color: #E74C3C; color: white; border: none; padding: 8px 15px; border-radius: 5px; font-weight: 600; cursor: pointer;">
                        LOGOUT
                    </button>
                </form>
            </div>

            <div class="profile-header">

                <div class="photo-container">
                    <form action="{{ route('profile.update.photo') }}" method="POST" enctype="multipart/form-data" id="photoForm">
                        @csrf

                        <input 
                            type="file" 
                            name="photo" 
                            id="photoInput" 
                            accept="image/*" 
                            style="display:none"
                            onchange="document.getElementById('photoForm').submit();"
                        >

                        <img 
                            src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('images/profil.png') }}" 
                            class="profile-avatar"
                            onclick="document.getElementById('photoInput').click();" 
                            alt="Foto Profil"
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
