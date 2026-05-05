<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Reservation;
use App\Models\Trajet;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $recentReservations = Reservation::query()
            ->with(['trajet', 'user', 'payment'])
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

        // Format chart labels and totals
        $chartLabels = $reservationsByRoute->map(function ($route) {
            return $route->departure_city . ' → ' . $route->arrival_city;
        })->toArray();

        $popularRouteTotals = $reservationsByRoute->pluck('total')->toArray();

        $totalRevenue = \App\Models\Payment::where('status', 'paid')->sum('amount');

        $chartData = [
            'labels' => ['Utilisateurs', 'Trajets', 'Réservations'],
            'datasets' => [
                [
                    'data' => [
                        User::query()->count(),
                        Trajet::query()->count(),
                        Reservation::query()->count()
                    ],
                    'backgroundColor' => ['#3B82F6', '#10B981', '#F59E0B']
                ]
            ]
        ];

        return view('admin.dashboard', [
            'usersCount' => User::query()->count(),
            'trajetsCount' => Trajet::query()->count(),
            'reservationsCount' => Reservation::query()->count(),
            'totalRevenue' => $totalRevenue,
            'recentReservations' => $recentReservations,
            'reservationsByRoute' => $reservationsByRoute,
            'chartLabels' => $chartLabels,
            'popularRouteTotals' => $popularRouteTotals,
            'chartData' => $chartData,
        ]);
    }
}
