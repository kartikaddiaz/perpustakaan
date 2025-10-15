<link rel="stylesheet" href="<?php echo e(asset('css/header.css')); ?>?v=<?php echo e(time()); ?>">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<header class="header d-flex justify-content-between align-items-center px-4 py-2 shadow-sm">
    <div class="logo d-flex align-items-center gap-2">
        <span class="fw-semibold fs-5 text-light">Aksaraloka</span>
    </div>

    <div>
        <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-light d-flex align-items-center gap-2">
            <i class="bi bi-box-arrow-in-right"></i> Login
        </a>
    </div>
</header>
<?php /**PATH C:\laragon\www\perpustakaan\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>