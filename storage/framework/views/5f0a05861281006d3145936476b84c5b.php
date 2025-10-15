<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Keranjang Buku</title>
  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo e(asset('css/cart.css')); ?>?v=<?php echo e(time()); ?>">
</head>
<body class="bg-light">
  <?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <div class="container my-5 fade-in-content">
    <div class="d-flex align-items-center mb-4">
        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-outline-secondary me-3">
            ‹
        </a>
        <h3 class="fw-bold mb-0">Keranjang Buku</h3>
    </div>

    <?php if(session('success')): ?>
      <div class="alert alert-success fade-in-element">
        <?php echo e(session('success')); ?>

      </div>
    <?php endif; ?>

    <?php if($cart->isEmpty()): ?>
      <div class="alert alert-info text-center fade-in-element">
        Keranjang kamu masih kosong.
      </div>
    <?php else: ?>
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
            <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td>
                  <img src="<?php echo e(asset('img/' . basename($item->book->cover))); ?>" 
                       alt="<?php echo e($item->book->judul); ?>" 
                       class="book-cover">
                </td>
                <td class="fw-semibold"><?php echo e($item->book->judul); ?></td>
                <td><?php echo e($item->book->penulis); ?></td>
                <td><?php echo e($item->book->penerbit); ?></td>
                <td><?php echo e($item->book->tahun_terbit); ?></td>
                <td>
                  <form action="<?php echo e(route('cart.remove', $item->id)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button class="btn btn-danger btn-sm">Hapus</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>

      <form action="<?php echo e(route('cart.checkout')); ?>" method="POST" class="mt-4 fade-in-element">
        <?php echo csrf_field(); ?>
        <button type="submit" class="btn btn-success px-4 py-2 shadow-sm">
          Checkout Semua Buku
        </button>
      </form>
    <?php endif; ?>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\laragon\www\perpustakaan\resources\views/cart/index.blade.php ENDPATH**/ ?>