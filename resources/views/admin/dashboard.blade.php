<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/beranda-admin.css') }}?v={{ time() }}">

  <style>
    body { font-family: 'Poppins', sans-serif; background: #f8f9fa; }
    .cover-thumb { width: 45px; height: 60px; object-fit: cover; border-radius: 4px; }
    .chart-section { display: flex; gap: 1rem; align-items: start; }
    .chart-box { flex: 1; max-width: 200px; }
    .list-box { flex: 2; }
    .card h6 { font-weight: 600; }
    .table th, .table td { vertical-align: middle !important; }
  </style>
</head>

<body>
@include('layouts.header2')

<div class="container mt-4">
  <div class="d-flex align-items-center mb-4">
    <h2 class="mb-0 fw-semibold">Beranda Admin</h2>
  </div>

  <!-- 📊 Statistik Atas -->
  <div class="row mb-4">
    @foreach ([['Total Buku', $totalBooks], ['Total Pengguna', $totalUsers], ['Peminjaman Aktif', $totalLoansActive], ['Peminjaman Hari Ini', $totalLoansToday]] as $stat)
      <div class="col-md-3 col-sm-6 mb-3">
        <div class="card text-center shadow-sm border-0">
          <div class="card-body">
            <h6 class="text-muted mb-1">{{ $stat[0] }}</h6>
            <h3 class="fw-bold">{{ $stat[1] }}</h3>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <!-- 📈 Statistik Buku -->
  <div class="row mb-4">
    <!-- Buku Paling Banyak Dipinjam -->
    <div class="col-lg-6 mb-3">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
          <h6 class="mb-0">Buku Paling Banyak Dipinjam</h6>
          <small class="text-muted">Top {{ $mostBorrowedBooks->count() }}</small>
        </div>
        <div class="card-body">
          @if($mostBorrowedBooks->isEmpty())
            <p class="text-muted text-center mb-0">Belum ada data peminjaman.</p>
          @else
            <div class="chart-section">
              <div class="chart-box"><canvas id="borrowedBooksPieChart"></canvas></div>
              <div class="list-box">
                <ul class="list-group list-group-flush small">
                  @foreach ($mostBorrowedBooks as $book)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span>{{ $book->judul }}</span>
                      <span class="badge bg-primary">{{ $book->total_loans }}x</span>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>

    <!-- Buku Paling Difavoritkan -->
    <div class="col-lg-6 mb-3">
      <div class="card shadow-sm border-0 h-100">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
          <h6 class="mb-0">Buku Paling Banyak Difavoritkan</h6>
          <small class="text-muted">Top {{ $mostFavoritedBooks->count() }}</small>
        </div>
        <div class="card-body">
          @if($mostFavoritedBooks->isEmpty())
            <p class="text-muted text-center mb-0">Belum ada data favorit.</p>
          @else
            <div class="chart-section">
              <div class="chart-box"><canvas id="favoritedBooksPieChart"></canvas></div>
              <div class="list-box">
                <ul class="list-group list-group-flush small">
                  @foreach ($mostFavoritedBooks as $book)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <span>{{ $book->judul }}</span>
                      <span class="badge bg-danger">{{ $book->total_favorites }} ❤️</span>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>

  <!-- 📚 Buku & Peminjaman -->
  <div class="row">
    <!-- Buku Terbaru -->
    <div class="col-md-6 mb-3">
      <div class="card shadow-sm border-0">
        <div class="card-header bg-light"><h6 class="mb-0 fw-semibold">Buku Terbaru</h6></div>
        <div class="card-body p-3">
          <div class="table-responsive">
            <table id="booksTable" class="table table-hover align-middle">
              <thead class="table-light">
                <tr>
                  <th>#</th><th>Cover</th><th>Judul</th><th>Penulis</th><th>Tahun</th><th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($latestBooks as $book)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><img src="{{ asset('img/' . ($book->cover ?: 'default.png')) }}" class="cover-thumb" alt=""></td>
                    <td>{{ $book->judul }}</td>
                    <td>{{ $book->penulis }}</td>
                    <td>{{ $book->tahun_terbit }}</td>
                    <td class="text-center">
                      <a href="{{ route('admin.buku.edit', $book->id) }}" class="btn btn-sm btn-warning">Edit</a>
                      <form action="{{ route('admin.buku.destroy', $book->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus buku ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr><td colspan="6" class="text-center text-muted py-3">Belum ada buku</td></tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Peminjaman Terbaru -->
    <div class="col-md-6 mb-3">
      <div class="card shadow-sm border-0">
        <div class="card-header bg-light"><h6 class="mb-0 fw-semibold">Peminjaman Terbaru</h6></div>
        <div class="card-body p-3">
          <div class="table-responsive">
            <table id="loansTable" class="table table-hover align-middle">
              <thead class="table-light">
                <tr><th>#</th><th>Buku</th><th>User</th><th>Tanggal</th></tr>
              </thead>
              <tbody>
                @forelse($latestLoans as $loan)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $loan->book->judul ?? '-' }}</td>
                    <td>{{ $loan->user->name ?? '-' }}</td>
                    <td>{{ $loan->loan_date ? \Carbon\Carbon::parse($loan->loan_date)->format('d M Y') : '' }}</td>
                  </tr>
                @empty
                  <tr><td colspan="4" class="text-center text-muted py-3">Belum ada peminjaman</td></tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- ⭐ Ulasan & Rating -->
  <div class="card shadow-sm mt-4 border-0">
    <div class="card-header bg-light d-flex justify-content-between align-items-center">
      <h6 class="mb-0 fw-semibold"> Ulasan & Rating Pengguna</h6>
      <small class="text-muted">Ulasan terbaru pengguna</small>
    </div>

    <div class="card-body">
      @if($reviews->isEmpty())
        <div class="text-center text-muted py-3">Belum ada ulasan pengguna.</div>
      @else
        <div class="row g-3">
          @foreach($reviews as $review)
            <div class="col-lg-3 col-md-4 col-sm-6">
              <div class="card h-100 shadow-sm border-0 d-flex flex-column justify-content-between">
                <img src="{{ asset('img/' . ($review->book->cover ?? 'default.png')) }}" 
                     class="card-img-top" 
                     alt="{{ $review->book->judul }}" 
                     style="height:160px; object-fit:cover; border-radius:0.5rem 0.5rem 0 0;">

                <div class="card-body pb-2">
                  <h6 class="fw-semibold text-truncate mb-1">{{ $review->book->judul }}</h6>
                  <small class="text-muted d-block mb-1">oleh {{ $review->user->name ?? 'Tidak diketahui' }}</small>
                  <div class="text-warning mb-2">
                    @for($i = 1; $i <= 5; $i++)
                      <i class="bi {{ $i <= $review->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                    @endfor
                  </div>
                  <p class="small text-secondary mb-2" style="min-height:40px;">{{ Str::limit($review->komentar, 80) }}</p>
                  <small class="text-muted d-block">{{ $review->created_at->format('d M Y') }}</small>
                </div>

                <div class="card-footer bg-transparent border-0 text-end">
                  <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus ulasan ini?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                      <i class="bi bi-trash"></i> Hapus
                    </button>
                  </form>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @endif
    </div>
  </div>
