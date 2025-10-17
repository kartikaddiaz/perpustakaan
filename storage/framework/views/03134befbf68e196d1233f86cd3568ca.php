<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo e(asset('css/beranda-admin.css')); ?>?v=<?php echo e(time()); ?>">
</head>
<body>
<?php echo $__env->make('layouts.header2', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container mt-4">
    <div class="d-flex align-items-center mb-4">
      <h2 class="mb-0">Beranda Admin</h2>
    </div>

  <!-- Statistik Atas -->
  <div class="row mb-4">
    <?php $__currentLoopData = [['Total Buku', $totalBooks], ['Total Pengguna', $totalUsers], ['Peminjaman Aktif', $totalLoansActive], ['Peminjaman Hari Ini', $totalLoansToday]]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="col-md-3 mb-2">
        <div class="card text-center shadow-sm">
          <div class="card-body">
            <h6 class="text-muted"><?php echo e($stat[0]); ?></h6>
            <h3><?php echo e($stat[1]); ?></h3>
          </div>
        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>

  <div class="row mb-4">
  <!-- Buku Paling Banyak Dipinjam -->
  <div class="col-lg-6 col-md-12 mb-3">
    <div class="card shadow-sm border-0 h-100">
      <div class="card-header bg-light d-flex justify-content-between align-items-center">
        <h6 class="mb-0">Buku Paling Banyak Dipinjam</h6>
        <small class="text-muted">Top <?php echo e($mostBorrowedBooks->count()); ?> buku</small>
      </div>
      <div class="card-body">
        <?php if($mostBorrowedBooks->isEmpty()): ?>
          <p class="text-muted text-center mb-0">Belum ada data peminjaman.</p>
        <?php else: ?>
          <div class="chart-section">
            <div class="chart-box">
              <canvas id="borrowedBooksPieChart"></canvas>
            </div>
            <div class="list-box">
              <ul class="list-group list-group-flush">
                <?php $__currentLoopData = $mostBorrowedBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span class="fw-semibold"><?php echo e($book->judul); ?></span>
                    <span class="badge bg-primary rounded-pill"><?php echo e($book->total_loans); ?>x</span>
                  </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- Buku Paling Banyak Difavoritkan -->
  
  <div class="col-lg-6 col-md-12 mb-3">
    <div class="card shadow-sm border-0 h-100">
      <div class="card-header bg-light d-flex justify-content-between align-items-center">
        <h6 class="mb-0">Buku Paling Banyak Difavoritkan</h6>
        <small class="text-muted">Top <?php echo e($mostFavoritedBooks->count()); ?> buku</small>
      </div>
      <div class="card-body">
        <?php if($mostFavoritedBooks->isEmpty()): ?>
          <p class="text-muted text-center mb-0">Belum ada data favorit.</p>
        <?php else: ?>
          <div class="chart-section">
            <div class="chart-box">
              <canvas id="favoritedBooksPieChart"></canvas>
            </div>
            <div class="list-box">
              <ul class="list-group list-group-flush">
                <?php $__currentLoopData = $mostFavoritedBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span class="fw-semibold"><?php echo e($book->judul); ?></span>
                    <span class="badge bg-danger rounded-pill"><?php echo e($book->total_favorites); ?> ❤️</span>
                  </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

  <!-- Tabel Buku dan Pengguna -->
  <div class="row">
    <div class="col-md-6 mb-3">
      <div class="card shadow-sm">
        <div class="card-header bg-light">
          <h6 class="mb-0">Buku Terbaru</h6>
        </div>
        <div class="card-body p-3">
          <div class="table-responsive">
            <table id="booksTable" class="table table-hover align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th>#</th>
                  <th>Cover</th>
                  <th>Judul</th>
                  <th>Penulis</th>
                  <th>Tahun</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $latestBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                  <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td>
                      <img src="<?php echo e(asset('img/' . ($book->cover ?: 'default.png'))); ?>" alt="<?php echo e($book->judul); ?>" class="cover-thumb">
                    </td>
                    <td><?php echo e($book->judul); ?></td>
                    <td><?php echo e($book->penulis); ?></td>
                    <td><?php echo e($book->tahun_terbit); ?></td>
                    <td class="text-center">
                      <a href="<?php echo e(route('admin.buku.edit', $book->id)); ?>" class="btn btn-sm btn-warning">Edit</a>
                      <form action="<?php echo e(route('admin.buku.destroy', $book->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus buku ini?');">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                      </form>
                    </td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                  <tr><td colspan="6" class="text-center text-muted py-3">Belum ada buku</td></tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 mb-3">
      <div class="card shadow-sm mb-3">
        <div class="card-header bg-light"><h6 class="mb-0">Pengguna Baru</h6></div>
        <div class="card-body p-0">
          <ul class="list-group list-group-flush">
            <?php $__empty_1 = true; $__currentLoopData = $latestUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <li class="list-group-item">
                <div class="d-flex justify-content-between">
                  <div>
                    <div class="fw-semibold"><?php echo e($user->name); ?></div>
                    <small class="text-muted"><?php echo e($user->email); ?></small>
                  </div>
                  <small class="text-muted"><?php echo e($user->created_at?->format('d M Y')); ?></small>
                </div>
              </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <li class="list-group-item text-center text-muted">Belum ada pengguna baru</li>
            <?php endif; ?>
          </ul>
        </div>
      </div>

      <div class="card shadow-sm">
        <div class="card-header bg-light"><h6 class="mb-0">Peminjaman Terbaru</h6></div>
        <div class="card-body p-3">
          <div class="table-responsive">
            <table id="loansTable" class="table table-hover mb-0">
              <thead class="table-light">
                <tr>
                  <th>#</th>
                  <th>Buku</th>
                  <th>User</th>
                  <th>Tanggal</th>
                </tr>
              </thead>
              <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $latestLoans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                  <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($loan->book->judul ?? '-'); ?></td>
                    <td><?php echo e($loan->user->name ?? '-'); ?></td>
                    <td><?php echo e($loan->loan_date ? \Carbon\Carbon::parse($loan->loan_date)->format('d M Y') : ''); ?></td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                  <tr><td colspan="4" class="text-center text-muted">Belum ada peminjaman</td></tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Script -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  new DataTable('#booksTable',{pageLength:5,language:{search:"Cari Buku:"}});
  new DataTable('#loansTable',{pageLength:5,order:[[3,'desc']],language:{search:"Cari Peminjaman:"}});

  <?php if(!$mostBorrowedBooks->isEmpty()): ?>
  new Chart(document.getElementById('borrowedBooksPieChart'),{
    type:'pie',
    data:{labels:<?php echo json_encode($mostBorrowedBooks->pluck('judul')); ?>,
      datasets:[{data:<?php echo json_encode($mostBorrowedBooks->pluck('total_loans')); ?>,
      backgroundColor:['#4e79a7','#f28e2b','#e15759','#76b7b2','#59a14f','#edc949','#af7aa1','#ff9da7','#9c755f','#bab0ab'],borderWidth:2}]},
    options:{responsive:true,plugins:{legend:{position:'bottom'}}}});
  <?php endif; ?>

  <?php if(!$mostFavoritedBooks->isEmpty()): ?>
  new Chart(document.getElementById('favoritedBooksPieChart'),{
    type:'pie',
    data:{labels:<?php echo json_encode($mostFavoritedBooks->pluck('judul')); ?>,
      datasets:[{data:<?php echo json_encode($mostFavoritedBooks->pluck('total_favorites')); ?>,
      backgroundColor:['#e15759','#f28e2b','#4e79a7','#76b7b2','#59a14f','#edc949','#af7aa1','#ff9da7','#9c755f','#bab0ab'],borderWidth:2}]},
    options:{responsive:true,plugins:{legend:{position:'bottom'}}}});
  <?php endif; ?>
</script>
</body>
</html>
<?php /**PATH C:\laragon\www\perpustakaan\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>