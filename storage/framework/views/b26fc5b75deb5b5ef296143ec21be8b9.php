<link rel="stylesheet" href="<?php echo e(asset('css/footer.css')); ?>?v=<?php echo e(time()); ?>">
  <footer class="bg-dark text-light mt-5 pt-5 pb-4">
    <div class="container">
      <div class="row align-items-stretch gy-4">
        
        <!-- Kolom Logo & Navigasi -->
        <div class="col-12 col-md-4 d-flex flex-column">
          <div class="mb-3 d-flex align-items-center">
            <h5 class="fw-bold mb-0">AksaraLoka</h5>
          </div>
          <ul class="list-unstyled flex-grow-1">
            <li><a href="#" class="text-decoration-none text-light-50 d-block mb-1">Beranda</a></li>
            <li><a href="#" class="text-decoration-none text-light-50 d-block mb-1">Koleksi</a></li>
            <li><a href="#" class="text-decoration-none text-light-50 d-block mb-1">Tentang Kami</a></li>
            <li><a href="#" class="text-decoration-none text-light-50 d-block">Kontak</a></li>
          </ul>
        </div>

        <!-- Kolom Tentang Kami -->
        <div class="col-12 col-md-4 d-flex flex-column justify-content-between">
          <div>
            <h5 class="fw-semibold mb-3">Tentang Kami</h5>
            <p class="text-light-50 small mb-0">
              <strong>AksaraLoka</strong> adalah sistem manajemen perpustakaan digital
              yang dirancang untuk memudahkan pustakawan dan pembaca menjelajahi dunia literasi secara modern.
              Dengan desain yang elegan dan fitur lengkap, kami menghadirkan pengalaman membaca yang efisien dan menyenangkan.
            </p>
          </div>
        </div>

        <!-- Kolom Cari Buku -->
        <div class="col-12 col-md-4 d-flex flex-column justify-content-between">
          <div>
            <h5 class="fw-semibold mb-3">Cari Buku</h5>
            <form class="d-flex flex-column flex-sm-row gap-2 mb-3">
              <input type="text" class="form-control" placeholder="Masukkan kata kunci...">
              <button class="btn btn-primary" type="submit">Cari</button>
            </form>
            <div class="d-flex flex-wrap gap-2">
              <a href="#" class="btn btn-success btn-sm flex-grow-1 flex-sm-grow-0">Donasi</a>
              <a href="#" class="btn btn-outline-light btn-sm flex-grow-1 flex-sm-grow-0">Bergabung</a>
            </div>
          </div>
        </div>

      </div>

      <hr class="border-secondary mt-4 mb-3">

      <div class="text-center small text-light-50">
        © 2025 — <span class="fw-semibold text-light">AksaraLoka Developer Community</span><br>
        Ditenagai oleh Laravel & Bootstrap 💡
      </div>
    </div>
  </footer><?php /**PATH C:\laragon\www\perpustakaan\resources\views/layouts/footer.blade.php ENDPATH**/ ?>