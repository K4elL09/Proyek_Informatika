<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Rincian Pesanan</title>
  <style>
    body {
      background-color: #000;
      color: #fff;
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 40px 0;
    }
    .container {
      width: 80%;
      max-width: 950px;
      margin: 0 auto;
      background: #111;
      border-radius: 16px;
      padding: 40px 50px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.6);
    }
    .logo {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 25px;
    }
    .logo img {
      height: 60px;
      margin-right: 10px;
    }
    h1 {
      font-size: 22px;
      text-align: center;
      margin-bottom: 30px;
    }
    .info {
      background: #1e1e1e;
      border-radius: 10px;
      padding: 20px;
      margin-bottom: 20px;
      line-height: 1.6;
    }
    .info strong {
      color: #00FF77;
    }
    .section-title {
      color: #00FF77;
      font-size: 16px;
      font-weight: 600;
      margin: 20px 0 10px;
    }
    .produk {
      display: flex;
      align-items: center;
      background-color: #2a2a2a;
      border-radius: 10px;
      padding: 12px;
      margin-bottom: 10px;
    }
    .produk img {
      width: 100px;
      height: 80px;
      border-radius: 8px;
      margin-right: 15px;
      object-fit: cover;
    }
    .produk-info {
      flex: 1;
    }
    .produk-info h4 {
      margin: 0;
      font-size: 15px;
      color: #fff;
    }
    .produk-info p {
      font-size: 13px;
      margin: 5px 0;
      color: #ccc;
    }
    .total-box, .pembayaran-box, .waktu-box {
      background: #1e1e1e;
      border-radius: 10px;
      padding: 15px 20px;
      margin-top: 15px;
      font-size: 14px;
    }
    .total-box {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-weight: 600;
      background: #333;
    }
    .button-row {
      display: flex;
      justify-content: space-between;
      margin-top: 25px;
    }
    .btn {
      width: 48%;
      background-color: #00b061;
      color: #fff;
      border: none;
      padding: 12px 0;
      border-radius: 8px;
      font-size: 15px;
      cursor: pointer;
      text-align: center;
      text-decoration: none;
      transition: background 0.2s ease;
    }
    .btn:hover {
      background-color: #00d072;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="logo">
      <img src="{{ asset('images/logo.png') }}" alt="PDMP Logo">
      <div>
        <strong>PDMP OUTDOOR</strong><br>
        <span style="font-size: 12px; color: #aaa;">Rincian Pesanan</span>
      </div>
    </div>

    <h1>{{ strtoupper($transaksi->nama) }} ({{ auth()->user()->no_telp ?? 'Nomor Tidak Diketahui' }})</h1>

    <div class="section-title">Barang Dipesan</div>
    @foreach($transaksi->penyewaan as $item)
      <div class="produk">
        <img src="{{ asset('images/' . $item->product->gambar_produk) }}" alt="{{ $item->product->nama_produk }}">
        <div class="produk-info">
          <h4>{{ $item->product->nama_produk }}</h4>
          <p>Rp{{ number_format($item->harga, 0, ',', '.') }},00 &nbsp;&nbsp; ×{{ $item->quantity }}</p>
        </div>
      </div>
    @endforeach

    <div class="total-box">
      <span>Total Pesanan</span>
      <span>Rp{{ number_format($transaksi->total, 0, ',', '.') }}</span>
    </div>

    <div class="pembayaran-box">
      <strong>Metode Pembayaran:</strong><br>
      {{ $transaksi->metode }}
    </div>

    <div class="pembayaran-box">
      <strong>Ambil di Tempat:</strong> diambil<br>
      <strong>Tanggal Pengembalian:</strong> {{ \Carbon\Carbon::parse($transaksi->tanggal_kembali)->format('d M Y') }}
    </div>

    <div class="waktu-box">
      <strong>No. Pesanan:</strong> {{ strtoupper(uniqid(date('ymd'))) }} <span style="color:#00FF77;">SALIN</span><br>
      <strong>Waktu Pemesanan:</strong> {{ \Carbon\Carbon::parse($transaksi->created_at)->format('d-m-Y H:i') }}<br>
      <strong>Waktu Pembayaran:</strong> {{ \Carbon\Carbon::parse($transaksi->created_at)->addMinutes(2)->format('d-m-Y H:i') }}<br>
      <strong>Waktu Pengiriman:</strong> -<br>
      <strong>Waktu Pesanan Selesai:</strong> {{ \Carbon\Carbon::parse($transaksi->created_at)->addMinutes(5)->format('d-m-Y H:i') }}
    </div>

    <div class="button-row">
      <a href="{{ route('home') }}" class="btn">Sewa Lagi</a>
      <a href="#" class="btn">Beri Ulasan</a>
    </div>
  </div>
</body>
</html>
