<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Panggil ProductSeeder
        $this->call([
            ProductSeeder::class,
        ]);

        // 2. Buat User (dengan tambahan 'username')
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'username' => 'testuser', // <-- TAMBAHKAN BARIS INI
        ]);
    }
}