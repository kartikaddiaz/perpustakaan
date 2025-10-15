<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginAdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\UserDashboardController;


Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserDashboardController::class, 'dashboard'])->name('user.dashboard');
});

Route::get('/admin/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/anggota', [AdminController::class, 'anggotaIndex'])->name('anggota.index');
    Route::get('/anggota/create', [AdminController::class, 'anggotaCreate'])->name('anggota.create');
    Route::post('/anggota/store', [AdminController::class, 'anggotaStore'])->name('anggota.store');
    Route::get('/anggota/{anggota}/edit', [AdminController::class, 'anggotaEdit'])->name('anggota.edit');
    Route::put('/anggota/{anggota}/update', [AdminController::class, 'anggotaUpdate'])->name('anggota.update');
    Route::delete('/anggota/{anggota}/delete', [AdminController::class, 'anggotaDestroy'])->name('anggota.destroy');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/buku', [BookController::class, 'index'])->name('buku.index');
    Route::get('/buku/create', [BookController::class, 'create'])->name('buku.create');
    Route::post('/buku/store', [BookController::class, 'store'])->name('buku.store');
    Route::get('/buku/{id}/edit', [BookController::class, 'edit'])->name('buku.edit');
    Route::put('/buku/{id}', [BookController::class, 'update'])->name('buku.update');
    Route::delete('/buku/{id}', [BookController::class, 'destroy'])->name('buku.destroy');
});

Route::get('/admin/login', [LoginAdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [LoginAdminController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/laporan', [LoanController::class, 'laporan'])->name('admin.laporan');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

Route::middleware(['auth'])->group(function () {
    Route::get('/user/books', [UserDashboardController::class, 'books'])->name('user.books');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
     Route::delete('/cart/remove/{cartId}', [CartController::class, 'remove'])->name('cart.remove');
});

Route::get('/admin/loans/latest', [LoanController::class, 'latest'])->name('admin.loans.latest');
Route::get('/loans/history', [CartController::class, 'history'])->name('loan.user.history');
Route::get('/loan/{book_id}', [LoanController::class, 'create'])->name('book.history');
Route::post('/loan/store', [LoanController::class, 'store'])->name('loan.store');
Route::get('/loan/history/{book_id}', [LoanController::class, 'history'])->name('loan.history');
Route::delete('/loan/remove/{book_id}', [LoanController::class, 'removeBook'])->name('loan.removeBook');

Route::get('/mybooks', [LoanController::class, 'myBooks'])->name('book.mybooks');
Route::get('/book/{id}/read', [LoanController::class, 'readBook'])->name('books.read');



Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');
