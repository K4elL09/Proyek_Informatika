<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ulasan Produk: {{ $product->nama_produk ?? 'Detail' }}</title>
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
      width: 95%;
      max-width: 900px;
      background-color: #111;
      border-radius: 15px;
      padding: 30px;
      margin-top: 40px;
      box-shadow: 0 0 10px rgba(0,0,0,0.5);
    }

    .header {
      background: #3C3B3B;
      border-radius: 10px;
      text-align: center;
      padding: 15px 0;
      font-size: 20px;
      font-weight: 700;
      margin-bottom: 30px;
      box-shadow: 0 4px 4px rgba(0,0,0,0.25);
    
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 25px;
    }
    .header-content {
        flex-grow: 1;
        text-align: center;
    }
    
    .btn-back {
        background: none;
        border: none;
        color: #00FF77;
        font-weight: 600;
        text-decoration: none;
        font-size: 14px;
        padding: 5px 10px;
        border-radius: 5px;
        transition: color 0.2s;
    }
    .btn-back:hover {
        color: #00cc88;
    }

    .header-product {
        font-size: 14px;
        font-weight: 500;
        color: #00FF77;
        display: block;
        margin-top: 5px;
    }
    
    .review-form-card {
        background: #1a1a1a;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 30px;
        border: 1px solid #333;
    }
    .form-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 15px;
        color: #ccc;
    }

    /* RATING STARS CSS */
    .rating-group {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 15px;
    }

    .rating-group input {
        display: none;
    }

    .rating-group label {
        cursor: pointer;
        font-size: 30px;
        padding: 0 5px;
        color: #444;
        transition: color 0.2s;
    }

    .rating-group input:checked ~ label {
        color: #FFC300;
    }
    .rating-group label:hover,
    .rating-group label:hover ~ label {
        color: #FFD700;
    }


    /* REVIEW LIST */
    .review-list {
      display: flex;
      flex-direction: column;
      gap: 15px;
      margin-bottom: 40px;
      border-top: 1px solid #333;
      padding-top: 20px;
    }

    .review-card {
      background: #2a2a2a;
      color: #fff;
      border-radius: 10px;
      padding: 15px 20px;
      font-family: 'Inter', sans-serif;
      font-weight: 400;
      font-size: 15px;
      line-height: 1.5;
      box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }

    .review-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .review-user {
        font-weight: 700;
        color: #00FF77;
    }

    .review-date {
        font-size: 12px;
        color: #aaa;
    }

    .review-rating-display {
        color: #FFC300;
        font-size: 18px;
    }
    
    .input-group textarea {
      width: 100%;
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
      box-sizing: border-box;
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

    .alert {
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 15px;
        font-size: 14px;
        font-weight: 600;
    }
    .alert-success {
        background-color: #00AA6C50;
        border: 1px solid #00AA6C;
    }
    .alert-error {
        background-color: #ff444450;
        border: 1px solid #ff4444;
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
    <div class="header">
        <a href="{{ route('home') }}" class="btn-back">
            ← Kembali
        </a>
        <div class="header-content">
            ULASAN PRODUK
            <span class="header-product">{{ $product->nama_produk ?? 'Nama Produk' }}</span>
        </div>
        <div style="width: 75px;"></div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-error">
            Mohon periksa data ulasan Anda:
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <div class="review-form-card">
        <div class="form-title">
            {{ $userReview ? 'Edit Ulasan Anda' : 'Tulis Ulasan Baru' }}
        </div>
        
        <form action="{{ route('review.store', $product->id ?? 0) }}" method="POST">
            @csrf

            <div class="rating-group">
                <input type="radio" id="star5" name="rating" value="5" {{ ($userReview && $userReview->rating == 5) ? 'checked' : '' }} required />
                <label for="star5" title="5 bintang">★</label>
                
                <input type="radio" id="star4" name="rating" value="4" {{ ($userReview && $userReview->rating == 4) ? 'checked' : '' }} />
                <label for="star4" title="4 bintang">★</label>
                
                <input type="radio" id="star3" name="rating" value="3" {{ ($userReview && $userReview->rating == 3) ? 'checked' : '' }} />
                <label for="star3" title="3 bintang">★</label>
                
                <input type="radio" id="star2" name="rating" value="2" {{ ($userReview && $userReview->rating == 2) ? 'checked' : '' }} />
                <label for="star2" title="2 bintang">★</label>
                
                <input type="radio" id="star1" name="rating" value="1" {{ ($userReview && $userReview->rating == 1) ? 'checked' : '' }} />
                <label for="star1" title="1 bintang">★</label>
            </div>

            <div class="input-group">
                <textarea 
                    name="content" 
                    placeholder="Tuliskan ulasan Anda mengenai produk ini..." 
                    required
                >{{ $userReview->content ?? '' }}</textarea>
                <button type="submit" class="btn-submit">
                    {{ $userReview ? 'Perbarui Ulasan' : 'Kirim Ulasan' }}
                </button>
            </div>
        </form>
    </div>

    <div class="section-title" style="color: #fff; border-left: 3px solid #00FF77; padding-left: 10px;">
        Semua Ulasan ({{ $reviews->count() ?? 0 }})
    </div>

    <div class="review-list">
        @forelse($reviews as $review)
            <div class="review-card">
                <div class="review-meta">
                    <span class="review-user">{{ $review->user->name ?? 'Pengguna Anonim' }}</span>
                    <span class="review-date">{{ $review->created_at->format('d M Y') }}</span>
                </div>
                <div class="review-rating-display">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $review->rating)
                            ★
                        @else
                            <span style="color: #444;">★</span>
                        @endif
                    @endfor
                </div>
                <div class="review-content" style="margin-top: 8px;">
                    {{ $review->content }}
                </div>
            </div>
        @empty
            <div class="review-card" style="background: #2a2a2a;">Belum ada ulasan untuk produk ini. Jadilah yang pertama!</div>
        @endforelse
    </div>

  </div>
</body>
</html>