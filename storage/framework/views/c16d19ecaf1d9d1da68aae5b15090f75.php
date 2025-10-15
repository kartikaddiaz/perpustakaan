<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="<?php echo e(asset('css/daftar-buku.css')); ?>" rel="stylesheet">
</head>
<body class="bg-light text-dark">

<?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container mt-5 fade-in">
    <div class="d-flex align-items-center mb-4">
      <a href="<?php echo e(url()->previous()); ?>" class="btn btn-outline-secondary me-3 back-btn">
        &lt;
      </a>
        <h3 class="mb-0 fw-bold">Daftar Buku</h3>
    </div>

    <?php if($books->isEmpty()): ?>
        <div class="alert alert-info text-center shadow-sm">Belum ada buku tersedia.</div>
    <?php else: ?>
        <div class="table-responsive shadow-sm rounded-4 overflow-hidden bg-white p-3">
            <table id="booksTable" class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Cover</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="fade-row">
                        <td>
                            <img src="<?php echo e(asset('img/' . basename($b->cover))); ?>" 
                                 alt="<?php echo e($b->judul); ?>" 
                                 class="book-cover">
                        </td>
                        <td class="fw-semibold"><?php echo e($b->judul); ?></td>
                        <td><?php echo e($b->penulis); ?></td>
                        <td><?php echo e($b->penerbit); ?></td>
                        <td>
                            <form action="<?php echo e(route('cart.add', $b->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-sm btn-dark rounded-3 px-3">
                                    Pinjam Buku
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<!-- ✅ jQuery + Bootstrap JS + DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.bootstrap5.js"></script>

<!-- ✅ Aktifkan DataTables -->
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
<?php /**PATH C:\laragon\www\perpustakaan\resources\views/loan/user/index.blade.php ENDPATH**/ ?>