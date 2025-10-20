<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDMP Outdoor - Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="container">
        <div class="logo-section">
            <img src="{{ asset('images/pdmp.png') }}" alt="Logo PDMP">
        </div>

        <h2>Masuk</h2>

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="input-group">
                <svg viewBox="0 0 24 24">
                    <path d="M22 7l-10 6L2 7"/>
                    <rect x="2" y="4" width="20" height="16" rx="2"/>
                </svg>
                <input type="text" name="emailOrPhone" placeholder="E-mail / Nomor Telepon" required>
            </div>

            <div class="input-group">
                <svg viewBox="0 0 24 24">
                    <rect x="3" y="11" width="18" height="11" rx="2"/>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                </svg>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <button type="button" class="toggle-password" onclick="togglePassword()">👁</button>
            </div>

            <button type="submit" class="submit">Login</button>
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
