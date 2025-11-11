<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - PDMP Outdoor</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body>
<div class="dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <h2>PDMP</h2>
            <p>Admin</p>
        </div>
        <ul class="sidebar-menu">
            <li><a href="#"><i class="fa-solid fa-boxes-stacked"></i> Stok Alat</a></li>
            <li><a href="#"><i class="fa-solid fa-file-invoice-dollar"></i> Laporan Keuangan</a></li>
            <li><a href="#"><i class="fa-solid fa-clipboard-list"></i> Informasi Pemesanan</a></li>
            <li><a href="#"><i class="fa-solid fa-rotate-left"></i> Pengembalian</a></li>
            <li><a href="#"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
        </ul>
    </aside>

    <!-- Main content -->
    <main class="main-content">
        @yield('content')
    </main>
</div>
</body>
</html>
