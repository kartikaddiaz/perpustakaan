<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use App\Models\Loan;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Statistik utama
        $totalBooks = Book::count();
        $totalUsers = User::count();
        // Peminjaman aktif = yang status = 'dipinjam'
        $totalLoansActive = Loan::where('status', 'dipinjam')->count();
        // Peminjaman hari ini (loan_date == today)
        $today = Carbon::today()->toDateString();
        $totalLoansToday = Loan::whereDate('loan_date', $today)->count();

        // Top 5 buku paling sering dipinjam
        $mostBorrowedBooks = Loan::select('book_id', DB::raw('COUNT(*) as total_loans'))
            ->groupBy('book_id')
            ->orderByDesc('total_loans')
            ->take(5)
            ->with('book')
            ->get()
            ->map(function ($loan) {
                return (object)[
                    'id' => $loan->book_id,
                    'judul' => $loan->book->judul ?? 'Tidak diketahui',
                    'total_loans' => (int)$loan->total_loans,
                ];
            });

        // Data untuk chart garis: peminjaman per bulan (6 bulan terakhir)
        $months = collect();
        $counts = collect();
        for ($i = 5; $i >= 0; $i--) {
            $dt = Carbon::now()->subMonths($i);
            $months->push($dt->format('M Y')); // label
            $start = $dt->copy()->startOfMonth()->toDateString();
            $end   = $dt->copy()->endOfMonth()->toDateString();
            $count = Loan::whereBetween('loan_date', [$start, $end])->count();
            $counts->push($count);
        }

        // Buku terbaru (5)
        $latestBooks = Book::latest()->take(5)->get();

        // Pengguna baru (5 terakhir)
        $latestUsers = User::latest()->take(5)->get();

        // Peminjaman terbaru (5 terakhir) with book & user
        $latestLoans = Loan::with(['book', 'user'])->latest()->take(5)->get();

        return view('admin.dashboard', [
            'totalBooks' => $totalBooks,
            'totalUsers' => $totalUsers,
            'totalLoansActive' => $totalLoansActive,
            'totalLoansToday' => $totalLoansToday,
            'mostBorrowedBooks' => $mostBorrowedBooks,
            'monthsLabels' => $months,
            'monthsCounts' => $counts,
            'latestBooks' => $latestBooks,
            'latestUsers' => $latestUsers,
            'latestLoans' => $latestLoans,
        ]);
    }
}
