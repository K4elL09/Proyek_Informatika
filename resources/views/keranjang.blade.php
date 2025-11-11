<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Keranjangku</title>
  <style>
    body {
      background-color: #000;
      font-family: 'Poppins', sans-serif;
      color: #fff;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 900px;
      margin: 40px auto;
      background-color: #111;
      border-radius: 12px;
      padding: 20px 40px;
      box-shadow: 0 0 15px rgba(0,0,0,0.5);
    }

    .header {
      background-color: #3C3B3B;
      padding: 15px 25px;
      border-radius: 8px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-weight: 600;
      font-size: 18px;
      margin-bottom: 25px;
    }

    .kategori {
      border-top: 1px solid #555;
      padding-top: 15px;
      margin-top: 20px;
    }

    .kategori h3 {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 18px;
      margin-bottom: 10px;
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
      width: 120px;
      height: 90px;
      object-fit: cover;
      border-radius: 8px;
      margin-right: 20px;
    }

    .info {
      flex: 1;
    }

    .info h4 {
      font-size: 15px;
      margin: 0 0 8px 0;
    }

    .info .harga {
      color: #00ff77;
      font-size: 13px;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .quantity {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .quantity button {
      background: #000;
      color: #fff;
      border: 1px solid #fff;
      width: 28px;
      height: 28px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    .quantity span {
      font-size: 14px;
      font-weight: bold;
    }

    .total-bar {
      background-color: #3C3B3B;
      border-radius: 8px;
      padding: 15px 25px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 30px;
      font-size: 16px;
      font-weight: 600;
    }

    .total-bar .total {
      color: #00FF77;
    }

    .checkout-btn {
      background-color: #00AA6C;
      border: none;
      color: #fff;
      padding: 10px 25px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
    }

    .checkout-btn:hover {
      background-color: #00cc88;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">
      <span>Keranjangku</span>
    </div>

    <div class="kategori">
      <h3>
        <span>Tenda</span>
        <span>Ubah</span>
      </h3>

      <div class="produk">
        <img src="{{ asset('images/tenda_borneo4.png') }}" alt="Tenda">
        <div class="info">
          <h4>Tenda Borneo 4</h4>
          <div class="harga">Rp65.000,00 / 24 Jam</div>
          <div class="quantity">
            <button>-</button>
            <span>0</span>
            <button>+</button>
          </div>
        </div>
      </div>

      <div class="produk">
        <img src="{{ asset('images/tenda_nsm4.jpg') }}" alt="Tenda">
        <div class="info">
          <h4>Tenda Nsm 4</h4>
          <div class="harga">Rp70.000,00 / 24 Jam</div>
          <div class="quantity">
            <button>-</button>
            <span>0</span>
            <button>+</button>
          </div>
        </div>
      </div>

    <div class="kategori">
      <h3>
        <span>Alat Masak</span>
        <span>Ubah</span>
      </h3>

      <div class="produk">
        <img src="{{ asset('images/cookingset.png') }}" alt="Cooking Set">
        <div class="info">
          <h4>Cooking Set</h4>
          <div class="harga">Rp20.000,00 / 24 Jam</div>
          <div class="quantity">
            <button>-</button>
            <span>0</span>
            <button>+</button>
          </div>
        </div>
      </div>

      <div class="kategori">
      <h3>
        <span>Senter</span>
        <span>Ubah</span>
      </h3>

      <div class="produk">
        <img src="{{ asset('images/senter 1.jpg') }}" alt="Senter">
        <div class="info">
          <h4>Senter</h4>
          <div class="harga">Rp15.000,00 / 24 Jam</div>
          <div class="quantity">
            <button>-</button>
            <span>1</span>
            <button>+</button>
          </div>
        </div>
      </div>
    </div>

    <div class="total-bar">
      <span>Total <span class="total">Rp80.000,00</span></span>
      <button class="checkout-btn">Checkout (3)</button>
    </div>
  </div>
</body>
</html>