<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function show($id)
    {
        $book = Book::findOrFail($id);
        $recommendedBooks = Book::inRandomOrder()->limit(4)->get(); // Tambah ini juga
        return view('book.show', compact('book', 'recommendedBooks'));
    }

    public function index()
    {
        $books = Book::all(); 
        $recommendedBooks = Book::inRandomOrder()->limit(4)->get(); // Tambah ini juga
        return view('loan.user.index', compact('books', 'recommendedBooks'));
    }

    public function create()
    {
        return view('book.create');
    }

    public function userIndex()
    {
        $books = Book::all();
        $recommendedBooks = Book::inRandomOrder()->limit(4)->get(); // Tambah ini juga
        return view('loan.user.index', compact('books', 'recommendedBooks'));
    }

    public function store(Request $request)
{
    $request->validate([
        'kode_buku' => 'required|unique:books,kode_buku|max:50',
        'judul' => 'required|string|max:255',
        'penulis' => 'nullable|string|max:255',
        'penerbit' => 'nullable|string|max:255',
        'tahun_terbit' => 'nullable|integer',
        'deskripsi' => 'nullable|string',
        'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'pdf' => 'nullable|mimes:pdf|max:10240',
    ]);

    if ($request->hasFile('cover')) {
        $coverName = time() . '.' . $request->cover->extension();
        $request->cover->move(public_path('img'), $coverName);
        $validated['cover'] = $coverName;
    }

    // Upload PDF
    $pdfPath = null;
    if ($request->hasFile('pdf')) {
        $pdfPath = $request->file('pdf')->store('pdf', 'public');
    }

    // Simpan ke database
    \App\Models\Book::create([
        'kode_buku'   => $request->kode_buku,
        'judul'       => $request->judul,
        'penulis'     => $request->penulis,
        'penerbit'    => $request->penerbit,
        'tahun_terbit'=> $request->tahun_terbit,
        'deskripsi'   => $request->deskripsi,
        'cover'       => $coverName,
        'pdf_path'    => $pdfPath, // 🟢 SIMPAN KE KOLOM pdf_path
        'stok'        => 1,
    ]);

    return redirect()->route('admin.dashboard')
        ->with('success', 'Buku berhasil ditambahkan!');
}

    public function edit(Book $book)
    {
        return view('books.edit', ['book' => $book]);
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'kode_buku' => 'required|unique:books,kode_buku,'.$book->id,
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|digits:4|integer',
            'stok' => 'required|integer|min:0',
        ]);

        $book->update($request->only(['kode_buku','judul','penulis','penerbit','tahun_terbit','stok']));

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil diperbarui');
    }

    public function destroy($id)
{
    $book = Book::findOrFail($id);

    // Hapus cover lama jika ada
    if ($book->cover && file_exists(public_path('img/' . $book->cover))) {
        unlink(public_path('img/' . $book->cover));
    }

    $book->delete();

    return redirect()->route('admin.dashboard')->with('success', 'Buku berhasil dihapus.');
}


   public function readBook($id)
{
    $book = \App\Models\Book::findOrFail($id);

    // Pastikan user memang meminjam buku ini
    $loan = \App\Models\Loan::where('book_id', $id)
        ->where('user_id', \Illuminate\Support\Facades\Auth::id())
        ->first();

    if (!$loan) {
        abort(403, 'Anda tidak memiliki akses untuk membaca buku ini.');
    }

    // Ambil path PDF dari kolom pdf_path
    $pdfPath = $book->pdf_path;

    if (!$pdfPath) {
        abort(404, 'File PDF belum diunggah untuk buku ini.');
    }

    $filePath = storage_path('app/public/' . $pdfPath);

    if (!file_exists($filePath)) {
        abort(404, 'File PDF tidak ditemukan di penyimpanan.');
    }

    // Tampilkan PDF langsung di browser
    return response()->file($filePath, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="' . $book->judul . '.pdf"',
    ]);
}

    public function dashboard(Request $request)
{
    $search = $request->input('search');
    $categoryId = $request->input('category');

    $books = Book::when($search, function ($query, $search) {
        return $query->where('judul', 'like', "%{$search}%")
                    ->orWhere('penulis', 'like', "%{$search}%");
    })->when($categoryId, function ($query, $categoryId) {
        return $query->where('category_id', $categoryId);
    })->get();

    $categories = Category::all();
    
    // 👉 Tambahkan ini
    $recommendedBooks = Book::inRandomOrder()->get();

    return view('user.dashboard', compact('books', 'categories', 'search', 'recommendedBooks'));
}


}