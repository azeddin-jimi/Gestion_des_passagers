<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchTrajetsRequest;
use App\Models\Trajet;
use Illuminate\View\View;

class TrajetSearchController extends Controller
{
    public function index(SearchTrajetsRequest $request): View
    {
        $data = $request->validated();

        $trajets = Trajet::query()
            ->fromCity($data['departure_city'])
            ->toCity($data['arrival_city'])
            ->where('seats_available', '>', 0)
            ->orderBy('date')
            ->orderBy('time')
            ->paginate(12)
            ->withQueryString();

        return view('trajets.search-results', [
            'trajets' => $trajets,
            'departure_city' => $data['departure_city'],
            'arrival_city' => $data['arrival_city'],
        ]);
    }
}
