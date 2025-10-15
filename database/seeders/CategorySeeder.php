<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tabel categories.
     */
    public function run(): void
    {
        $categories = [
            'Sastra',
            'Teknologi',
            'Sains',
            'Sejarah',
            'Novel',
        ];

        foreach ($categories as $nama) {
            Category::create(['nama' => $nama]);
        }
    }
}
