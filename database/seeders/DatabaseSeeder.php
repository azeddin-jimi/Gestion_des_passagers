<?php

namespace Database\Seeders;

use App\Models\Reservation;
use App\Models\Trajet;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrateur',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
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

        // Trajets
        $this->call([
            TrajetSeeder::class,
        ]);

        // Extra users + realistic reservations
        User::factory(20)->create();

        $trajets = Trajet::query()->inRandomOrder()->limit(30)->get();
        $users = User::query()->where('role', User::ROLE_USER)->inRandomOrder()->limit(12)->get();

        foreach ($trajets as $trajet) {
            $reservationCount = random_int(0, 4);

            for ($i = 0; $i < $reservationCount; $i++) {
                $seats = random_int(1, 3);
                if ($trajet->seats_available <= 0) {
                    break;
                }

                $seats = min($seats, $trajet->seats_available);
                $selectedUser = $users->random();

                Reservation::create([
                    'user_id' => $selectedUser->id,
                    'trajet_id' => $trajet->id,
                    'name' => $selectedUser->name,
                    'phone' => fake()->phoneNumber(),
                    'seats_reserved' => $seats,
                    'created_at' => now()->subDays(random_int(0, 20)),
                    'updated_at' => now(),
                ]);

                $trajet->decrement('seats_available', $seats);
            }
        }
    }
}