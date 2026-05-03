<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Trajet;
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

        return view('admin.dashboard', [
            'trajetsCount' => Trajet::query()->count(),
            'reservationsCount' => Reservation::query()->count(),
            'recentReservations' => $recentReservations,
        ]);
    }
}
