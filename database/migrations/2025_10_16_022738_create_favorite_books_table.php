<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('favorites', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id');
    $table->unsignedBigInteger('book_id');
    $table->string('judul');
    $table->string('penulis')->nullable();
    $table->string('cover')->nullable();
    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
});

    }

    public function down(): void
    {
        Schema::dropIfExists('favorite_books');
    }
};
