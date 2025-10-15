<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout Peminjaman</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <form action="{{ route('cart.checkout') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="loan_date" class="form-label">Tanggal Pinjam</label>
        <input type="date" name="loan_date" id="loan_date" class="form-control" required onchange="updateExpireDate()">
    </div>

    <div class="mb-3">
        <label for="expire_date" class="form-label">Tanggal Kadaluarsa (7 Hari Setelah Pinjam)</label>
        <input type="date" name="expire_date" id="expire_date" class="form-control" readonly>
    </div>

    <ul class="list-group mb-3">
        @foreach($cart as $item)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                <strong>{{ $item->book->judul }}</strong><br>
                <small>{{ $item->book->penulis }} | {{ $item->book->penerbit }}</small>
            </div>
            <input type="hidden" name="book_ids[]" value="{{ $item->book->id }}">
            <input type="hidden" name="quantities[]" value="{{ $item->quantity }}">
        </li>
        @endforeach
    </ul>

    <button type="submit" class="btn btn-dark">Pinjam</button>
</form>

<script>
function updateExpireDate() {
    const loanDateInput = document.getElementById('loan_date');
    const expireDateInput = document.getElementById('expire_date');

    if (loanDateInput.value) {
        const loanDate = new Date(loanDateInput.value);
        loanDate.setDate(loanDate.getDate() + 7);
        expireDateInput.value = loanDate.toISOString().split('T')[0];
    }
}
</script>
</body>
</html>
