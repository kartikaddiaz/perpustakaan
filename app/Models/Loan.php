<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id',
    'book_id',
    'book_name',
    'loan_date',
    'return_date',
    'status',
    'quantity',
];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // app/Models/Loan.php
public function review()
{
    return $this->hasOne(\App\Models\Review::class, 'loan_id');
}

}
