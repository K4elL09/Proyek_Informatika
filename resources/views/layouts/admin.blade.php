<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin PDMP')</title>
    
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="dashboard-container">
    
    <aside class="sidebar">
        <div class="sidebar-header">
            <img src="{{ asset('images/pdmp2.png') }}" alt="Logo" class="logo">
        </div>
<ul class="sidebar-menu">
    <li><a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-home"></i> Dashboard</a></li>
    <li><a href="{{ route('admin.stok.index') }}"><i class="fa-solid fa-boxes-stacked"></i> Stok Alat</a></li>
    <li><a href="{{ route('admin.laporan.index') }}"><i class="fa-solid fa-file-invoice-dollar"></i> Laporan Keuangan</a></li>
    <li><a href="{{ route('admin.pemesanan.index') }}"><i class="fa-solid fa-clipboard-list"></i> Informasi Pemesanan</a></li>
    <li><a href="{{ route('admin.pengembalian.index') }}"><i class="fa-solid fa-rotate-left"></i> Pengembalian</a></li>

    <li>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-button">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </button>
        </form>
    </li>
</ul>
    </aside>

    <main class="main-content">
        @yield('content')
    </main>

</div>
</body>
</html>