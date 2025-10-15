<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buku Saya</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link href="{{ asset('css/mybooks.css') }}" rel="stylesheet">
</head>

<body>
  @include('layouts.header')
  <div class="container mt-5 mb-5 fade-in">
    <div class="d-flex align-items-center mb-4">
      <a href="{{ url()->previous() }}" class="btn btn-outline-secondary me-3 back-btn">
        &lt;
      </a>
      <h3 class="mb-0 fw-semibold">Buku Saya</h3>
    </div>

    @if($loans->isEmpty())
        <div class="alert alert-info text-center shadow-sm rounded-3 fade-in-delayed">
          Kamu belum menambahkan buku ke koleksi.
        </div>
    @else
        <div class="table-responsive fade-in-delayed">
          <table id="myBooksTable" class="table table-striped table-hover align-middle shadow-sm">
            <thead class="table-dark">
              <tr>
                <th>Cover</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Tanggal Expired</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($loans as $loan)
                @php
                    $expiredDate = \Carbon\Carbon::parse($loan->created_at)->addDays(7)->format('d M Y');
                @endphp
                <tr class="row-hover">
                  <td>
                    <img src="{{ asset('img/' . basename($loan->book->cover)) }}" 
                         alt="{{ $loan->book->judul }}" 
                         class="book-cover">
                  </td>
                  <td class="fw-medium">{{ $loan->book->judul }}</td>
                  <td>{{ $loan->book->penulis }}</td>
                  <td class="text-danger fw-semibold">{{ $expiredDate }}</td>
                  <td>
                    <a href="{{ route('books.read', $loan->book->id) }}" 
                      class="btn btn-sm btn-dark px-3 py-1 read-btn" target="_blank">
                      Baca Buku
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
    @endif
  </div>
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.3.4/js/dataTables.bootstrap5.js"></script>
  <script>
    new DataTable('#myBooksTable', {
      responsive: true,
      pageLength: 5,
      language: {
        search: "Cari Buku:",
        lengthMenu: "Tampilkan _MENU_ buku per halaman",
        info: "Menampilkan _START_–_END_ dari _TOTAL_ buku",
        paginate: { previous: "‹", next: "›" },
        zeroRecords: "Tidak ada buku ditemukan."
      }
    });
  </script>
</body>
</html>
