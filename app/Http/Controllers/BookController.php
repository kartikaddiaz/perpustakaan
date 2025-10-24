<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function show($id)
    {
        $book = Book::findOrFail($id);
        $recommendedBooks = Book::inRandomOrder()->limit(4)->get();
        return view('book.show', compact('book', 'recommendedBooks'));
    }

    public function index()
    {
        $books = Book::all(); 
        $recommendedBooks = Book::inRandomOrder()->limit(4)->get();
        return view('loan.user.index', compact('books', 'recommendedBooks'));
    }

    public function userIndex()
    {
        $books = Book::all();
        $recommendedBooks = Book::inRandomOrder()->limit(4)->get();
        return view('loan.user.index', compact('books', 'recommendedBooks'));
    }

    public function create()
    {
        return view('book.create');
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
            'category_id' => 'required|exists:categories,id', 
        ]);

        $coverName = null;
        if ($request->hasFile('cover')) {
            $coverName = time() . '.' . $request->cover->extension();
            $request->cover->move(public_path('img'), $coverName);
        }

        $pdfPath = null;
        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('pdf', 'public');
        }

        Book::create([
            'kode_buku'   => $request->kode_buku,
            'judul'       => $request->judul,
            'penulis'     => $request->penulis,
            'penerbit'    => $request->penerbit,
            'tahun_terbit'=> $request->tahun_terbit,
            'deskripsi'   => $request->deskripsi,
            'cover'       => $coverName,
            'pdf_path'    => $pdfPath,
            'stok'        => 1,
        ]);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = \App\Models\Category::all(); // ambil semua kategori
        return view('book.edit', compact('book', 'categories'));
    }


    public function update(Request $request, $id)
{
    $book = Book::findOrFail($id);

    // 1️⃣ Validasi input
    $validated = $request->validate([
        'judul' => 'required|string|max:255',
        'penulis' => 'nullable|string|max:255',
        'penerbit' => 'nullable|string|max:255',
        'tahun_terbit' => 'nullable|integer',
        'deskripsi' => 'nullable|string',
        'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'pdf' => 'nullable|mimes:pdf|max:10240',
        'category_id' => 'required|exists:categories,id', // wajib sesuai kategori
    ]);

    // 2️⃣ Handle cover jika diupdate
    if ($request->hasFile('cover')) {
        // hapus cover lama
        if ($book->cover && file_exists(public_path('img/' . $book->cover))) {
            unlink(public_path('img/' . $book->cover));
        }
        $coverName = time() . '.' . $request->cover->extension();
        $request->cover->move(public_path('img'), $coverName);
        $validated['cover'] = $coverName;
    }

    // 3️⃣ Handle PDF jika diupdate
    if ($request->hasFile('pdf')) {
        // opsional: hapus PDF lama jika perlu
        $pdfPath = $request->file('pdf')->store('pdf', 'public');
        $validated['pdf_path'] = $pdfPath;
    }

    // 4️⃣ Update book dengan data tervalidasi
    $book->update($validated);

    return redirect()->route('admin.dashboard')
        ->with('success', 'Buku berhasil diperbarui!');
}

    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        if ($book->cover && file_exists(public_path('img/' . $book->cover))) {
            unlink(public_path('img/' . $book->cover));
        }

        $book->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Buku berhasil dihapus.');
    }

    public function readBook($id)
    {
        $book = Book::findOrFail($id);

        $loan = \App\Models\Loan::where('book_id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$loan) {
            abort(403, 'Anda tidak memiliki akses untuk membaca buku ini.');
        }

        $pdfPath = $book->pdf_path;

        if (!$pdfPath) {
            abort(404, 'File PDF belum diunggah untuk buku ini.');
        }

        $filePath = storage_path('app/public/' . $pdfPath);

        if (!file_exists($filePath)) {
            abort(404, 'File PDF tidak ditemukan di penyimpanan.');
        }

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
        $recommendedBooks = Book::inRandomOrder()->get();

        return view('user.dashboard', compact('books', 'categories', 'search', 'recommendedBooks'));
    }

    public function toggleFavorite($id)
    {
        $book = Book::findOrFail($id);

        $book->is_favorite = !$book->is_favorite;
        $book->save();

        return redirect()->back()->with('success', $book->is_favorite 
            ? '❤️ Buku ditambahkan ke daftar favorit kamu!' 
            : '💔 Buku dihapus dari daftar favorit kamu.');
    }

    public function favorites()
    {
        $favorites = Book::where('is_favorite', true)->get();
        return view('book.favorite', compact('favorites'));
    }
    public function createBuku()
    {
        $categories = \App\Models\Category::all();
        return view('book.create', compact('categories'));
    }

}
