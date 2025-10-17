<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use App\Models\Loan;
use App\Models\Favorite; // ⬅️ Tambahkan ini
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminController extends Controller
{
    /** -------------------------------
     * DASHBOARD
     * ------------------------------- */
    public function dashboard()
    {
        $totalBooks = Book::count();
        $totalUsers = User::count();
        $totalLoansActive = Loan::where('status', 'dipinjam')->count();
        $today = Carbon::today()->toDateString();
        $totalLoansToday = Loan::whereDate('loan_date', $today)->count();

        // 📚 Buku paling banyak dipinjam
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

        // ❤️ Buku paling banyak difavoritkan
        $mostFavoritedBooks = Favorite::select('book_id', DB::raw('COUNT(*) as total_favorites'))
            ->groupBy('book_id')
            ->orderByDesc('total_favorites')
            ->take(5)
            ->with('book')
            ->get()
            ->map(function ($favorite) {
                return (object)[
                    'id' => $favorite->book_id,
                    'judul' => $favorite->book->judul ?? 'Tidak diketahui',
                    'total_favorites' => (int)$favorite->total_favorites,
                ];
            });

        $latestBooks = Book::latest()->take(5)->get();
        $latestUsers = User::latest()->take(5)->get();
        $latestLoans = Loan::with(['book', 'user'])->latest()->take(5)->get();

        return view('admin.dashboard', [
            'totalBooks' => $totalBooks,
            'totalUsers' => $totalUsers,
            'totalLoansActive' => $totalLoansActive,
            'totalLoansToday' => $totalLoansToday,
            'mostBorrowedBooks' => $mostBorrowedBooks,
            'mostFavoritedBooks' => $mostFavoritedBooks, // ⬅️ kirim ke view
            'latestBooks' => $latestBooks,
            'latestUsers' => $latestUsers,
            'latestLoans' => $latestLoans,
        ]);
    }

    /** -------------------------------
     * KELOLA ANGGOTA
     * ------------------------------- */
    public function anggotaIndex(Request $request)
    {
        $search = $request->input('search');

        $users = User::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            })
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.anggota', compact('users'));
    }

    public function anggotaCreate()
    {
        return view('admin.anggota.create');
    }

    public function anggotaStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.anggota.index')->with('success', 'Anggota baru berhasil ditambahkan!');
    }

    public function anggotaEdit(User $anggota)
    {
        return view('admin.anggota.edit', compact('anggota'));
    }

    public function anggotaUpdate(Request $request, User $anggota)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $anggota->id,
            'password' => 'nullable|min:6',
        ]);

        $anggota->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
                ? Hash::make($request->password)
                : $anggota->password,
        ]);

        return redirect()->route('admin.anggota.index')->with('success', 'Data anggota berhasil diperbarui!');
    }

    public function anggotaDestroy(User $anggota)
    {
        $anggota->delete();
        return redirect()->route('admin.anggota.index')->with('success', 'Anggota berhasil dihapus!');
    }
}
