<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo e($book->judul); ?> - Detail Buku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <?php if(auth()->guard()->check()): ?>
    <?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <?php else: ?>
    <?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <?php endif; ?>

  <div class="container my-5">
    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
      <div class="row g-0">
        <div class="col-md-4">
          <img src="<?php echo e(asset('img/' . basename($book->cover))); ?>" class="img-fluid h-100 w-100" style="object-fit: cover;" alt="<?php echo e($book->judul); ?>">
        </div>
        <div class="col-md-8">
          <div class="card-body p-4">
            <h3 class="fw-bold mb-3"><?php echo e($book->judul); ?></h3>
            <p class="text-muted mb-2">✍️ Penulis: <strong><?php echo e($book->penulis); ?></strong></p>
            <p class="text-muted mb-2">🏢 Penerbit: <?php echo e($book->penerbit); ?></p>
            <p class="text-muted mb-3">📅 Tahun Terbit: <?php echo e($book->tahun_terbit); ?></p>
            <hr>
            <h5 class="fw-semibold mt-3">Deskripsi Buku</h5>
            <p class="mt-2" style="text-align: justify;">
              <?php echo e($book->deskripsi); ?>

            </p>

            <a href="<?php echo e(route('user.dashboard')); ?>" class="btn btn-outline-secondary mt-3">Kembali</a>
            <form action="<?php echo e(route('cart.add', $book->id)); ?>" method="POST" class="d-inline">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-success mt-3">Tambah ke Keranjang</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div> 

  <!-- 💡 Rekomendasi Buku -->
  <div class="mt-5">
    <h4 class="fw-semibold mb-4 text-center">Rekomendasi Buku Untukmu</h4>
    <div class="row row-cols-2 row-cols-md-4 g-4 justify-content-center">
      <?php $__currentLoopData = $recommendedBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recommended): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col" style="max-width: 220px;">
          <div class="card shadow-sm border-0 text-center" style="border-radius: 12px;">
            <img src="<?php echo e(asset('img/' . basename($recommended->cover))); ?>" 
                 alt="<?php echo e($recommended->judul); ?>" 
                 class="card-img-top mx-auto mt-3"
                 style="height: 200px; width: 140px; object-fit: cover; border-radius: 8px;">
            <div class="card-body p-3">
              <h6 class="fw-bold mb-1" style="font-size: 0.95rem;"><?php echo e($recommended->judul); ?></h6>
              <p class="text-muted small mb-2"><?php echo e($recommended->penulis); ?></p>
              <a href="<?php echo e(route('books.show', $recommended->id)); ?>" class="btn btn-success btn-sm px-3 py-1">Lihat Buku</a>
            </div>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>

  <?php echo $__env->make('layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\laragon\www\perpustakaan\resources\views/book/show.blade.php ENDPATH**/ ?>