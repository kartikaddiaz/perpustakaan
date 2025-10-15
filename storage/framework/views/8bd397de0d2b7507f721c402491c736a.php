<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buku Saya</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link href="<?php echo e(asset('css/mybooks.css')); ?>" rel="stylesheet">
</head>

<body>
  <?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <div class="container mt-5 mb-5 fade-in">
    <div class="d-flex align-items-center mb-4">
      <a href="<?php echo e(url()->previous()); ?>" class="btn btn-outline-secondary me-3 back-btn">
        &lt;
      </a>
      <h3 class="mb-0 fw-semibold">Buku Saya</h3>
    </div>

    <?php if($loans->isEmpty()): ?>
        <div class="alert alert-info text-center shadow-sm rounded-3 fade-in-delayed">
          Kamu belum menambahkan buku ke koleksi.
        </div>
    <?php else: ?>
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
              <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $expiredDate = \Carbon\Carbon::parse($loan->created_at)->addDays(7)->format('d M Y');
                ?>
                <tr class="row-hover">
                  <td>
                    <img src="<?php echo e(asset('img/' . basename($loan->book->cover))); ?>" 
                         alt="<?php echo e($loan->book->judul); ?>" 
                         class="book-cover">
                  </td>
                  <td class="fw-medium"><?php echo e($loan->book->judul); ?></td>
                  <td><?php echo e($loan->book->penulis); ?></td>
                  <td class="text-danger fw-semibold"><?php echo e($expiredDate); ?></td>
                  <td>
                    <a href="<?php echo e(route('books.read', $loan->book->id)); ?>" 
                      class="btn btn-sm btn-dark px-3 py-1 read-btn" target="_blank">
                      Baca Buku
                    </a>
                  </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
        </div>
    <?php endif; ?>
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
<?php /**PATH C:\laragon\www\perpustakaan\resources\views/book/mybooks.blade.php ENDPATH**/ ?>