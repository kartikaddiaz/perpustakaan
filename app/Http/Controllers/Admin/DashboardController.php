<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use App\Models\Loan;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{

public function index()
{
    return view('admin.books.index', [
        'books' => Book::with('category')->latest()->get(),
        'totalBooks' => Book::count(),
        'totalCategories' => Category::count(),
        'totalLoans' => Loan::count(),
    ]);
}

}
