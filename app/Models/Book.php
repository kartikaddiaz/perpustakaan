<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Favorite;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $fillable = [
        'kode_buku',
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'deskripsi',
        'cover',
        'pdf_path',
        'is_favorite'
    ];

    public function favorites()
{
    return $this->hasMany(Favorite::class);
}
}

