<?php

namespace Tests\Feature;

use App\Models\Trajet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TrajetSearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_search_filters_by_departure_and_arrival_only(): void
    {
        $matching = Trajet::factory()->create([
            'departure_city' => 'Casablanca',
            'arrival_city' => 'Rabat',
            'date' => now()->addDays(3)->toDateString(),
        ]);

        Trajet::factory()->create([
            'departure_city' => 'Casablanca',
            'arrival_city' => 'Marrakech',
        ]);

        $response = $this->get(route('trajets.search', [
            'departure_city' => 'Casablanca',
            'arrival_city' => 'Rabat',
        ]));

        $response->assertOk();
        $response->assertSee($matching->departure_city);
        $response->assertSee($matching->arrival_city);
    }

    public function test_search_can_filter_by_optional_date(): void
    {
        Trajet::factory()->create([
            'departure_city' => 'Tangier',
            'arrival_city' => 'Fes',
            'date' => now()->addDays(2)->toDateString(),
        ]);

        Trajet::factory()->create([
            'departure_city' => 'Tangier',
            'arrival_city' => 'Fes',
            'date' => now()->addDays(8)->toDateString(),
        ]);

        $response = $this->get(route('trajets.search', [
            'departure_city' => 'Tangier',
            'arrival_city' => 'Fes',
            'date' => now()->addDays(2)->toDateString(),
        ]));

        $response->assertOk();
        $response->assertSeeText((string) now()->addDays(2)->format('d/m/Y'));
        $response->assertDontSeeText((string) now()->addDays(8)->format('d/m/Y'));
    }
}
