<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="{{ asset('css/daftar-buku.css') }}" rel="stylesheet">
</head>
<body class="bg-light text-dark">

@include('layouts.header')

<div class="container mt-5 fade-in">
    <div class="d-flex align-items-center mb-4">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary me-3 back-btn">
            &lt;
        </a>
        <h3 class="mb-0 fw-bold">Daftar Buku</h3>
    </div>

    @if($books->isEmpty())
        <div class="alert alert-info text-center shadow-sm">Belum ada buku tersedia.</div>
    @else
        <div class="table-responsive shadow-sm rounded-4 overflow-hidden bg-white p-3">
            <table id="booksTable" class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Cover</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $b)
                    <tr class="fade-row">
                        <td>
                            <img src="{{ asset('img/' . basename($b->cover)) }}" 
                                 alt="{{ $b->judul }}" 
                                 class="book-cover">
                        </td>
                        <td class="fw-semibold">{{ $b->judul }}</td>
                        <td>{{ $b->penulis }}</td>
                        <td>{{ $b->penerbit }}</td>
                        <td>
                            {{ $b->category->nama ?? 'Tidak Ada' }}
                        </td>
                        <td>
                            @if($b->pdf_path)
                                <form action="{{ route('cart.add', $b->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-dark rounded-3 px-3">
                                        Pinjam Buku
                                    </button>
                                </form>
                            @else
                                <button type="button" class="btn btn-sm btn-secondary rounded-3 px-3" disabled title="File PDF belum diunggah">
                                    Tidak Tersedia
                                </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<!-- ✅ jQuery + Bootstrap JS + DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.bootstrap5.js"></script>

<script>
    new DataTable('#booksTable', {
        responsive: true,
        pageLength: 8,
        language: {
            search: "Cari Buku:",
            lengthMenu: "Tampilkan _MENU_ buku per halaman",
            info: "Menampilkan _START_–_END_ dari _TOTAL_ buku",
            paginate: {
                previous: "‹",
                next: "›"
            },
            zeroRecords: "Tidak ada buku yang cocok."
        }
    });
</script>

</body>
</html>
