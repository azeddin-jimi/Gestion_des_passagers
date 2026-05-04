<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Trajet;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $recentReservations = Reservation::query()
            ->with(['trajet', 'user'])
            ->latest()
            ->limit(8)
            ->get();

        $reservationsByRoute = Reservation::query()
            ->selectRaw('trajets.departure_city, trajets.arrival_city, COUNT(reservations.id) as total')
            ->join('trajets', 'trajets.id', '=', 'reservations.trajet_id')
            ->groupBy('trajets.departure_city', 'trajets.arrival_city')
            ->orderByDesc('total')
            ->limit(6)
            ->get();

        return view('admin.dashboard', [
            'usersCount' => User::query()->count(),
            'trajetsCount' => Trajet::query()->count(),
            'reservationsCount' => Reservation::query()->count(),
            'recentReservations' => $recentReservations,
            'reservationsByRoute' => $reservationsByRoute,
        ]);
    }
}
