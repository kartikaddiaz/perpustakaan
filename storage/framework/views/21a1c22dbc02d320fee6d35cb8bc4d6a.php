<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="<?php echo e(asset('css/laporan.css')); ?>?v=<?php echo e(time()); ?>">
</head>

<body>
    <?php echo $__env->make('layouts.header2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="container mt-4">
        <h2 class="mb-4">Tambah Buku</h2>

        
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($e); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('admin.buku.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div class="mb-3">
                <label class="form-label">Kode Buku</label>
                <input type="text" name="kode_buku" class="form-control" value="<?php echo e(old('kode_buku')); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Judul Buku</label>
                <input type="text" name="judul" class="form-control" value="<?php echo e(old('judul')); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Penulis</label>
                <input type="text" name="penulis" class="form-control" value="<?php echo e(old('penulis')); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Penerbit</label>
                <input type="text" name="penerbit" class="form-control" value="<?php echo e(old('penerbit')); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Tahun Terbit</label>
                <input type="number" name="tahun_terbit" class="form-control" value="<?php echo e(old('tahun_terbit')); ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi Buku</label>
                <textarea name="deskripsi" class="form-control" rows="4"><?php echo e(old('deskripsi')); ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Upload Cover</label>
                <input type="file" name="cover" class="form-control" accept="image/*">
                <small class="text-muted">Format: JPG, PNG. Max 2MB.</small>
            </div>

            <div class="mb-3">
                <label class="form-label">File PDF Buku</label>
                <input type="file" name="pdf" class="form-control" accept="application/pdf">
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\laragon\www\perpustakaan\resources\views/book/create.blade.php ENDPATH**/ ?>