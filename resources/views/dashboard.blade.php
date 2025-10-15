<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Pengguna - Perpustakaan</title>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/beranda-admin.css') }}">
</head>
<body class="bg-light text-dark">

  @include('layouts.header')

  <main class="fade-in">
    <!-- Carousel -->
    <div id="bookCarousel" class="carousel slide mb-5 shadow-lg rounded-4 overflow-hidden" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="{{ asset('img/book.jpeg') }}" class="d-block w-100" style="height: 420px; object-fit: cover;" alt="Slide 1">
          <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-3">
            <h3 class="text-white fw-bold">Selamat Datang di Perpustakaan Digital</h3>
            <p class="text-light">Temukan dan pinjam buku favoritmu dengan mudah!</p>
          </div>
        </div>
      </div>
    </div>

    <div class="container mt-4">
      <h3 class="text-center mb-4 fw-bold">Jelajahi Koleksi Buku</h3>

      <form method="GET" action="{{ route('user.dashboard') }}" class="mb-5">
        <div class="input-group shadow-sm search-box">
          <input type="text" name="search" class="form-control form-control-lg border-dark"
                 placeholder="Cari buku atau penulis..." value="{{ $search ?? '' }}">
          <button class="btn btn-dark px-4" type="submit">Cari</button>
        </div>
      </form>

      <h5 class="fw-semibold mb-3 text-center">Pilih Kategori</h5>
      <div class="text-center mb-5 fade-in-delayed">
        <div class="d-flex flex-wrap justify-content-center gap-4">
          @foreach($categories->take(5) as $category)
            <a href="{{ route('user.dashboard', ['category' => $category->id]) }}" class="text-decoration-none">
              <div class="category-card">
                <p class="fw-semibold mb-0">{{ $category->nama }}</p>
              </div>
            </a>
          @endforeach

          <a href="{{ route('user.dashboard') }}" class="text-decoration-none">
            <div class="category-card">
              <p class="fw-semibold mb-0 text-muted">Lainnya</p>
            </div>
          </a>
        </div>
      </div>

      <div class="mt-5 fade-in-delayed">
        <h4 class="fw-semibold mb-4 text-center">Yang Populer di Antara Koleksi Kami</h4>

        <div class="d-flex flex-nowrap overflow-auto pb-3 px-2" style="gap: 25px;">
          @forelse($books as $book)
            <div class="book-card">
              <img src="{{ asset('img/' . basename($book->cover)) }}"
                   alt="{{ $book->judul }}"
                   class="book-cover">
              <div class="card-body text-center p-3">
                <h6 class="fw-bold mb-1">{{ $book->judul }}</h6>
                <p class="text-muted small mb-2">{{ $book->penulis }}</p>
                <a href="{{ route('books.show', $book->id) }}" class="btn btn-outline-dark btn-sm px-3 py-1">
                  Lihat Buku
                </a>
              </div>
            </div>
          @empty
            <div class="text-center text-muted w-100">Tidak ada buku ditemukan.</div>
          @endforelse
        </div>
      </div>
    </div>
  </main>

  @include('layouts.footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
