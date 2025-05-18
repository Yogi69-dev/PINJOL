<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'phone' => '081234567890',
            'id_card_number' => '1234567890123456',
            'role' => 'admin', // pastikan kolom 'role' ada di tabel users
        ]);

        // Test user (default sebagai user biasa)
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'), // tambahkan password
            'phone' => '089876543210',
            'id_card_number' => '6543210987654321',
            'role' => 'user', // default role
        ]);
    }
}
