<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Pengguna - Perpustakaan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>

  @include('layouts.navbar')

  <main>
    <!-- Carousel -->
    <div id="bookCarousel" class="carousel slide mb-5 shadow-sm rounded-4 overflow-hidden" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="{{ asset('img/book.jpeg') }}" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Slide 1">
        </div>
      </div>
    </div>

    <div class="container mt-4">
      <h3 class="text-center mb-4 fw-bold">Jelajahi Koleksi Buku</h3>

      <form method="GET" action="{{ route('user.dashboard') }}" class="mb-5">
        <div class="input-group shadow-sm">
          <input type="text" name="search" class="form-control form-control-lg" placeholder="Cari buku atau penulis..." value="{{ $search ?? '' }}">
          <button class="btn btn-dark" type="submit">Cari</button>
        </div>
      </form>

      <h5 class="fw-semibold mb-3 text-center">Pilih Kategori</h5>
      <div class="text-center mb-5">
        <div class="d-flex flex-wrap justify-content-center gap-4">
          @foreach($categories->take(5) as $category)
            <a href="{{ route('user.dashboard', ['category' => $category->id]) }}" class="text-decoration-none">
              <div class="card border-0 shadow-sm category-text-card d-flex align-items-center justify-content-center">
                <p class="fw-semibold text-dark mb-0">{{ $category->nama }}</p>
              </div>
            </a>
          @endforeach

          <a href="{{ route('user.dashboard') }}" class="text-decoration-none">
            <div class="card border-0 shadow-sm category-text-card d-flex align-items-center justify-content-center">
              <p class="fw-semibold text-muted mb-0">Lainnya</p>
            </div>
          </a>
        </div>
      </div>

      <div class="mt-5">
        <h4 class="fw-semibold mb-4 text-center">Yang Populer di Antara Koleksi Kami</h4>

        <div class="d-flex flex-nowrap overflow-auto pb-3 px-2" style="gap: 25px;">
          @forelse($books as $book)
            <div class="card shadow-sm border-0"
                 style="min-width: 210px; max-width: 210px; flex: 0 0 auto; border-radius: 14px;">
              <img src="{{ asset('img/' . basename($book->cover)) }}"
                   alt="{{ $book->judul }}"
                   class="card-img-top"
                   style="height: 280px; object-fit: cover; border-top-left-radius: 14px; border-top-right-radius: 14px;">
              <div class="card-body text-center p-3">
                <h6 class="fw-bold mb-1" style="font-size: 1rem;">{{ $book->judul }}</h6>
                <p class="text-muted small mb-2">{{ $book->penulis }}</p>
                <a href="{{ route('books.show', $book->id) }}" class="btn btn-success btn-sm px-3 py-1">Lihat Buku</a>
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
