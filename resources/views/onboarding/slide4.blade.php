<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PDMP Outdoor - Onboarding 4</title>
  <link rel="stylesheet" href="{{ asset('css/onboarding.css') }}">
</head>
<body>
  <div class="slide4">
    <div class="slide4-content">
      <div class="logo-section">
        <img src="{{ asset('images/pdmp.png') }}" alt="PDMP Outdoor Logo">
        <p class="tagline">Pioneers of Discovery<br>Mountaineering<br>And Pursuit</p>
      </div>

      <h2>PDMP OUTDOOR</h2>
      <p>Silahkan melakukan pendaftaran ketika pertama kali mengakses PDMP Outdoor. 
        Masuk dengan login jika anda sudah pernah mendaftar.</p>

      <div class="slide4-buttons">
        <a href="{{ route('login') }}" class="btn-primary">Masuk</a>
        <a href="{{ route('register') }}" class="btn-outline">Daftar</a>
      </div>
    </div>
  </div>
</body>
</html>
