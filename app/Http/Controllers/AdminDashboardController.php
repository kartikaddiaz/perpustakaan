<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
{
    // Data utama
    $totalBooks = Book::count();
    $totalUsers = User::count();
    $totalLoans = Loan::count();

    // Buku paling sering dipinjam
    $mostBorrowedBooks = Loan::select('book_id', DB::raw('COUNT(*) as total_loans'))
        ->groupBy('book_id')
        ->orderByDesc('total_loans')
        ->take(5)
        ->with('book')
        ->get()
        ->map(function($loan) {
            return (object)[
                'judul' => $loan->book->judul ?? 'Tidak diketahui',
                'total_loans' => $loan->total_loans,
            ];
        });

    $maxLoans = $mostBorrowedBooks->max('total_loans') ?? 0;

    // Buku terbaru
    $latestBooks = Book::latest()->take(5)->get();

    return view('admin.dashboard', compact(
        'totalBooks', 'totalUsers', 'totalLoans',
        'mostBorrowedBooks', 'maxLoans', 'latestBooks'
    ));
}
}
