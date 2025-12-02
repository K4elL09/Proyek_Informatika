<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rincian Pesanan #{{ $transaksi->id }}</title>
  <style>
    body {
      background-color: #000;
      color: #fff;
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 40px 0;
    }

    .container {
      width: 95%;
      max-width: 900px;
      margin: 0 auto;
      background: #111;
      border-radius: 16px;
      padding: 30px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.6);
    }
    .logo-header {
      display: flex;
      align-items: center;
      justify-content: flex-start;
      margin-bottom: 25px;
      border-bottom: 1px solid #222;
      padding-bottom: 15px;
    }
    .logo-header img {
      height: 40px;
      margin-right: 15px;
    }
    .logo-text strong {
        font-size: 18px;
        color: #00FF77;
    }
    .logo-text span {
        font-size: 12px;
        color: #aaa;
        display: block;
    }

    /* SECTION TITLES */
    .section-title {
      color: #ccc;
      font-size: 15px;
      font-weight: 600;
      margin: 25px 0 10px;
      padding-left: 10px;
      border-left: 3px solid #00AA6C;
    }

    /* PRODUK LIST */
    .produk {
      display: flex;
      align-items: center;
      background-color: #2a2a2a;
      border-radius: 10px;
      padding: 12px;
      margin-bottom: 10px;
    }
    .produk img {
      width: 80px; 
      height: 60px; 
      border-radius: 6px;
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
      margin: 5px 0 0;
      color: #00FF77;
      font-weight: 600;
    }
    .produk-info span {
        font-size: 12px;
        color: #aaa;
    }
    
    /* DETAIL BOXES */
    .detail-box {
      background: #1e1e1e;
      border-radius: 10px;
      padding: 15px 20px;
      margin-bottom: 15px;
      font-size: 14px;
      line-height: 1.8;
    }
    .detail-box strong {
        color: #ccc;
        font-weight: 600;
    }
    .detail-box span.value {
        float: right;
        font-weight: 500;
    }

    /* TOTAL BOX (Footer) */
    .total-box {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-weight: 700;
      background: #333;
      border-radius: 10px;
      padding: 15px 20px;
      margin-top: 25px;
      font-size: 18px;
      color: #00FF77;
    }

    /* BUTTONS */
    .button-row {
      display: flex;
      justify-content: space-between;
      margin-top: 25px;
      gap: 15px;
    }
    .btn {
      flex: 1;
      background-color: #00AA6C;
      color: #fff;
      border: none;
      padding: 12px 0;
      border-radius: 8px;
      font-size: 15px;
      cursor: pointer;
      text-align: center;
      text-decoration: none;
      font-weight: 600;
      transition: background 0.2s ease;
    }
    .btn:hover {
      background-color: #00CC88;
    }
    .btn.secondary {
        background-color: #3C3B3B;
        border: 1px solid #666;
        color: #ccc;
    }
    .btn.secondary:hover {
        background-color: #555;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="logo-header">
      <img src="{{ asset('images/pdmp2.png') }}" alt="PDMP Logo">
      <div class="logo-text">
        <strong>PDMP OUTDOOR</strong>
        <span>Rincian Pesanan #{{ $transaksi->id }}</span>
      </div>
    </div>
    
    {{-- PHP untuk menghitung Durasi Sewa --}}
    @php
        // Menggunakan startOfDay agar perhitungan hari akurat
        $tanggalSewa = \Carbon\Carbon::parse($transaksi->tanggal_sewa)->startOfDay();
        $tanggalKembali = \Carbon\Carbon::parse($transaksi->tanggal_kembali)->startOfDay();
        $rentalDays = $tanggalSewa->diffInDays($tanggalKembali);
        if ($rentalDays < 1) $rentalDays = 1; // Minimal 1 hari

        $biayaLayanan = 7000;
        $subtotalBarang = $transaksi->total - $biayaLayanan;
    @endphp

    {{-- Detail Pelanggan --}}
    <div class="section-title">Detail Pelanggan</div>
    <div class="detail-box">
        Nama Pemesan: <strong>{{ strtoupper($transaksi->nama) }}</strong><br>
        Nomor Kontak: <span>{{ auth()->user()->no_telp ?? 'Tidak Tersedia' }}</span><br>
        Alamat: <span>{{ $transaksi->alamat }}</span>
    </div>

    {{-- Detail Pengambilan & Pengembalian --}}
    <div class="section-title">Durasi & Pengembalian</div>
    <div class="detail-box">
        Pengiriman/Pengambilan: <strong>Ambil di Tempat</strong> <br>
        Tanggal Sewa: <span>{{ $tanggalSewa->format('d M Y') }}</span><br>
        Durasi Sewa: <strong style="color: #00FF77;">{{ $rentalDays }} Hari</strong><br>
        Tanggal Pengembalian: <span style="color: #F5893A;">{{ $tanggalKembali->format('d M Y') }}</span>
    </div>
    
    {{-- Barang Dipesan --}}
    <div class="section-title">Barang Dipesan</div>
    @foreach($transaksi->penyewaan as $item)
      <div class="produk">
        <img src="{{ asset('images/' . $item->product->gambar_produk) }}" alt="{{ $item->product->nama_produk }}">
        <div class="produk-info">
          <h4>{{ $item->product->nama_produk }}</h4>
          
          {{-- Hitung Harga Item --}}
          @php
              $hargaSatuanPerHari = $item->product->harga;
              $totalHargaItemPerHari = $hargaSatuanPerHari * $item->quantity;
          @endphp
          
          <span>Harga (@php echo number_format($hargaSatuanPerHari, 0, ',', '.'); @endphp × {{ $item->quantity }}): Rp{{ number_format($totalHargaItemPerHari, 0, ',', '.') }} / Hari</span>

          <p>Total Item ({{ $rentalDays }} Hari): Rp{{ number_format($item->harga, 0, ',', '.') }}</p>
        </div>
      </div>
    @endforeach

    {{-- Detail Pembayaran --}}
    <div class="section-title">Rincian & Total Pembayaran</div>
    <div class="detail-box">
        Metode Pembayaran: <span class="value">{{ $transaksi->metode }}</span><br>
        Subtotal Barang ({{ $rentalDays }} Hari): <span class="value">Rp{{ number_format($subtotalBarang, 0, ',', '.') }}</span><br>
        Biaya Layanan: <span class="value">Rp7.000</span><br>
    </div>

    <div class="total-box">
      <span>Total Pembayaran Akhir</span>
      <span>Rp{{ number_format($transaksi->total, 0, ',', '.') }}</span>
    </div>

    <div class="button-row">
      <a href="{{ route('home') }}" class="btn secondary">Sewa Lagi</a>
      <a href="#" class="btn">Beri Ulasan</a>
    </div>
  </div>
</body>
</html>
