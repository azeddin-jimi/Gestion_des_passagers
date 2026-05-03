<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Trajet;
use Carbon\Carbon;

class TrajetSeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            ['Agadir', 'Casablanca'],
            ['Marrakech', 'Rabat'],
            ['Tanger', 'Fes'],
            ['Oujda', 'Casablanca'],
            ['Agadir', 'Marrakech'],
            ['Rabat', 'Tanger'],
            ['Fes', 'Meknes'],
            ['Casablanca', 'Essaouira'],
            ['Agadir', 'Essaouira'],
            ['Marrakech', 'Fes'],
            ['Taroudant', 'Agadir'],   
            ['Taroudant', 'Marrakech'], 
            ['Taroudant', 'Casablanca'] 
        ];

        foreach ($cities as $i => $city) {
            Trajet::create([
                'departure_city' => $city[0],
                'arrival_city' => $city[1],
                'date' => Carbon::now()->addDays($i + 1)->toDateString(),
                'time' => '08:00',
                'price' => rand(80, 300),
                'seats_available' => rand(10, 50),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}