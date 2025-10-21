<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Baru</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
    <img src="{{ asset('images/bromo.jpg') }}" alt="Pemandangan Gunung" class="background-image">
    
    <div class="overlay"></div>

    <div class="container">
        <div>
            <div class="header">
                <a href="{{ route('login') }}">
                    <i class="fas fa-arrow-left back-arrow"></i>
                </a>
                <h1>Daftar</h1>
            </div>

            <form action="{{ route('register.post') }}" method="POST">
                @csrf

                @if ($errors->any())
                    <div style="background-color: #ffcccc; border: 1px solid #ff0000; color: #ff0000; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                        <strong>Oops! Ada yang salah:</strong>
                        <ul style="margin-top: 10px; padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="input-group">
                    <i class="fas fa-user icon"></i>
                    <input type="text" name="name" placeholder="Masukkan Nama Anda" required value="{{ old('name') }}">
                </div>
                
                <div class="input-group">
                    <i class="fas fa-id-badge icon"></i>
                    <input type="text" name="username" placeholder="Masukkan Username Anda" required value="{{ old('username') }}">
                </div>

                <div class="input-group">
                    <i class="fas fa-envelope icon"></i>
                    <input type="email" name="email" placeholder="Masukkan Email Anda" required value="{{ old('email') }}">
                </div>

                <div class="input-group">
                    <i class="fas fa-lock icon"></i>
                    <input type="password" name="password" placeholder="Masukkan Password" required>
                </div>
                
                <div class="input-group">
                    <i class="fas fa-lock icon"></i>
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
                </div>

                <button type="submit" class="submit-button">
                    Daftar
                </button>
            </form>
        </div>

        <div class="form-info">
            <p class="footer-text">
                *Password dan verifikasi harus sama untuk membuat akun baru
            </p>

            <p class="footer-text">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
            </p>
        </div>
    </div>
</body>
</html>