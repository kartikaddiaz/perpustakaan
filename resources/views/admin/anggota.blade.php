<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola Anggota</title>
  
  {{-- Bootstrap --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  {{-- DataTables CSS --}}
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">
</head>
<body>
@include('layouts.header2')

<div class="container py-4">
<div class="d-flex justify-content-between align-items-center mb-3">
    <div class="d-flex align-items-center">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary me-3">
            <
        </a>
        <h4 class="fw-semibold mb-0">Kelola Anggota</h4>
    </div>

    <a href="{{ route('anggota.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Anggota
    </a>
</div>


  {{-- Alert sukses --}}
  @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
  @endif

  {{-- Tabel anggota --}}
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
                          <th>Username</th>
                          <th>Tanggal Bergabung</th>
                          <th class="text-center">Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                      @forelse ($users as $user)
                          <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $user->name }}</td>
                              <td>{{ $user->email }}</td>
                              <td>{{ $user->username ?? '-' }}</td>
                              <td>{{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}</td>
                              <td class="text-center">
                                  <a href="{{ route('anggota.edit', $user->id) }}" class="btn btn-sm btn-warning me-1">
                                      <i class="bi bi-pencil"></i>
                                  </a>
                                  <form action="{{ route('anggota.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus anggota ini?')">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-sm btn-danger">
                                          <i class="bi bi-trash"></i>
                                      </button>
                                  </form>
                              </td>
                          </tr>
                      @empty
                          <tr>
                              <td colspan="6" class="text-center text-muted py-4">Belum ada anggota.</td>
                          </tr>
                      @endforelse
                  </tbody>
              </table>
          </div>
      </div>
  </div>
</div>

{{-- Scripts --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

{{-- DataTables JS --}}
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
