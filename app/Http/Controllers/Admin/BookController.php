<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'kode_buku' => 'required|unique:books,kode_buku|max:50',
            'judul' => 'required|string|max:255',
            'penulis' => 'nullable|string|max:255',
            'penerbit' => 'nullable|string|max:255',
            'tahun_terbit' => 'nullable|integer',
            'deskripsi' => 'nullable|string',
            'cover' => 'nullable|image|max:2048', // 2MB
            'pdf' => 'nullable|mimes:pdf|max:10240', // 10MB
        ]);

        $coverPath = $request->file('cover') ? $request->file('cover')->store('covers', 'public') : null;
        $pdfPath = $request->file('pdf') ? $request->file('pdf')->store('pdf', 'public') : null;

        Book::create([
            'kode_buku' => $request->kode_buku,
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun_terbit' => $request->tahun_terbit,
            'deskripsi' => $request->deskripsi,
            'cover' => $coverPath,
            'pdf_path' => $pdfPath,
        ]);

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil ditambahkan!');
    }
}
