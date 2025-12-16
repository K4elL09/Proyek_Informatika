@extends('layouts.main')

@section('title', 'Ganti Password')

@section('content')

<style>
    .form-wrapper {
        width: 90%;
        max-width: 550px;
        margin: 60px auto;
        color: white;
    }

    .form-wrapper h2 {
        font-size: 30px;
        font-weight: bold;
        margin-bottom: 25px;
    }

    .input-box {
        position: relative;
        margin-bottom: 20px;
    }

    .input-box input {
        width: 100%;
        padding: 14px 45px 14px 45px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        font-size: 16px;
        color: white;
        backdrop-filter: blur(10px);
    }

    .input-box input::placeholder {
        color: #e5e5e5;
    }

    .input-box .icon-left {
        position: absolute;
        top: 50%;
        left: 15px;
        transform: translateY(-50%);
        opacity: 0.7;
    }

    .input-box .icon-right {
        position: absolute;
        top: 50%;
        right: 15px;
        transform: translateY(-50%);
        cursor: pointer;
        opacity: 0.8;
    }

    .btn-submit {
        width: 100%;
        margin-top: 10px;
        background-color: #00AA6C;
        color: white;
        padding: 15px;
        border-radius: 12px;
        font-weight: bold;
        font-size: 17px;
        border: none;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn-submit:hover {
        background-color: #1aa34a;
    }
</style>

<div class="form-wrapper">

    <h2>Ganti Password</h2>

    @if ($errors->any())
        <div style="color: #ff6b6b; margin-bottom: 20px;">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('profile.update.password') }}" method="POST">
        @csrf

        <!-- PASSWORD LAMA -->
        <div class="input-box">
            <span class="icon-left">🔒</span>
            <input type="password" name="current_password" placeholder="Password Lama" required>
            <span class="icon-right toggle-pass">👁️</span>
        </div>

        <!-- PASSWORD BARU -->
        <div class="input-box">
            <span class="icon-left">🔒</span>
            <input type="password" name="new_password" placeholder="Password Baru" required>
            <span class="icon-right toggle-pass">👁️</span>
        </div>

        <!-- KONFIRMASI PASSWORD -->
        <div class="input-box">
            <span class="icon-left">🔒</span>
            <input type="password" name="new_password_confirmation" placeholder="Konfirmasi Password Baru" required>
            <span class="icon-right toggle-pass">👁️</span>
        </div>

        <button type="submit" class="btn-submit">Simpan</button>

    </form>

</div>

<script>
    // Show/Hide password
    document.querySelectorAll('.toggle-pass').forEach(btn => {
        btn.addEventListener('click', function () {
            const input = this.previousElementSibling;
            input.type = input.type === "password" ? "text" : "password";
        });
    });
</script>

@endsection
