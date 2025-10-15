<?php

// app/Models/Cart.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'book_id', 'tanggal_pinjam'];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
