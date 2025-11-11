<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #211F20;
            color: #00ff99;
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            overflow-x: hidden;
        }

        /* Navbar */
        .navbar {
            background-color: #1a1a1a;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 50px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }

        .navbar img.logo {
            height: 70px;
            width: auto;
        }

        .navbar .profile {
            display: flex;
            align-items: center;
            gap: 15px;
            color: #00ff99;
            font-size: 18px;
        }

        .navbar .profile img {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            border: 2px solid #00ff99;
            object-fit: cover;
        }

        /* Layout utama */
        .dashboard-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 110px);
        }

        /* Grid menu */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(2, 320px);
            grid-gap: 50px;
            justify-content: center;
            align-items: center;
        }

        /* Kartu menu */
        .menu-card {
            background-color: #1c1c1c;
            border-radius: 20px;
            width: 320px;
            height: 220px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-shadow: 0 6px 20px rgba(0, 255, 153, 0.25);
            transition: transform 0.2s, box-shadow 0.2s;
            text-align: center;
            text-decoration: none;
        }

        .menu-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 25px rgba(0, 255, 153, 0.4);
        }

        .menu-card img {
            width: 80px;
            height: 80px;
            margin-bottom: 15px;
            object-fit: contain;
            filter: brightness(0) saturate(100%) invert(56%) sepia(89%) saturate(600%) hue-rotate(90deg);
        }

        .menu-card h3 {
            color: #00ff99;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        /* Responsif */
        @media (max-width: 900px) {
            .menu-grid {
                grid-template-columns: repeat(1, 280px);
                grid-gap: 30px;
            }
            .menu-card {
                width: 280px;
                height: 200px;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <img src="{{ asset('images/pdmp2.png') }}" alt="PDMP Logo" class="logo">
        <div class="profile">
            <span>admin</span>
            <img src="{{ asset('images/profile.png') }}" alt="Profile">
        </div>
    </div>

    <!-- Isi Dashboard -->
    <div class="dashboard-container">
        <div class="menu-grid">
            <a href="#" class="menu-card">
                <img src="{{ asset('images/tenda-icon.png') }}" alt="Stok Alat">
                <h3>STOK ALAT</h3>
            </a>

            <a href="#" class="menu-card">
                <img src="{{ asset('images/laporan-icon.png') }}" alt="Laporan Keuangan">
                <h3>LAPORAN KEUANGAN</h3>
            </a>

            <a href="#" class="menu-card">
                <img src="{{ asset('images/info-icon.png') }}" alt="Informasi Pemesanan">
                <h3>INFORMASI PEMESANAN</h3>
            </a>

            <a href="#" class="menu-card">
                <img src="{{ asset('images/kembali-icon.png') }}" alt="Pengembalian">
                <h3>PENGEMBALIAN</h3>
            </a>
        </div>
    </div>

</body>
</html>
