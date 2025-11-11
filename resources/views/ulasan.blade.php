<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ulasan Produk</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #000;
      color: #fff;
      font-family: 'Poppins', sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      min-height: 100vh;
    }

    .container {
      width: 80%;
      max-width: 900px;
      background-color: #111;
      border-radius: 15px;
      padding: 30px;
      margin-top: 40px;
      box-shadow: 0 0 10px rgba(0,0,0,0.5);
    }

    .header {
      background: #3C3B3B;
      border-radius: 15px;
      text-align: center;
      padding: 10px 0;
      font-size: 22px;
      font-weight: 700;
      margin-bottom: 30px;
      box-shadow: 0 4px 4px rgba(0,0,0,0.25);
    }

    .review-list {
      display: flex;
      flex-direction: column;
      gap: 20px;
      margin-bottom: 40px;
    }

    .review-card {
      background: #F1F1F1;
      color: #000;
      border-radius: 10px;
      padding: 15px 20px;
      font-family: 'Inter', sans-serif;
      font-weight: 500;
      font-size: 15px;
      line-height: 20px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }

    .input-group {
      margin-bottom: 15px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .input-group textarea {
      width: 100%;
      max-width: 700px;
      height: 80px;
      background: #3C3B3B;
      border: none;
      border-radius: 7px;
      color: #fff;
      padding: 10px;
      font-family: 'Poppins', sans-serif;
      font-size: 14px;
      resize: none;
      margin-bottom: 15px;
    }

    .btn-submit {
      background: #00AA6C;
      color: #fff;
      border: none;
      border-radius: 10px;
      padding: 10px 40px;
      font-size: 15px;
      font-weight: 700;
      cursor: pointer;
      transition: background 0.3s;
    }

    .btn-submit:hover {
      background: #00925d;
    }

    @media (max-width: 768px) {
      .container {
        width: 95%;
        padding: 20px;
      }
      .review-card {
        font-size: 14px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="header">ULASAN</div>

    <div class="review-list">
      <div class="review-card">Lorem ipsum dolor sit amet, consectetur adipiscing elit...</div>
      <div class="review-card">Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua...</div>
      <div class="review-card">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</div>
      <div class="review-card">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum...</div>
      <div class="review-card">Excepteur sint occaecat cupidatat non proident, sunt in culpa...</div>
    </div>

    <div class="input-group">
      <textarea placeholder="Masukkan ulasan..."></textarea>
      <button class="btn-submit">Kirim Ulasan</button>
    </div>
  </div>
</body>
</html>
