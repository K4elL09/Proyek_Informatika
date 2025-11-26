<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDMP Outdoor - Daftar</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="background">
        <div class="overlay"></div>
    </div>

    <div class="container">
        
        <a href="{{ route('onboarding.slide4') }}" class="back-btn">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="white" width="28" height="28">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>

        <div class="logo-section">
            <img src="{{ asset('images/pdmp.png') }}" alt="Logo PDMP">
        </div>

        <h2 class="title">Daftar</h2>

        <form action="{{ route('register.post') }}" method="POST">
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
                     <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#10b981" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                </div>
                <input type="text" name="name" placeholder="Nama Lengkap" required value="{{ old('name') }}">
            </div>

            <div class="input-group">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#10b981" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 4c1.93 0 3.5 1.57 3.5 3.5S13.93 13 12 13s-3.5-1.57-3.5-3.5S10.07 6 12 6zm0 14c-2.03 0-4.43-.82-6.14-2.88C7.55 15.8 9.68 15 12 15s4.45.8 6.14 2.12C16.43 19.18 14.03 20 12 20z"/>
                    </svg>
                </div>
                <input type="text" name="username" placeholder="Username" required value="{{ old('username') }}">
            </div>

            <div class="input-group">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#10b981" viewBox="0 0 24 24">
                        <path d="M22 7l-10 6L2 7v10h20V7z" opacity=".3"/>
                        <path d="M22 6H2v12h20V6zM4 16V8l8 4 8-4v8H4z"/>
                    </svg>
                </div>
                <input type="email" name="email" placeholder="Masukkan E-mail Anda" required value="{{ old('email') }}">
            </div>

            <div class="input-group">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#10b981" viewBox="0 0 24 24">
                        <path d="M17 8V7a5 5 0 0 0-10 0v1H5v13h14V8h-2zm-8 0V7a3 3 0 0 1 6 0v1H9zm8 11H7V10h10v9z"/>
                    </svg>
                </div>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <button type="button" class="toggle-password" onclick="togglePassword('password')">👁</button>
            </div>

            <div class="input-group">
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#10b981" viewBox="0 0 24 24">
                        <path d="M17 8V7a5 5 0 0 0-10 0v1H5v13h14V8h-2zm-8 0V7a3 3 0 0 1 6 0v1H9zm8 11H7V10h10v9z"/>
                    </svg>
                </div>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password" required>
                <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation')">👁</button>
            </div>

            <button type="submit" class="btn-green">Daftar</button>
        </form>

        <p class="register-link">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </p>
    </div>

    <script>
        function togglePassword(fieldId) {
            const input = document.getElementById(fieldId);
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
</body>
</html>