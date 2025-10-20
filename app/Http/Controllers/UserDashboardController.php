<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Loan;
use App\Models\Category;
use App\Models\Review;
use Carbon\Carbon;

class UserDashboardController extends Controller
{
    /**
     * Halaman dashboard utama user
     */
    public function dashboard(Request $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('category');

        $query = Book::query();

        // 🔍 Filter pencarian buku
        if ($search) {
            $query->where('judul', 'like', "%{$search}%")
                  ->orWhere('penulis', 'like', "%{$search}%");
        }

        // 🎯 Filter berdasarkan kategori
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        // 📚 Buku populer (dibatasi 5 aja)
        $books = $query->take(5)->get();

        // 🆕 Buku terbaru (7 hari terakhir)
        $newBooks = Book::where('created_at', '>=', Carbon::now()->subDays(7))
                        ->latest()
                        ->get();

        // 💬 Ambil semua review untuk ditampilkan di dashboard (bukan hanya user login)
        $reviews = Review::with(['book', 'user'])
            ->latest()
            ->get();

        // 📦 Kategori
        $categories = Category::all();

        return view('dashboard', compact('books', 'categories', 'search', 'reviews', 'newBooks'));
    }

    /**
     * Menampilkan daftar buku untuk dipinjam user
     */
    public function books()
    {
        $books = Book::all();
        return view('loan.user.index', compact('books'));
    }

    /**
     * Menampilkan detail satu buku
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        $recommendedBooks = Book::where('id', '!=', $id)->get();
        return view('books.show', compact('book', 'recommendedBooks'));
    }

    /**
     * Halaman landing (umum)
     */
    public function landing()
    {
        $books = Book::latest()->get();
        return view('landing', compact('books'));
    }

    /**
     * Halaman ulasan & rating pengguna (semua user terlihat)
     */
    public function myReviews()
    {
        $reviews = Review::with(['book', 'user'])
            ->latest()
            ->get();

        return view('user.reviews', compact('reviews'));
    }

    /**
     * Halaman admin untuk melihat semua review dari loans
     */
    public function showReviews()
    {
        $reviews = Loan::with(['book', 'user'])
            ->whereNotNull('rating')
            ->whereNotNull('review')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.reviews', compact('reviews'));
    }

    /**
     * Halaman umum semua review (jika dipisah dari dashboard)
     */
    public function reviews()
    {
        $reviews = Review::with(['user', 'book'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('reviews.index', compact('reviews'));
    }
    
}

