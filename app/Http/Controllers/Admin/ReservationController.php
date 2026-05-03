<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function index(): View
    {
        $reservations = Reservation::query()
            ->with(['trajet', 'user'])
            ->latest()
            ->paginate(20);

        return view('admin.reservations.index', compact('reservations'));
    }
}
