<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Cart;
use App\Models\Loan;

class CartController extends Controller
{
    // Tampilkan keranjang
    public function index()
    {
        $cart = \App\Models\Cart::with('book')  // Relasi ke model Book
            ->where('user_id', Auth::id())      // Mengambil hanya cart untuk user yang sedang login
            ->get();

        return view('cart.index', compact('cart'));
    }

    // Tambah buku ke keranjang
   public function add($id)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
    }

    $book = Book::findOrFail($id);
    $user = Auth::user();

    // Cegah duplikat
    $exists = Cart::where('user_id', $user->id)
                  ->where('book_id', $book->id)
                  ->exists();

    if ($exists) {
        return redirect()->route('cart.index')->with('info', 'Buku ini sudah ada di keranjang kamu.');
    }

    // Tambah ke keranjang
    Cart::create([
        'user_id' => $user->id,
        'book_id' => $book->id,
    ]);

    // ⬅️ Setelah tambah, pindah ke halaman keranjang
    return redirect()->route('cart.index')->with('success', 'Buku berhasil ditambahkan ke keranjang!');
}

    // Hapus buku dari keranjang
    public function remove($cartId)
{
    Cart::where('id', $cartId)
        ->where('user_id', Auth::id())
        ->delete();

    return back()->with('success', 'Buku berhasil dihapus dari keranjang!');
}

   public function checkout()
{
    $user = Auth::user();
    $cartItems = Cart::with('book')->where('user_id', $user->id)->get();

    if ($cartItems->isEmpty()) {
        return back()->with('success', 'Keranjang masih kosong.');
    }

    $loanDate = now();
    $returnDate = now()->addDays(7);

    foreach ($cartItems as $item) {
        Loan::create([
            'user_id' => $user->id,
            'book_id' => $item->book->id,
            'book_name' => $item->book->judul,
            'loan_date' => $loanDate,
            'return_date' => $returnDate,
            'cover' => $item->book->cover,
        ]);
    }

    Cart::where('user_id', $user->id)->delete();

    return back()->with('success', 'Peminjaman berhasil!');
}
    // Riwayat peminjaman
    public function history()
    {
        $user = Auth::user();
        $loans = Loan::with('book')->where('user_id', $user->id)->get();
        return view('cart.history', compact('loans', 'user'));
    }
}
