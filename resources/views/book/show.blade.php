<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $book->judul }} - Detail Buku</title>
    
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/show.css') }}">
</head>
<body class="bg-light">

  @auth
    @include('layouts.header')
  @else
    @include('layouts.navbar')
  @endauth

  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  <div class="container my-5">
    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
      <div class="row g-0">
        <div class="col-md-4">
          <img src="{{ asset('img/' . basename($book->cover)) }}" class="img-fluid h-100 w-100" style="object-fit: cover;" alt="{{ $book->judul }}">
        </div>
        <div class="col-md-8">
          <div class="card-body p-4">
            <h3 class="fw-bold mb-3">{{ $book->judul }}</h3>
            <p class="text-muted mb-2">✍️ Penulis: <strong>{{ $book->penulis }}</strong></p>
            <p class="text-muted mb-2">🏢 Penerbit: {{ $book->penerbit }}</p>
            <p class="text-muted mb-3">📅 Tahun Terbit: {{ $book->tahun_terbit }}</p>
            <hr>
            <h5 class="fw-semibold mt-3">Deskripsi Buku</h5>
            <p class="mt-2" style="text-align: justify;">
              {{ $book->deskripsi }}
            </p>

            @auth
              <form action="{{ route('favorites.toggle', $book->id) }}" method="POST" class="d-inline">
                  @csrf
                  @if($book->favorites->where('user_id', Auth::id())->count() > 0)
                      <button type="submit" class="btn btn-favorite mt-3" title="Hapus dari Favorit">
                          💔
                      </button>
                  @else
                      <button type="submit" class="btn btn-favorite mt-3" title="Tambah ke Favorit">
                          ❤️
                      </button>
                  @endif
              </form>
            @else
              <a href="{{ route('login') }}" class="btn btn-outline-danger mt-3">❤️</a>
            @endauth

            <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary mt-3">Kembali</a>

            {{-- ✅ Tombol pinjam hanya untuk buku yang ada PDF-nya --}}
            @if ($book->pdf_path)
              <form action="{{ route('cart.add', $book->id) }}" method="POST" class="d-inline">
                  @csrf
                  <button type="submit" class="btn btn-success mt-3">Tambah ke Keranjang</button>
              </form>
            @else
              <button class="btn btn-secondary mt-3" disabled>Tidak tersedia untuk dipinjam</button>
            @endif

          </div>
        </div>
      </div>
    </div>
  </div> 

  <!-- 💡 Rekomendasi Buku -->
  <div class="mt-5">
    <h4 class="fw-semibold mb-4 text-center">Rekomendasi Buku Untukmu</h4>
    <div class="row row-cols-2 row-cols-md-4 g-4 justify-content-center">
      @foreach($recommendedBooks as $recommended)
        <div class="col" style="max-width: 220px;">
          <div class="card shadow-sm border-0 text-center" style="border-radius: 12px;">
            <img src="{{ asset('img/' . basename($recommended->cover)) }}" 
                 alt="{{ $recommended->judul }}" 
                 class="card-img-top mx-auto mt-3"
                 style="height: 200px; width: 140px; object-fit: cover; border-radius: 8px;">
            <div class="card-body p-3">
              <h6 class="fw-bold mb-1" style="font-size: 0.95rem;">{{ $recommended->judul }}</h6>
              <p class="text-muted small mb-2">{{ $recommended->penulis }}</p>
              <a href="{{ route('books.show', $recommended->id) }}" class="btn btn-success btn-sm px-3 py-1">Lihat Buku</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>

  @include('layouts.footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
