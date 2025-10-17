<link rel="stylesheet" href="<?php echo e(asset('css/header.css')); ?>?v=<?php echo e(time()); ?>">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<header class="header d-flex justify-content-between align-items-center px-4">
    <div class="logo">
        <span class="fw-semibold fs-5 text-light">Aksaraloka</span>
    </div>

    <nav class="d-flex gap-4">
        <a href="<?php echo e(route('user.dashboard')); ?>" class="<?php echo e(Route::is('user.dashboard') ? 'active' : ''); ?>">Beranda</a>
        <a href="<?php echo e(route('user.books')); ?>" class="<?php echo e(Route::is('user.books') ? 'active' : ''); ?>">Daftar Buku</a>
        <a href="<?php echo e(route('book.mybooks')); ?>" class="<?php echo e(Route::is('book.mybooks') ? 'active' : ''); ?>">Buku Saya</a>
        <a href="<?php echo e(route('loan.user.history')); ?>" class="<?php echo e(Route::is('loan.user.history') ? 'active' : ''); ?>">Riwayat</a>
    </nav>

    <div class="icons d-flex align-items-center gap-3 text-white">
        <a href="<?php echo e(route('favorites.index')); ?>" class="<?php echo e(Route::is('favorites.index') ? 'active' : ''); ?>" 
        title="Buku Favorit">
            <i class="bi bi-heart-fill fs-5" style="color: #ff4d6d;"></i>
        </a>
        <a href="<?php echo e(route('cart.index')); ?>" class="<?php echo e(Route::is('cart.index') ? 'active' : ''); ?>" 
           title="Keranjang Buku">
            <i class="bi bi-cart4 fs-5"></i>
        </a>
        <form action="<?php echo e(route('logout')); ?>" method="POST" class="d-inline m-0 p-0">
            <?php echo csrf_field(); ?>
            <button type="submit" 
                    class="btn btn-link text-white text-decoration-none p-0 m-0 d-flex align-items-center gap-1" 
                    style="border: none;" 
                    title="Keluar">
                <i class="bi bi-box-arrow-right fs-5"></i> 
            </button>
        </form>
    </div>
</header>
<?php /**PATH C:\laragon\www\perpustakaan\resources\views/layouts/header.blade.php ENDPATH**/ ?>