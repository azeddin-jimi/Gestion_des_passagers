<?php

namespace App\Http\Controllers;

use App\Models\Trajet;
use App\Support\MoroccanCities;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredTrajets = Trajet::query()
            ->where('seats_available', '>', 0)
            ->whereDate('date', '>=', now()->toDateString())
            ->orderBy('date')
            ->orderBy('time')
            ->limit(6)
            ->get();

        return view('home', [
            'cities' => MoroccanCities::all(),
            'featuredTrajets' => $featuredTrajets,
        ]);
    }
}
