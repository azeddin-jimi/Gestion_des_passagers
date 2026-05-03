<?php

namespace Database\Factories;

use App\Models\Trajet;
use App\Support\MoroccanCities;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Trajet>
 */
class TrajetFactory extends Factory
{
    protected $model = Trajet::class;

    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cities = MoroccanCities::all();
        $departure = fake()->randomElement($cities);
        $arrival = fake()->randomElement(array_values(array_diff($cities, [$departure])));

        return [
            'departure_city' => $departure,
            'arrival_city' => $arrival,
            'date' => fake()->dateTimeBetween('now', '+45 days')->format('Y-m-d'),
            'time' => fake()->time('H:i'),
            'price' => fake()->randomFloat(2, 49, 499),
            'seats_available' => fake()->numberBetween(8, 55),
        ];
    }
}
