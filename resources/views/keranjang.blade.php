<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Keranjang</title>

  <style>
    body { background-color: #000; font-family: 'Poppins', sans-serif; color: #fff; margin: 0; padding: 0; }
    .container { max-width: 900px; margin: 40px auto; background-color: #111; border-radius: 12px; padding: 20px 40px; box-shadow: 0 0 15px rgba(0,0,0,0.5);}
    .header { background-color: #3C3B3B; padding: 15px 25px; border-radius: 8px; display: flex; justify-content: space-between; align-items: center; font-weight: 600; font-size: 18px; margin-bottom: 25px;}
    .produk { display: flex; align-items: center; background-color: #1a1a1a; border-radius: 10px; padding: 10px; margin-bottom: 15px;}
    .produk img { width: 120px; height: 90px; object-fit: cover; border-radius: 8px; margin-right: 20px;}
    .info { flex: 1;}
    .info h4 { font-size: 15px; margin: 0 0 8px 0;}
    .info .harga { color: #00ff77; font-size: 13px; font-weight: 600; margin-bottom: 10px;}

    .quantity-wrapper { display: flex; align-items: center; gap: 8px; }
    .quantity-wrapper button {
      background: #000; color: #fff; border: 1px solid #fff;
      width: 28px; height: 28px; border-radius: 5px; cursor: pointer;
    }

    .hapus-btn { background: none; border: none; color: #ff5555; font-weight: bold; cursor: pointer; }

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

    .total { color: #00FF77; }

    .checkout-btn {
      background-color: #00AA6C;
      border: none;
      color: #fff;
      padding: 10px 25px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 600;
    }

    .checkout-btn:disabled {
      background-color: #555;
      cursor: not-allowed;
      opacity: 0.7;
    }

    .notification-popup {
      position: fixed;
      top: 20px;
      left: 50%;
      transform: translateX(-50%) translateY(-50px);
      background-color: #00AA6C;
      color: #fff;
      padding: 15px 25px;
      border-radius: 8px;
      opacity: 0;
      transition: 0.3s;
      font-weight: 600;
      z-index: 999;
    }

    .notification-popup.show {
      opacity: 1;
      transform: translateX(-50%) translateY(0);
    }
  </style>
</head>
<body>

<div id="notificationPopup" class="notification-popup"></div>

<div class="container">
  <div class="header">
    <span>Keranjangku</span>
    <a href="{{ route('home') }}" style="color:#00FF77;text-decoration:none;">← Kembali</a>
  </div>

  {{-- SESSION MESSAGE --}}
  @if(session('success'))
    <p id="successMsg" hidden>{{ session('success') }}</p>
  @endif

  @if(session('error'))
    <p id="errorMsg" hidden>{{ session('error') }}</p>
  @endif

  @php $total = 0; @endphp

  @forelse($cart as $id => $item)
    @php $total += $item['harga'] * $item['quantity']; @endphp

    <div class="produk">
      <img src="{{ asset('images/'.$item['gambar']) }}">
      <div class="info">
        <h4>{{ $item['nama'] }}</h4>
        <div class="harga">Rp{{ number_format($item['harga']) }}</div>

        <div class="quantity-wrapper">
          <form method="POST" action="{{ route('keranjang.update',$id) }}">
            @csrf
            <input type="hidden" name="quantity" value="{{ $item['quantity'] - 1 }}">
            <button>-</button>
          </form>

          <span>{{ $item['quantity'] }}</span>

          <form method="POST" action="{{ route('keranjang.update',$id) }}">
            @csrf
            <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
            <button>+</button>
          </form>
        </div>

        <form method="POST" action="{{ route('keranjang.hapus',$id) }}">
          @csrf
          <button class="hapus-btn">Hapus</button>
        </form>
      </div>
    </div>
  @empty
    <p>Keranjang masih kosong.</p>
  @endforelse

  {{-- CHECKOUT --}}
  <div class="total-bar">
    <span>Total <span class="total">Rp{{ number_format($total) }}</span></span>

    <form action="{{ route('checkout') }}" method="GET">
      <button class="checkout-btn" {{ count($cart) === 0 ? 'disabled' : '' }}>
        Checkout ({{ count($cart) }})
      </button>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const popup = document.getElementById('notificationPopup');
  const success = document.getElementById('successMsg');
  const error = document.getElementById('errorMsg');

  let msg = '';
  let isError = false;

  if (success) msg = success.innerText;
  if (error) { msg = error.innerText; isError = true; }

  if (msg) {
    popup.innerText = msg;
    popup.style.backgroundColor = isError ? '#ff4444' : '#00AA6C';
    popup.classList.add('show');

    setTimeout(() => popup.classList.remove('show'), 3000);
  }
});
</script>

</body>
</html>
