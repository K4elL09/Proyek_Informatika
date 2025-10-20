<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PDMP Outdoor')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #121212;
            color: white;
            font-family: "Poppins", sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            width: 100%;
            padding: 15px 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #1e1e1e;
        }

        header img.logo {
            height: 50px;
        }

        header .profile {
            font-size: 26px;
            cursor: pointer;
        }

        main {
            flex: 1;
            width: 100%;
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }

        footer {
            width: 100%;
            background-color: #1e1e1e;
            text-align: center;
            padding: 20px 0;
        }

        .btn-main {
            background-color: #00c67d;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.2s;
        }

        .btn-main:hover {
            background-color: #00b16a;
        }
    </style>

    @stack('styles')
</head>
<body>
    <header>
        <!-- ✅ Logo PDMP -->
        <img src="{{ asset('images/pdmp2.png') }}" alt="Logo PDMP" class="logo">
        <div class="profile"><i class="fas fa-user-circle"></i></div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <button class="btn-main" style="width:250px;">Cek Pesanan Saya</button>
        <p style="margin-top:10px; font-size:13px;">© 2025 PDMP Outdoor</p>
    </footer>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    @stack('scripts')
</body>
</html>
