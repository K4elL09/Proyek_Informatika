<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Keranjangku</title>
  <style>
    body { background-color: #000; font-family: 'Poppins', sans-serif; color: #fff; margin: 0; padding: 0; }
    .container { max-width: 900px; margin: 40px auto; background-color: #111; border-radius: 12px; padding: 20px 40px; box-shadow: 0 0 15px rgba(0,0,0,0.5);}
    .header { background-color: #3C3B3B; padding: 15px 25px; border-radius: 8px; display: flex; justify-content: space-between; align-items: center; font-weight: 600; font-size: 18px; margin-bottom: 25px;}
    .produk { display: flex; align-items: center; background-color: #1a1a1a; border-radius: 10px; padding: 10px; margin-bottom: 15px;}
    .produk img { width: 120px; height: 90px; object-fit: cover; border-radius: 8px; margin-right: 20px;}
    .info { flex: 1;}
    .info h4 { font-size: 15px; margin: 0 0 8px 0;}
    .info .harga { color: #00ff77; font-size: 13px; font-weight: 600; margin-bottom: 10px;}
    
    .quantity-wrapper {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-top: 5px;
      margin-bottom: 5px;
    }
    .quantity-wrapper form {
      margin: 0;
    }
    .quantity-wrapper button {
      background: #000;
      color: #fff;
      border: 1px solid #fff;
      width: 28px;
      height: 28px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      line-height: 1;
      transition: all 0.2s;
    }
    .quantity-wrapper button:hover {
      background: #00ff77;
      color: #000;
    }
    .quantity-wrapper span {
      font-size: 14px;
      font-weight: bold;
      min-width: 25px;
      text-align: center;
    }

    .hapus-btn { background: none; border: none; color: #ff5555; font-weight: bold; cursor: pointer; margin-top: 5px; font-size: 13px; }
    .total-bar { background-color: #3C3B3B; border-radius: 8px; padding: 15px 25px; display: flex; justify-content: space-between; align-items: center; margin-top: 30px; font-size: 16px; font-weight: 600;}
    .total-bar .total { color: #00FF77;}
    .checkout-btn { background-color: #00AA6C; border: none; color: #fff; padding: 10px 25px; border-radius: 8px; cursor: pointer; font-weight: 600;}
    .checkout-btn:hover { background-color: #00cc88;}

    .notification-popup {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%) translateY(-50px);
        
        background-color: #00AA6C;
        color: white;
        padding: 15px 25px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
        z-index: 1000;
        opacity: 0; 
        transition: opacity 0.4s ease-out, transform 0.4s ease-out;
        font-weight: 600;
    }
    .notification-popup.show {
        opacity: 1;
        transform: translateX(-50%) translateY(0); 
    }

  </style>
</head>
<body>
    
    <div id="notificationPopup" class="notification-popup">
    </div>

  <div class="container">
    <div class="header">
      <span>Keranjangku</span>
      <a href="{{ route('home') }}" style="color:#00FF77; text-decoration:none;">← Kembali</a>
    </div>

    {{-- ⚠️ INI ADALAH PERUBAHAN UTAMA: Notifikasi statis dihapus dan diganti dengan elemen tersembunyi untuk dibaca JS --}}
    @if(session('success'))
      <p id="sessionSuccessMessage" style="display: none;">{{ session('success') }}</p>
    @endif

    @php $total = 0; @endphp

    @forelse($cart as $id => $item)
      @php $total += $item['harga'] * $item['quantity']; @endphp
      <div class="produk">
        <img src="{{ asset('images/' . $item['gambar']) }}" alt="{{ $item['nama'] }}">
        <div class="info">
          <h4>{{ $item['nama'] }}</h4>
          <div class="harga">Rp{{ number_format($item['harga'], 0, ',', '.') }} / {{ $item['durasi'] }}</div>

          {{-- Tombol Quantity sejajar --}}
          <div class="quantity-wrapper">
            {{-- Tombol minus --}}
            <form action="{{ route('keranjang.update', $id) }}" method="POST">
              @csrf
              <input type="hidden" name="quantity" value="{{ $item['quantity'] - 1 }}">
              <button type="submit">-</button>
            </form>

            <span>{{ $item['quantity'] }}</span>

            {{-- Tombol plus --}}
            <form action="{{ route('keranjang.update', $id) }}" method="POST">
              @csrf
              <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
              <button type="submit">+</button>
            </form>
          </div>

          {{-- Tombol hapus --}}
          <form action="{{ route('keranjang.hapus', $id) }}" method="POST">
            @csrf
            <button type="submit" class="hapus-btn">Hapus</button>
          </form>
        </div>
      </div>
    @empty
      <p>Keranjang masih kosong.</p>
    @endforelse

    <div class="total-bar">
  <span>Total <span class="total">Rp{{ number_format($total, 0, ',', '.') }}</span></span>
  <form action="{{ route('checkout') }}" method="GET">
    <button type="submit" class="checkout-btn">
      Checkout ({{ count($cart) }})
    </button>
  </form>
</div>
</div>

{{-- 🔑 SCRIPT JAVASCRIPT UNTUK MENAMPILKAN POPUP --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const popup = document.getElementById('notificationPopup');
        const successMessageElement = document.getElementById('sessionSuccessMessage');

        if (successMessageElement) {
            const message = successMessageElement.textContent.trim();
            if (message) {
                popup.textContent = message;
                
                popup.classList.add('show');

                setTimeout(() => {
                    popup.classList.remove('show');
                }, 3000);
            }
        }
    });
</script>
</body>
</html>
