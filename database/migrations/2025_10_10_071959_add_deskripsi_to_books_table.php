<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeskripsiToBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function (Blueprint $table) {
            // Menambahkan kolom 'deskripsi' bertipe text
            $table->text('deskripsi')->nullable(); // Nullable artinya bisa kosong
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books', function (Blueprint $table) {
            // Menghapus kolom 'deskripsi' saat rollback
            $table->dropColumn('deskripsi');
        });
    }
}
