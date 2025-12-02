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

    /* HEADER */
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
    .header a {
        color: #00FF77;
        text-decoration: none;
    }

    /* PRODUK ITEM */
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
      font-size: 16px; 
      margin-top: 30px;
      margin-bottom: 10px;
      border-left: 4px solid #00AA6C;
      padding-left: 10px;
    }

    .section-sub {
      color: #fff;
      font-weight: 400;
      font-size: 13px;
      margin-bottom: 15px;
    }

    .box {
      background-color: #3C3B3B;
      border-radius: 8px;
      padding: 15px 25px;
      margin-bottom: 15px;
    }

    .alamat {
      display: block;
    }

    .alamat-info {
      font-size: 14px; 
      line-height: 1.6;
      margin-bottom: 10px;
    }

    .ubah-btn {
      color: #00AA6C; 
      font-size: 13px;
      cursor: pointer;
      display: none; 
    }

    textarea, input[type="date"] {
      width: 100%;
      background-color: #1a1a1a;
      border: 1px solid #555;
      border-radius: 6px;
      color: #fff;
      font-size: 14px;
      padding: 12px;
      resize: none;
      transition: border-color 0.2s;
      box-sizing: border-box;
    }
    textarea:focus, input[type="date"]:focus {
        border-color: #00AA6C;
        outline: none;
    }

    /* Styling khusus untuk input date */
    input[type="date"] {
        -webkit-appearance: none;
        appearance: none;
        background-color: #1a1a1a;
        color: white;
    }
    input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(1);
        cursor: pointer;
    }

    .rincian {
      font-size: 14px;
      line-height: 2.0;
      margin-top: 10px;
    }

    .rincian-row {
      display: flex;
      justify-content: space-between;
    }
    .rincian-row span:first-child {
        color: #ddd;
    }

    .total {
      color: #05FF00;
      font-weight: bold;
      margin-top: 15px;
      padding-top: 10px;
      border-top: 1px dashed #555;
    }

    .pembayaran {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background-color: #3C3B3B;
      border-radius: 8px;
      padding: 15px 25px;
      font-size: 14px; 
      font-weight: 600;
    }

    .pengiriman {
      display: flex;
      flex-direction: column;
      gap: 10px;
      margin-top: 15px;
    }

    .pengiriman div {
      background-color: #3C3B3B;
      border-radius: 8px;
      padding: 12px 18px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 14px;
      cursor: pointer;
      border: 1px solid transparent;
      transition: border 0.2s;
    }

    .pengiriman div.active {
      border: 1px solid #00AA6C;
      background-color: #2a2a2a;
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
      font-size: 14px;
    }

    .footer-checkout .total-harga .nominal {
      color: #05FF00;
      font-size: 20px;
      font-weight: 700;
    }

    .buat-btn {
      background-color: #00AA6C;
      border: none;
      color: #fff;
      font-weight: 700;
      font-size: 15px;
      padding: 12px 35px;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .buat-btn:hover {
      background-color: #00CC88;
    }

    @media (max-width: 600px) {
        .container {
            margin: 20px 10px;
            padding: 20px;
        }
        .footer-checkout {
            padding: 15px;
        }
    }
    
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
    {{-- Header --}}
    <div class="header">
      <span>Checkout</span>
      <a href="{{ route('keranjang.index') }}">← Kembali</a>
    </div>

    <form action="{{ route('checkout.process') }}" method="POST">
      @csrf
      
      {{-- ⚠️ Handle Error/Success Messages di sini (jika ada) --}}
      @if(session('error'))
          <div class="box" style="background-color: #5d2020; color: white; padding: 10px; margin-bottom: 20px;">
              {{ session('error') }}
          </div>
      @endif
      @if(session('success'))
          <p id="sessionSuccessMessage" style="display: none;">{{ session('success') }}</p>
      @endif

      {{-- Data Alamat --}}
      <div class="section-title">Alamat Pengiriman/Pengambilan</div>
      <div class="box alamat">
        <div class="alamat-info">
          <strong>{{ auth()->user()->name ?? 'Penyewa Guest' }}</strong><br>
          <textarea name="alamat" rows="2" placeholder="Masukkan alamat lengkap kamu (Wajib diisi)" required></textarea>
        </div>
      </div>

      {{-- FIELD TANGGAL PENGEMBALIAN --}}
      <div class="section-title">Tanggal Pengembalian Sewa</div>
      <div class="box">
        <label for="tanggal_kembali" style="display: block; font-size: 14px; margin-bottom: 5px; color: #ccc;">Pilih Tanggal Pengembalian:</label>
        <input type="date" 
               name="tanggal_kembali" 
               id="tanggal_kembali" 
               min="{{ \Carbon\Carbon::now()->addDay()->format('Y-m-d') }}"
               value="{{ \Carbon\Carbon::now()->addDay()->format('Y-m-d') }}" 
               required>
        <p style="font-size: 12px; color: #ccc; margin-top: 10px;">*Minimal pengembalian adalah besok.</p>
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
            <h4>{{ $item['nama'] }} ({{ $item['durasi'] }})</h4>
            <div class="harga">Rp{{ number_format($item['harga'],0,',','.') }}</div>
            <div class="qty">x{{ $item['quantity'] }}</div>
          </div>
        </div>
      @endforeach

      {{-- Pesan --}}
      <div class="section-title" style="margin-top: 20px;">Catatan (Opsional)</div>
      <div class="box">
        <textarea name="pesan" rows="2" placeholder="Silakan tinggalkan pesan untuk penjual..."></textarea>
        <p style="margin-top:10px; font-size:14px; font-weight: 600; color: #ccc;">
          Total Harga Barang ({{ count($cart) }} item): <span id="subtotalBarangDisplay" style="color:white;">Rp{{ number_format($total, 0, ',', '.') }}</span>
        </p>
        </div>

      {{-- Metode Pembayaran --}}
      <div class="section-title">Pembayaran</div>
      <div class="pembayaran">
        <span>Metode Pembayaran:</span>
        <span style="font-weight: 400;">Transfer Bank - Bank Jateng</span>
        <input type="hidden" name="metode" value="Transfer Bank - Bank Jateng">
      </div>

      {{-- Metode Pengiriman --}}
      <div class="section-title">Pengiriman & Pengambilan</div>
      <div class="pengiriman" style="margin-top:0;">
        <div id="pickup" class="active" onclick="selectPengiriman('Ambil di Tempat')">
          <span>Ambil di Tempat (Gratis)</span>
          <span style="color: #05FF00;">Gratis</span>
        </div>
        <div id="delivery" onclick="selectPengiriman('Diantar ke Rumah')">
          <span>Diantar ke Rumah (Biaya Tambahan)</span>
          <span style="color: #ccc;">(Hubungi Admin)</span>
        </div>
      </div>
      <input type="hidden" name="pengiriman" id="pengiriman" value="Ambil di Tempat">

      {{-- Rincian Pembayaran --}}
      <div class="section-title">Rincian Pembayaran</div>
      <div class="box">
        <div class="rincian">
          <div class="rincian-row">
            <span>Subtotal Barang</span><span id="subtotalRincian">Rp{{ number_format($total, 0, ',', '.') }}</span>
          </div>
          <div class="rincian-row">
            <span>Subtotal Pengiriman</span><span id="biayaPengiriman">-</span>
          </div>
          <div class="rincian-row">
            <span>Biaya Layanan</span><span>Rp7.000</span>
          </div>
          <div class="rincian-row total">
            <span>Total Pembayaran</span><span id="totalAkhir">Rp{{ number_format($total + 7000, 0, ',', '.') }}</span>
          </div>
        </div>
      </div>

      {{-- Footer --}}
      <div class="footer-checkout">
        <div class="total-harga">
          <p>Total Pembayaran</p>
          <p class="nominal" id="nominalFooter">Rp{{ number_format($total + 7000, 0, ',', '.') }}</p>
        </div>
        <button type="submit" class="buat-btn">Buat Pesanan</button>
      </div>
    </form>
  </div>

  <script>
    // 🔑 Data Cart dari PHP (digunakan untuk kalkulasi dinamis)
    const cartData = @json($cart);
    const biayaLayanan = 7000;
    
    // Fungsi utama untuk menghitung total berdasarkan tanggal pengembalian
    function calculateTotalByDays() {
        const dateInput = document.getElementById('tanggal_kembali');
        const rentalDate = new Date(dateInput.value);
        const currentDate = new Date();
        
        currentDate.setHours(0, 0, 0, 0);
        
        const diffTime = Math.abs(rentalDate.getTime() - currentDate.getTime());
        let rentalDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        
        if (rentalDays < 1 || isNaN(rentalDays)) {
            rentalDays = 1;
        }

        let subtotalBarangBaru = 0;
        
        for (const id in cartData) {
            if (cartData.hasOwnProperty(id)) {
                const item = cartData[id];
                subtotalBarangBaru += item.harga * item.quantity * rentalDays;
            }
        }

        const totalBaru = subtotalBarangBaru + biayaLayanan;
        
        return { subtotalBarangBaru, totalBaru };
    }

    function updateDisplay() {
        const { subtotalBarangBaru, totalBaru } = calculateTotalByDays();
        
        document.getElementById('subtotalBarangDisplay').textContent = 'Rp' + formatRupiah(subtotalBarangBaru);
        document.getElementById('subtotalRincian').textContent = 'Rp' + formatRupiah(subtotalBarangBaru);

        document.getElementById('totalAkhir').textContent = 'Rp' + formatRupiah(totalBaru);
        document.getElementById('nominalFooter').textContent = 'Rp' + formatRupiah(totalBaru);
        
        selectPengiriman(document.getElementById('pengiriman').value);
    }
    
    function selectPengiriman(method) {
      document.getElementById('pickup').classList.remove('active');
      document.getElementById('delivery').classList.remove('active');
      
      let biayaKirimDisplay = '-';
      
      if (method === 'Ambil di Tempat') {
        document.getElementById('pickup').classList.add('active');
      } else {
        document.getElementById('delivery').classList.add('active');
        biayaKirimDisplay = '(Hubungi Admin)';
      }
      
      document.getElementById('biayaPengiriman').textContent = biayaKirimDisplay;
      document.getElementById('pengiriman').value = method;
    }
    
    function formatRupiah(angka) {
        let reverse = angka.toString().split('').reverse().join(''),
        ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');
        return ribuan;
    }

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
        
        const today = new Date();
        const tomorrow = new Date(today);
        tomorrow.setDate(tomorrow.getDate() + 1);
        const tomorrowFormatted = tomorrow.toISOString().split('T')[0];
        
        const dateInput = document.getElementById('tanggal_kembali');
        
        if (dateInput) {
            dateInput.min = tomorrowFormatted;
            if (!dateInput.value) {
                dateInput.value = tomorrowFormatted;
            }
            
            dateInput.addEventListener('change', updateDisplay); 
        }

        updateDisplay();
        selectPengiriman('Ambil di Tempat');
    });
  </script>

</body>
</html>
