<?php

namespace Database\Seeders;

use App\Models\Trajet;
use App\Support\MoroccanCities;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TrajetSeeder extends Seeder
{
    public function run(): void
    {
        $coreRoutes = [
            ['Casablanca', 'Rabat'],
            ['Rabat', 'Casablanca'],
            ['Casablanca', 'Marrakech'],
            ['Marrakech', 'Casablanca'],
            ['Agadir', 'Marrakech'],
            ['Tangier', 'Fes'],
            ['Fes', 'Oujda'],
            ['Meknes', 'Tetouan'],
            ['Laayoune', 'Dakhla'],
            ['Taroudant', 'Agadir'],
            ['Taroudant', 'Casablanca'],
            ['Taroudant', 'Marrakech'],
        ];

        foreach ($coreRoutes as $i => $route) {
            Trajet::create([
                'departure_city' => $route[0],
                'arrival_city' => $route[1],
                'date' => Carbon::now()->addDays(($i % 14) + 1)->toDateString(),
                'time' => sprintf('%02d:%02d', random_int(6, 21), random_int(0, 1) ? 0 : 30),
                'price' => random_int(70, 320),
                'seats_available' => random_int(8, 52),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $cities = MoroccanCities::all();

        for ($i = 0; $i < 80; $i++) {
            $departure = fake()->randomElement($cities);
            $arrival = fake()->randomElement(array_values(array_diff($cities, [$departure])));

            Trajet::create([
                'departure_city' => $departure,
                'arrival_city' => $arrival,
                'date' => Carbon::now()->addDays(random_int(1, 40))->toDateString(),
                'time' => sprintf('%02d:%02d', random_int(6, 22), random_int(0, 1) ? 0 : 30),
                'price' => random_int(65, 420),
                'seats_available' => random_int(5, 56),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}