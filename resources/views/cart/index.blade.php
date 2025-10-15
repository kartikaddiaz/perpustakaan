<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Keranjang Buku</title>
  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/cart.css') }}?v={{ time() }}">
</head>
<body class="bg-light">
  @include('layouts.header')
  <div class="container my-5 fade-in-content">
    <div class="d-flex align-items-center mb-4">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary me-3">
            ‹
        </a>
        <h3 class="fw-bold mb-0">Keranjang Buku</h3>
    </div>

    @if(session('success'))
      <div class="alert alert-success fade-in-element">
        {{ session('success') }}
      </div>
    @endif

    @if($cart->isEmpty())
      <div class="alert alert-info text-center fade-in-element">
        Keranjang kamu masih kosong.
      </div>
    @else
      <div class="table-responsive fade-in-element">
        <table class="table table-hover align-middle bg-white shadow-sm rounded-4">
          <thead class="table-dark text-white">
            <tr>
              <th>Cover</th>
              <th>Judul Buku</th>
              <th>Penulis</th>
              <th>Penerbit</th>
              <th>Tahun Terbit</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($cart as $item)
              <tr>
                <td>
                  <img src="{{ asset('img/' . basename($item->book->cover)) }}" 
                       alt="{{ $item->book->judul }}" 
                       class="book-cover">
                </td>
                <td class="fw-semibold">{{ $item->book->judul }}</td>
                <td>{{ $item->book->penulis }}</td>
                <td>{{ $item->book->penerbit }}</td>
                <td>{{ $item->book->tahun_terbit }}</td>
                <td>
                  <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <form action="{{ route('cart.checkout') }}" method="POST" class="mt-4 fade-in-element">
        @csrf
        <button type="submit" class="btn btn-success px-4 py-2 shadow-sm">
          Checkout Semua Buku
        </button>
      </form>
    @endif
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
