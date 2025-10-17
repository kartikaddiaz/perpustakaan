<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola Anggota</title>
  
  <link rel="stylesheet" href="<?php echo e(asset('css/anggota.css')); ?>?v=<?php echo e(time()); ?>">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
  <?php echo $__env->make('layouts.header2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <!-- 🌟 hanya bagian ini yang animasi -->
  <div class="page-content">
    <div class="container py-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="d-flex align-items-center">
          <a href="<?php echo e(url()->previous()); ?>" class="btn btn-outline-secondary me-3">
            <i class="bi bi-arrow-left"></i>
          </a>
          <h4 class="fw-semibold mb-0">Kelola Anggota</h4>
        </div>

        <a href="<?php echo e(route('anggota.create')); ?>" class="btn btn-primary">
          <i class="bi bi-plus-circle me-1"></i> Tambah Anggota
        </a>
      </div>

      
      <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <?php echo e(session('success')); ?>

          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      <?php endif; ?>

      
      <div class="card shadow-sm border-0">
        <div class="card-header bg-light">
          <h6 class="mb-0">Daftar Anggota</h6>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive p-3">
            <table id="anggotaTable" class="table table-striped table-hover align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th>#</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Tanggal Bergabung</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                  <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($user->name); ?></td>
                    <td><?php echo e($user->email); ?></td>
                    <td><?php echo e($user->created_at ? $user->created_at->format('d M Y') : '-'); ?></td>
                    <td class="text-center">
                    <a href="<?php echo e(route('anggota.edit', $user->id)); ?>" class="btn btn-sm btn-warning me-1">
                        <i class="bi bi-pencil"></i>
                    </a>

                    <form action="<?php echo e(route('anggota.destroy', $user->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Hapus anggota ini?')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-sm btn-danger me-1">
                        <i class="bi bi-trash"></i>
                        </button>
                    </form>

                    <form action="<?php echo e(route('anggota.ban', $user->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('<?php echo e($user->is_banned ? 'Aktifkan kembali akun ini?' : 'Blokir akun ini?'); ?>')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        <?php if($user->is_banned): ?>
                        <button type="submit" class="btn btn-sm btn-success">
                            <i class="bi bi-unlock"></i>
                        </button>
                        <?php else: ?>
                        <button type="submit" class="btn btn-sm btn-secondary">
                            <i class="bi bi-lock"></i>
                        </button>
                        <?php endif; ?>
                    </form>
                </td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                  <tr>
                    <td colspan="6" class="text-center text-muted py-4">Belum ada anggota.</td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

  <script>
    $(document).ready(function () {
      $('#anggotaTable').DataTable({
        language: {
          url: '//cdn.datatables.net/plug-ins/1.13.5/i18n/id.json'
        },
        pageLength: 10,
        lengthChange: false,
        ordering: true
      });
    });
  </script>
</body>
</html>
<?php /**PATH C:\laragon\www\perpustakaan\resources\views/admin/anggota.blade.php ENDPATH**/ ?>