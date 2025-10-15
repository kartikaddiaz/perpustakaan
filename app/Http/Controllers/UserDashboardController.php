<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Loan;
use App\Models\Category;

class UserDashboardController extends Controller
{
   public function dashboard(Request $request)
    {
        $search = $request->input('search');
        $categoryId = $request->input('category');

        $query = Book::query();

        if ($search) {
            $query->where('judul', 'like', "%{$search}%")
                  ->orWhere('penulis', 'like', "%{$search}%");
        }

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $books = $query->take(10)->get();
        $categories = Category::all();

        return view('dashboard', compact('books', 'categories', 'search'));
    }


    public function books()
    {
        $books = Book::all();
        return view('loan.user.index', compact('books'));
    }

public function show($id)
{
    $book = Book::findOrFail($id);
    $recommendedBooks = Book::where('id', '!=', $id)->get(); // tampilkan semua selain buku yang sedang dilihat

    return view('books.show', compact('book', 'recommendedBooks'));
}

public function landing()
{
    // Ini halaman khusus setelah login
    $books = Book::latest()->get();
    return view('landing', compact('books'));
}
}
