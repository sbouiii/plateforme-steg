<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admins')->insert([
            'email' => 'admin@example.com', // Changez cet email si nécessaire
            'password' => Hash::make('password123'), // Changez le mot de passe si nécessaire
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
