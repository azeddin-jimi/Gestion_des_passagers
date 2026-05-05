<?php

namespace App\Http\Controllers;

use App\Models\Trajet;
use App\Support\MoroccanCities;
use Illuminate\View\View;

class FooterPageController extends Controller
{
    public function villes(): View
    {
        // Get all cities
    $cities = collect(MoroccanCities::all());
        // Get popular routes (routes with the most reservations)
        $popularRoutes = Trajet::query()
            ->select('departure_city', 'arrival_city')
            ->selectRaw('COUNT(reservations.id) as count')
            ->leftJoin('reservations', 'trajets.id', '=', 'reservations.trajet_id')
            ->groupBy('departure_city', 'arrival_city')
            ->orderByDesc('count')
            ->limit(6)
            ->get();

        return view('pages.villes', [
            'cities' => $cities,
            'popularRoutes' => $popularRoutes,
        ]);
    }

    public function partenaires(): View
    {
        return view('pages.partenaires');
    }

    public function parrainage(): View
    {
        return view('pages.parrainage');
    }

    public function offres(): View
    {
        return view('pages.offres');
    }

    public function mkhyer(): View
    {
        return view('pages.mkhyer');
    }

    public function paiementEnEspeces(): View
    {
        return view('pages.paiement-en-especes');
    }

    public function contactezNous(): View
    {
        return view('pages.contactez-nous');
    }

    public function centreAide(): View
    {
        return view('pages.centre-aide');
    }

    public function confidentialite(): View
    {
        return view('pages.confidentialite');
    }

    public function conditions(): View
    {
        return view('pages.conditions');
    }

    public function carrieres(): View
    {
        return view('pages.carrieres');
    }

    public function blog(): View
    {
        return view('pages.blog');
    }


}
