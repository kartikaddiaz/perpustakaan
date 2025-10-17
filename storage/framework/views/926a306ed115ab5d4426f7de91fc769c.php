<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title ?? 'Perpustakaan'); ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('css/login.css')); ?>" rel="stylesheet">
</head>

<body>
    <div class="header-shape"></div>

    <div class="auth-container">
        <?php echo e($slot); ?>

    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\perpustakaan\resources\views/layouts/guest.blade.php ENDPATH**/ ?>