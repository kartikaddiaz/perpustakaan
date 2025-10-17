<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Cart;
use App\Models\Loan;
use App\Models\Favorite;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // 🔹 Relasi ke tabel carts
    public function carts()
{
    return $this->hasMany(\App\Models\Cart::class, 'user_id');
}

    // 🔹 Relasi ke tabel loans
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function favorites()
{
    return $this->hasMany(Favorite::class);
}

}
