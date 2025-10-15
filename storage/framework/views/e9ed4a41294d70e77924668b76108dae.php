<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Perpustakaan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('css/login.css')); ?>" rel="stylesheet">
</head>
<body>
    <div class="auth-container">
        <h1>Login Admin</h1>
        <p>Masuk ke akun admin Anda</p>

        <?php if($errors->any()): ?>
            <div class="error-msg">
                <ul style="margin:0; padding-left:18px;">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('admin.login.submit')); ?>">
            <?php echo csrf_field(); ?>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required autofocus>

            <label for="password">Sandi</label>
            <input type="password" name="password" id="password" required>

            <div class="remember-me">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Ingat saya</label>
            </div>

            <button type="submit" class="btn-submit">MASUK</button>
        </form>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\perpustakaan\resources\views/auth/login-admin.blade.php ENDPATH**/ ?>