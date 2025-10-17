<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Perpustakaan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('css/login.css')); ?>" rel="stylesheet">
</head>

<body>
    <div class="header-shape"></div>

    <div class="auth-container">
        <h3><b>Lupa Password?</b></h3>
        <p>Masukkan email Anda dan kami akan kirimkan link untuk reset sandi.</p>

        <!-- Status sukses -->
        <?php if(session('status')): ?>
            <div class="alert alert-success py-2 px-3 mb-3 rounded">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>

        <!-- Pesan error -->
        <?php if($errors->any()): ?>
            <div class="error-msg">
                <ul style="margin:0; padding-left:18px;">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('password.email')); ?>">
            <?php echo csrf_field(); ?>

            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus>

            <button type="submit" class="btn-submit">Kirim Link Reset</button>
        </form>

        <p class="register-text mt-3">
            <a href="<?php echo e(route('login')); ?>">← Kembali ke Login</a>
        </p>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\perpustakaan\resources\views/auth/forgot-password.blade.php ENDPATH**/ ?>