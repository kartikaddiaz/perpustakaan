<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Pengguna - Perpustakaan</title>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo e(asset('css/beranda-admin.css')); ?>">
</head>
<body class="bg-light text-dark">

  <?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <main class="fade-in">
    <!-- Carousel -->
    <div id="bookCarousel" class="carousel slide mb-5 shadow-lg rounded-4 overflow-hidden" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="<?php echo e(asset('img/book.jpeg')); ?>" class="d-block w-100" style="height: 420px; object-fit: cover;" alt="Slide 1">
          <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-3">
            <h3 class="text-white fw-bold">Selamat Datang di Perpustakaan Digital</h3>
            <p class="text-light">Temukan dan pinjam buku favoritmu dengan mudah!</p>
          </div>
        </div>
      </div>
    </div>

    <div class="container mt-4">
      <h3 class="text-center mb-4 fw-bold">Jelajahi Koleksi Buku</h3>

      <form method="GET" action="<?php echo e(route('user.dashboard')); ?>" class="mb-5">
        <div class="input-group shadow-sm search-box">
          <input type="text" name="search" class="form-control form-control-lg border-dark"
                 placeholder="Cari buku atau penulis..." value="<?php echo e($search ?? ''); ?>">
          <button class="btn btn-dark px-4" type="submit">Cari</button>
        </div>
      </form>

      <h5 class="fw-semibold mb-3 text-center">Pilih Kategori</h5>
      <div class="text-center mb-5 fade-in-delayed">
        <div class="d-flex flex-wrap justify-content-center gap-4">
          <?php $__currentLoopData = $categories->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('user.dashboard', ['category' => $category->id])); ?>" class="text-decoration-none">
              <div class="category-card">
                <p class="fw-semibold mb-0"><?php echo e($category->nama); ?></p>
              </div>
            </a>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          <a href="<?php echo e(route('user.dashboard')); ?>" class="text-decoration-none">
            <div class="category-card">
              <p class="fw-semibold mb-0 text-muted">Lainnya</p>
            </div>
          </a>
        </div>
      </div>

      <div class="mt-5 fade-in-delayed">
        <h4 class="fw-semibold mb-4 text-center">Yang Populer di Antara Koleksi Kami</h4>

        <div class="d-flex flex-nowrap overflow-auto pb-3 px-2" style="gap: 25px;">
          <?php $__empty_1 = true; $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="book-card">
              <img src="<?php echo e(asset('img/' . basename($book->cover))); ?>"
                   alt="<?php echo e($book->judul); ?>"
                   class="book-cover">
              <div class="card-body text-center p-3">
                <h6 class="fw-bold mb-1"><?php echo e($book->judul); ?></h6>
                <p class="text-muted small mb-2"><?php echo e($book->penulis); ?></p>
                <a href="<?php echo e(route('books.show', $book->id)); ?>" class="btn btn-outline-dark btn-sm px-3 py-1">
                  Lihat Buku
                </a>
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