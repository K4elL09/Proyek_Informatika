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

        .notification-popup {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: #00AA6C;
            color: #fff;
            padding: 14px 25px;
            border-radius: 10px;
            font-weight: 600;
            z-index: 9999;
            box-shadow: 0 10px 25px rgba(0,0,0,.25);
            animation: notifFade 3s forwards;
        }

        .notification-popup.error {
            background: #e74c3c;
        }

        @keyframes notifFade {
            0% { opacity: 0; transform: translate(-50%, -10px); }
            10% { opacity: 1; transform: translate(-50%, 0); }
            80% { opacity: 1; }
            100% { opacity: 0; }
        }

        .page-wrapper {
            width: 100%;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: #211F20;
        }

        header.site-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto; 
            padding: 1px 10px;
        }
        header.site-header .logo img {
            height: 100px; 
            width: auto;
        }
        header.site-header .profile-icon img {
            height: 50px; 
            width: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .header-icons {
            display: flex;
            align-items: center;
            gap: 20px; 
        }
        
        .cart-icon-link img {
            width: 30px; 
            height: 30px; 
            cursor: pointer;
        }

       
        main {
            flex: 1;
            width: 100%;
            max-width: 1200px; 
            margin: 10px auto 0 auto; 
            padding: 0 15px;
        }

        footer.site-footer {
            margin-top: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            padding: 20px 15px;
            border-top: 1px solid #3a3839;
        }

        /* Update Style untuk Tombol Pesanan agar support tag <a> */
        footer.site-footer .order-btn {
            margin-top: 100px;
            background: #00AA6C;
            border: none;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            border-radius: 10px;
            padding: 14px 0;
            width: 100%;
            max-width: 420px;
            cursor: pointer;
            text-decoration: none; /* Hilangkan garis bawah link */
            display: block;        /* Agar width 100% berfungsi */
            text-align: center;    /* Agar teks di tengah */
        }
        
        .product-card {
            background-color: #3c3c3c; 
            border-radius: 8px;
            overflow: hidden;
            color: white;
        }
        .product-card img {
            width: 100%;
            height: 200px;
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
            color: #00A87D; 
            font-weight: bold;
        }
    </style>
</head>
<body>
    @if(session('success'))
    <div id="globalNotif" class="notification-popup">
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div id="globalNotif" class="notification-popup error">
        {{ session('error') }}
    </div>
    @endif

    <div class="page-wrapper">
        
        <header class="site-header">
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('images/pdmp2.png') }}" alt="Logo PDMP">
            </a>
            
            <div class="header-icons">
                
                {{-- 🛒 LOKASI UNTUK GAMBAR KERANJANG --}}
                <a href="{{ route('keranjang.index') }}" class="cart-icon-link" title="Keranjang Belanja">
                    <img 
                        src="{{ asset('images/keranjang.png') }}" 
                        alt="Keranjang"
                    >
                </a>
                
                {{-- FOTO PROFIL USER DINAMIS --}}
                <a href="{{ route('profile') }}" class="profile-icon">
                    <img 
                        src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('images/profile.png') }}" 
                        alt="Foto Profil"
                    >
                </a>
            </div>
            
        </header>

        <main>
            @yield('content')
        </main>

        <footer class="site-footer">
            {{-- Tombol hanya muncul jika bukan di halaman profile --}}
            @if (!Request::is('profile'))
                <a href="{{ route('pesanan.index') }}" class="order-btn">
                    Cek Pesanan Saya
                </a>
            @endif
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    @stack('scripts')
</body>
</html>