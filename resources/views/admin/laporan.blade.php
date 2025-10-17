<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Peminjaman</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('css/laporan.css') }}?v={{ time() }}">
</head>

<body>
  @include('layouts.header2')

  <div class="container mt-4">
    <div class="d-flex align-items-center mb-4">
      <a href="{{ url()->previous() }}" class="btn btn-outline-secondary me-3">
        <i class="bi bi-arrow-left"></i>
      </a>
      <h2 class="mb-0">Laporan Peminjaman Terbaru</h2>
    </div>

    <div class="card-body">
      @if(!isset($latestLoans) || empty($latestLoans) || count($latestLoans) === 0)
        <p class="text-muted text-center mb-0">Belum ada data peminjaman.</p>
      @else
        <div class="table-responsive">
          <table id="loanTable" class="table table-striped table-bordered align-middle">
            <thead class="table-light">
              <tr>
                <th>#</th>
                <th>Nama Anggota</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kadeluarsa</th>
              </tr>
            </thead>
            <tbody>
              @foreach($latestLoans as $index => $loan)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $loan->user->name ?? '-' }}</td>
                <td>{{ $loan->book->judul ?? '-' }}</td>
                <td>{{ $loan->loan_date ? \Carbon\Carbon::parse($loan->loan_date)->format('d M Y') : '-' }}</td>
                <td>{{ $loan->return_date ? \Carbon\Carbon::parse($loan->return_date)->format('d M Y') : '-' }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

  <script>
    $(document).ready(function () {
      $('#loanTable').DataTable({
        "language": {
          "search": "Cari:",
          "lengthMenu": "Tampilkan _MENU_ data per halaman",
          "zeroRecords": "Tidak ditemukan data yang sesuai",
          "info": "Menampilkan _START_ - _END_ dari _TOTAL_ data",
          "infoEmpty": "Tidak ada data tersedia",
          "infoFiltered": "(difilter dari _MAX_ total data)",
          "paginate": {
            "first": "Awal",
            "last": "Akhir",
            "next": "›",
            "previous": "‹"
          }
        },
        "pageLength": 10,
        "order": [[3, "desc"]]
      });
    });
  </script>
</body>
</html>