<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 👤 Admin (NOT verified)
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrateur',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => null,
            ]
        );

        //  User (verified)
        User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Client Test',
                'password' => Hash::make('password'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]
        );

        //  Trajets
        $this->call([
            TrajetSeeder::class,
        ]);
    }
}