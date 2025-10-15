<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Pengguna - Perpustakaan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo e(asset('css/dashboard.css')); ?>">
</head>
<body>

  <?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <main>
    <!-- Carousel -->
    <div id="bookCarousel" class="carousel slide mb-5 shadow-sm rounded-4 overflow-hidden" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="<?php echo e(asset('img/book.jpeg')); ?>" class="d-block w-100" style="height: 400px; object-fit: cover;" alt="Slide 1">
        </div>
      </div>
    </div>

    <div class="container mt-4">
      <h3 class="text-center mb-4 fw-bold">Jelajahi Koleksi Buku</h3>

      <form method="GET" action="<?php echo e(route('user.dashboard')); ?>" class="mb-5">
        <div class="input-group shadow-sm">
          <input type="text" name="search" class="form-control form-control-lg" placeholder="Cari buku atau penulis..." value="<?php echo e($search ?? ''); ?>">
          <button class="btn btn-dark" type="submit">Cari</button>
        </div>
      </form>

      <h5 class="fw-semibold mb-3 text-center">Pilih Kategori</h5>
      <div class="text-center mb-5">
        <div class="d-flex flex-wrap justify-content-center gap-4">
          <?php $__currentLoopData = $categories->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('user.dashboard', ['category' => $category->id])); ?>" class="text-decoration-none">
              <div class="card border-0 shadow-sm category-text-card d-flex align-items-center justify-content-center">
                <p class="fw-semibold text-dark mb-0"><?php echo e($category->nama); ?></p>
              </div>
            </a>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          <a href="<?php echo e(route('user.dashboard')); ?>" class="text-decoration-none">
            <div class="card border-0 shadow-sm category-text-card d-flex align-items-center justify-content-center">
              <p class="fw-semibold text-muted mb-0">Lainnya</p>
            </div>
          </a>
        </div>
      </div>

      <div class="mt-5">
        <h4 class="fw-semibold mb-4 text-center">Yang Populer di Antara Koleksi Kami</h4>

        <div class="d-flex flex-nowrap overflow-auto pb-3 px-2" style="gap: 25px;">
          <?php $__empty_1 = true; $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="card shadow-sm border-0"
                 style="min-width: 210px; max-width: 210px; flex: 0 0 auto; border-radius: 14px;">
              <img src="<?php echo e(asset('img/' . basename($book->cover))); ?>"
                   alt="<?php echo e($book->judul); ?>"
                   class="card-img-top"
                   style="height: 280px; object-fit: cover; border-top-left-radius: 14px; border-top-right-radius: 14px;">
              <div class="card-body text-center p-3">
                <h6 class="fw-bold mb-1" style="font-size: 1rem;"><?php echo e($book->judul); ?></h6>
                <p class="text-muted small mb-2"><?php echo e($book->penulis); ?></p>
                <a href="<?php echo e(route('books.show', $book->id)); ?>" class="btn btn-success btn-sm px-3 py-1">Lihat Buku</a>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center text-muted w-100">Tidak ada buku ditemukan.</div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </main>

  <?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\laragon\www\perpustakaan\resources\views/landing.blade.php ENDPATH**/ ?>