<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    // Tambah atau hapus dari favorit
    public function toggle($bookId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $book = Book::findOrFail($bookId);

        $favorite = Favorite::where('user_id', Auth::id())
                    ->where('book_id', $bookId)
                    ->first();

        if ($favorite) {
            $favorite->delete();
            return back()->with('success', '📕 Buku dihapus dari daftar favorit.');
        } else {
            Favorite::create([
                'user_id' => Auth::id(),
                'book_id' => $book->id,
                'judul' => $book->judul,
                'penulis' => $book->penulis,
                'cover' => $book->cover,
            ]);
            return back()->with('success', '💖 Buku ditambahkan ke daftar favorit.');
        }
    }

   public function index()
{
    $favorites = \App\Models\Favorite::where('user_id', Auth::id())->get();
    return view('book.favorite', compact('favorites'));
}

}
