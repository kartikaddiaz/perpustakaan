<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?php echo e($book->title); ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flipbook-css3@1.1.0/dist/flipbook.min.css">
  <style>
    body {
      background-color: #f4f4f4;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .flipbook {
      width: 90%;
      height: 90%;
      box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }
  </style>
</head>
<body>
  <div id="flipbook" class="flipbook">
    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div style="background-image:url('<?php echo e(asset($page)); ?>'); background-size: cover; background-position: center;"></div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/turn.js@4/turn.min.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const flipbook = document.getElementById("flipbook");
      if (flipbook) {
        $('#flipbook').turn({
          width: 900,
          height: 600,
          autoCenter: true,
        });
      }
    });
  </script>
</body>
</html>
<?php /**PATH C:\laragon\www\perpustakaan\resources\views/book/flipbook.blade.php ENDPATH**/ ?>