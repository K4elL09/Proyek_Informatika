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

    textarea, input[type="date"], input[type="number"], select {
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
      margin-top: 8px; 
    }
    
    textarea:focus, input[type="date"]:focus, input[type="number"]:focus, select:focus {
        border-color: #00AA6C;
        outline: none;
    }

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

    /* PAYMENT BUTTONS */
    .payment-options {
        display: flex;
        gap: 15px;
        margin-top: 15px;
        margin-bottom: 30px;
    }
    .payment-option-btn {
        flex: 1;
        background-color: #3C3B3B;
        color: #fff;
        border: 2px solid transparent;
        border-radius: 8px;
        padding: 15px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        text-align: center;
    }
    .payment-option-btn.selected {
        border-color: #00AA6C;
        background-color: #2a2a2a;
        color: #00FF77;
    }
    .payment-option-btn:hover:not(.selected) {
        background-color: #4a4a4a;
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

    <form id="checkoutForm" action="{{ route('checkout.process') }}" method="POST">
      @csrf
      
      @if(session('error'))
          <div class="box" style="background-color: #5d2020; color: white; padding: 10px; margin-bottom: 20px;">
              {{ session('error') }}
          </div>
      @endif
      @if(session('success'))
          <p id="sessionSuccessMessage" style="display: none;">{{ session('success') }}</p>
      @endif

      {{-- Data Alamat --}}
      <div class="section-title">Alamat & Kontak</div>
      <div class="box alamat">
        <div class="alamat-info">
          <strong>{{ auth()->user()->name ?? 'Penyewa Guest' }}</strong><br>
          
          {{-- INPUT NOMOR TELEPON OTOMATIS --}}
          <label for="no_hp" style="display: block; font-size: 14px; margin-top: 15px; margin-bottom: 0px; color: #ccc;">Nomor WhatsApp / HP:</label>
          <input 
              type="number" 
              name="no_hp" 
              class="form-control" 
              placeholder="Contoh: 08123456789"
              value="{{ auth()->user()->phone ?? '' }}" 
              required
          >
          
          <select id="provinsi" required onchange="loadRegencies()"></select>
          <select id="kabupaten" required disabled onchange="loadDistricts()"></select>
          <select id="kecamatan" required disabled></select>

          <label for="detail_alamat" style="display: block; font-size: 14px; margin-top: 15px; margin-bottom: 0px; color: #ccc;">Detail Jalan:</label>
          <textarea name="detail_alamat" id="detail_alamat" rows="2" placeholder="Detail jalan, RT/RW, dan patokan..." required></textarea>
          
          <input type="hidden" name="alamat" id="finalAlamat" required>
        </div>
      </div>

      {{-- FIELD TANGGAL PENGEMBALIAN --}}
      <div class="section-title">Tanggal Pengembalian Sewa</div>
      <div class="box">
        <label for="tanggal_kembali" style="display: block; font-size: 14px; margin-bottom: 5px; color: #ccc;">Pilih Tanggal Pengembalian:</label>
        <input type="date" 
               name="tanggal_kembali" 
               id="tanggal_kembali" 
               onchange="updateDisplay()"
               required>
        <p style="font-size: 12px; color: #ccc; margin-top: 10px;">*Minimal pengembalian adalah besok.</p>
      </div>

      {{-- METODE PEMBAYARAN --}}
      <div class="section-title">Pilih Metode Pembayaran</div>
      <div class="payment-options">
          <button type="button" class="payment-option-btn selected" data-method="QRIS" onclick="selectPaymentMethod(this, 'QRIS')">
              QRIS
          </button>
          <button type="button" class="payment-option-btn" data-method="Transfer Bank" onclick="selectPaymentMethod(this, 'Transfer Bank')">
              Transfer Bank
          </button>
      </div>
      <input type="hidden" name="metode" id="metodePembayaran" value="QRIS">

      {{-- Barang Dipesan --}}
      <div class="section-title">Barang Dipesan</div>
      <div class="section-sub">PDMP OUTDOOR</div>

      @php $total = 0; @endphp
      @foreach($cart as $id => $item)
        @php $total += $item['harga'] * $item['quantity']; @endphp
        <div class="produk">
          {{-- Pastikan path gambar sesuai dengan yang ada --}}
          <img src="{{ asset('images/' . $item['gambar']) }}" alt="{{ $item['nama'] }}" onerror="this.src='https://via.placeholder.com/100'">
          <div class="produk-info">
            <h4>{{ $item['nama'] }} ({{ $item['durasi'] }})</h4>
            <div class="harga">Rp{{ number_format($item['harga'],0,',','.') }} / Hari</div>
            <div class="qty">x{{ $item['quantity'] }}</div>
          </div>
        </div>
      @endforeach

      {{-- Pesan --}}
      <div class="section-title" style="margin-top: 20px;">Catatan (Opsional)</div>
      <div class="box">
        <textarea name="pesan" rows="2" placeholder="Silakan tinggalkan pesan untuk penjual..."></textarea>
        <p style="margin-top:10px; font-size:14px; font-weight: 600; color: #ccc;">
          Subtotal Barang (1 Hari): <span id="subtotalBarangDisplay" style="color:white;">Rp{{ number_format($total, 0, ',', '.') }}</span>
        </p>
        </div>

      {{-- Metode Pengiriman --}}
      <div class="section-title">Pengiriman & Pengambilan</div>
      <div class="pengiriman" style="margin-top:0;">
        <div id="pickup" class="active" onclick="selectPengiriman(this, 'Ambil di Tempat')">
          <span>Ambil di Tempat (Gratis)</span>
          <span style="color: #05FF00;">Gratis</span>
        </div>
        <div id="delivery" onclick="selectPengiriman(this, 'Diantar ke Rumah')">
          <span>Diantar ke Rumah (Biaya Tambahan)</span>
          <span style="color: #ccc;">(Hubungi Admin)</span>
        </div>
      </div>
      <input type="hidden" name="pengiriman" id="pengirimanInput" value="Ambil di Tempat">

      {{-- Rincian Pembayaran --}}
      <div class="section-title">Rincian Pembayaran</div>
      <div class="box">
        <div class="rincian">
          <div class="rincian-row">
            <span>Subtotal Barang (<span id="durasiHariText">1</span> Hari)</span><span id="subtotalRincian">Rp{{ number_format($total, 0, ',', '.') }}</span>
          </div>
          <div class="rincian-row">
            <span>Subtotal Pengiriman</span><span id="biayaPengiriman">Rp0</span>
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
    const cartData = @json($cart);
    const biayaLayanan = 7000;
    const API_BASE_URL = 'https://www.emsifa.com/api-wilayah-indonesia/api/';
    
    // Element Selectors
    const provinceSelect = document.getElementById('provinsi');
    const regencySelect = document.getElementById('kabupaten');
    const districtSelect = document.getElementById('kecamatan');
    const detailAlamatInput = document.getElementById('detail_alamat');
    const finalAlamatInput = document.getElementById('finalAlamat');
    const checkoutForm = document.getElementById('checkoutForm');


    // === 🔑 LOGIKA API WILAYAH INDONESIA ===

    function createOption(text, value, disabled = false) {
        const option = document.createElement('option');
        option.textContent = text;
        option.value = value;
        option.disabled = disabled;
        return option;
    }

    // 1. Load Provinsi
    async function loadProvinces() {
        provinceSelect.innerHTML = '';
        provinceSelect.appendChild(createOption('Memuat Provinsi...', '', true));
        provinceSelect.disabled = true;

        try {
            const response = await fetch(API_BASE_URL + 'provinces.json');
            const data = await response.json();
            
            provinceSelect.innerHTML = '';
            provinceSelect.appendChild(createOption('Pilih Provinsi', '', true));
            provinceSelect.disabled = false;
            
            data.forEach(province => {
                provinceSelect.appendChild(createOption(province.name, province.id));
            });
            provinceSelect.selectedIndex = 0;

        } catch (error) {
            console.error('Gagal memuat provinsi:', error);
            provinceSelect.appendChild(createOption('Gagal memuat', '', true));
        }
    }

    // 2. Load Kabupaten/Kota
    async function loadRegencies() {
        const provinceId = provinceSelect.value;
        regencySelect.innerHTML = '';
        districtSelect.innerHTML = '';
        
        regencySelect.appendChild(createOption('Memuat Kabupaten/Kota...', '', true));
        regencySelect.disabled = true;
        districtSelect.disabled = true;
        
        if (!provinceId) return;

        try {
            const response = await fetch(`${API_BASE_URL}regencies/${provinceId}.json`);
            const data = await response.json();
            
            regencySelect.innerHTML = '';
            regencySelect.appendChild(createOption('Pilih Kabupaten/Kota', '', true));
            regencySelect.disabled = false;

            data.forEach(regency => {
                regencySelect.appendChild(createOption(regency.name, regency.id));
            });
            regencySelect.selectedIndex = 0;
        } catch (error) {
            console.error('Gagal memuat kabupaten:', error);
            regencySelect.appendChild(createOption('Gagal memuat', '', true));
        }
    }

    // 3. Load Kecamatan
    async function loadDistricts() {
        const regencyId = regencySelect.value;
        districtSelect.innerHTML = '';
        
        districtSelect.appendChild(createOption('Memuat Kecamatan...', '', true));
        districtSelect.disabled = true;
        
        if (!regencyId) return;

        try {
            const response = await fetch(`${API_BASE_URL}districts/${regencyId}.json`);
            const data = await response.json();
            
            districtSelect.innerHTML = '';
            districtSelect.appendChild(createOption('Pilih Kecamatan', '', true));
            districtSelect.disabled = false;

            data.forEach(district => {
                districtSelect.appendChild(createOption(district.name, district.id));
            });
            districtSelect.selectedIndex = 0;
        } catch (error) {
            console.error('Gagal memuat kecamatan:', error);
            districtSelect.appendChild(createOption('Gagal memuat', '', true));
        }
    }

    // 4. Compile Final Address
    function compileAddress() {
        const provName = provinceSelect.options[provinceSelect.selectedIndex]?.textContent || '';
        const regencyName = regencySelect.options[regencySelect.selectedIndex]?.textContent || '';
        const districtName = districtSelect.options[districtSelect.selectedIndex]?.textContent || '';
        const detailJalan = detailAlamatInput.value.trim();

        const fullAddress = `${detailJalan}, Kec. ${districtName}, ${regencyName}, Prov. ${provName}`;
        
        finalAlamatInput.value = fullAddress;
    }
    
        [provinceSelect, regencySelect, districtSelect, detailAlamatInput].forEach(element => {
        if (element) element.addEventListener('change', compileAddress);
        if (element) element.addEventListener('input', compileAddress);
    });

    checkoutForm.addEventListener('submit', function(e) {
        compileAddress();
        
        // Validasi Alamat
        if (!provinceSelect.value || !regencySelect.value || !districtSelect.value || finalAlamatInput.value.length < 10) {
            alert("Mohon lengkapi seluruh kolom wilayah dan detail jalan.");
            e.preventDefault();
            return false;
        }
    });
    
    function formatRupiah(angka) {
        if (typeof angka !== 'number') return '0';
        const formatted = angka.toString().split('').reverse().join('');
        const ribuan = formatted.match(/\d{1,3}/g).join('.').split('').reverse().join('');
        return ribuan;
    }

    function calculateTotalByDays() {
        const tanggalKembaliInput = document.getElementById('tanggal_kembali').value;
        const hariIni = new Date();
        hariIni.setHours(0, 0, 0, 0);

        if (!tanggalKembaliInput) {
            return { subtotalBarangBaru: @json($total), totalBaru: @json($total + 7000), rentalDays: 1 };
        }

        const tglKembali = new Date(tanggalKembaliInput);
        tglKembali.setHours(0, 0, 0, 0);

        const diffTime = tglKembali.getTime() - hariIni.getTime();
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

        const biayaKirimNominal = 0;
        const totalBaru = subtotalBarangBaru + biayaKirimNominal + biayaLayanan;

        return { subtotalBarangBaru, totalBaru, rentalDays };
    }

    function updateDisplay() {
        const { subtotalBarangBaru, totalBaru, rentalDays } = calculateTotalByDays();
        
        document.getElementById('subtotalBarangDisplay').textContent = 'Rp' + formatRupiah(subtotalBarangBaru);        
        document.getElementById('durasiHariText').textContent = rentalDays;
        document.getElementById('subtotalRincian').textContent = 'Rp' + formatRupiah(subtotalBarangBaru);
        document.getElementById('totalAkhir').textContent = 'Rp' + formatRupiah(totalBaru);
        document.getElementById('nominalFooter').textContent = 'Rp' + formatRupiah(totalBaru);
        
        selectPengiriman(document.querySelector('.pengiriman div.active'), document.getElementById('pengirimanInput').value);

    }
    
    function selectPaymentMethod(element, method) {
        document.querySelectorAll('.payment-option-btn').forEach(btn => {
            btn.classList.remove('selected');
        });

        element.classList.add('selected');
        document.getElementById('metodePembayaran').value = method;
    }

    function selectPengiriman(element, method) {
      document.getElementById('pickup').classList.remove('active');
      document.getElementById('delivery').classList.remove('active');
      
      let biayaKirimDisplay = '-';
      
      if (method === 'Ambil di Tempat') {
        document.getElementById('pickup').classList.add('active');
        biayaKirimDisplay = 'Rp0';
      } else {
        document.getElementById('delivery').classList.add('active');
        biayaKirimDisplay = '(Hubungi Admin)';
      }
      
      document.getElementById('biayaPengiriman').textContent = biayaKirimDisplay;
      document.getElementById('pengirimanInput').value = method;
        
        // Re-run display update to ensure consistency
        // (Removed circular call to updateDisplay to prevent stack overflow if any)
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        loadProvinces(); 
        
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
        }

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
        
        updateDisplay();
        selectPaymentMethod(document.querySelector('.payment-option-btn[data-method="QRIS"]'), 'QRIS');
        selectPengiriman(document.querySelector('.pengiriman #pickup'), 'Ambil di Tempat');
    });
  </script>

</body>
</html>