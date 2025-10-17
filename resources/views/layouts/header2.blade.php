<link rel="stylesheet" href="{{ asset('css/header.css') }}?v={{ time() }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<header class="header">
    <div class="logo">
         <span class="fw-semibold fs-5 text-light">Aksaraloka</span>
    </div>
    <nav>
        <a href="{{ route('admin.dashboard') }}" class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">Beranda </a>
        <a href="{{ route('anggota.index') }}" class="{{ Route::is('anggota.index') ? 'active' : '' }}">Kelola Anggota</a>
        <a href="{{ route('admin.buku.create') }}" class="{{ Route::is('admin.buku.create') ? 'active' : '' }}">Tambah Buku</a>
        <a href="{{ route('admin.laporan') }}" class="{{ Route::is('admin.laporan') ? 'active' : '' }}">Laporan</a>
    </nav>
        <div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
            <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
          </form>
        </div>
</header>
