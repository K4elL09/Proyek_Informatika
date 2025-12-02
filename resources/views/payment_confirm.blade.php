<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Konfirmasi Pembayaran</title>
  <style>
    body {
      background-color: #000;
      color: #fff;
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 40px 0;
    }

    .container {
      max-width: 600px; 
      margin: 0 auto;
      background-color: #111;
      border-radius: 16px;
      padding: 30px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.6);
    }

    .header {
      text-align: center;
      margin-bottom: 30px;
      border-bottom: 1px solid #222;
      padding-bottom: 20px;
    }
    .header h2 {
      font-size: 24px;
      color: #00FF77;
      margin: 0;
    }
    .header p {
      font-size: 14px;
      color: #ccc;
      margin-top: 5px;
    }

    .payment-details {
      background-color: #3C3B3B;
      border-radius: 10px;
      padding: 20px;
      margin-bottom: 25px;
      text-align: center;
    }
    .payment-details h3 {
        margin-top: 0;
        color: #00FF77;
        font-size: 20px;
    }

    .payment-box-content {
        background-color: #1a1a1a;
        padding: 20px;
        border-radius: 8px;
        margin-top: 15px;
    }

    .qris-code img {
      width: 80%;
      max-width: 250px;
      height: auto;
      border-radius: 8px;
      margin-bottom: 15px;
    }

    .tf-bri img {
      width: 80%;
      max-width: 250px;
      height: auto;
      border-radius: 8px;
      margin-bottom: 15px;
    }

    .total-info {
      font-size: 14px;
      line-height: 1.8;
      margin-bottom: 15px;
    }
    .total-info strong {
        display: block;
        font-size: 22px;
        color: #F5893A;
        margin-top: 5px;
    }

    .upload-section {
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px dashed #555;
        text-align: left;
    }
    .upload-section label {
        display: block;
        font-weight: 600;
        margin-bottom: 10px;
        color: #ccc;
    }

    input[type="file"] {
        width: 100%;
        padding: 10px;
        background-color: #1a1a1a;
        border: 1px solid #555;
        border-radius: 8px;
        color: white;
        margin-bottom: 15px;
        box-sizing: border-box;
    }

    input[type="file"]::file-selector-button {
        background-color: #00AA6C;
        color: white;
        border: none;
        padding: 8px 12px;
        margin-right: 15px;
        border-radius: 6px;
        cursor: pointer;
        transition: background 0.2s;
    }
    input[type="file"]::file-selector-button:hover {
        background-color: #00CC88;
    }

    .btn-submit {
        width: 100%;
        background-color: #00AA6C;
        border: none;
        color: #fff;
        font-weight: 700;
        font-size: 16px; 
        padding: 15px 0;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.3s;
    }
    .btn-submit:hover {
        background-color: #00CC88;
    }
    .error-message {
        color: #ff5555;
        font-size: 13px;
        margin-bottom: 10px;
    }
    
    @media (max-width: 600px) {
        .container {
            margin: 20px 10px;
            padding: 20px;
        }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <h2>Selesaikan Pembayaran</h2>
      <p>ID Transaksi: #{{ $transaksi->id ?? 'XXX' }}</p>
    </div>

    @if(session('error'))
        <div class="error-message" style="text-align: center;">{{ session('error') }}</div>
    @endif

    @php
        $metode = $transaksi->metode ?? 'Transfer Bank';
    @endphp

    <div class="payment-details">
        <h3>Pembayaran dengan {{ strtoupper($metode) }}</h3>

        <div class="payment-box-content">

            {{-- TAMPILAN QRIS --}}
            @if ($metode === 'QRIS')
                <div class="qris-code">
                    <img src="{{ asset('images/barcode.png') }}" alt="QRIS Code Placeholder">
                </div>
                <p style="font-size: 14px; margin: 5px 0; color: #aaa;">Scan kode QRIS di atas untuk menyelesaikan pembayaran.</p>
                <p style="font-size: 13px; font-weight: 600;">Merchant: PDMP OUTDOOR</p>
            @endif

            {{-- TAMPILAN TRANSFER BANK --}}
            @if ($metode === 'Transfer Bank')
                <div class="tf-bri">
                    <img src="{{ asset('images/bri.png') }}" alt="Logo BRI">
                </div>
                <p style="font-size: 14px; margin: 5px 0; color: #aaa;">Silakan transfer ke rekening berikut:</p>
                <div style="font-size: 20px; font-weight: 700; color: white; margin: 10px 0;">
                    3356 0102 5382 534 (Bank BRI)
                </div>
                <p style="font-size: 13px; font-weight: 600; color: #ccc;">A.N. PDMP OUTDOOR</p>
            @endif

            <div class="total-info">
                Total yang Harus Dibayar:
                <strong>Rp{{ number_format($transaksi->total ?? 0, 0, ',', '.') }}</strong>
                <span style="font-size: 12px; color: #F5893A; font-weight: 400;">(Termasuk Biaya Layanan Rp7.000)</span>
            </div>
        </div>
    </div>


    <form action="{{ route('pembayaran.konfirmasi', $transaksi->id ?? 0) }}" method="POST" enctype="multipart/form-data" class="upload-section">
        @csrf
        
        @if ($errors->any())
            <div class="error-message">
                Mohon koreksi kesalahan berikut sebelum mengirim:
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <label for="bukti_pembayaran">Unggah Bukti Pembayaran (Wajib):</label>
        <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" accept="image/jpeg,image/png" required>
        
        <button type="submit" class="btn-submit">
            Kirim Bukti Pembayaran
        </button>
    </form>
  </div>
</body>
</html>