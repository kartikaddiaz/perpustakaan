<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Riwayat Peminjaman</title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo e(asset('css/history.css')); ?>?v=<?php echo e(time()); ?>">
</head>
<body class="bg-light">

<?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container mt-4 fade-in-content">
    <div class="d-flex align-items-center mb-4">
        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-outline-secondary me-4">&lt;</a>
        <h3 class="mb-0 fw-semibold">Riwayat Peminjaman - <?php echo e(Auth::user()->name); ?></h3>
    </div>

    <?php
        use Carbon\Carbon;
        $loans = \App\Models\Loan::where('user_id', Auth::id())
            ->with('book')
            ->orderBy('created_at', 'desc')
            ->get();
    ?>

    <?php if($loans->isEmpty()): ?>
        <div class="alert alert-info text-center fade-in-element">
            Belum ada riwayat peminjaman.
        </div>
    <?php else: ?>

    <?php if(session('status')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('status')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

        <div class="table-responsive fade-in-element">
            <table id="loanHistory" class="table table-striped align-middle shadow-sm">
                <thead class="table-dark">
                    <tr>
                        <th>Cover</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Expired</th>
                        <th>Rating</th>
                        <th>Ulasan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <img src="<?php echo e(asset('img/' . basename($loan->book->cover ?? 'default.jpg'))); ?>" 
                                 alt="<?php echo e($loan->book_name ?? $loan->book->judul); ?>" 
                                 class="cover-img">
                        </td>
                        <td style="max-width: 200px;"><?php echo e($loan->book_name ?? $loan->book->judul); ?></td>
                        <td><?php echo e($loan->book->penulis ?? '-'); ?></td>
                        <td><?php echo e(Carbon::parse($loan->created_at)->translatedFormat('d F Y')); ?></td>
                        <td>
                            <?php if($loan->return_date): ?>
                                <?php echo e(Carbon::parse($loan->return_date)->translatedFormat('d F Y')); ?>

                            <?php else: ?>
                                <span class="text-muted">Belum ditentukan</span>
                            <?php endif; ?>
                        </td>

                        <!-- Rating -->
                        <td>
                            <form action="<?php echo e(route('loans.review.update', $loan->id)); ?>" method="POST" class="d-flex flex-column gap-1">
                                <?php echo csrf_field(); ?>
                                <div class="star-rating d-flex flex-row-reverse justify-content-end">
                                    <?php for($i = 5; $i >= 1; $i--): ?>
                                        <input type="radio" id="star<?php echo e($i); ?>-<?php echo e($loan->id); ?>" name="rating" value="<?php echo e($i); ?>" <?php echo e($loan->rating == $i ? 'checked' : ''); ?>>
                                        <label for="star<?php echo e($i); ?>-<?php echo e($loan->id); ?>">&#9733;</label>
                                    <?php endfor; ?>
                                </div>
                        </td>

                        <!-- Review -->
                        <td>
                            <textarea name="review" class="form-control review-textarea" rows="3" placeholder="Tulis ulasan..."><?php echo e($loan->review); ?></textarea>
                            <button type="submit" class="btn btn-dark mt-2 w-100">Simpan</button>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.bootstrap5.js"></script>
<script>
new DataTable('#loanHistory', {
    responsive: true,
    order: [[0, 'desc']],
    pageLength: 10,
    language: {
        search: "Cari Riwayat:",
        lengthMenu: "Tampilkan _MENU_ data per halaman",
        info: "Menampilkan _START_–_END_ dari _TOTAL_ riwayat",
        paginate: { previous: "‹", next: "›" },
        zeroRecords: "Tidak ada data ditemukan."
    }
});
</script>

</body>
</html>
<?php /**PATH C:\laragon\www\perpustakaan\resources\views/cart/history.blade.php ENDPATH**/ ?>