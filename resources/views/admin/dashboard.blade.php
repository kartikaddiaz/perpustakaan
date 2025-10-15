<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/beranda-admin.css') }}?v={{ time() }}">
</head>
<body>
@include('layouts.header2')

<div class="container py-4">
    <h3>Beranda Admin</h3>
    <div class="row mb-4">
        <div class="col-md-3 mb-2">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Total Buku</h6>
                    <h3>{{ $totalBooks }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-2">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Total Pengguna</h6>
                    <h3>{{ $totalUsers }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-2">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Peminjaman Aktif</h6>
                    <h3>{{ $totalLoansActive }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-2">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted">Peminjaman Hari Ini</h6>
                    <h3>{{ $totalLoansToday }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Buku Paling Banyak Dipinjam</h6>
            <small class="text-muted">Top {{ $mostBorrowedBooks->count() }} buku</small>
        </div>
        <div class="card-body">
            @if($mostBorrowedBooks->isEmpty())
                <p class="text-muted text-center mb-0">Belum ada data peminjaman.</p>
            @else
                <div class="row align-items-center">
                    <div class="col-md-6 d-flex justify-content-center">
                        <div style="max-width: 300px; width:100%;">
                            <canvas id="borrowedBooksPieChart" height="220"></canvas>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <ul class="list-group list-group-flush">
                            @foreach ($mostBorrowedBooks as $book)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="fw-semibold">{{ $book->judul }}</span>
                                    <span class="badge bg-primary rounded-pill">{{ $book->total_loans }}x</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="mb-0">Buku Terbaru</h6>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table id="booksTable" class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Cover</th>
                                    <th>Judul</th>
                                    <th>Penulis</th>
                                    <th>Tahun</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latestBooks as $book)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if (!empty($book->cover))
                                                <img src="{{ asset('img/' . $book->cover) }}" alt="{{ $book->judul }}" class="cover-thumb">
                                            @else
                                                <img src="{{ asset('img/default.png') }}" alt="No Cover" class="cover-thumb">
                                            @endif
                                        </td>
                                        <td>{{ $book->judul }}</td>
                                        <td>{{ $book->penulis }}</td>
                                        <td>{{ $book->tahun_terbit }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.buku.edit', $book->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('admin.buku.destroy', $book->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus buku ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-3">Belum ada buku</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-light">
                    <h6 class="mb-0">Pengguna Baru</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse($latestUsers as $user)
                            <li class="list-group-item">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <div class="fw-semibold">{{ $user->name }}</div>
                                        <small class="text-muted">{{ $user->email }}</small>
                                    </div>
                                    <small class="text-muted">{{ $user->created_at?->format('d M Y') }}</small>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item text-center text-muted">Belum ada pengguna baru</li>
                        @endforelse
                    </ul>
                </div>
            </div>
            <div class="card shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="mb-0">Peminjaman Terbaru</h6>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table id="loansTable" class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Buku</th>
                                    <th>User</th>
                                    <th>Tanggal</th>
                                </tr>
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
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">Belum ada peminjaman</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Aktifkan DataTables
    new DataTable('#booksTable', {
        pageLength: 5,
        language: { search: "Cari Buku:" }
    });

    new DataTable('#loansTable', {
        pageLength: 5,
        order: [[3, 'desc']],
        language: { search: "Cari Peminjaman:" }
    });

    // Pie Chart
    @if(!$mostBorrowedBooks->isEmpty())
    const ctxPie = document.getElementById('borrowedBooksPieChart').getContext('2d');
    const pieLabels = {!! json_encode($mostBorrowedBooks->pluck('judul')) !!};
    const pieData = {!! json_encode($mostBorrowedBooks->pluck('total_loans')) !!};
    const pieColors = ['#4e79a7','#f28e2b','#e15759','#76b7b2','#59a14f','#edc949','#af7aa1','#ff9da7','#9c755f','#bab0ab'];

    new Chart(ctxPie, {
        type: 'pie',
        data: { labels: pieLabels, datasets: [{ data: pieData, backgroundColor: pieColors.slice(0, pieLabels.length), borderWidth: 2 }] },
        options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
    });
    @endif
</script>
</body>
</html>
