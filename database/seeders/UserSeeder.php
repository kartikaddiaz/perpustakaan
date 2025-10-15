<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->upsert([
            [
                'name' => 'User Biasa',
                'email' => 'user@perpus.com',
                'password' => Hash::make('user123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ], ['email']); // unique key email
    }
}
