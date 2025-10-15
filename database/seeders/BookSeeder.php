<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    public function run()
    {
        DB::table('books')->upsert([
            [
                'cover' => 'hello-cello.jpeg',
                'judul' => 'Hello, Cello',
                'kode_buku' => 'BK001',
                'penerbit' => 'Bukune',
                'penulis' => 'Nadia Ristivani',
                'tahun_terbit' => 2022,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [   
                'cover' => 'hilmy-milan.jpeg',
                'judul' => 'Hilmy Milan',
                'kode_buku' => 'BK002',
                'penerbit' => 'Bukune',
                'penulis' => 'Nadia Ristivani',
                'tahun_terbit' => 2021,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cover' => 'alster-lake.jpeg',
                'judul' => 'Alster Lake',
                'kode_buku' => 'BK003',
                'penerbit' => 'Bukune',
                'penulis' => 'Auryn Vientania',
                'tahun_terbit' => 2021,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cover' => 'lotus-in-the-mud.jpeg',
                'judul' => 'Lotus In The Mud',
                'kode_buku' => 'BK004',
                'penerbit' => 'id.akad',
                'penulis' => 'Annelie Vienrose',
                'tahun_terbit' => 2022,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cover' => 'amarabel.jpg',
                'judul' => 'Butterflies',
                'kode_buku' => 'BK005',
                'penerbit' => 'Nexterday Publisher',
                'penulis' => 'Alesacakes',
                'tahun_terbit' => 2021,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ], ['kode_buku']); // 'kode_buku' sebagai key unik untuk upsert
    }
}
