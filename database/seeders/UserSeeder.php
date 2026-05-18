<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Akun untuk Daffa (Project Lead)
        User::create([
            'name' => 'Muhammad Daffa Musyafa',
            'email' => 'daffa@cloudrent.com',
            'password' => Hash::make('password123'),
        ]);

        // Akun untuk Hikmah (Frontend Dashboard)
        User::create([
            'name' => 'Nur Hikmah',
            'email' => 'hikmah@cloudrent.com',
            'password' => Hash::make('password123'),
        ]);
    }
}