</div>

<!-- 🔧 Script -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  new DataTable('#booksTable',{pageLength:5,language:{search:"Cari Buku:"}});
  new DataTable('#loansTable',{pageLength:5,order:[[3,'desc']],language:{search:"Cari Peminjaman:"}});

  @if(!$mostBorrowedBooks->isEmpty())
  new Chart(document.getElementById('borrowedBooksPieChart'),{
    type:'pie',
    data:{labels:{!! json_encode($mostBorrowedBooks->pluck('judul')) !!},
      datasets:[{data:{!! json_encode($mostBorrowedBooks->pluck('total_loans')) !!},
      backgroundColor:['#4e79a7','#f28e2b','#e15759','#76b7b2','#59a14f','#edc949','#af7aa1','#ff9da7','#9c755f','#bab0ab']}]},
    options:{plugins:{legend:{position:'bottom'}}}});
  @endif

  @if(!$mostFavoritedBooks->isEmpty())
  new Chart(document.getElementById('favoritedBooksPieChart'),{
    type:'pie',
    data:{labels:{!! json_encode($mostFavoritedBooks->pluck('judul')) !!},
      datasets:[{data:{!! json_encode($mostFavoritedBooks->pluck('total_favorites')) !!},
      backgroundColor:['#e15759','#f28e2b','#4e79a7','#76b7b2','#59a14f','#edc949','#af7aa1','#ff9da7','#9c755f','#bab0ab']}]},
    options:{plugins:{legend:{position:'bottom'}}}});
  @endif
</script>
</body>
</html>
