<link rel="stylesheet" href="<?php echo e(asset('css/header.css')); ?>?v=<?php echo e(time()); ?>">
<header class="header">
    <div class="logo">
         <span class="fw-semibold fs-5 text-light">Aksaraloka</span>
    </div>
    <nav>
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="<?php echo e(Route::is('admin.dashboard') ? 'active' : ''); ?>">Beranda </a>
        <a href="<?php echo e(route('anggota.index')); ?>" class="<?php echo e(Route::is('anggota.index') ? 'active' : ''); ?>">Kelola Anggota</a>
        <a href="<?php echo e(route('admin.buku.create')); ?>" class="<?php echo e(Route::is('admin.buku.create') ? 'active' : ''); ?>">Tambah Buku</a>
        <a href="<?php echo e(route('admin.laporan')); ?>" class="<?php echo e(Route::is('admin.laporan') ? 'active' : ''); ?>">Laporan</a>
    </nav>
        <div>
            <form action="<?php echo e(route('logout')); ?>" method="POST">
                <?php echo csrf_field(); ?>
            <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
          </form>
        </div>
</header>
<?php /**PATH C:\laragon\www\perpustakaan\resources\views/layouts/header2.blade.php ENDPATH**/ ?>