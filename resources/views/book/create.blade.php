<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('layouts.header2')

<div class="container mt-4">
    <h2 class="mb-4">Tambah Buku</h2>

    {{-- Notifikasi error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<form action="{{ route('admin.buku.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label fw-semibold">Kode Buku</label>
            <input type="text" name="kode_buku" class="form-control" value="{{ old('kode_buku') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Judul Buku</label>
            <input type="text" name="judul" class="form-control" value="{{ old('judul') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Penulis</label>
            <input type="text" name="penulis" class="form-control" value="{{ old('penulis') }}">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Penerbit</label>
            <input type="text" name="penerbit" class="form-control" value="{{ old('penerbit') }}">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Tahun Terbit</label>
            <input type="number" name="tahun_terbit" class="form-control" value="{{ old('tahun_terbit') }}">
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Deskripsi Buku</label>
            <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Upload Cover</label>
            <input type="file" name="cover" class="form-control" accept="image/*">
            <small class="text-muted">Format: JPG, PNG. Max 2MB.</small>
        </div>

        <div class="mb-3">
            <label>File PDF Buku</label>
            <input type="file" name="pdf" class="form-control" accept="application/pdf">
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Simpan
            </button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
