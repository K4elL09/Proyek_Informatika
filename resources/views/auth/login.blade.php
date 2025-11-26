<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDMP Outdoor - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="background">
        <div class="overlay"></div>
    </div>

    <div class="container">
        {{-- Tombol back --}}
        <a href="{{ route('onboarding.slide4') }}" class="back-btn">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="white" width="28" height="28">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>

        {{-- Logo PDMP --}}
        <div class="logo-section">
            <img src="{{ asset('images/pdmp.png') }}" alt="Logo PDMP">
        </div>

        {{-- Form login --}}
        <h2 class="title">Masuk</h2>

        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            @if ($errors->any())
                <div style="background-color: #ffcccc; border: 1px solid #ff0000; color: #ff0000; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 14px;">
                    <strong>Oops! Ada yang salah:</strong>
                    <ul style="margin-top: 10px; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="input-group">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#00AA6C" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                </div>
                
                <input type="text" name="login_field" placeholder="Email atau Username" required value="{{ old('login_field') }}">
            </div>

            <div class="input-group">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#00AA6C" viewBox="0 0 24 24">
                        <path d="M17 8V7a5 5 0 0 0-10 0v1H5v13h14V8h-2zm-8 0V7a3 3 0 0 1 6 0v1H9zm8 11H7V10h10v9z"/>
                    </svg>
                </div>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <button type="button" class="toggle-password" onclick="togglePassword()">👁</button>
            </div>

            <button type="submit" class="btn-green">Masuk</button>
        </form>

        <p class="register-link">
            Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
        </p>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>