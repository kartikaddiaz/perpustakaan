<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buku Favorit</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/favorite.css') }}?v={{ time() }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

  @auth
    @include('layouts.header')
  @else
    @include('layouts.navbar')
  @endauth

  <div class="container mt-4 main-content">
    <div class="page-header d-flex align-items-center">
      <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm me-2">
        <i class="bi bi-arrow-left"></i>
      </a>
      <h3 class="mb-0">Buku Favorit Kamu</h3>
    </div>

    @if($favorites->isEmpty())
      <div class="text-center text-muted mt-5">
        <p>Belum ada buku yang kamu favoritkan.</p>
        <a href="{{ route('user.dashboard') }}" class="btn btn-outline-dark mt-2">Cari Buku</a>
      </div>
    @else
      <div class="row row-cols-2 row-cols-md-4 g-4 justify-content-center mt-3">
        @foreach($favorites as $book)
          <div class="col" style="max-width: 220px;">
            <div class="card shadow-sm border-0 text-center">
              <img src="{{ asset('img/' . basename($book->cover)) }}" 
                   alt="{{ $book->judul }}" 
                   class="card-img-top mx-auto mt-3"
                   style="height: 200px; width: 140px; object-fit: cover; border-radius: 8px;">
              <div class="card-body p-3">
                <h6 class="fw-bold mb-1">{{ $book->judul }}</h6>
                <p class="text-muted small mb-2">{{ $book->penulis }}</p>
               <a href="{{ route('books.show', $book->book_id) }}" class="btn btn-success btn-sm px-3 py-1">Lihat Buku</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
