<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Perpustakaan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('css/login.css')); ?>" rel="stylesheet">
</head>
<body>
    <div class="header-shape"></div>

    <div class="auth-container">
        <h2><b>Selamat Datang!</b></h2>
        <p>Masuk ke akun Anda</p>

        <?php if($errors->any()): ?>
            <div class="error-msg">
                <ul style="margin:0; padding-left:18px;">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus autocomplete="email">

            <label for="password">Sandi</label>
            <input type="password" id="password" name="password" required autocomplete="current-password">

            <div class="d-flex justify-content-between align-items-center mt-2">
                <div class="remember-forgot">
                <label class="remember-me">
                    <input type="checkbox" name="remember"> Ingat saya
                </label>
            </div>
                <a href="<?php echo e(route('password.request')); ?>" class="forgot-password">Lupa sandi?</a>
            </div>

            <button type="submit" class="btn-submit mt-3">MASUK</button>
        </form>

        <p class="register-text">
            Belum punya akun?
            <a href="<?php echo e(route('register')); ?>">Daftar di sini</a>
        </p>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\perpustakaan\resources\views/auth/login.blade.php ENDPATH**/ ?>