<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php echo $__env->make('layouts.header2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container mt-4">
    <h2 class="mb-4">Edit Buku</h2>

    
    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($e); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    
    <form action="<?php echo e(route('book.update', $book->id)); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

        <div class="mb-3">
            <label class="form-label fw-semibold">Kode Buku</label>
            <input type="text" name="kode_buku" class="form-control" value="<?php echo e(old('kode_buku', $book->kode_buku)); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Judul Buku</label>
            <input type="text" name="judul" class="form-control" value="<?php echo e(old('judul', $book->judul)); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Penulis</label>
            <input type="text" name="penulis" class="form-control" value="<?php echo e(old('penulis', $book->penulis)); ?>">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Penerbit</label>
            <input type="text" name="penerbit" class="form-control" value="<?php echo e(old('penerbit', $book->penerbit)); ?>">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Tahun Terbit</label>
            <input type="number" name="tahun_terbit" class="form-control" value="<?php echo e(old('tahun_terbit', $book->tahun_terbit)); ?>">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Deskripsi Buku</label>
            <textarea name="deskripsi" class="form-control" rows="4"><?php echo e(old('deskripsi', $book->deskripsi)); ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Cover Saat Ini</label><br>
            <?php if($book->cover): ?>
                <img src="<?php echo e(asset('img/' . $book->cover)); ?>" alt="<?php echo e($book->judul); ?>" class="img-thumbnail mb-2" width="120">
            <?php else: ?>
                <p class="text-muted">Belum ada cover</p>
            <?php endif; ?>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Ganti Cover (opsional)</label>
            <input type="file" name="cover" class="form-control" accept="image/*">
            <small class="text-muted">Format: JPG, PNG. Max 2MB.</small>
        </div>

        <div class="mb-3">
    <label>File PDF Buku (opsional)</label>
    <input type="file" name="pdf" class="form-control" accept="application/pdf">
    <?php if($book->pdf_path): ?>
        <small class="d-block mt-1">File saat ini: 
            <a href="<?php echo e(asset('storage/pdf/' . $book->pdf_path)); ?>" target="_blank">
                <?php echo e($book->pdf_path); ?>

            </a>
        </small>
    <?php endif; ?>
</div>


        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-save"></i> Update Buku
            </button>
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\laragon\www\perpustakaan\resources\views/book/edit.blade.php ENDPATH**/ ?>