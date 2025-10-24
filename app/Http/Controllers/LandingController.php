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
        $search = $request->input('search');

        $books = Book::when($search, function($query, $search) {
            $query->where('judul', 'like', "%{$search}%")
                ->orWhere('penulis', 'like', "%{$search}%");
        })->take(8)->get();

        $newBooks = Book::latest()->take(6)->get();
        $categories = Category::all();
        $reviews = Review::with(['book', 'user'])->latest()->take(10)->get();

        return view('landing', compact('books', 'newBooks', 'categories', 'reviews', 'search'));
    }

}
