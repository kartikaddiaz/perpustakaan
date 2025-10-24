<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $table = 'categories';
    protected $fillable = ['name']; // cukup satu kolom: nama kategori

    // Relasi: satu kategori bisa punya banyak buku
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
