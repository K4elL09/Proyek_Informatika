@extends('layouts.main')

@section('title', 'Edit Nomor Telepon')

@section('content')
<div class="edit-phone-page">

    <a href="{{ route('profile') }}" class="back-btn">
        <i class="fas fa-arrow-left"></i>
    </a>

    <div class="container">

        <h2 class="title">Edit Nomor Telepon</h2>

        {{-- FORM UPDATE --}}
        <form action="{{ route('profile.update.phone') }}" method="POST" class="phone-form">
            @csrf

            <div class="input-group">
                <i class="fas fa-phone icon-left"></i>

                <input 
                    type="text" 
                    name="phone" 
                    value="{{ old('phone', $user->phone) }}"
                    placeholder="Masukkan Nomor Telepon"
                    class="input-field"
                    required
                >

                <button type="button" class="eye-btn" onclick="togglePhone()">
                    <i id="eyeIcon" class="fas fa-eye"></i>
                </button>
            </div>

            @error('phone')
                <p class="error">{{ $message }}</p>
            @enderror

            <button type="submit" class="save-btn">Simpan</button>

        </form>
    </div>
</div>

<style>
    .edit-phone-page {
        padding: 30px;
        color: white;
    }

    .container {
        max-width: 400px;
        margin: 0 auto;
        text-align: center;
    }

    .title {
        font-size: 26px;
        font-weight: bold;
        margin-bottom: 30px;
    }

    .input-group {
        position: relative;
        margin-bottom: 20px;
    }

    .input-field {
        width: 100%;
        padding: 14px 45px 14px 45px;
        border-radius: 14px;
        border: 2px solid #4caf50;
        background: rgba(255,255,255,0.15);
        color: white;
        font-size: 17px;
        outline: none;
    }

    .input-field:focus {
        border-color: #4dd875;
        box-shadow: 0 0 10px #4dd875;
    }

    .icon-left {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 18px;
        color: rgb(163, 255, 163);
    }

    .eye-btn {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: white;
        font-size: 18px;
        cursor: pointer;
    }

    .save-btn {
        width: 100%;
        padding: 14px;
        background: #00AA6C;
        border: none;
        color: white;
        font-size: 18px;
        border-radius: 12px;
        cursor: pointer;
        margin-top: 10px;
    }

    .save-btn:hover {
        background: #00AA6C;
    }

    .error {
        color: #ff8080;
        font-size: 14px;
        text-align: left;
    }

</style>

<script>
function togglePhone() {
    const input = document.querySelector('.input-field');
    const icon = document.getElementById('eyeIcon');

    if (input.type === "text") {
        input.type = "password";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        input.type = "text";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}
</script>
@endsection
