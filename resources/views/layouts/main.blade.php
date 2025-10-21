<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PDMP Outdoor')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&family=Quicksand:wght@600&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            padding: 0;
            background-color: #211F20; 
            color: white;
            font-family: "Poppins", sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .page-wrapper {
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: #211F20;
        }

        /* HEADER */
        header.site-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 1200px; /* Batas lebar di desktop */
            margin: 0 auto; /* Menengahkan di desktop */
            padding: 15px 20px;
        }
        header.site-header .logo img {
            height: 45px; /* Ukuran diperbesar */
            width: auto;
        }
        header.site-header .profile-icon img {
            height: 38px; /* Ukuran diperbesar */
            width: 38px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* MAIN */
        main {
            flex: 1;
            width: 100%;
            max-width: 1200px; /* Batas lebar di desktop */
            margin: 20px auto 0 auto; /* Menengahkan & beri jarak atas */
            padding: 0 15px;
        }

        /* FOOTER */
        footer.site-footer {
            margin-top: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            padding: 20px 15px;
            border-top: 1px solid #3a3839;
        }
        footer.site-footer .footer-logo img {
            height: 60px;
            width: auto;
            margin: 10px 0;
        }
        footer.site-footer .order-btn {
            background: #00AA6C;
            border: none;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            border-radius: 10px;
            padding: 14px 0;
            width: 100%;
            max-width: 420px; /* Tombol footer tetap seukuran HP */
            cursor: pointer;
        }
        
        /* CSS untuk product-card Anda (pastikan ada di file .css atau di sini) */
        .product-card {
            background-color: #3c3c3c; /* Asumsi dari gambar Anda */
            border-radius: 8px;
            overflow: hidden;
            color: white;
        }
        .product-card img {
            width: 100%;
            height: 200px; /* Atur tinggi gambar */
            object-fit: cover;
        }
        .product-card .product-info {
            padding: 15px;
        }
        .product-card .product-info h3 {
            margin: 0 0 10px 0;
            font-size: 18px;
        }
        .product-card .product-info p {
            margin: 0;
            font-size: 14px;
            color: #00A87D; /* Asumsi warna hijau */
            font-weight: bold;
        }
    </style>
</head>
<body>
    
    <div class="page-wrapper">
        
        <header class="site-header">
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('images/pdmp2.png') }}" alt="Logo PDMP">
            </a>
            
            <a href="{{ route('profile') }}" class="profile-icon">
                <img src="{{ asset('images/profile.png') }}" alt="Profile">
            </a>
        </header>

        <main>
            @yield('content')
        </main>

       <footer class="site-footer">
    <div class="footer-logo">
        <img src="{{ asset('images/pdmp2.png') }}" alt="Footer Logo">
    </div>

    @if (!Request::is('profile'))
        <button class="order-btn">Cek Pesanan Saya</button>
    @endif
</footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


    @stack('scripts')
</body>
</html>