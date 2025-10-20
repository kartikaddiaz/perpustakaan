<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Models\Review;
use Carbon\Carbon;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $search = $request->input('search');

        // Ambil 5 buku populer pertama (sama kayak dashboard)
        $books = Book::take(5)->get();

        // Buku terbaru (7 hari terakhir)
        $newBooks = Book::where('created_at', '>=', Carbon::now()->subDays(7))
                        ->latest()
                        ->take(5)
                        ->get();

        // Review terbaru
        $reviews = Review::with(['book', 'user'])
                        ->latest()
                        ->take(5)
                        ->get();

        return view('landing', compact('books', 'newBooks', 'categories', 'reviews', 'search'));
    }
}
