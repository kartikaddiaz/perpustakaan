<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Loan;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    /**
     * Form pinjam buku
     */
    public function create($book_id)
    {
        $book = Book::findOrFail($book_id);
        return view('loan.user.history', compact('book'));
    }

    /**
     * Simpan peminjaman
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $book = Book::findOrFail($request->book_id);

        Loan::create([
            'user_id'   => Auth::id(),
            'book_id'   => $book->id,
            'book_name' => $book->judul,
            'loan_date' => now(),
            'cover'     => $book->cover,
            'status'    => 'Dipinjam',
        ]);

        return redirect()->back()->with('success', 'Buku berhasil dipinjam!');
    }

    /**
     * History peminjaman user
     */
    public function historyUser()
    {
        $loans = Loan::where('user_id', Auth::id())->with('book')->get();
        return view('loan.user.history', compact('loans'));
    }

    /**
     * Semua peminjaman user
     */
    public function index()
    {
        $loans = Loan::with('book')->where('user_id', Auth::id())->get();
        return view('loans.index', compact('loans'));
    }

    /**
     * Buku yang sedang dipinjam user
     * (otomatis hapus setelah 7 hari)
     */
    public function myBooks()
    {
        $userId = Auth::id();

        // 🔹 Hapus otomatis pinjaman yang sudah lebih dari 7 hari
        Loan::where('user_id', $userId)
            ->where('created_at', '<', Carbon::now()->subDays(7))
            ->delete();

        // 🔹 Ambil pinjaman aktif milik user setelah yang expired dihapus
        $loans = Loan::where('user_id', $userId)
            ->with('book')
            ->get();

        return view('book.mybooks', compact('loans'));
    }

    /**
     * Baca buku PDF langsung dari storage
     */
    public function readBook($id)
    {
        $book = Book::findOrFail($id);

        // pastikan user meminjam buku ini
        $loan = Loan::where('book_id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$loan) {
            abort(403, 'Anda tidak memiliki akses untuk membaca buku ini.');
        }

        // ambil path PDF
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

    /**
     * Laporan peminjaman (untuk admin)
     */
    public function laporan()
    {
        $latestLoans = Loan::with(['user', 'book'])
            ->orderBy('loan_date', 'desc')
            ->get();

        return view('admin.laporan', compact('latestLoans'));
    }
   public function updateReview(Request $request, $bookId)
{
    $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'review' => 'nullable|string',
    ]);

    Review::updateOrCreate(
        ['user_id' => Auth::id(), 'book_id' => $bookId],
        ['rating' => $request->rating, 'komentar' => $request->review]
    );

    return back()->with('status', 'Review berhasil disimpan!');
}

    public function extend(Loan $loan)
    {
        // Tambah 7 hari dari tanggal expired sekarang
        $loan->return_date = Carbon::parse($loan->return_date)->addDays(7);
        $loan->save();

        return back()->with('status', 'Masa peminjaman berhasil diperpanjang.');
    }
}
