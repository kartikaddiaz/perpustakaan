<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    {{-- Header --}}
    @include('layouts.header2')

    <div class="container mt-4">
        <h2>Daftar Buku</h2>
        <a href="{{ route('book.create') }}" class="btn btn-primary mb-3">Tambah Buku</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($books as $b)
                <tr>
                    <td>{{ $b->kode_buku }}</td>
                    <td>{{ $b->judul }}</td>
                    <td>{{ $b->penulis }}</td>
                    <td>{{ $b->penerbit }}</td>
                    <td>{{ $b->tahun_terbit }}</td>
                    <td>{{ $b->stok }}</td>
                    <td>
                        <a href="{{ route('book.edit',$b->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('book.destroy',$b->id) }}" method="POST" class="d-inline">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin hapus?')" class="btn btn-sm btn-danger">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>    
</body>
</html>
