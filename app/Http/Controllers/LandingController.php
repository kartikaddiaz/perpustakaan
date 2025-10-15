<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class LandingController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $search = $request->input('search');

        $books = Book::when($search, function ($query, $search) {
                return $query->where('judul', 'like', "%{$search}%")
                             ->orWhere('penulis', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        return view('landing', compact('categories', 'books', 'search'));
    }
}
