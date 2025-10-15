<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    {{-- Header --}}
    @include('layouts.header')
    <h2>Loan Form</h2>

<form action="{{ route('loan.store') }}" method="POST">
    @csrf

    <p><strong>User:</strong> {{ $user->name }} (ID: {{ $user->id }})</p>

    <div>
        <label>Book:</label>
        <input type="hidden" name="book_id" value="{{ $book->id }}">
        <input type="hidden" name="book_name" value="{{ $book->judul }}">
    </div>

    <div class="mt-2">
        <label>Tanggal Pinjam:</label>
        <input type="date" name="loan_date" id="loan_date" class="form-control" required onchange="updateExpireDate()">
    </div>

    <div class="mt-2">
        <label>Tanggal Kadeluarsa:</label>
        <input type="text" name="return_date" id="return_date" class="form-control" readonly>
    </div>

    <button type="submit" class="btn btn-success mt-3">Pinjam</button>
</form>

<script>
    document.getElementById('tanggal_pinjam').addEventListener('change', function () {
        let tanggalPinjam = new Date(this.value);
        if (!isNaN(tanggalPinjam.getTime())) {
            tanggalPinjam.setDate(tanggalPinjam.getDate() + 7);
            let year = tanggalPinjam.getFullYear();
            let month = String(tanggalPinjam.getMonth() + 1).padStart(2, '0');
            let day = String(tanggalPinjam.getDate()).padStart(2, '0');
            document.getElementById('tanggal_kembali').value = `${year}-${month}-${day}`;
        }
    });
</script>
</body>
</html>