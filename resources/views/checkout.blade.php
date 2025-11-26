<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout</title>
  <style>
    body {
      background-color: #000;
      color: #fff;
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 900px;
      margin: 40px auto;
      background-color: #111;
      border-radius: 12px;
      padding: 30px 50px;
      box-shadow: 0 0 15px rgba(0,0,0,0.5);
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #3C3B3B;
      padding: 15px 25px;
      border-radius: 8px;
      font-weight: 600;
      margin-bottom: 30px;
    }

    .produk {
      display: flex;
      align-items: center;
      background-color: #1a1a1a;
      border-radius: 10px;
      padding: 10px;
      margin-bottom: 15px;
    }

    .produk img {
      width: 100px;
      height: 80px;
      border-radius: 8px;
      margin-right: 15px;
      object-fit: cover;
    }

    .produk-info h4 {
      margin: 0;
      font-size: 15px;
      font-weight: 500;
    }

    .produk-info .harga {
      font-size: 13px;
      color: #00ff77;
      margin-top: 5px;
    }

    .produk-info .qty {
      margin-top: 5px;
      font-size: 13px;
      color: #ccc;
    }

    .section-title {
      color: #05FF00;
      font-weight: 700;
      font-size: 14px;
      margin-top: 30px;
      margin-bottom: 10px;
    }

    .section-sub {
      color: #fff;
      font-weight: 400;
      font-size: 12px;
      margin-bottom: 10px;
    }

    .box {
      background-color: #3C3B3B;
      border-radius: 8px;
      padding: 15px 25px;
      margin-bottom: 15px;
    }

    .alamat {
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }

    .alamat-info {
      font-size: 13px;
      line-height: 1.5;
    }

    .ubah-btn {
      color: #0F8E5F;
      font-size: 13px;
      cursor: pointer;
    }

    textarea {
      width: 100%;
      background-color: #1a1a1a;
      border: none;
      border-radius: 6px;
      color: #fff;
      font-size: 13px;
      padding: 10px;
      resize: none;
    }

    .rincian {
      font-size: 13px;
      line-height: 1.8;
    }

    .rincian-row {
      display: flex;
      justify-content: space-between;
    }

    .total {
      color: #F5893A;
      font-weight: bold;
      margin-top: 10px;
    }

    .pembayaran {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background-color: #3C3B3B;
      border-radius: 8px;
      padding: 15px 25px;
      font-size: 13px;
    }

    .pengiriman {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .pengiriman div {
      background-color: #3C3B3B;
      border-radius: 8px;
      padding: 10px 15px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 13px;
      cursor: pointer;
    }

    .pengiriman div.active {
      border: 1px solid #00AA6C;
      background-color: #1f1f1f;
    }

    .footer-checkout {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #3C3B3B;
      border-radius: 8px;
      padding: 15px 25px;
      margin-top: 30px;
    }

    .footer-checkout .total-harga {
      text-align: left;
    }

    .footer-checkout .total-harga p {
      margin: 0;
      font-size: 13px;
    }

    .footer-checkout .total-harga .nominal {
      color: #05FF00;
      font-size: 18px;
      font-weight: 700;
    }

    .buat-btn {
      background-color: #00AA6C;
      border: none;
      color: #fff;
      font-weight: 700;
      font-size: 13px;
      padding: 12px 35px;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .buat-btn:hover {
      background-color: #00CC88;
    }
  </style>
</head>
<body>

  <div class="container">
    {{-- Header --}}
    <div class="header">
      <span>Checkout</span>
      <a href="{{ route('keranjang.index') }}" style="color:#00FF77; text-decoration:none;">← Kembali</a>
    </div>

    <form action="{{ route('checkout.process') }}" method="POST">
      @csrf

      {{-- Data Alamat --}}
      <div class="box alamat">
        <div class="alamat-info">
          <strong>{{ auth()->user()->name ?? 'Penyewa Guest' }}</strong><br>
          <textarea name="alamat" rows="2" placeholder="Masukkan alamat lengkap kamu..." required></textarea>
        </div>
      </div>

      {{-- Barang Dipesan --}}
      <div class="section-title">Barang Dipesan</div>
      <div class="section-sub">PDMP OUTDOOR</div>

      @php $total = 0; @endphp
      @foreach($cart as $id => $item)
        @php $total += $item['harga'] * $item['quantity']; @endphp
        <div class="produk">
          <img src="{{ asset('images/' . $item['gambar']) }}" alt="{{ $item['nama'] }}">
          <div class="produk-info">
            <h4>{{ $item['nama'] }}</h4>
            <div class="harga">Rp{{ number_format($item['harga'],0,',','.') }}</div>
            <div class="qty">x{{ $item['quantity'] }}</div>
          </div>
        </div>
      @endforeach

      {{-- Pesan --}}
      <div class="box">
        <p style="font-size:13px;">Pesan:</p>
        <textarea name="pesan" rows="2" placeholder="Silakan tinggalkan pesan..."></textarea>
        <p style="margin-top:10px; font-size:13px;">
          Total Pesanan ({{ count($cart) }} barang): Rp{{ number_format($total, 0, ',', '.') }}
        </p>
      </div>

      {{-- Metode Pembayaran --}}
      <div class="pembayaran">
        <span>Metode Pembayaran:</span>
        <span>Transfer Bank - Bank Jateng</span>
        <input type="hidden" name="metode" value="Transfer Bank - Bank Jateng">
      </div>

      {{-- Metode Pengiriman --}}
      <div class="pengiriman" style="margin-top:15px;">
        <div id="pickup" class="active" onclick="selectPengiriman('Ambil di Tempat')">
          <span>Ambil di Tempat</span>
        </div>
        <div id="delivery" onclick="selectPengiriman('Diantar ke Rumah')">
          <span>Diantar ke Rumah</span>
        </div>
      </div>
      <input type="hidden" name="pengiriman" id="pengiriman" value="Ambil di Tempat">

      {{-- Rincian Pembayaran --}}
      <div class="box">
        <p style="font-size:13px;">Rincian Pembayaran</p>
        <div class="rincian">
          <div class="rincian-row">
            <span>Subtotal Barang</span><span>Rp{{ number_format($total, 0, ',', '.') }}</span>
          </div>
          <div class="rincian-row">
            <span>Subtotal Pengiriman</span><span>-</span>
          </div>
          <div class="rincian-row">
            <span>Biaya Layanan</span><span>Rp7.000</span>
          </div>
          <div class="rincian-row total">
            <span>Total Pembayaran</span><span>Rp{{ number_format($total + 7000, 0, ',', '.') }}</span>
          </div>
        </div>
      </div>

      {{-- Footer --}}
      <div class="footer-checkout">
        <div class="total-harga">
          <p>Total Pembayaran</p>
          <p class="nominal">Rp{{ number_format($total + 7000, 0, ',', '.') }}</p>
        </div>
        <button type="submit" class="buat-btn">Buat Pesanan</button>
      </div>
    </form>
  </div>

  <script>
    function selectPengiriman(method) {
      document.getElementById('pickup').classList.remove('active');
      document.getElementById('delivery').classList.remove('active');
      if (method === 'Ambil di Tempat') {
        document.getElementById('pickup').classList.add('active');
      } else {
        document.getElementById('delivery').classList.add('active');
      }
      document.getElementById('pengiriman').value = method;
    }
  </script>

</body>
</html>