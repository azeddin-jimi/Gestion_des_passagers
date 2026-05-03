<?php

namespace App\Http\Controllers;

use App\Models\Trajet;
use Illuminate\Http\JsonResponse;

class TrajetAvailabilityController extends Controller
{
    public function __invoke(Trajet $trajet): JsonResponse
    {
        $trajet->refresh();

        return response()->json([
            'seats_available' => $trajet->seats_available,
            'bookable' => $trajet->isBookable(),
        ]);
    }
}
