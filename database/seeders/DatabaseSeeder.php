<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // ← ini yang kurang

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'ADMIN',
            'email' => 'Admin@gmail.com',
            'password' => Hash::make('admin12345'), // bisa diganti sesuai kebutuhan
            'role' => 'admin',
        ]);

        // Tambahan user dummy (boleh dihapus kalau tidak perlu)
    //    User::factory()->create([
    // 'name' => 'Test User',
    // 'email' => 'test@example.com',
    // 'email_verified_at' => null, // atau bisa hapus key ini
    // ]);

    }
}
